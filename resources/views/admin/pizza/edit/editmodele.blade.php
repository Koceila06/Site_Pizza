@extends('modele')

@section('contents')
    <p><a href="{{route('admin.pizza.edit')}}">Liste des pizza à modifier</a></p>
    @yield('content')
@endsection
