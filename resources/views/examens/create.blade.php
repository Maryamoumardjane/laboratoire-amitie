@extends('layout')

@section('content')

<button class="mobile-menu-btn" id="menu-toggle">☰</button>

<div class="dashboard-wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
        <h3>🧪 LAB ADMIN</h3>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="/admin" class="nav-link">📊 Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="/admin/rendezvous" class="nav-link active">📅 Rendez-vous</a>
            </li>
            <li class="nav-item">
                <a href="/admin/examens" class="nav-link">🔬 Examens</a>
            </li>
            <li class="nav-item">
                <a href="/admin/resultats" class="nav-link">📄 Résultats</a>
            </li>
            <li class="nav-item">
                <a href="/admin/temoignages" class="nav-link">⭐ Témoignages</a>
            </li>
            <li class="nav-item">
    <a href="/admin/contacts" class="nav-link d-flex justify-content-between align-items-center">
        <span>✉️ Messages</span>
        @php $nonLus = \App\Models\Contact::where('lu', false)->count(); @endphp
        @if($nonLus > 0)
            <span class="badge rounded-pill" style="background:#dc3545; font-size:11px;">
                {{ $nonLus }}
            </span>
        @endif
    </a>
</li>
        </ul>
    </div>
<div class="container mt-4">

    <h2>➕ Ajouter un examen</h2>

    <form method="POST" action="/examens">
        @csrf

        <input type="text" name="nom" class="form-control mb-2" placeholder="Nom">

        <input type="number" name="prix" class="form-control mb-2" placeholder="Prix">

        <input type="text" name="delai" class="form-control mb-2" placeholder="Délai">

        <input type="text" name="categorie" class="form-control mb-2" placeholder="Catégorie">

        <button class="btn btn-success w-100">
            Enregistrer
        </button>

    </form>

</div>

@endsection