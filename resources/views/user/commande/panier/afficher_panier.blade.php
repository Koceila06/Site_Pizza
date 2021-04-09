@extends('modele')

@section('title','Panier')

@section('contents')
    <h1>Panier des commandes</h1>
    @if(isset($panier) && isset($panier_nom))
    <table>
        <tr>
            <th>Nom pizza</th>
            <th>Quantite</th>
        </tr>

        @foreach($panier as $cle=>$val)
        <tr>
            <td>{{$panier_nom[$cle]}} </td>
            <td> {{$val}} <a href="{{route('user.commande.panier.modifier_quantite_pizza',['pizza_id'=>$cle])}}">Modifier</a> <a href="{{route('user.commande.panier.supprimer',['pizza_id'=>$cle])}}">Supprimer</a>  </td>

        </tr>
        @endforeach
    </table>
    <p><h3><a href="{{route('user.commande.panier.affiche_confirmer_panier')}}"> Confirmer commandes</a></h3></p>
    @else
        Pas de pizza dans le panier
    @endif
    <p><h2><a href="{{route('user.commande.panier.index')}}">Retour aux commandes</a></h2></p>

@endsection
