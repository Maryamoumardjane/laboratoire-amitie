@extends('layout')

@section('content')

<button class="mobile-menu-btn" id="menu-toggle">☰</button>

<div class="dashboard-wrapper">

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
                <a href="/admin/resultats" class="nav-link">📄 Résultats</a>
            </li>
            <li class="nav-item">
                <a href="/admin/temoignages" class="nav-link active">⭐ Témoignages</a>
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

    <div class="main-content">

        <h1 class="mb-4">⭐ Gestion des Témoignages</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow border-0 rounded-4 p-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Patient</th>
                            <th>Note</th>
                            <th>Avis</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($temoignages as $t)
                        <tr>
                            <td><strong>{{ $t->nom }}</strong><br>
                                <small class="text-muted">{{ $t->email }}</small>
                            </td>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    <span style="color:{{ $i <= $t->etoiles ? '#f4c430' : '#ddd' }}; font-size:18px;">★</span>
                                @endfor
                            </td>
                            <td style="max-width:250px;">{{ $t->message }}</td>
                            <td>
                                @if($t->approuve)
                                    <span class="badge bg-success">✅ Publié</span>
                                @else
                                    <span class="badge bg-warning text-dark">⏳ En attente</span>
                                @endif
                            </td>
                            <td>{{ $t->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-flex gap-2">

                                    <!-- APPROUVER -->
                                    <form method="POST" action="/admin/temoignages/{{ $t->id }}/approuver">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-sm {{ $t->approuve ? 'btn-warning' : 'btn-success' }}">
                                            {{ $t->approuve ? '🚫 Dépublier' : '✅ Publier' }}
                                        </button>
                                    </form>

                                    <!-- SUPPRIMER -->
                                    <form method="POST" action="/admin/temoignages/{{ $t->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Supprimer ce témoignage ?')">
                                            🗑️
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Aucun témoignage reçu</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection