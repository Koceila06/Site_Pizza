<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function formRegister(){//page pour s'enregistrer
        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate([
            'nom'=>'required|string|max:40',
            'prenom'=>'required|string|max:40',
            'login'=>'required|string|max:30|unique:users',
            'mdp'=>'required|string|max:60|confirmed'//confirmed: pour confirmer me champs suivant bde mdp
        ]);

        $user=new User();
        $user->nom=$request->nom;
        $user->prenom=$request->prenom;
        $user->login=$request->login;
        $user->mdp=hash::make($request->mdp);//hash::make() pour coder le mdp, le securiser
        $user->save();

        //Auth::login($user);//optionelle: pour connecter directement l(utilisateur

        return redirect('/');
    }

    public function registerAdmin(Request $request){
        $request->validate([
            'nom'=>'required|string|max:40',
            'prenom'=>'required|string|max:40',
            'login'=>'required|string|max:30|unique:users',
            'mdp'=>'required|string|max:60|confirmed'//confirmed: pour confirmer me champs suivant bde mdp
        ]);

        $user=new User();
        $user->nom=$request->nom;
        $user->prenom=$request->prenom;
        $user->login=$request->login;
        $user->mdp=hash::make($request->mdp);//hash::make() pour coder le mdp, le securiser
        $user->type="admin";
        $user->save();

        //Auth::login($user);//optionelle: pour connecter directement l(utilisateur
        $request->session()->flash('etat',"Creation de l'utilisateur administrateur effectuer");
        return redirect()->route('admin.utilisateur.index_utilisateur');
    }
    public function registerCook(Request $request){
        $request->validate([
            'nom'=>'required|string|max:40',
            'prenom'=>'required|string|max:40',
            'login'=>'required|string|max:30|unique:users',
            'mdp'=>'required|string|max:60|confirmed'//confirmed: pour confirmer me champs suivant bde mdp
        ]);

        $user=new User();
        $user->nom=$request->nom;
        $user->prenom=$request->prenom;
        $user->login=$request->login;
        $user->mdp=hash::make($request->mdp);//hash::make() pour coder le mdp, le securiser
        $user->type="cook";
        $user->save();

        //Auth::login($user);//optionelle: pour connecter directement l(utilisateur
        $request->session()->flash('etat','Creation du pizzaiolo effectuer');
        return redirect()->route('admin.utilisateur.index_utilisateur');
    }
}
