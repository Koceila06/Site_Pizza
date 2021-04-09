@extends('modele_bootstrap')

@section('title','Pizzas')

@section('contents')
    <p><h1>Ajouter les pizza au panier</h1></p>
    <p><h2>Veuillez selectionner uniquement les pizzas, puis vous allez modifier la quantite dans le panier et confirmer l'achat</h2></p>
    <table>
        <tr>
            <th>Ajouter</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
        </tr>
        @foreach($pizzas as $pizza)
            <tr>
                <td><a href="{{route('user.commande.panier.ajout',["pizza_id"=>$pizza->id])}}">Ajouter</a></td>{{--{{$pizza->id}}  --}}
                <td>{{$pizza->nom}}</td>
                <td>{{$pizza->description}}</td>
                <td>{{$pizza->prix}}</td>
            </tr>
        @endforeach
    </table>
    <h2><a href="{{route('user.commande.panier.afficher')}}">Voir panier</a></h2>
    {{$pizzas->links()}}
@endsection
