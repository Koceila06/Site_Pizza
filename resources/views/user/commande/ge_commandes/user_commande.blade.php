@extends('modele')

@section('title','Listes commandes')

@section('contents')
    <p><h1>Historique des pizzas commander</h1></p>
    @if(isset($list)   && isset($pizza_nom) && isset($user_login))
        <table>
            <tr>
                <th>Nom pizza</th>
                <th>Details</th>
                <th>Date</th>

            </tr>
            @foreach($list as $li)
                <tr>
                    <td>{{$pizza_nom[$li->id]}}</td>
                    <td><a href="{{route('pizzaiolo.detail_commande_non_traiter',['commande_id'=>$li->id])}}">Details</a> </td>
                    <td>{{$li->updated_at}}</td>

                </tr>
            @endforeach
        </table>
    @else
        <p><h2>Vous n'avez pas commander de pizza</h2></p>
    @endif
    {{-- {{$list->links()}} --}}
@endsection
