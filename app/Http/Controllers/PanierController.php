<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PanierController extends Controller
{
    /**
     * Pagination des pizza, ou l'on pourra ajouter les pizza au panier
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function panierIndex(){
        $pizza=Pizza::paginate(15);
        return view('user.commande.panier.panier_index',['pizzas'=>$pizza]);
    }


    /**
     * methode post, qui va ajouter la pizza dans le panier, qui est la session de l'utilisateur
     * @param Request $request
     * @param $pizza_id l'id de la pizza à ajouter dans le panier
     * @return \Illuminate\Http\RedirectResponse
     */
    public function panierAjout(Request $request,$pizza_id){

        if(!$request->session()->has('panier')){//creation de la session panier si elle existe pas
            //$pan=array();
            $pan=[];
            $request->session()->put('panier',$pan);
        }

        if(!$request->session()->has('panier_nom')){//creation de la session panier_nom si elle existe pas
            //$pan=array();
            $pan_nom=[];
            $request->session()->put('panier_nom',$pan_nom);
        }

        $pan=$request->session()->get('panier');
        $pan_nom=$request->session()->get('panier_nom');

        if(isset($pan[$pizza_id])){//si le panier contient deja l'id de la pizza alors l'incrementer
            /*
            $c=$pan[$pizza_id];
            $pan[$pizza_id]=$c+1;
            */
            $request->session()->flash('etat','Pizza deja dans le panier, allez dans le panier pr le modier ou le supprimer');
            return back();

        }else{//sinon ajouter l'id et le mettre à 1
            $pizza=Pizza::findOrFail($pizza_id);
            $pan[$pizza_id]=1;
            $pan_nom[$pizza_id]=$pizza->nom;
        }

        $request->session()->put('panier',$pan);
        $request->session()->put('panier_nom',$pan_nom);

        //dd($pan);
        $request->session()->flash('etat','Ajout de la pizza dans le panier effectuer');
        return back();
        //return redirect()->route('user.commande.panier.index');
    }


    /**
     * Affiche le panier
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function afficherPanier(Request $request){
        $pan=$request->session()->get('panier');
        $pan_nom=$request->session()->get('panier_nom');
        //$pan_vide=[];
        //dump($pan);
        return view('user.commande.panier.afficher_panier',['panier'=>$pan],['panier_nom'=>$pan_nom]);
    }

    /**
     * page pour saisir la quantite des pizza dans le panier
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function modifier_quantite_pizza_panier_form(){
        return view('user.commande.panier.modifier_quantite');
    }

    /**
     * methode post qui va gerer la modification de la quantite de pizza
     * @param Request $request
     * @param $pizza_id l'id de la pizza dons le panier, dont la quantite doit etre modifier
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function modifier_quantite_pizza_panier(Request $request,$pizza_id){
        $request->validate([
           'quantite'=>'required|integer'
        ]);

        $pan=$request->session()->get('panier');
        $pan[$pizza_id]=$request->quantite;
        $request->session()->put('panier',$pan);
        $pan_nom=$request->session()->get('panier_nom');

        return view('user.commande.panier.afficher_panier',['panier'=>$pan],['panier_nom'=>$pan_nom]);
    }

    /**
     * methode post qui va gerer de supprimer la pizza du panier
     * @param Request $request
     * @param $pizza_id l'id de la pizza qu'on va supprimer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function supprimer_Pizza_panier(Request $request,$pizza_id){
        $pan=$request->session()->get('panier');
        $pan_nom=$request->session()->get('panier_nom');
        unset($pan[$pizza_id]);//supprime la pizza du tableau
        unset($pan_nom[$pizza_id]);
        $request->session()->put('panier',$pan);
        $request->session()->put('panier_nom',$pan_nom);
        return view('user.commande.panier.afficher_panier',['panier'=>$pan],['panier_nom'=>$pan_nom]);
    }

    /**
     * page qui resume la somme total de l'achat de l'utilisateur
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function affiche_confirmer_panier(Request $request){
        //$request->session()->get('panier',$pan_vide);//on met à vide le panier
        $prix_total=0;
        $pan=$request->session()->get('panier');
        foreach ($pan as $cle=>$val){
            $pizza=Pizza::findOrFail($cle);
            $pizza_prix=$pizza->prix;
            $prix_total=$prix_total+$pizza_prix*$val;
        }

        return view('user.commande.panier.affiche_confirmer_panier',['prix'=>$prix_total]);
    }

    /**
     * va confirmer l'achat, et le mettre dans les tables puis vider le panier
     * @param Request $request
     */
    public function confirmer_panier(Request $request){

        $panier=$request->session()->get('panier');
        foreach ($panier as $cle=>$val){
            $commande=new Commande();
            $commande->user_id=AUTH::User()->id;
            $commande->save();
            $pizza=Pizza::findOrFail($cle);

            $commande->pizzas()->attach($pizza,['qte'=>$val]);
        }
        $pan_vide=[];
        $pan_nom_vide=[];
        $request->session()->put('panier',$pan_vide);
        $request->session()->put('panier_nom',$pan_nom_vide);

        $request->session()->flash('etat','Achat effectuer');
        return redirect()->route('user.commande.panier.index');

    }
}
