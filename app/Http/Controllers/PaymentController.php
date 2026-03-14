<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarbonCalculation;
use App\Models\CorporateCalculation;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // Konstanta tarif
    const RATE_PER_KG  = 15000; // Rp per kg CO2
    const TAX_PER_KG   = 30;    // Rp pajak per kg CO2
    const ADMIN_FEE    = 5000;  // Rp admin fee flat

    // ── Corporate Calculator ─────────────────────────────────────────────────
    public function create($calculationId)
    {
        try {
            $calculation = CorporateCalculation::findOrFail($calculationId);

            $carbonAmount = $calculation->total_emission / 1000; // kg
            $subtotal     = $calculation->total_emission * self::RATE_PER_KG;
            $tax          = round($calculation->total_emission * self::TAX_PER_KG);
            $adminFee     = self::ADMIN_FEE;
            $totalAmount  = $subtotal + $tax + $adminFee;

            return view('payment.corporate', [
                'calculation'    => $calculation,
                'carbonAmount'   => $carbonAmount,
                'calculatorType' => 'corporate',
                'rate'           => self::RATE_PER_KG,
                'taxRate'        => self::TAX_PER_KG,
                'subtotal'       => $subtotal,
                'tax'            => $tax,
                'adminFee'       => $adminFee,
                'totalAmount'    => $totalAmount,
                'period'         => 'Year ' . $calculation->calculation_year,
            ]);

        } catch (\Exception $e) {
            Log::error('Error loading corporate payment:', [
                'calculation_id' => $calculationId,
                'error'          => $e->getMessage(),
            ]);

            return redirect()->route('calc.corporate.index')
                ->with('error', 'Calculation not found');
        }
    }

    // ── General Calculator (index) ────────────────────────────────────────────
    public function index(Request $request)
    {
        $carbonAmount = (float) $request->query('carbon_amount', 0);
        $type         = $request->query('type', 'general');

        $subtotal    = $carbonAmount * self::RATE_PER_KG;
        $tax         = round($carbonAmount * self::TAX_PER_KG);
        $adminFee    = self::ADMIN_FEE;
        $totalAmount = $subtotal + $tax + $adminFee;

        return view('payment', [
            'carbonAmount'   => $carbonAmount,
            'calculatorType' => $type,
            'rate'           => self::RATE_PER_KG,
            'taxRate'        => self::TAX_PER_KG,
            'subtotal'       => $subtotal,
            'tax'            => $tax,
            'adminFee'       => $adminFee,
            'totalAmount'    => $totalAmount,
            'period'         => 'Weekly',
        ]);
    }

    // ── Process Payment ───────────────────────────────────────────────────────
    public function process(Request $request)
    {
        Log::info('=== PAYMENT PROCESS STARTED ===');
        Log::info('User ID: ' . Auth::id());
        Log::info('Request Data:', $request->all());

        try {
            $validated = $request->validate([
                'carbon_amount'    => 'required|numeric|min:0',
                'total_amount'     => 'required|numeric|min:0',
                'tax'              => 'nullable|numeric|min:0',
                'calculator_type'  => 'required|string',
                'offset_program'   => 'required|array|min:1',
                'offset_program.*' => 'in:water_turbine,mangrove,waste_recycle,coral_reef',
                'name'             => 'required|string|max:255',
                'email'            => 'required|email|max:255',
                'phone'            => 'required|string|max:20',
                'payment_method'   => 'required|in:bank_transfer,e_wallet,credit_card',
                'agreement'        => 'accepted',
                'calculation_id'   => 'nullable|exists:corporate_calculations,id',
            ]);

            Log::info('✅ Validation passed');

            // Hitung ulang di server agar tidak bisa dimanipulasi dari client
            $carbonAmount      = (float) $validated['carbon_amount'];
            $subtotal          = $carbonAmount * self::RATE_PER_KG;
            $tax               = round($carbonAmount * self::TAX_PER_KG);
            $adminFee          = self::ADMIN_FEE;
            $totalAmount       = $subtotal + $tax + $adminFee;

            $programCount      = count($validated['offset_program']);
            $splitAmount       = round($totalAmount / $programCount, 2);
            $offsetProgramJson = json_encode($validated['offset_program']);

            DB::beginTransaction();

            try {
                // Handle calculation record
                if ($validated['calculator_type'] === 'corporate' && isset($validated['calculation_id'])) {
                    $carbonCalculationId    = null;
                    $corporateCalculationId = $validated['calculation_id'];

                } else {
                    $carbonData = session('carbonData');
                    if (is_string($carbonData)) {
                        $carbonData = json_decode($carbonData, true);
                    }

                    Log::info('Carbon Data from session:', ['data' => $carbonData]);

                    $carbonCalculation = CarbonCalculation::create([
                        'user_id'       => Auth::id(),
                        'type'          => $validated['calculator_type'],
                        'carbon_amount' => $carbonAmount,
                        'price'         => $totalAmount,
                        'price_per_kg'  => self::RATE_PER_KG,
                        'details'       => $carbonData['details'] ?? [],
                        'plastic_eq'    => $carbonData['plasticEq'] ?? 0,
                        'tree_eq'       => $carbonData['treeEq'] ?? 0,
                        'coral_eq'      => $carbonData['coralEq'] ?? 0,
                    ]);

                    Log::info('✅ Carbon calculation created', ['id' => $carbonCalculation->id]);

                    $carbonCalculationId    = $carbonCalculation->id;
                    $corporateCalculationId = null;
                }

                // Simpan payment
                $payment = Payment::create([
                    'user_id'                  => Auth::id(),
                    'carbon_calculation_id'    => $carbonCalculationId,
                    'corporate_calculation_id' => $corporateCalculationId,
                    'order_id'                 => Payment::generateOrderId(),
                    'name'                     => $validated['name'],
                    'email'                    => $validated['email'],
                    'phone'                    => $validated['phone'],
                    'carbon_amount'            => $carbonAmount,
                    'subtotal'                 => $subtotal,
                    'tax'                      => $tax,
                    'admin_fee'                => $adminFee,
                    'total_amount'             => $totalAmount,
                    'offset_program'           => $offsetProgramJson,
                    'program_count'            => $programCount,
                    'split_amount'             => $splitAmount,
                    'payment_method'           => $validated['payment_method'],
                    'calculator_type'          => $validated['calculator_type'],
                    'status'                   => 'pending',
                ]);

                Log::info('✅ Payment created', ['id' => $payment->id, 'order_id' => $payment->order_id]);

                DB::commit();
                Log::info('✅ Transaction committed');

                session()->forget('carbonData');

                return redirect()->route('payment.success', ['payment' => $payment->id])
                    ->with('success', 'Payment initiated successfully!');

            } catch (\Exception $e) {
                DB::rollBack();

                Log::error('❌ Database error:', [
                    'message' => $e->getMessage(),
                    'file'    => $e->getFile(),
                    'line'    => $e->getLine(),
                    'trace'   => $e->getTraceAsString(),
                ]);

                return back()
                    ->withErrors(['error' => 'Database error: ' . $e->getMessage()])
                    ->withInput();
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('❌ Validation error:', ['errors' => $e->errors()]);

            return back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (\Exception $e) {
            Log::error('❌ Unexpected error:', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString(),
            ]);

            return back()
                ->withErrors(['error' => 'An unexpected error occurred: ' . $e->getMessage()])
                ->withInput();
        }
    }

    // ── Success Page ──────────────────────────────────────────────────────────
    public function success($paymentId)
    {
        try {
            $payment = Payment::with(['carbonCalculation', 'corporateCalculation'])->findOrFail($paymentId);

            if (Auth::check() && $payment->user_id !== Auth::id()) {
                abort(403, 'Unauthorized access');
            }

            Log::info('✅ Success page loaded', ['payment_id' => $paymentId]);

            $offsetPrograms = json_decode($payment->offset_program, true) ?? [];
            $programCount   = count($offsetPrograms);
            $splitAmount    = $programCount > 0
                ? round($payment->total_amount / $programCount, 2)
                : $payment->total_amount;

            $programLabels = [
                'water_turbine' => ['label' => 'Water Turbine Development', 'icon' => '💧'],
                'mangrove'      => ['label' => 'Mangrove Planting',         'icon' => '🌿'],
                'waste_recycle' => ['label' => 'Waste Recycling Program',   'icon' => '♻️'],
                'coral_reef'    => ['label' => 'Coral Reef Restoration',    'icon' => '🪸'],
            ];

            $paymentData = [
                'order_id'        => $payment->order_id,
                'name'            => $payment->name,
                'email'           => $payment->email,
                'phone'           => $payment->phone,
                'carbon_amount'   => $payment->carbon_amount,
                'offset_programs' => $offsetPrograms,
                'program_labels'  => $programLabels,
                'split_amount'    => $splitAmount,
                'program_count'   => $programCount,
                'payment_method'  => $payment->payment_method,
                'total_amount'    => $payment->total_amount,
                'subtotal'        => $payment->subtotal,
                'tax'             => $payment->tax ?? 0,
                'tax_rate'        => self::TAX_PER_KG,
                'admin_fee'       => $payment->admin_fee,
                'status'          => $payment->status,
            ];

            return view('payment.success', compact('payment', 'paymentData'));

        } catch (\Exception $e) {
            Log::error('❌ Error loading success page:', [
                'payment_id' => $paymentId,
                'error'      => $e->getMessage(),
            ]);

            return redirect()->route('dashboard')
                ->with('error', 'Payment not found');
        }
    }
}