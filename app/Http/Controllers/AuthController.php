<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister() { return view('auth.register'); }

    public function register(Request $r)
    {
        $r->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $r->name,
            'email' => $r->email,
            'password' => Hash::make($r->password)
        ]);

        Auth::login($user);
        return redirect()->route('inicio');
    }

    public function showLogin() { return view('auth.login'); }

    public function login(Request $r)
    {
        $credentials = $r->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $session = session()->getId();
            Cart::where('session_id', $session)->update(['user_id' => Auth::id(), 'session_id' => null]);
            return redirect()->route('inicio');
        }
        return back()->withErrors('Credenciais inválidas');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('inicio');
    }
}
