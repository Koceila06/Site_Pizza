@extends('modele')

@section('contents')
    <ul>
        <li><a href="{{route('admin.commande.list')}}"> Afficher commandes par date</a></li>
        <li><a href="{{route('admin.commande.commande_du_jour')}}">Liste commandes du jour</a> </li>
        <li><a href="{{route('admin.commande.toutes_commandes_pagi')}}">Liste de tous les commandes</a> </li>
        <li><a href="{{route('admin.commande.recette_du_jour')}}">Recette du jour</a> </li>

    </ul>
@endsection
