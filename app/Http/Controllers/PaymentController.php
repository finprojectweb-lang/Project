<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Tampilkan halaman payment
     */
    public function show(Request $request)
    {
        $carbonAmount = $request->query('carbon_amount', 0);
        $calculatorType = $request->query('type', 'general');
        
        if ($carbonAmount <= 0) {
            return redirect()->back()
                ->with('error', 'Silakan hitung emisi karbon terlebih dahulu');
        }
        
        $rate = 15000;
        $subtotal = $carbonAmount * $rate;
        $adminFee = 5000;
        $totalAmount = $subtotal + $adminFee;
        
        $periodMap = [
            'housing' => 'Monthly',
            'transportation' => 'Per Trip',
            'food' => 'Monthly',
            'expenditure' => 'Monthly'
        ];
        $period = $periodMap[$calculatorType] ?? 'Monthly';
        
        return view('pages.payment', compact(
            'carbonAmount',
            'calculatorType',
            'rate',
            'subtotal',
            'adminFee',
            'totalAmount',
            'period'
        ));
    }

    /**
     * Proses payment
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'offset_program' => 'required|in:water_turbine,mangrove,waste_recycle,coral_reef',
            'calculator_type' => 'nullable|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|in:bank_transfer,e_wallet,credit_card',
            'carbon_amount' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'agreement' => 'required|accepted',
        ]);

        $orderId = 'NC-' . strtoupper(uniqid());
        
        $paymentData = [
            'order_id' => $orderId,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'offset_program' => $validated['offset_program'],
            'calculator_type' => $validated['calculator_type'] ?? 'general',
            'carbon_amount' => $validated['carbon_amount'],
            'total_amount' => $validated['total_amount'],
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
            'created_at' => now()->format('d M Y, H:i')
        ];
        
        session()->put('payment_data', $paymentData);
        session()->flash('success', true);
        
        return redirect()->route('payment.success');
    }

    /**
     * Halaman sukses pembayaran
     */
    public function success()
{
    if (!session()->has('success')) {
        return redirect('/')->with('error', 'Invalid access');
    }
    
    $paymentData = session()->get('payment_data');
    
    // Pilih salah satu sesuai lokasi file Anda:
    
    // Jika di resources/views/pages/payment/success.blade.php
    return view('payment.success', compact('paymentData'));
    
    // ATAU jika di resources/views/payment/success.blade.php
    // return view('payment.success', compact('paymentData'));
    }
}