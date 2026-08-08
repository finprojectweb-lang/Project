<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'accepted',
            'account_type' => 'nullable|in:individu,perusahaan',
            'company_name' => 'required_if:account_type,perusahaan|nullable|string|max:255',
            'company_npwp' => 'required_if:account_type,perusahaan|nullable|string|max:50',
        ], [
            'name.required' => 'Nama lengkap harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar. Silakan login atau gunakan email lain.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan.',
            'company_name.required_if' => 'Nama perusahaan harus diisi.',
            'company_npwp.required_if' => 'NPWP / No. Registrasi Usaha harus diisi.',
        ]);

        $accountType = $validated['account_type'] ?? 'individu';

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'account_type' => $accountType,
            'company_name' => $validated['company_name'] ?? null,
            'company_npwp' => $validated['company_npwp'] ?? null,
        ]);

        Auth::login($user);

        // Redirect: individu -> home, perusahaan -> homeperusahaan
        return redirect()->route($user->homeRouteName())
            ->with('success', 'Akun berhasil dibuat! Selamat datang, ' . $user->name . '!');
    }
}