<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PizzaController extends Controller
{
    public function index(){
        return view('admin.pizza.index');
    }

    public function ajoutForm(){
        return view('admin.pizza.ajout');
    }

    public function ajout(Request $request){
        $request->validate([
            'nom'=>'required|string|max:30',
            'description'=>'required|string',
            'prix'=>'required|numeric|between:0,999.99'
        ]);

        $pizza=new Pizza();
        $pizza->nom=$request->nom;
        $pizza->description=$request->description;
        $pizza->prix=$request->prix;
        $pizza->save();

        $request->session()->flash('etat','Ajout effectuer');

        return redirect(route('admin.pizza.index'));
    }

    public function list(){
        $pizza=Pizza::all();
        //$piz=array_reverse($pizza);
        return view('admin.pizza.list',['list'=>$pizza]);
    }

    //Modifier une pizza

    /**
     * Fonction de mise en page pour modifier une pizza
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editForm(){
        $pizza=Pizza::all();
        return view('admin.pizza.edit.edit',['list'=>$pizza]);
    }

    /**
     * Fonction post qui recupere l'id de la pizza a modifier
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(Request $request){
        $validated=$request->validate([
            'ida'=>'required|integer'
        ]);

        //$request->session()->flash('etat','Ajout effectuer');

        return redirect()->route('admin.pizza.edit.index',['id'=>$validated['ida']]);

    }

    /**
     *
     * @param $id l
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function indexEditPizza($id){
        //$pizza=DB::table('pizzas')->find($id);
        return view('admin.pizza.edit.index',['ida'=>$id]);
    }

    /**
     * Mise en page pour la modification du nom de la pizza
     * @param $id l'id de la pizza a modifier
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function EditNomForm($id){
        return view('admin.pizza.edit.nom');
    }

    /**
     * Modification du nom de la pizza
     * @param Request $request
     * @param $id 'id de la pizza a modifier
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditNom(Request $request,$id){
        $request->validate([
            'nom'=>'required|string|max:30'
        ]);

        //$pizza=DB::table('pizzas')->find($id);
        $pizza=Pizza::find($id);
        $pizza->nom=$request->nom;
        $pizza->save();

        //$pizza=

        return redirect()->route('admin.pizza.edit.index',['id'=>$id]);
        //return redirect()->route('home');
    }

    /**
     * @param $id 'id de la pizza a modifier
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function EditDescriptionForm($id){
        return view('admin.pizza.edit.description');
    }

    /**
     * @param Request $request
     * @param $id l'id de la pizza à modifier
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditDescription(Request $request,$id){
        $request->validate([
           'description'=>'required|string'
        ]);

        $pizza=Pizza::findOrFail($id);
        $pizza->description=$request->description;
        $pizza->save();

        return redirect()->route('admin.pizza.edit.index',['id'=>$id]);
    }

    /**
     * affichage de la page de tous les pizzas pour supprimer une pizza
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function supprimer_pizza_form(){
        $pizza=Pizza::all();

        return view('admin.pizza.supprimer_page',['list'=>$pizza]);
    }

    /**
     * methode qui supprime la pizza
     * @param Request $request
     * @param $pizza_id l'id de la pizza a supprimer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function supprimer_pizza(Request $request,$pizza_id){
        $pizza=Pizza::findOrFail($pizza_id);
        $commande_pizza_pizza_id=DB::table('commande_pizza')->where('pizza_id','=',$pizza_id);
        if(empty($commande_pizza_pizza_id)){
            $pizza->delete();
            $request->session()->flash('etat','suppression en softdelete effectuer');
            return back();
        }

        $pizza->forceDelete();
        $request->session()->flash('etat','suppression definitive effectuer');
        return back();
    }

    /**
     * Affiches les pizzas en pagination
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function pizzaListPaginate(){
        $pizza=Pizza::paginate(15);
        //$this->authorize('view',$pizza);
        return view('user.commande.list_paginate',['pizzas'=>$pizza]);
    }


}
