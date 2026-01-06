<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarbonCalculation;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $carbonAmount = $request->query('carbon_amount', 0);
        $type = $request->query('type', 'general');
        
        $subtotal = $carbonAmount * 15000;
        $adminFee = 5000;
        $totalAmount = $subtotal + $adminFee;
        
        return view('payment', [
            'carbonAmount' => $carbonAmount,
            'calculatorType' => $type,
            'rate' => 15000,
            'subtotal' => $subtotal,
            'adminFee' => $adminFee,
            'totalAmount' => $totalAmount,
            'period' => 'Monthly'
        ]);
    }

    public function process(Request $request)
    {
        Log::info('=== PAYMENT PROCESS STARTED ===');
        Log::info('User ID: ' . Auth::id());
        Log::info('Request Data:', $request->all());
        
        try {
            // Validasi input
            $validated = $request->validate([
                'carbon_amount' => 'required|numeric|min:0',
                'total_amount' => 'required|numeric|min:0',
                'calculator_type' => 'required|string',
                'offset_program' => 'required|in:water_turbine,mangrove,waste_recycle,coral_reef',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'payment_method' => 'required|in:bank_transfer,e_wallet,credit_card',
                'agreement' => 'accepted'
            ]);
            
            Log::info('✅ Validation passed');

            DB::beginTransaction();
            
            try {
                // 1. Simpan Carbon Calculation
                $carbonData = session('carbonData');
                if (is_string($carbonData)) {
                    $carbonData = json_decode($carbonData, true);
                }
                
                Log::info('Carbon Data from session:', ['data' => $carbonData]);
                
                $carbonCalculation = CarbonCalculation::create([
                    'user_id' => Auth::id(),
                    'type' => $validated['calculator_type'],
                    'carbon_amount' => $validated['carbon_amount'],
                    'price' => $validated['total_amount'],
                    'price_per_kg' => 15000,
                    'details' => $carbonData['details'] ?? [],
                    'plastic_eq' => $carbonData['plasticEq'] ?? 0,
                    'tree_eq' => $carbonData['treeEq'] ?? 0,
                    'coral_eq' => $carbonData['coralEq'] ?? 0,
                ]);
                
                Log::info('✅ Carbon calculation created', ['id' => $carbonCalculation->id]);

                // 2. Simpan Payment
                $subtotal = $validated['carbon_amount'] * 15000;
                $adminFee = 5000;
                
                $payment = Payment::create([
                    'user_id' => Auth::id(),
                    'carbon_calculation_id' => $carbonCalculation->id,
                    'order_id' => Payment::generateOrderId(),
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'carbon_amount' => $validated['carbon_amount'],
                    'subtotal' => $subtotal,
                    'admin_fee' => $adminFee,
                    'total_amount' => $validated['total_amount'],
                    'offset_program' => $validated['offset_program'],
                    'payment_method' => $validated['payment_method'],
                    'calculator_type' => $validated['calculator_type'],
                    'status' => 'pending'
                ]);
                
                Log::info('✅ Payment created', ['id' => $payment->id, 'order_id' => $payment->order_id]);

                DB::commit();
                
                Log::info('✅ Transaction committed');

                // Clear session data
                session()->forget('carbonData');
                
                Log::info('Redirecting to success page', ['payment_id' => $payment->id]);

                // Redirect ke success page
                return redirect()->route('payment.success', ['payment' => $payment->id])
                    ->with('success', 'Payment initiated successfully!');
                
            } catch (\Exception $e) {
                DB::rollBack();
                
                Log::error('❌ Database error:', [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
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
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()
                ->withErrors(['error' => 'An unexpected error occurred: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function success($paymentId)
{
    try {
        $payment = Payment::with('carbonCalculation')->findOrFail($paymentId);
        
        // Cek authorization
        if (Auth::check() && $payment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }
        
        Log::info('✅ Success page loaded', ['payment_id' => $paymentId]);
        
        // Prepare payment data for view
        $paymentData = [
            'order_id' => $payment->order_id,
            'name' => $payment->name,
            'email' => $payment->email,
            'phone' => $payment->phone,
            'carbon_amount' => $payment->carbon_amount,
            'offset_program' => $payment->offset_program,
            'payment_method' => $payment->payment_method,
            'total_amount' => $payment->total_amount,
            'subtotal' => $payment->subtotal,
            'admin_fee' => $payment->admin_fee,
            'status' => $payment->status,
        ];
        
        return view('payment.success', compact('payment', 'paymentData'));
        
    } catch (\Exception $e) {
        Log::error('❌ Error loading success page:', [
            'payment_id' => $paymentId,
            'error' => $e->getMessage()
        ]);
        
        return redirect()->route('dashboard')
            ->with('error', 'Payment not found');
    }
}
}