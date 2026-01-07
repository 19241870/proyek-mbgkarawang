<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Logika bypass untuk kebutuhan presentasi/demonstrasi
        session([
            'role' => 'pemerintah',
            'is_logged_in' => true,
            'user_name' => 'Administrator Pusat'
        ]);

        return redirect()->route('pemerintah.dashboard');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('landing');
    }
}
