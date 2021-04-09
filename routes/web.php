<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main');
})->name('main');

Route::view('/home','user.home')->middleware('auth')->name('home.user');

Route::view('/admin','admin.home')->middleware('auth')
    ->middleware('is_admin')->name('admin.home');

//Routes pour se connecter et ce deconnecter
Route::get('/login', [AuthenticatedSessionController::class,'formLogin'])
    ->name('login');
Route::post('/login', [AuthenticatedSessionController::class,'login']);
Route::get('/logout', [AuthenticatedSessionController::class,'logout'])
    ->name('logout')->middleware('auth');

//routes pour s'enregistrer
Route::get('/register', [RegisterUserController::class,'formRegister'])
    ->name('register');
Route::post('/register', [RegisterUserController::class,'register']);


//Administrateur

                //gestion des pizzas
Route::get('/admin/pizza',[PizzaController::class,'index'])
    ->middleware('auth')->middleware('is_admin')->name('admin.pizza.index');

Route::get('/admin/pizza/ajout',[PizzaController::class,'ajoutForm'])
    ->middleware('auth')->middleware('is_admin')->name('admin.pizza.ajout');
Route::post('/admin/pizza/ajout',[PizzaController::class,'ajout']);

Route::get('admin/pizza/list',[PizzaController::class,'list'])
    ->middleware('auth')->middleware('is_admin')->name('admin.pizza.list');

Route::get('admin/pizza/edit',[PizzaController::class,'editForm'])
    ->middleware('auth')->middleware('is_admin')->name('admin.pizza.edit');
//Route::post('admin/pizza/edit',[PizzaController::class,'edit']);

Route::get('admin/pizza/edit/{id}/index',[PizzaController::class,'indexEditPizza'])
    ->middleware('auth')->middleware('is_admin')->name('admin.pizza.edit.index');

Route::get('admin/pizza/edit/{id}/nom',[PizzaController::class,'EditNomForm'])//modifier le nom d'une pizza
    ->middleware('auth')->middleware('is_admin')->name('admin.pizza.edit.nom');
Route::post('admin/pizza/edit/{id}/nom',[PizzaController::class,'EditNom']);

Route::get('admin/pizza/edit/{id}/description',[PizzaController::class,'EditDescriptionForm'])//modifier description d'une pizza
    ->middleware('auth')->middleware('is_admin')->name('admin.pizza.edit.description');
Route::post('admin/pizza/edit/{id}/description',[PizzaController::class,'EditDescription']);

Route::get('admin/pizza/supprimer_form',[PizzaController::class,'supprimer_pizza_form'])
    ->middleware('auth')->middleware('is_admin')->name('admin.pizza.supprimer_form');

Route::get('admin/pizza/supprimer/{pizza_id}',[PizzaController::class,'supprimer_pizza'])
    ->middleware('auth')->middleware('is_admin')->name('admin.pizza.supprimer');


                //gestion des commandes
Route::view('/admin/commande','admin.commande.commande_index')
    ->middleware('auth')->middleware('is_admin')->name('admin.commande.commande_index');

Route::get('admin/commande/list',[CommandeController::class,'listCommandeDateForm'])
    ->middleware('auth')->middleware('is_admin')->name('admin.commande.list');
Route::post('admin/commande/list',[CommandeController::class,'listCommandeDate']);
    //->middleware('auth')->middleware('is_admin');

Route::get('admin/commande/commande_du_jour',[CommandeController::class,'commande_du_jour'])
    ->middleware('auth')->middleware('is_admin')->name('admin.commande.commande_du_jour');

Route::get('admin/commande/toutes_commandes',[CommandeController::class,'toutes_commandes_pagi'])
    ->middleware('auth')->middleware('is_admin')->name('admin.commande.toutes_commandes_pagi');

Route::get('admin/commande/recette_du_jour',[CommandeController::class,'recette_du_jour'])
    ->middleware('auth')->middleware('is_admin')->name('admin.commande.recette_du_jour');


                //Gestion des utilisateur

Route::view('/admin/utilisateurs','admin.utilisateurs.index_utilisateur')//page pour creer des utilisateurs
    ->middleware('auth')->middleware('is_admin')->name('admin.utilisateur.index_utilisateur');

Route::get('/admin/utilisteurs/create_admin', [RegisterUserController::class,'formRegister'])//formulaire
    ->middleware('auth')->middleware('is_admin')->name('admin.utilisateur.create_admin');
Route::post('/admin/utilisteurs/create_admin',[RegisterUserController::class,'registerAdmin']);//creation d'un utilisateur admin avec formulaire d'enregistrement

