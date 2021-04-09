@extends('modele')

@section('contents')
    <form method="post">
        <p><label for="fnom">Nom pizza : </label>
            <input type="text" id="fnom" name="nom"></p>

        <p></p><label for="fdescription">Description :</label>
        <input type="text" id="fdescription" name="description"></p>

        <p></p><label for="fprix">Prix :</label>
        <input type="number" id="fprix" name="prix" min="0" value="0" step="any"></p>

        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection
