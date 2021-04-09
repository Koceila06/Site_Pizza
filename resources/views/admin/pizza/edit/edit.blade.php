@extends('admin.pizza.edit.editmodele')

@section('title','modifier pizza')

@section("content")

    <table class="center">
        <caption>Liste des Pizzas à modifier</caption>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
        </tr>
        @foreach($list as $listpi)
            <tr>
                <td><a href="{{route('admin.pizza.edit.index',['id'=>$listpi->id])}}" >{{$listpi->id}} </a></td>
                <td>{{$listpi->nom}}</td>
                <td>{{$listpi->description}}</td>
            </tr>
        @endforeach
    </table>
    <!--
    <form method="post">
        <label for="fid">ID pizza : </label>
        <input type="text" id="fid" name="ida"><br>

        <input type="submit" value="Envoyer">

    </form>
    -->

@endsection
