@extends('modele')

@section('title','Listes commandes')

@section('contents')
    <p><h1>Liste des pizza non traiter</h1></p>
    @if(isset($list)   && isset($pizza_nom) && isset($user_login))
        <table>
            <tr>

                <th>login commanditaire</th>
                <th>Nom pizza</th>
                <th>Statut</th>
                <th>Details</th>
                <th>Date</th>

            </tr>
            @foreach($list as $li)
                <tr>

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
    {{-- {{$list->links()}} --}}
@endsection
