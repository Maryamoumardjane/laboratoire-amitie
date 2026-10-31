@extends('layout')

@section('content')

<!-- BOUTON MOBILE -->
<button class="mobile-menu-btn" id="menu-toggle">☰</button>

<div class="dashboard-wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">

        <h3>🧪 LAB ADMIN</h3>

        <ul class="nav flex-column">

            <li class="nav-item">
                <a href="/admin" class="nav-link active">
                    📊 Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="/admin/rendezvous" class="nav-link d-flex justify-content-between align-items-center">
                    <span>📅 Rendez-vous</span>
                    @if($enAttenteGlobal > 0)
                        <span class="badge rounded-pill"
                              style="background:#dc3545; font-size:11px; animation: pulse 1s infinite;">
                            {{ $enAttenteGlobal }}
                        </span>
                    @endif
                </a>
            </li>

            <li class="nav-item">
                <a href="/admin/examens" class="nav-link">
                    🔬 Examens
                </a>
            </li>

            <li class="nav-item">
                <a href="/admin/patients" class="nav-link">
                    👨‍⚕️ Patients
                </a>
            </li>

            <li class="nav-item">
    <a href="/admin/resultats" class="nav-link">
        📄 Résultats
    </a>
</li>


<li class="nav-item">
    <a href="/admin/temoignages" class="nav-link">
        ⭐ Témoignages
    </a>
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

        <h1 class="mb-4">Tableau de bord Administrateur</h1>

        <!-- ===== CARDS STATS ===== -->
        <div class="row g-4">

            <!-- RDV -->
            <div class="col-md-4">
                <div class="card shadow p-4">
                    <h5>📅 Rendez-vous</h5>
                    <h2>{{ $rendezvousCount }}</h2>
                </div>
            </div>

            <!-- EXAMENS -->
            <div class="col-md-4">
                <div class="card shadow p-4">
                    <h5>🔬 Examens</h5>
                    <h2>{{ $examensCount }}</h2>
                </div>
            </div>

            <!-- PATIENTS -->
            <div class="col-md-4">
                <div class="card shadow p-4">
                    <h5>👨‍⚕️ Patients</h5>
                    <h2>0</h2>
                </div>
            </div>

        </div>

        <!-- ===== STATUTS RDV ===== -->
        <div class="card shadow p-4 mt-4">

            <h5 class="mb-4">📊 Statuts des Rendez-vous</h5>

            <div class="row g-3">

                <!-- EN ATTENTE -->
                <div class="col-md-4">
                    <div class="card border-0 p-3 text-center"
                         style="background:linear-gradient(135deg, #fff8e1, #ffe082); border-radius:12px;">
                        <div style="font-size:32px;">⏳</div>
                        <h2 class="fw-bold mt-1" style="color:#e65100;">{{ $enAttenteCount }}</h2>
                        <p class="mb-0 fw-semibold" style="color:#e65100;">En attente</p>
                        <div class="mt-2">
                            <div class="progress" style="height:6px; border-radius:10px;">
                                <div class="progress-bar"
                                     style="width:{{ $rendezvousCount > 0 ? round($enAttenteCount / $rendezvousCount * 100) : 0 }}%;
                                            background:#ff9800; border-radius:10px;">
                                </div>
                            </div>
                            <small style="color:#e65100;">
                                {{ $rendezvousCount > 0 ? round($enAttenteCount / $rendezvousCount * 100) : 0 }}%
                            </small>
                        </div>
                    </div>
                </div>

                <!-- CONFIRMÉS -->
                <div class="col-md-4">
                    <div class="card border-0 p-3 text-center"
                         style="background:linear-gradient(135deg, #e8f5e9, #a5d6a7); border-radius:12px;">
                        <div style="font-size:32px;">✅</div>
                        <h2 class="fw-bold mt-1" style="color:#1b5e20;">{{ $confirmeCount }}</h2>
                        <p class="mb-0 fw-semibold" style="color:#1b5e20;">Confirmés</p>
                        <div class="mt-2">
                            <div class="progress" style="height:6px; border-radius:10px;">
                                <div class="progress-bar"
                                     style="width:{{ $rendezvousCount > 0 ? round($confirmeCount / $rendezvousCount * 100) : 0 }}%;
                                            background:#28a745; border-radius:10px;">
                                </div>
                            </div>
                            <small style="color:#1b5e20;">
                                {{ $rendezvousCount > 0 ? round($confirmeCount / $rendezvousCount * 100) : 0 }}%
                            </small>
                        </div>
                    </div>
                </div>

                <!-- ANNULÉS -->
                <div class="col-md-4">
                    <div class="card border-0 p-3 text-center"
                         style="background:linear-gradient(135deg, #fdecea, #ef9a9a); border-radius:12px;">
                        <div style="font-size:32px;">❌</div>
                        <h2 class="fw-bold mt-1" style="color:#b71c1c;">{{ $annuleCount }}</h2>
                        <p class="mb-0 fw-semibold" style="color:#b71c1c;">Annulés</p>
                        <div class="mt-2">
                            <div class="progress" style="height:6px; border-radius:10px;">
                                <div class="progress-bar"
                                     style="width:{{ $rendezvousCount > 0 ? round($annuleCount / $rendezvousCount * 100) : 0 }}%;
                                            background:#dc3545; border-radius:10px;">
                                </div>
                            </div>
                            <small style="color:#b71c1c;">
                                {{ $rendezvousCount > 0 ? round($annuleCount / $rendezvousCount * 100) : 0 }}%
                            </small>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- ===== RDV DU JOUR ===== -->
        <div class="card shadow p-4 mt-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">🔔 Rendez-vous du jour</h4>
                <span class="badge bg-danger">
                    {{ $todayRendezvous->count() }} aujourd'hui
                </span>
            </div>

            @forelse($todayRendezvous as $rdv)
                <div class="notification-item">
                    <div>
                        <strong>👤 {{ $rdv->nom }}</strong>
                        <br>
                        <small>⏰ {{ $rdv->heure_rdv }}</small>
                    </div>
                </div>
            @empty
                <div class="alert alert-success mb-0">
                    ✅ Aucun rendez-vous aujourd'hui
                </div>
            @endforelse

        </div>

        <!-- ===== CALENDRIER ===== -->
        <div class="card shadow p-4 mt-4">
            <h4 class="mb-4">📆 Calendrier des Rendez-vous</h4>
            <div id="calendar"></div>
        </div>

        <!-- ===== GRAPHIQUE BARRES ===== -->
        

        <!-- ===== GRAPHIQUE ÉVOLUTION MENSUELLE ===== -->
        <div class="card shadow p-4 mt-4 mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">📈 Évolution des Rendez-vous (12 derniers mois)</h4>
                <span class="badge"
                      style="background:#1a2e5a; font-size:13px; padding:8px 14px; border-radius:20px;">
                    {{ array_sum($moisData) }} total
                </span>
            </div>
            <div style="position:relative; height:300px;">
                <canvas id="evolutionChart"></canvas>
            </div>
        </div>

    </div>
    {{-- fin main-content --}}

