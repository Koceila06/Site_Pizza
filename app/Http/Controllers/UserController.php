<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Formulaire pour modifier le mot de passe d'un utilisateur
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function modifierMdpForm(){
        return view('user.compte.modifier_mdp');
    }

    /**
     * methode post qui va changer le mot de passe de l'utilisateur
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function modifierMdp(Request $request){
        $validated=$request->validate([
            'a_mdp'=>'required|string|max:60',
            'mdp'=>'required|string|max:60|confirmed'
        ]);
        //$m_mdp=hash::make($request->a_mdp);
        $mdp_c=AUTH::User()->mdp;

        if(Hash::check($validated['a_mdp'],$mdp_c)){
            $user_id=Auth::User()->id;
            $user=User::findOrFail($user_id);
            //$user = $user->makeVisible(['mdp']);
            $user->mdp=Hash::make($validated['mdp']);
            //$user->timestamps = false;
            $user->save();
            $request->session()->flash('etat','Modification effectuée');
            return redirect()->route('home.user');
        }

        $request->session()->flash('etat','erreur dans votre saisie, veuillez réessayer');
        return redirect()->route('user.modifier_mdp');
    }

            //administrateur: gestion des utilisateurs
    /**
     * Formulaire pour envoyer le login du pizzaiolo a modifier
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function adminModifierMdpCookLoginForm(){
        return view('admin.utilisateurs.change_mdp_cook_login');
    }

    /**
     * methode post qui recupere le login du pizzaiolo a modidifier
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function adminModifierMdpCookLogin(Request $request){

        $validated=$request->validate([
            'login'=>'required|string|max:30'
        ]);

        //return view('admin.utilisateurs.change_mdp_cook',['log'=>$validated['login']]);
        return redirect()->route('admin.utilisateur.change_mdp_cook_form',['login'=>$validated['login']]);
    }

    /**
     * page ou le login de l'utilisateur ou pizzaiolo est demander pr modifier son mdp
     * @param $login le login de l'utilisateur ou pizzaiolo
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function adminModifierMdpCookForm($login){
        return view('admin.utilisateurs.change_mdp_cook',['login'=>$login]);
    }

    /**
     * Methode post qui recupere les info pr modifier le mdp du pizzaiolo
     * @param Request $request
     * @param $login le login de l'utilisateur ou pizzaiolo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminModifierMdpCook(Request $request,$login){
        $validated=$request->validate([
            'mdp'=>'required|string|max:60|confirmed'
        ]);
        //$m_mdp=hash::make($request->a_mdp);
        //$type_c=AUTH::User()->type;

        $user=User::where('login','=',$login)->first();//on recupere l'utilisateur avec le login
        //$user=User::findOrFail(7);

        if(isset($user)){//on verifie si l'utilisateur existe

            if($user->type=="cook"){//on verifie si l'utilisateur à modifier est un pizzaiolo
                $user->mdp=Hash::make($validated['mdp']);
                $user->save();
                $request->session()->flash('etat','Modification du mot de passe du Pizzaiolo effectuée ');
                return redirect()->route('admin.utilisateur.index_utilisateur');
            }
            $request->session()->flash('etat',"l'utilisateur n'est pas un pizzaiolo");
            return redirect()->route('admin.utilisateur.index_utilisateur');
        }

        $request->session()->flash('etat','login incorrecte, utilisateur inexistant');
        return redirect()->route('admin.utilisateur.index_utilisateur');
    }

}
