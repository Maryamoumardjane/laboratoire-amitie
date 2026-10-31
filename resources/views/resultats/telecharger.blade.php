@extends('layout')

@section('content')

<div class="container mt-5" style="max-width:500px;">
    <div class="card shadow border-0 rounded-4 p-5 text-center">

        <div style="font-size:60px; margin-bottom:16px;">🔬</div>
        <h2 class="mb-2" style="color:#1a2e5a;">Télécharger mes résultats</h2>
        <p class="text-muted mb-4">
            Saisissez le code unique reçu par email pour accéder à vos résultats.
        </p>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/resultats/verifier">
            @csrf
            <div class="mb-3">
                <input type="text"
                       name="code"
                       class="form-control form-control-lg text-center"
                       placeholder="Ex: AB12CD34"
                       maxlength="8"
                       style="letter-spacing:4px; font-size:22px; font-weight:700; text-transform:uppercase;"
                       required>
            </div>
            <button type="submit" class="btn btn-success w-100 py-3" style="font-size:16px;">
                📥 Télécharger mes résultats
            </button>
        </form>

        <p class="text-muted mt-4" style="font-size:12px;">
            ⚠️ Si vous n'avez pas reçu votre code, contactez-nous au 675 85 82 39
        </p>

    </div>
</div>

@endsection