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
                <a href="/admin/rendezvous" class="nav-link">📅 Rendez-vous</a>
            </li>
            <li class="nav-item">
                <a href="/admin/examens" class="nav-link">🔬 Examens</a>
            </li>
            <li class="nav-item">
                <a href="/admin/resultats" class="nav-link active">📄 Résultats</a>
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

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>📄 Résultats d'analyses</h1>
            <a href="/admin/resultats/create" class="btn btn-success">
                ➕ Uploader un résultat
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow border-0 rounded-4 p-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Patient</th>
                            <th>Examen</th>
                            <th>Code unique</th>
                            <th>Téléchargé</th>
                            <th>Date upload</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($resultats as $resultat)
                        <tr>
                            <td>{{ $resultat->rendezvous->nom ?? '-' }}</td>
                            <td>{{ $resultat->rendezvous->examen->nom ?? '-' }}</td>
                            <td>
                                <span class="badge"
                                      style="background:#1a2e5a; font-size:14px; letter-spacing:2px; padding:8px 12px;">
                                    {{ $resultat->code_unique }}
                                </span>
                            </td>
                            <td>
                                @if($resultat->telecharge)
                                    <span class="badge bg-success">✅ Oui</span>
                                @else
                                    <span class="badge bg-warning text-dark">⏳ Non</span>
                                @endif
                            </td>
                            <td>{{ $resultat->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $resultat->fichier_pdf) }}"
                                   target="_blank"
                                   class="btn btn-primary btn-sm">
                                    👁 Voir
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Aucun résultat uploadé</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection