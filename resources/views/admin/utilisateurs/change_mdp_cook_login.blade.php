@extends('modele')

@section('title','MDP Pizzaiolo')

@section('contents')
    <h1>Changement du mot de passe du pizzaiolo</h1>
    <form method="post">
        <p><label for="login">Login Pizzaiolo :</label>
        <input type="text" id="login" name="login"></p>

        <p><input type="submit" value="Envoyer"></p>
    @csrf
    </form>
@endsection
