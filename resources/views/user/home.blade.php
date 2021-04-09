@extends('modele')

@section('title','home: user')

@section('contents')
    <ul>
        <li><a href="{{route('user.modifier_mdp')}}" >Modifier le mot de passe</a></li>
        <li><a href="{{route('list_pizza_paginate')}}" >Liste des pizzas.</a></li>
        <li><a href="{{route('user.commande.panier.index')}}" >Commander des pizzas.</a></li>
        <li><a href="{{route('user.commande.ge_commandes.ses_commandes')}}">Voir ses commandes</a> </li>
    </ul>

@endsection
