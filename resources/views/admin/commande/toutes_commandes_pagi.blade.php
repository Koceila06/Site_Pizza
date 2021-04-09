@extends('modele_bootstrap')

@section('title','commande du jour')

@section('contents')
    <p><h1>Liste de toutes les commandes</h1></p>
    @if(isset($list)   && isset($pizza_nom) && isset($user_login))
        <table>
            <tr>
                <th>Commande n°</th>
                <th>login commanditaire</th>
                <th>Nom pizza</th>
                <th>Statut</th>
                <th>Details</th>
                <th>Date de la commande</th>

            </tr>
            @foreach($list as $li)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user_login[$li->user_id]}} </td>
                    <td>{{$pizza_nom[$li->id]}}</td>
                    <td>{{$li->statut}}</td>
                    <td><a href="{{route('pizzaiolo.detail_commande_non_traiter',['commande_id'=>$li->id])}}">Details</a> </td>
                    <td>{{$li->updated_at}}</td>

                </tr>
            @endforeach
        </table>
    @else
        <p><h2>Tout les pizzas sont traiter</h2></p>
    @endif
    {{$list->links()}}
@endsection
