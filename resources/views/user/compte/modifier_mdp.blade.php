@extends('modele')

@section('title','Modifier mdp')

@section('contents')
    <h1>Modifier mdp</h1>
    <form method="post">

        <p></p><label for="fa_mdp">Ancien Password :</label>
        <input type="password" name="a_mdp"></p>

        <p></p><label for="fmdp">Nouveau Password :</label>
        <input type="password" id="fmdp" name="mdp"></p>

        <p></p><label for="fcmdp">Confirmer nouveau Password :</label>
        <input type="password" id="fcmdp" name="mdp_confirmation"></p>

        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection
