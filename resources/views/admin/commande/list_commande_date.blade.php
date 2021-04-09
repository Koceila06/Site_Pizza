@extends('modele')

@section('titel','Date_commande')

@section('contents')
    <table class="center">
        <caption>Liste des Pizzas</caption>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>user login</th>
            <th>Date</th>
        </tr>
        @foreach($commande as $com)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$pizza_nom[$com->id]}}</td>
                <td>{{$user_login[$com->user_id]}}</td>
                <td>{{$com->created_at}}</td>
            </tr>
        @endforeach
    </table>
@endsection
