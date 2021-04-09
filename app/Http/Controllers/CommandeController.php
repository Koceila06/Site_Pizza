<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Pizza;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CommandeController extends Controller
{
    public function commandeNonTraiter(){

        $commande=DB::table('commandes')->where('status','=','traitement')->get();
        $ess=array_reverse($commande);
        return view('pizzaiolo.commande_non_traite',['commande',$ess]);
    }

    //Partie Administrateur

                ///Gestion des commandes

    public function listCommandeDateForm(){
        $commande = Commande::orderBy('created_at','desc')->get(); //orderBy
//,['commande'=>$pizza]
        $user_login=[];
        $pizza_nom=[];
        if(isset($commande)){
            foreach ($commande as $cle){
                if(!isset($user_login[$cle->user_id])){
                    $user=User::findOrFail($cle->user_id);
                    $user_login[$cle->user_id]=$user->login;


                }

                if(!isset($pizza_nom[$cle->id])){
                    $commende_pizza=DB::table('commande_pizza')->where('commande_id','=',$cle->id)->first();
                    if(empty(Pizza::find($commende_pizza->pizza_id))) {
                        $pizza = Pizza::withTrashed()->where('id',$commende_pizza->pizza_id)->first();
                        $pizza_nom[$cle->id] = $pizza->nom;
                    }else{

                        $pizza = Pizza::findOrFail($commende_pizza->pizza_id);
                        $pizza_nom[$cle->id] = $pizza->nom;
                    }

                }

            }
        }
        return view('admin.commande.list_commande_date',['commande'=>$commande,'pizza_nom'=>$pizza_nom,'user_login'=>$user_login]);
    }

/*
    public function listCommandeDate(Request $request){
        $request->validate([
           'date_f' =>'required|date_format:Y-m-d'
        ]);
       // $date=new DateTime($request->datet)->format('Y-m-d');
    //$date=new \DateTime($request->datet)->format('Y-m-d')
            //$date->format('Y')


        //$date=new Date::now();
        $date=Carbon::
        $date->sub('1 day');

        $commande=Commande::where('created_at','>',$request->date_f)
            ->where('created_at','>',$date)->get();
       //$commande = Pizza::all()->sortBy('created_at'); //orderBy
        return view('admin.commande.list_commande_date',['commande'=>$commande]);
    }*/

    /**
     * Affiche les commandes du jours
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function commande_du_jour(){
        $date_today=Carbon::today();
        $commande=Commande::where('updated_at','>',$date_today)->orderBy('statut')->orderBy('updated_at','desc')->get();

        $user_login=[];
        $pizza_nom=[];
        if(isset($commande)){
            foreach ($commande as $cle){
                if(!isset($user_login[$cle->user_id])){
                    $user=User::findOrFail($cle->user_id);
                    $user_login[$cle->user_id]=$user->login;


                }

                if(!isset($pizza_nom[$cle->id])){
                    $commende_pizza=DB::table('commande_pizza')->where('commande_id','=',$cle->id)->first();
                    if(empty(Pizza::find($commende_pizza->pizza_id))) {
                        $pizza = Pizza::withTrashed()->where('id',$commende_pizza->pizza_id)->first();
                        $pizza_nom[$cle->id] = $pizza->nom;
                    }else{

                        $pizza = Pizza::findOrFail($commende_pizza->pizza_id);
                        $pizza_nom[$cle->id] = $pizza->nom;
                    }

                }

            }
        }

        return view('admin.commande.commande_du_jour',['list'=>$commande,'pizza_nom'=>$pizza_nom,'user_login'=>$user_login]);
    }

    /**
     * Affiche toutes les commandes en pagination
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function toutes_commandes_pagi(){
        $commande=Commande::orderBy('created_at','desc')->paginate(15);

        $user_login=[];
        $pizza_nom=[];
        if(isset($commande)){
            foreach ($commande as $cle){
                if(!isset($user_login[$cle->user_id])){
                    $user=User::findOrFail($cle->user_id);
                    $user_login[$cle->user_id]=$user->login;


                }

                if(!isset($pizza_nom[$cle->id])){
                    $commende_pizza=DB::table('commande_pizza')->where('commande_id','=',$cle->id)->first();
                    if(empty(Pizza::find($commende_pizza->pizza_id))) {
                        $pizza = Pizza::withTrashed()->where('id',$commende_pizza->pizza_id)->first();
                        $pizza_nom[$cle->id] = $pizza->nom;
                    }else{

                        $pizza = Pizza::findOrFail($commende_pizza->pizza_id);
                        $pizza_nom[$cle->id] = $pizza->nom;
                    }

                }

            }
        }

        return view('admin.commande.toutes_commandes_pagi',['list'=>$commande,'pizza_nom'=>$pizza_nom,'user_login'=>$user_login]);
    }

    public function recette_du_jour(){
        $date_today=Carbon::today();
        $commande=Commande::where('updated_at','>',$date_today)->get();

        $prix_total=0;
        if(isset($commande)){
            foreach ($commande as $cle){
                //$pizza=Pizza::commandes()->where('commande_id','=',$cle->id)->first();
                $commande_pizza=DB::table('commande_pizza')->where('commande_id','=',$cle->id)->first();
                //dd($pizza_id);
                $pizza=Pizza::findOrFail($commande_pizza->pizza_id);
                $prix_total=$prix_total+$pizza->prix*$commande_pizza->qte;
            }
        }

        return view('admin.commande.recette_du_jour',['recette'=>$prix_total]);
    }

                //Partie pizzaiolo

    /**
     * Liste des commande qui ne sont pas encore traiter en statut 'envoye'
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function list_commande_non_traiter(){
        $commande=Commande::where('statut','=','envoye')->orderBy('updated_at','desc')->get();//car si il est maj il redescend dans le classement

        $user_login=[];
        $pizza_nom=[];
        if(isset($commande)){
            foreach ($commande as $cle){
                if(!isset($user_login[$cle->user_id])){
                    $user=User::findOrFail($cle->user_id);
                    $user_login[$cle->user_id]=$user->login;


                }

                if(!isset($pizza_nom[$cle->id])){
                    $commende_pizza=DB::table('commande_pizza')->where('commande_id','=',$cle->id)->first();
                    if(empty(Pizza::find($commende_pizza->pizza_id))) {
                        $pizza = Pizza::withTrashed()->where('id',$commende_pizza->pizza_id)->first();
                        $pizza_nom[$cle->id] = $pizza->nom;
                    }else{

                        $pizza = Pizza::findOrFail($commende_pizza->pizza_id);
                        $pizza_nom[$cle->id] = $pizza->nom;
                    }

                }

            }
        }

        return view('pizzaiolo.list_commande_non_traiter',['list'=>$commande,'pizza_nom'=>$pizza_nom,'user_login'=>$user_login]);
    }

    /**
     * affichage des details d'une commmande
     * @param $commande_id l'id de la commande
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detail_commande_non_traiter($commande_id){
        $commende_pizza=DB::table('commande_pizza')->where('commande_id','=',$commande_id)->first();
        //$commande=Commande::findOrFail($commande_id);//on recupere la comamande
        //$commende_pizza_commande=$commande->pizzas()->where('commande_id','=',$commande_id);//on recupere la commande dasn la table commande_pizza

        //$pizza_id=$commende_pizza_commande->pizza_id;//recupre l'id de la pizza a partir de la table commende_pizza
        //$commende_pizza_pizza=$commande->pizzas()->where('commande_id','=',$commande_id);
        //$pizza=Pizza::findOrFail($pizza_id);//puis on recupere la pizza


        if(empty(Pizza::find($commende_pizza->pizza_id))) {
            $pizza = Pizza::withTrashed()->where('id',$commende_pizza->pizza_id)->first();
            $prix_total=$pizza->prix*$commende_pizza->qte;
            return view('pizzaiolo.detail_commande_non_traiter',['pizza'=>$pizza,'qte'=>$commende_pizza->qte,'prix_total'=>$prix_total]);

        }

        $pizza = Pizza::findOrFail($commende_pizza->pizza_id);//puis on recupere la pizza

        //$commende_pizza_qte=$commende_pizza->qte;

        $prix_total=$pizza->prix*$commende_pizza->qte;
        return view('pizzaiolo.detail_commande_non_traiter',['pizza'=>$pizza,'qte'=>$commende_pizza->qte,'prix_total'=>$prix_total]);
    }

    /**
     * affiche les commande avec leurs statu a modifier
     * @param $statut le statu de la commande qu'on doit traiter
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function maj_statut_page($statut){
        $commande=Commande::where('statut','=',$statut)->get()->sortBy('update_at');//car si il est maj il redescend dans le classement

        $user_login=[];
        $pizza_nom=[];
        if(isset($commande)){
            foreach ($commande as $cle){
                if(!isset($user_login[$cle->user_id])){
                    $user=User::findOrFail($cle->user_id);
                    $user_login[$cle->user_id]=$user->login;


                }

                if(!isset($pizza_nom[$cle->id])){
                    $commende_pizza=DB::table('commande_pizza')->where('commande_id','=',$cle->id)->first();
                    if(empty(Pizza::find($commende_pizza->pizza_id))) {
                        $pizza = Pizza::withTrashed()->where('id',$commende_pizza->pizza_id)->first();
                        $pizza_nom[$cle->id] = $pizza->nom;
                    }else{

                        $pizza = Pizza::findOrFail($commende_pizza->pizza_id);
                        $pizza_nom[$cle->id] = $pizza->nom;
                    }

                }

            }
        }

        return view('pizzaiolo.maj_statut_page',['list'=>$commande,'pizza_nom'=>$pizza_nom,'user_login'=>$user_login]);

    }

    /**
     * change les statu de la commande et l'applique
     * @param Request $request
     * @param $commande_id id ded la commande
     * @param $statut statut de la commande
     * @return \Illuminate\Http\RedirectResponse
     */
    public function maj_statut(Request $request,$commande_id,$statut){
        $commande=Commande::findOrFail($commande_id);
        $commande->statut=$statut;
        $commande->save();

        $request->session()->flash('etat','statu changer avec succes');
        return back();

    }

            //////Utilisateur : gestion des commandes

    /**
     * Fonction qui renvoie vers la vue pour affiche la liste des pizza commander par l'utilisateur
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function user_commandes_page(){
        $user_id=AUTH::User()->id;
        $commande=Commande::where('user_id','=',$user_id)->get()->sortBy('update_at');//car si il est maj il redescend dans le classement

        $user_login=[];
        $pizza_nom=[];
        if(isset($commande)){
            foreach ($commande as $cle){
                if(!isset($user_login[$cle->user_id])){
                    $user=User::findOrFail($cle->user_id);
                    $user_login[$cle->user_id]=$user->login;


                }

                if(!isset($pizza_nom[$cle->id])){
                    $commende_pizza=DB::table('commande_pizza')->where('commande_id','=',$cle->id)->first();
                    if(empty(Pizza::find($commende_pizza->pizza_id))) {
                        $pizza = Pizza::withTrashed()->where('id',$commende_pizza->pizza_id)->first();
                        $pizza_nom[$cle->id] = $pizza->nom;
                    }else{

                        $pizza = Pizza::findOrFail($commende_pizza->pizza_id);
                        $pizza_nom[$cle->id] = $pizza->nom;
                    }

                }

            }
        }

        return view('user.commande.ge_commandes.user_commande',['list'=>$commande,'pizza_nom'=>$pizza_nom,'user_login'=>$user_login]);
    }

    /**
     * Fonction qui renvoie vers la vue pour affiche la liste des pizza commander par l'utilisateur qui n'ont pas encore ete traiter
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function user_commade_non_recuperer(){
        $commande=Commande::where('statut','<>','pret')->get()->sortBy('update_at');//car si il est maj il redescend dans le classement

        $user_login=[];
        $pizza_nom=[];
        if(isset($commande)){
            foreach ($commande as $cle){
                if(!isset($user_login[$cle->user_id])){
                    $user=User::findOrFail($cle->user_id);
                    $user_login[$cle->user_id]=$user->login;

                }

                if(!isset($pizza_nom[$cle->id])){
                    $commende_pizza=DB::table('commande_pizza')->where('commande_id','=',$cle->id)->first();
                    if(empty(Pizza::find($commende_pizza->pizza_id))) {
                        $pizza = Pizza::withTrashed()->where('id',$commende_pizza->pizza_id)->first();
                        $pizza_nom[$cle->id] = $pizza->nom;
                    }else{

                        $pizza = Pizza::findOrFail($commende_pizza->pizza_id);
                        $pizza_nom[$cle->id] = $pizza->nom;
                    }
                }

            }
        }

        return view('user\commande\ge_commandes\user_commade_non_recuperer',['list'=>$commande,'pizza_nom'=>$pizza_nom,'user_login'=>$user_login]);
    }

}
