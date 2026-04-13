<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'successfully logged in');
        }

        return back()->with([
            'error' => 'The provided credentials do not match our records',
        ]);
    }

    public function postRegister(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:18'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        return redirect()->route('login')->with('success', 'successfully registered');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'successfully logged out');
    }

    public function dashboard()
    {
        $role = Auth::user()->role;
        
        if ($role == 'admin') {
            return view('admin.dashboard');
        } else {
            return view('customer.dashboard');
        }
    }
}
