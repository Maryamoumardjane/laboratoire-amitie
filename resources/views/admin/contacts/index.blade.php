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
                <a href="/admin/temoignages" class="nav-link">⭐ Témoignages</a>
            </li>
            <li class="nav-item">
                <a href="/admin/contacts" class="nav-link active">✉️ Messages</a>
            </li>
        </ul>
    </div>

    <div class="main-content">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>✉️ Messages de contact</h1>
            <span class="badge bg-danger" style="font-size:14px; padding:8px 14px; border-radius:20px;">
                {{ $contacts->where('lu', false)->count() }} non lus
            </span>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow border-0 rounded-4 p-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nom</th>
                            <th>Téléphone</th>
                            <th>Objet</th>
                            <th>Message</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                        <tr style="{{ !$contact->lu ? 'background:#f0f7ff;' : '' }}">

                            <td>
                                <strong>{{ $contact->prenom }} {{ $contact->nom }}</strong>
                            </td>

                            <td>{{ $contact->telephone }}</td>

                            <td>
                                <span class="badge"
                                      style="background:#1a2e5a; padding:6px 10px; border-radius:10px;">
                                    {{ $contact->objet }}
                                </span>
                            </td>

                           <td style="max-width:300px;">
    {{ $contact->message }}
</td>

                            <td>
                                @if($contact->lu)
                                    <span class="badge bg-success">✅ Lu</span>
                                @else
                                    <span class="badge bg-warning text-dark">🔵 Non lu</span>
                                @endif
                            </td>

                            <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>

                            <td>
                                <div class="d-flex gap-2">

                                    <!-- MARQUER LU -->
                                    <form method="POST" action="/admin/contacts/{{ $contact->id }}/lu">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-sm {{ $contact->lu ? 'btn-warning' : 'btn-success' }}">
                                            {{ $contact->lu ? '🔵 Non lu' : '✅ Lu' }}
                                        </button>
                                    </form>

                                    <!-- SUPPRIMER -->
                                    <form method="POST" action="/admin/contacts/{{ $contact->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Supprimer ce message ?')">
                                            🗑️
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                Aucun message reçu
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar    = document.getElementById('sidebar');
    if (menuToggle) {
        menuToggle.addEventListener('click', function () {
            sidebar.classList.toggle('active');
        });
    }
});
</script>

@endsection