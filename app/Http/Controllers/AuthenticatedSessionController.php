<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function formLogin(){
        return view('auth.login');
    }

    public function login(Request $request)
    {//pour se connecter
        $request->validate([
            'login' => 'required|string',
            'mdp' => 'required|string'
        ]);

        $credentials = ['login' => $request->input('login'),
            'password' => $request->input('mdp')];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->flash('etat','Login successful');
            return redirect()->intended('/home');
        }

        //il a pas reussi a ce connecter
        return back()->withErrors([
            'login' => 'Erreur survenue sur le login',
        ]);

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
