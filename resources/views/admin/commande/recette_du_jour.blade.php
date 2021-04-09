@extends('modele')

@section('title','recette du jour')

@section('contents')
    <h1>La recette du jour</h1>
    <p>La recette du jour actuellement est de :<h3>{{$recette}} €</h3></p>
    <p><a href="{{back()->getTargetUrl()}}">Retour en arrier</a> </p>
@endsection
