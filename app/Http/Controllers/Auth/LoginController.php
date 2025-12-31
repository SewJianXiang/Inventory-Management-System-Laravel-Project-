<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->is_admin) {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/dashboard');
            }
        }

        return back()->withErrors(['email' => 'Incorrect email or password. Please try again.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
