@extends('layout')

@section('content')

<div class="main-content p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            👨‍⚕️ Liste des Patients
        </h2>

        <a href="/admin/patients/create" class="btn btn-success">
            ➕ Ajouter Patient
        </a>

    </div>

    <div class="card shadow border-0 rounded-4 p-4">

        <table class="table table-hover table-bordered">

            <thead class="table-dark">

                <tr>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>Age</th>
                    <th>Sexe</th>
                    <th>Adresse</th>
                    <th>Actions</th>
                </tr>

            </thead>

            <tbody>

                @foreach($patients as $patient)

                <tr>

                    <td>{{ $patient->nom }}</td>

                    <td>{{ $patient->telephone }}</td>

                    <td>{{ $patient->age }}</td>

                    <td>{{ $patient->sexe }}</td>

                    <td>{{ $patient->adresse }}</td>

                    <td>

                        <a href="/admin/patients/{{ $patient->id }}/edit"
                           class="btn btn-primary btn-sm">
                            Modifier
                        </a>

                        <form action="/admin/patients/{{ $patient->id }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">
                                Supprimer
                            </button>

                        </form>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection