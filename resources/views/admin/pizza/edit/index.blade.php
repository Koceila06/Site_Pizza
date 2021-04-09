@extends('modele')


@section('contents')

    <p><a href="{{route('admin.pizza.edit.nom',['id'=>$ida])}}">Nom</a></p>
    <a href="{{route('admin.pizza.edit.description',['id'=>$ida])}}">Description</a>

@endsection
