<?php

namespace App\Http\Controllers;

use App\Models\CorporateCalculation;
use Illuminate\Http\Request;

class PaymentCorporateController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'calculation_id'   => 'required|exists:corporate_calculations,id',
            'total_amount'     => 'required|numeric',
            'maintenance_amt'  => 'required|numeric',
            'payment_scheme'   => 'required|in:annual,semi_annual,quarterly',
            'offset_program'   => 'required|array|min:1',
            'offset_program.*' => 'required|string',
            'payment_method'   => 'required|in:bank_transfer,e_wallet,virtual_account',
            'agreement'        => 'required|accepted',
        ], [
            'offset_program.required' => 'Pilih minimal 1 program alokasi dana restorasi.',
            'offset_program.min'      => 'Pilih minimal 1 program alokasi dana restorasi.',
            'payment_method.required' => 'Pilih metode pembayaran.',
            'agreement.required'      => 'Anda harus menyetujui pernyataan di atas.',
            'agreement.accepted'      => 'Anda harus menyetujui pernyataan di atas.',
        ]);

        $calculation = CorporateCalculation::findOrFail($request->calculation_id);

        // Hitung installment amounts berdasarkan skema
        $installRates = ['annual' => 1.0, 'semi_annual' => 0.55, 'quarterly' => 0.30];
        $installNums  = ['annual' => 1,   'semi_annual' => 2,    'quarterly' => 4];
        $scheme       = $request->payment_scheme;
        $instAmt      = $request->total_amount * ($installRates[$scheme] ?? 1.0);

        // Update calculation dengan payment scheme yang dipilih
        $calculation->update([
            'payment_scheme'         => $scheme,
            'payment_cycles'         => $installNums[$scheme] ?? 1,
            'compensation_per_cycle' => $instAmt,
            'status'                 => 'active',
        ]);

        // Simpan data payment ke session
        session([
            'payment_review_' . $calculation->id => [
                'total_amount'    => $request->total_amount,
                'maintenance_amt' => $request->maintenance_amt,
                'payment_scheme'  => $scheme,
                'offset_program'  => $request->offset_program,
                'payment_method'  => $request->payment_method,
                'pic_name'        => $request->pic_name     ?? $calculation->pic_name,
                'pic_position'    => $request->pic_position ?? $calculation->pic_position,
                'pic_email'       => $request->pic_email    ?? $calculation->pic_email,
                'pic_phone'       => $request->pic_phone    ?? $calculation->pic_phone,
            ]
        ]);

        return redirect()->route('payment.corporate.review', $calculation->id)
            ->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
}