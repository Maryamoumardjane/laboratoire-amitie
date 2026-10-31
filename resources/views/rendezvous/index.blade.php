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

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">📅 Liste des Rendez-vous</h4>
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
                            <th>Email</th>
                            <th>Examen</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($rendezvous as $rdv)
                        <tr>

                            <!-- PATIENT -->
                            <td>{{ $rdv->nom }}</td>

                            <!-- EMAIL -->
                            <td>{{ $rdv->email }}</td>

                            <!-- EXAMEN -->
                            <td>{{ $rdv->examen->nom ?? 'Non défini' }}</td>

                            <!-- DATE -->
                            <td>{{ \Carbon\Carbon::parse($rdv->date_rdv)->format('d/m/Y') }}</td>

                            <!-- HEURE -->
                            <td>{{ \Carbon\Carbon::parse($rdv->heure_rdv)->format('H:i') }}</td>

                            <!-- STATUT -->
                            <td>
                                <form action="/rendezvous/{{ $rdv->id }}/statut" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="statut"
                                            class="form-select form-select-sm
                                            @if($rdv->statut == 'confirme') border-success text-success
                                            @elseif($rdv->statut == 'annule') border-danger text-danger
                                            @else border-warning text-warning
                                            @endif"
                                            onchange="this.form.submit()">
                                        <option value="en_attente"
                                            {{ $rdv->statut == 'en_attente' ? 'selected' : '' }}>
                                            ⏳ En attente
                                        </option>
                                        <option value="confirme"
                                            {{ $rdv->statut == 'confirme' ? 'selected' : '' }}>
                                            ✅ Confirmé
                                        </option>
                                        <option value="annule"
                                            {{ $rdv->statut == 'annule' ? 'selected' : '' }}>
                                            ❌ Annulé
                                        </option>
                                    </select>
                                </form>
                            </td>

                            <!-- ACTIONS -->
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="/rendezvous/{{ $rdv->id }}/edit"
                                       class="btn btn-primary btn-sm">
                                        ✏️ Modifier
                                    </a>
                                    <form action="/rendezvous/{{ $rdv->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Supprimer ce rendez-vous ?')">
                                            🗑️ Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                Aucun rendez-vous trouvé
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>

    </div>
    {{-- fin main-content --}}

</div>
{{-- fin dashboard-wrapper --}}

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