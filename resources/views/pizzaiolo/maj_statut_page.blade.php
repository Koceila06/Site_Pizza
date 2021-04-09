@extends('modele')

@section('title','Listes commandes')

@section('contents')
    <p><h1>Liste des pizza dont le statut est</h1></p>
    @if(isset($list)   && isset($pizza_nom)&& isset($user_login))
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
                    <td>{{$li->statut}}: modifier en :
                        @if($li->staut=="envoye")
                            <a href="{{route('pizzaiolo.maj_statut',['commande_id'=>$li->id,'statut'=>"traitement"])}}">Traitemnt</a>
                            <a href="{{route('pizzaiolo.maj_statut',['commande_id'=>$li->id,'statut'=>"pret"])}}">pret</a>

                        @elseif($li->statut=="traitement")
                            <a href="{{route('pizzaiolo.maj_statut',['commande_id'=>$li->id,'statut'=>"pret"])}}">Pret</a>
                            <a href="{{route('pizzaiolo.maj_statut',['commande_id'=>$li->id,'statut'=>"recupere"])}}">Recuperer</a>

                        @elseif($li->statut=="pret")
                            <a href="{{route('pizzaiolo.maj_statut',['commande_id'=>$li->id,'statut'=>"traitement"])}}">Traitemnt</a>
                            <a href="{{route('pizzaiolo.maj_statut',['commande_id'=>$li->id,'statut'=>"recupere"])}}">Recuperer</a>

                        @else
                            <a href="{{route('pizzaiolo.maj_statut',['commande_id'=>$li->id,'statut'=>"traitement"])}}">Traitemnt</a>
                            <a href="{{route('pizzaiolo.maj_statut',['commande_id'=>$li->id,'statut'=>"pret"])}}">pret</a>
                        @endif

                    </td>
                    <td><a href="{{route('pizzaiolo.detail_commande_non_traiter',['commande_id'=>$li->id])}}">Details</a> </td>
                    <td>{{$li->updated_at}}</td>

                </tr>
            @endforeach
        </table>
        <p><h3><a href="{{route('home.pizzaiolo')}}">Revenir aux choix de maj de statut</a> </h3></p>
    @else
        <p><h2>Pas de pizza</h2></p>
    @endif
    {{-- {{$list->links()}} --}}
@endsection
