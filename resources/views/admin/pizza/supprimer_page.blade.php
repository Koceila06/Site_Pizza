@extends('modele')

@section('title','supprimer pizza')

@section('contents')
    <p><h1>Suppression de pizza</h1></p>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Action</th>
        </tr>
        @foreach($list as $listpi)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$listpi->nom}}</td>
                <td>{{$listpi->description}}</td>
                <td>{{$listpi->prix}}</td>
                <td><a href="{{route('admin.pizza.supprimer',['pizza_id'=>$listpi->id])}}">Supprimer {{$loop->iteration}}</a> </td>
            </tr>
        @endforeach
    </table>
@endsection
