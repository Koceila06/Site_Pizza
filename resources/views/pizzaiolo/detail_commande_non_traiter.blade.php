@extends('modele')

@section('title','details commande')

@section('contents')
    <p><h3>Nom de la pizza: {{$pizza->nom}}</h3></p>
    <p><h3>Description de la pizza: {{$pizza->description}}</h3></p>
    <p><h3>Prix de la pizza: {{$pizza->prix}} €</h3></p>
    <p><h3>Quantite de la pizza: {{$qte}}</h3></p>
    <p><h3>Prix total de la pizza: {{$prix_total}}</h3></p>

    <p><h3><a href="{{back()->getTargetUrl()}}">Retour a la page precedente</a> </h3></p>

@endsection
