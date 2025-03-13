<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            "title" => "Login",

        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required",
            "password" => "required"
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            if ($user->role === 'admin' || $user->role === 'super') {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role === 'mahasiswa') {
                $request->session()->regenerate();
                return redirect()->intended('/mahasiswa/dashboard');
            }
        }
    
        return redirect('/login')->withErrors('Kata sandi atau password salah')->withInput();
    }
    



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
