@extends('layout')

@section('content')

<div class="main-content p-4">

    <div class="card shadow border-0 rounded-4 p-4">

        <h3 class="mb-4">
            ✏️ Modifier Patient
        </h3>

        <form action="/admin/patients/{{ $patient->id }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Nom</label>

                <input type="text"
                       name="nom"
                       class="form-control"
                       value="{{ $patient->nom }}">

            </div>

            <div class="mb-3">

                <label>Téléphone</label>

                <input type="text"
                       name="telephone"
                       class="form-control"
                       value="{{ $patient->telephone }}">

            </div>

            <div class="mb-3">

                <label>Age</label>

                <input type="number"
                       name="age"
                       class="form-control"
                       value="{{ $patient->age }}">

            </div>

            <div class="mb-3">

                <label>Sexe</label>

                <select name="sexe" class="form-control">

                    <option value="Masculin"
                        {{ $patient->sexe == 'Masculin' ? 'selected' : '' }}>
                        Masculin
                    </option>

                    <option value="Féminin"
                        {{ $patient->sexe == 'Féminin' ? 'selected' : '' }}>
                        Féminin
                    </option>

                </select>

            </div>

            <div class="mb-3">

                <label>Adresse</label>

                <textarea name="adresse"
                          class="form-control">{{ $patient->adresse }}</textarea>

            </div>

            <button class="btn btn-primary">
                Modifier
            </button>

        </form>

    </div>

</div>

@endsection