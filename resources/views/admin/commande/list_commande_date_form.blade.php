@extends('modele')

@section('titel','Date_commande')

@section('contents')
    <form method="post">
        <label for="fdate">Date affichage:</label>
        <input type="date" id="fdate" name="date_f">
        <input type="submit">
        @csrf
    </form>
@endsection
