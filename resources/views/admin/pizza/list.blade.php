@extends('modele')

@section('contents')
    <table class="center">
        <caption>Liste des Pizzas</caption>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
        </tr>
        @foreach($list as $listpi)
            <tr>
                <td>{{$listpi->id}}</td>
                <td>{{$listpi->nom}}</td>
                <td>{{$listpi->description}}</td>
                <td>{{$listpi->prix}}</td>
            </tr>
        @endforeach
    </table>
@endsection
