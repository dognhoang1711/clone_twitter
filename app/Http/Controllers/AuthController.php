<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function store()
    {
        $vadidation = request()->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'name' => 'required|min:5'
        ]);
        User::create([
            'email' => $vadidation['email'],
            'password' => Hash::make($vadidation['password']),
            'name' => $vadidation['name']
        ]);

        return redirect()->route('dashboard')->with('sucess', 'đăng kí tài khoản thành công');
    }
    public function showLogin()
    {
        return view('auth.login');
    }
    public function login()
    {
        $vadidation = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->attempt($vadidation)) {
            request()->session()->regenerate();
            return redirect()->route('user.index')->with('sucess', 'bạn đã đăng nhập thành công');
        }

        return redirect()->route('show-login')->withErrors([
            'errolLogin' => 'tài khoản hoặc mật khẩu không đúng'
        ]);
    }
    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('dashboard');
    }
}
