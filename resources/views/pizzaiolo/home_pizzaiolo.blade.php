@extends('modele')

@section('title','HOME: pizzaiolo')

@section('contents')
    <ul>
        <li><p><a href="{{route('pizzaiolo.commande_non_traiter')}}">Liste des commandes non traiter</a> </p></li>
        <li><a href="{{route('pizzaiolo.maj_statut_page',['statut'=>"envoye"])}}">MAJ des statut envoye </a> </li>
        <li><a href="{{route('pizzaiolo.maj_statut_page',['statut'=>"traitement"])}}">MAJ du statut traitement</a></li>
        <li><a href="{{route('pizzaiolo.maj_statut_page',['statut'=>"pret"])}}">MAJ du statut pret en recuperer</a></li>
        <li><a href="{{route('pizzaiolo.maj_statut_page',['statut'=>"recupe"])}}">MAJ du statu recuperer</a></li>

    </ul>

@endsection
