<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password harus diisi.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak terdaftar. Silakan daftar terlebih dahulu.',
            ])->withInput($request->only('email'));
        }

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Cek apakah ada intended URL (URL yang dicoba diakses sebelum login)
            if ($request->session()->has('url.intended')) {
                $intendedUrl = $request->session()->get('url.intended');
                $request->session()->forget('url.intended');
                return redirect($intendedUrl)->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
            }
            
            // Cek apakah ada parameter redirect dari query string
            if ($request->has('redirect')) {
                return redirect($request->input('redirect'))->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
            }
            
            // Default redirect ke home jika tidak ada intended URL
            return redirect()->route('home')->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
        }

        return back()->withErrors([
            'password' => 'Password yang Anda masukkan salah.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect ke home (bukan /)
        return redirect()->route('home')->with('success', 'Anda berhasil logout.');
    }
}