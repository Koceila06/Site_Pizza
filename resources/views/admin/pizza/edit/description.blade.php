@extends('modele')

@section('contents')
    <form method="post">
        <p><label for="fdescription">Descritpion :</label>
            <input type="text" id="fdescription" name="description">

            <input type="submit" value="Envoyer"></p>
        @csrf
    </form>
@endsection
