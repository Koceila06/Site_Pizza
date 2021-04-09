@extends('modele')

@section('title','Utilisateurs')

@section('contents')
    <ul>
        <li><a href="{{route('admin.utilisateur.create_admin')}}">Creer un utilisateur administrateur</a> </li>
        <li><a href="{{route('admin.utilisateur.create_cook')}}">Creer un Pizzaiolo</a> </li>
        <li><a href="{{route('admin.utilisateur.change_mdp_cook_login')}}">Changer MDP d'un Pizzaiolo</a> </li>
    </ul>
@endsection
