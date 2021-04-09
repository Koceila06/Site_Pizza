@extends('modele')

@section('contents')
    <ul>
        <li><a href="{{route('admin.pizza.ajout')}}"> ajouter une pizza</a></li>
        <li><a href="{{route('admin.pizza.list')}}"> Liste des pizza</a></li>
        <li><a href="{{route('admin.pizza.edit')}}">Modifier Pizza</a></li>
        <li><a href="{{route('admin.pizza.supprimer_form')}}">Supprimer pizza</a></li>
    </ul>
@endsection