</div>
{{-- fin dashboard-wrapper --}}


<!-- ===== SCRIPTS ===== -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    // CALENDRIER
    var calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 650,
            events: '/admin/events',
            eventClick: function(info) {
                alert('Patient : ' + info.event.title);
            }
        });
        calendar.render();
    }

    // MENU MOBILE
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar    = document.getElementById('sidebar');
    if (menuToggle) {
        menuToggle.addEventListener('click', function () {
            sidebar.classList.toggle('active');
        });
    }

    // GRAPHIQUE BARRES
    const ctxBar = document.getElementById('statsChart');
    if (ctxBar) {
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Rendez-vous', 'Examens', 'Patients'],
                datasets: [{
                    label: 'Statistiques',
                    data: [
                        {{ $stats['rendezvous'] }},
                        {{ $stats['examens'] }},
                        {{ $stats['patients'] }}
                    ],
                    backgroundColor: ['#fe780a', '#1f3c88', '#28a745'],
                    borderRadius: 10,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
    }

    // GRAPHIQUE ÉVOLUTION MENSUELLE
    const ctxLine = document.getElementById('evolutionChart');
    if (ctxLine) {
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: {!! json_encode($moisLabels) !!},
                datasets: [{
                    label: 'Rendez-vous',
                    data: {!! json_encode($moisData) !!},
                    borderColor: '#1a2e5a',
                    backgroundColor: 'rgba(26, 46, 90, 0.08)',
                    borderWidth: 3,
                    pointBackgroundColor: '#0BAF87',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 9,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1a2e5a',
                        titleColor: '#fff',
                        bodyColor: '#0BAF87',
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.parsed.y + ' rendez-vous';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#666', font: { size: 11 }, maxRotation: 45 }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        ticks: { color: '#666', stepSize: 1, precision: 0 }
                    }
                }
            }
        });
    }

});
</script>

@endsection