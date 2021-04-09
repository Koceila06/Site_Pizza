@extends('modele_bootstrap')

@section('title','Listes Pizzas')

@section('contents')
    <table>
        <tr>
            <th>Numero</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
        </tr>
        @foreach($pizzas as $pizza)
            <tr>
                <td>{{$pizza->id}} </td>
                <td>{{$pizza->nom}}</td>
                <td>{{$pizza->description}}</td>
                <td>{{$pizza->prix}}</td>
            </tr>
        @endforeach
    </table>
    {{$pizzas->links()}}
@endsection