Route::get('/admin/utilisteurs/create_cook', [RegisterUserController::class,'formRegister'])//formulaire
    ->middleware('auth')->middleware('is_admin')->name('admin.utilisateur.create_cook');
Route::post('/admin/utilisateurs/create_cook',[RegisterUserController::class,'registerCook']);//creation d'un utilisateur pizzaiolo avec formulaire d'enregistrement

Route::get('/admin/utilisateurs/change_mdp_cook_login',[UserController::class,'adminModifierMdpCookLoginForm'])//formulaire pr recupere le login du pizzaiolo pr modif son mdp
    ->middleware('auth')->middleware('is_admin')->name('admin.utilisateur.change_mdp_cook_login');
Route::post('/admin/utilisateurs/change_mdp_cook_login',[UserController::class,'adminModifierMdpCookLogin']);

Route::get('admin/utlisateurs/change_mdp_cook/{login}',[UserController::class,'adminModifierMdpCookForm'])//utilise le formulaire de modification de mdp
    ->middleware('auth')->middleware('is_admin')->name('admin.utilisateur.change_mdp_cook_form');
Route::post('admin/utilisateurs/change_mdp_cook/{login}/co',[UserController::class,'adminModifierMdpCook'])->name('admin.utilisateur.change_mdp_cook');
    //->middleware('auth')->middleware('is_admin')->name('admin.utilisateur.change_mdp_cook');

//Partie utilisateur

Route::get('user/modifier_mdp',[UserController::class,'modifierMdpForm'])
    ->middleware('auth')->name('user.modifier_mdp');
Route::post('user/modifier_mdp',[UserController::class,'modifierMdp']);

Route::get('user/commande/list',[PizzaController::class,'pizzaListPaginate'])->middleware('auth')
    ->name('list_pizza_paginate');

        //Panier

Route::get('user/panier/index',[PanierController::class,'panierIndex'])
    ->middleware('auth')->name('user.commande.panier.index');
Route::get('user/panier/index/{pizza_id}',[PanierController::class,'panierAjout'])
    ->middleware('auth')->name('user.commande.panier.ajout');

Route::get('user/panier/afficher',[PanierController::class,'afficherPanier'])
    ->middleware('auth')->name('user.commande.panier.afficher');

Route::get('user/panier/modifier_quantite_pizza/{pizza_id}',[PanierController::class,'modifier_quantite_pizza_panier_form'])
    ->middleware('auth')->name('user.commande.panier.modifier_quantite_pizza');
Route::post('user/panier/modifier_quantite_pizza/{pizza_id}',[PanierController::class,'modifier_quantite_pizza_panier']);

Route::get('user/panier/supprimer/{pizza_id}',[PanierController::class,'supprimer_Pizza_panier'])
    ->middleware('auth')->name('user.commande.panier.supprimer');

Route::get('user/panier/affiche_confirmer_panier',[PanierController::class,'affiche_confirmer_panier'])
    ->middleware('auth')->name('user.commande.panier.affiche_confirmer_panier');

Route::get('user/panier/confirmer_panier',[PanierController::class,'confirmer_panier'])
    ->middleware('auth')->name('user.commande.panier.confirmer_panier');

            //Gestion des commandes
Route::view('user/ses_commandes','user.commande.ge_commandes.ses_commandes')
    ->middleware('auth')->name('user.commande.ge_commandes.ses_commandes');

Route::get('user/commande_detail',[CommandeController::class,'user_commandes_page'])
    ->middleware('auth')->name('user.commande.user_commandes_page');

Route::get('user/commande_non_recuperer',[CommandeController::class,'user_commade_non_recuperer'])
    ->middleware('auth')->name('user.commande.user_commade_non_recuperer');

//Partie Pizzaiolo

Route::view('/pizzaiolo','pizzaiolo.home_pizzaiolo')
    ->middleware('auth')->middleware('is_cook')->name('home.pizzaiolo');

Route::get('/pizzaiolo/commande',[CommandeController::class,'list_commande_non_traiter'])
    ->middleware('auth')->middleware('is_cook')->name('pizzaiolo.commande_non_traiter');

Route::get('/pizzaiolo/detail_commande_non_traiter/{commande_id}',[CommandeController::class,'detail_commande_non_traiter'])
    ->middleware('auth')->name('pizzaiolo.detail_commande_non_traiter');

Route::get('/pizzaiolo/maj_statut/{statut}',[CommandeController::class,'maj_statut_page'])
    ->middleware('auth')->middleware('is_cook')->name('pizzaiolo.maj_statut_page');

Route::get('/pizzaiolo/maj_statut/{commande_id}/{statut}',[CommandeController::class,'maj_statut'])
    ->middleware('auth')->middleware('is_cook')->name('pizzaiolo.maj_statut');

