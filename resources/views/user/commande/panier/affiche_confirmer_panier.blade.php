@extends('modele')

@section('title','payement')

@section('contents')
    <p><h1>Confirmation de l'acaht</h1></p>
    <p><h2>Le prix total de vos sont {{$prix}} €.</h2></p>
    <p><h2><a href="{{route('user.commande.panier.confirmer_panier')}}">Confirmer achat</a> </h2></p>
@endsection
