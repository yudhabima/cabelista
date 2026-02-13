<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // ⬇️ PAKSA ke dashboard admin
        return redirect('/admin/dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah',
    ]);
}
public function logout(Request $request)
{
Auth::logout();


$request->session()->invalidate();
$request->session()->regenerateToken();


return redirect('/'); // balik ke beranda
}
}