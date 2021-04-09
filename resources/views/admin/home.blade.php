@extends('modele')

@section('title','administrateur')

@section('contents')
    <ul>
        <li><p><a href="{{route('admin.pizza.index')}}">Gestion des pizzas</a> </p></li>
        <li><p><a href="{{route('admin.commande.commande_index')}}">Gestion des commandes</a> </p></li>
        <li><p><a href="{{route('admin.utilisateur.index_utilisateur')}}">Gestion des utilisateurs</a> </p></li>
    </ul>
@endsection
