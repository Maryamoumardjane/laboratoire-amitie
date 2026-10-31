@extends('layout')

@section('content')

<div class="main-content p-4">

    <div class="card shadow border-0 rounded-4 p-4">

        <h3 class="mb-4">
            ➕ Ajouter un Patient
        </h3>

        <form action="/admin/patients" method="POST">

            @csrf

            <div class="mb-3">

                <label>Nom</label>

                <input type="text"
                       name="nom"
                       class="form-control"
                       required>

            </div>

            <div class="mb-3">

                <label>Téléphone</label>

                <input type="text"
                       name="telephone"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label>Age</label>

                <input type="number"
                       name="age"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label>Sexe</label>

                <select name="sexe" class="form-control">

                    <option value="Masculin">Masculin</option>

                    <option value="Féminin">Féminin</option>

                </select>

            </div>

            <div class="mb-3">

                <label>Adresse</label>

                <textarea name="adresse"
                          class="form-control"></textarea>

            </div>

            <button class="btn btn-success">
                Enregistrer
            </button>

        </form>

    </div>

</div>

@endsection