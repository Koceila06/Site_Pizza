@extends('modele')

@section('title','ses commandes')

@section('contents')
    <h1>Gestion de ses commandes</h1>
    <ul>
        <li><a href="{{route('user.commande.user_commandes_page')}}">Details de ses commandes</a> </li>
        <li><a href="{{route('user.commande.user_commade_non_recuperer')}}">Les commandes non recuperer</a> </li>
    </ul>
@endsection
