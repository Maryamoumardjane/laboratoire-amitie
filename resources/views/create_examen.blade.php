@extends('layout')

@section('content')

<div class="container mt-5">

    <h2>Ajouter un examen</h2>

    <form action="/examens" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nom de l'examen</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Prix</label>
            <input type="number" name="prix" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Délai</label>
            <input type="text" name="delai" class="form-control" required>
        </div>

        <button class="btn btn-primary">
            Enregistrer
        </button>

    </form>

</div>

@endsection