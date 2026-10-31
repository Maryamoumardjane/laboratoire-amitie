@extends('layout')

@section('content')

<button class="mobile-menu-btn" id="menu-toggle">☰</button>

<div class="dashboard-wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
        <h3>🧪 LAB ADMIN</h3>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="/admin" class="nav-link">📊 Dashboard</a></li>
            <li class="nav-item"><a href="/admin/rendezvous" class="nav-link">📅 Rendez-vous</a></li>
            <li class="nav-item"><a href="/admin/examens" class="nav-link active">🔬 Examens</a></li>
            <li class="nav-item"><a href="/admin/resultats" class="nav-link">📄 Résultats</a></li>
            <li class="nav-item"><a href="/admin/temoignages" class="nav-link">⭐ Témoignages</a></li>
            <li class="nav-item">
                <a href="/admin/contacts" class="nav-link d-flex justify-content-between align-items-center">
                    <span>✉️ Messages</span>
                    @php $nonLus = \App\Models\Contact::where('lu', false)->count(); @endphp
                    @if($nonLus > 0)
                        <span class="badge rounded-pill" style="background:#dc3545;font-size:11px;">{{ $nonLus }}</span>
                    @endif
                </a>
            </li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <style>
        :root {
            --blue:   #1F3A5F;
            --green:  #2E7A4F;
            --orange: #E8671A;
        }

        /* ── EN-TÊTE ── */
        .examen-page-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 24px; flex-wrap: wrap; gap: 12px;
        }
        .examen-page-header h2 { font-size: 22px; font-weight: 800; color: var(--blue); margin: 0; }
        .btn-add-exam {
            background: linear-gradient(135deg, var(--green), #1a5c35);
            color: white; border: none; border-radius: 10px;
            padding: 10px 20px; font-weight: 700; font-size: 14px;
            text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
            transition: all .3s ease; box-shadow: 0 4px 14px rgba(46,122,79,.3);
        }
        .btn-add-exam:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(46,122,79,.4); color: white; }

        /* ── STATS RAPIDES ── */
        .exam-admin-stats {
            display: grid; grid-template-columns: repeat(auto-fit,minmax(140px,1fr));
            gap: 14px; margin-bottom: 24px;
        }
        .exam-admin-stat {
            background: white; border-radius: 14px; padding: 16px 18px;
            box-shadow: 0 4px 16px rgba(31,58,95,.08);
            border-left: 4px solid var(--blue);
        }
        .exam-admin-stat.green  { border-left-color: var(--green); }
        .exam-admin-stat.orange { border-left-color: var(--orange); }
        .exam-admin-stat.purple { border-left-color: #7b1fa2; }
        .exam-admin-stat-num { font-size: 26px; font-weight: 800; color: var(--blue); }
        .exam-admin-stat.green  .exam-admin-stat-num { color: var(--green); }
        .exam-admin-stat.orange .exam-admin-stat-num { color: var(--orange); }
        .exam-admin-stat.purple .exam-admin-stat-num { color: #7b1fa2; }
        .exam-admin-stat-lbl { font-size: 12px; color: #6B7280; margin-top: 2px; }

        /* ── FILTRES ── */
        .exam-admin-filters {
            background: white; border-radius: 14px; padding: 16px 20px;
            box-shadow: 0 4px 16px rgba(31,58,95,.08); margin-bottom: 22px;
            display: flex; gap: 12px; flex-wrap: wrap; align-items: center;
        }
        .exam-admin-filters input,
        .exam-admin-filters select {
            border: 1.5px solid #e0e8f5; border-radius: 10px;
            padding: 8px 14px; font-size: 13px; color: var(--blue);
            transition: border-color .3s;
        }
        .exam-admin-filters input:focus,
        .exam-admin-filters select:focus { border-color: var(--green); outline: none; }
        .exam-admin-filters input { flex: 1; min-width: 200px; }
        #admin-count { font-size: 13px; font-weight: 700; color: #6B7280; margin-left: auto; }

        /* ── ONGLETS SERVICE ── */
        .service-tabs-admin { display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap; }
        .stab {
            display: flex; align-items: center; gap: 8px;
            padding: 9px 20px; border-radius: 50px; font-size: 13px;
            font-weight: 700; cursor: pointer; border: 2px solid #e0e8f5;
            background: #f5f8fa; color: var(--blue); transition: all .3s ease;
        }
        .stab:hover { border-color: var(--blue); }
        .stab.active.analyses { background: linear-gradient(135deg,var(--green),#1a5c35); color: white; border-color: transparent; box-shadow: 0 4px 14px rgba(46,122,79,.3); }
        .stab.active.imagerie { background: linear-gradient(135deg,#1565c0,#0a3880); color: white; border-color: transparent; box-shadow: 0 4px 14px rgba(21,101,192,.3); }
        .stab-count { font-size: 11px; background: rgba(0,0,0,.1); padding: 1px 7px; border-radius: 50px; }
        .stab.active .stab-count { background: rgba(255,255,255,.25); }

        /* ── BLOCS SERVICE ── */
        .svc-block { display: none; }
        .svc-block.active { display: block; }

        /* Bandeau service */
        .svc-banner {
            border-radius: 12px; padding: 16px 22px; margin-bottom: 16px;
            display: flex; align-items: center; gap: 14px;
        }
        .svc-banner.analyses { background: linear-gradient(135deg,var(--green),#1a5c35); }
        .svc-banner.imagerie { background: linear-gradient(135deg,#1565c0,#0a3880); }
        .svc-banner-icon { font-size: 28px; width: 54px; height: 54px; background: rgba(255,255,255,.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid rgba(255,255,255,.2); }
        .svc-banner h3 { color: white; font-size: 18px; font-weight: 800; margin: 0 0 3px; }
        .svc-banner p  { color: rgba(255,255,255,.75); font-size: 12px; margin: 0; }

        /* ── CATÉGORIES ADMIN ── */
        .cat-admin-block { margin-bottom: 18px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 16px rgba(31,58,95,.08); }
        .cat-admin-header {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 18px; color: white; cursor: pointer;
            user-select: none; transition: filter .2s;
        }
        .cat-admin-header:hover { filter: brightness(1.1); }
        .cat-admin-header.hematologie { background: linear-gradient(135deg,#7b1fa2,#4a0e6e); }
        .cat-admin-header.bacterio    { background: linear-gradient(135deg,#1F3A5F,#0d1f3c); }
        .cat-admin-header.biochimie   { background: linear-gradient(135deg,#1a5c35,#0d3320); }
        .cat-admin-header.immuno      { background: linear-gradient(135deg,#b84e10,#7a2e00); }
        .cat-admin-header.parasito    { background: linear-gradient(135deg,#00695c,#003d33); }
        .cat-admin-header.echographie { background: linear-gradient(135deg,#1565c0,#0a3880); }
        .cat-admin-icon { width: 36px; height: 36px; background: rgba(255,255,255,.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; border: 1px solid rgba(255,255,255,.2); }
        .cat-admin-title { font-size: 14px; font-weight: 700; }
        .cat-admin-count { margin-left: auto; font-size: 11px; background: rgba(255,255,255,.2); padding: 2px 10px; border-radius: 50px; font-weight: 700; }
        .cat-admin-chevron { font-size: 12px; transition: transform .3s; }
        .cat-admin-block.open .cat-admin-chevron { transform: rotate(180deg); }

        .cat-admin-body { background: white; max-height: 0; overflow: hidden; transition: max-height .4s cubic-bezier(.4,0,.2,1); }
        .cat-admin-block.open .cat-admin-body { max-height: 9999px; }

        /* ── TABLEAU ADMIN ── */
        .exam-admin-table { width: 100%; border-collapse: collapse; }
        .exam-admin-table thead tr { background: #f5f8fa; }
        .exam-admin-table thead th { padding: 10px 16px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--blue); border-bottom: 2px solid #e0e8f5; }
        .exam-admin-table tbody tr { border-bottom: 1px solid #f0f4f8; transition: background .2s; }
        .exam-admin-table tbody tr:hover { background: #f8faff; }
        .exam-admin-table tbody tr.admin-hidden { display: none; }
        .exam-admin-table tbody td { padding: 11px 16px; font-size: 13.5px; color: #334155; vertical-align: middle; }
        .exam-nom { font-weight: 600; color: var(--blue); display: flex; align-items: center; gap: 7px; }
        .exam-nom i { color: var(--green); font-size: 12px; }
        .price-badge { display: inline-flex; align-items: center; gap: 4px; background: linear-gradient(135deg,#e8f5ee,#d4eddb); color: var(--green); font-weight: 700; font-size: 12px; padding: 3px 10px; border-radius: 50px; border: 1px solid #b7dfc5; }
        .delay-badge { display: inline-flex; align-items: center; gap: 4px; background: #fef3e2; color: #92400e; font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 50px; border: 1px solid #f6d28d; }
        .btn-edit { background: linear-gradient(135deg,#1565c0,#0a3880); color: white; border: none; border-radius: 7px; padding: 5px 12px; font-size: 12px; font-weight: 600; text-decoration: none; transition: all .2s; }
        .btn-edit:hover { transform: translateY(-1px); color: white; }
        .btn-del { background: linear-gradient(135deg,#dc3545,#9b1c28); color: white; border: none; border-radius: 7px; padding: 5px 12px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all .2s; }
        .btn-del:hover { transform: translateY(-1px); }

        @media(max-width:768px) {
            .exam-admin-stats { grid-template-columns: 1fr 1fr; }
            .exam-admin-table thead th:nth-child(3) { display: none; }
            .exam-admin-table tbody td:nth-child(3) { display: none; }
        }
        </style>

        @php
            $serviceMap = [
                'analyses' => [
                    'label' => 'Analyses Médicales',
                    'emoji' => '🔬',
                    'desc'  => 'Hématologie, Bactériologie, Biochimie, Immuno, Parasitologie',
                    'cats'  => ['Hématologie','Bactériologie','Biochimie','Immuno','Parasitologie'],
                    'class' => 'analyses',
                ],
                'imagerie' => [
                    'label' => 'Imagerie Médicale',
                    'emoji' => '🩻',
                    'desc'  => 'Échographie, ECG, Echo Cœur et examens d\'imagerie',
                    'cats'  => ['Échographie'],
                    'class' => 'imagerie',
                ],
            ];

            $catMeta = [
                'Hématologie'   => ['icon'=>'fa-droplet',     'class'=>'hematologie','emoji'=>'🩸'],
                'Bactériologie' => ['icon'=>'fa-bacteria',    'class'=>'bacterio',   'emoji'=>'🦠'],
                'Biochimie'     => ['icon'=>'fa-flask',       'class'=>'biochimie',  'emoji'=>'⚗️'],
                'Immuno'        => ['icon'=>'fa-dna',         'class'=>'immuno',     'emoji'=>'🧬'],
                'Parasitologie' => ['icon'=>'fa-bug',         'class'=>'parasito',   'emoji'=>'🪱'],
                'Échographie'   => ['icon'=>'fa-wave-square', 'class'=>'echographie','emoji'=>'🩻'],
            ];

            $examensParCat = $examens->groupBy('categorie');
            $totalExamens  = $examens->count();
            $totalCats     = $examensParCat->count();
        @endphp

        {{-- En-tête --}}
        <div class="examen-page-header">
            <h2>🧪 Gestion des Examens</h2>
            <a href="/examens/create" class="btn-add-exam">
                <i class="fa-solid fa-plus"></i> Ajouter un examen
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success rounded-3">✅ {{ session('success') }}</div>
        @endif

        {{-- Stats rapides --}}
        <div class="exam-admin-stats">
            <div class="exam-admin-stat">
                <div class="exam-admin-stat-num">{{ $totalExamens }}</div>
                <div class="exam-admin-stat-lbl">Total examens</div>
            </div>
            <div class="exam-admin-stat green">
                <div class="exam-admin-stat-num">{{ $examensParCat->filter(fn($v,$k) => in_array($k, ['Hématologie','Bactériologie','Biochimie','Immuno','Parasitologie']))->flatten()->count() }}</div>
                <div class="exam-admin-stat-lbl">Analyses médicales</div>
            </div>
            <div class="exam-admin-stat" style="border-left-color:#1565c0;">
                <div class="exam-admin-stat-num" style="color:#1565c0;">{{ $examensParCat->filter(fn($v,$k) => in_array($k, ['Échographie']))->flatten()->count() }}</div>
                <div class="exam-admin-stat-lbl">Imagerie médicale</div>
            </div>
            <div class="exam-admin-stat purple">
                <div class="exam-admin-stat-num">{{ $totalCats }}</div>
                <div class="exam-admin-stat-lbl">Catégories</div>
            </div>
        </div>

        {{-- Filtres --}}
        <div class="exam-admin-filters">
            <i class="fa-solid fa-magnifying-glass" style="color:#6B7280;"></i>
            <input type="text" id="adminSearch" placeholder="Rechercher un examen…">
            <select id="adminCatFilter">
                <option value="">Toutes les catégories</option>
                @foreach($examensParCat->keys() as $cat)
                    <option value="{{ strtolower($cat) }}">{{ $cat }}</option>
                @endforeach
            </select>
            <span id="admin-count">{{ $totalExamens }} examen(s)</span>
        </div>

        {{-- Onglets service --}}
        <div class="service-tabs-admin">
            @foreach($serviceMap as $key => $srv)
            @php
                $cnt = 0;
                foreach($srv['cats'] as $c) $cnt += isset($examensParCat[$c]) ? $examensParCat[$c]->count() : 0;
            @endphp
            <div class="stab {{ $key }} {{ $loop->first ? 'active' : '' }}" onclick="switchSvc('{{ $key }}')">
                {{ $srv['emoji'] }} {{ $srv['label'] }}
                <span class="stab-count">{{ $cnt }}</span>
            </div>
            @endforeach
        </div>

        {{-- Blocs par service --}}
        @foreach($serviceMap as $key => $srv)
        <div class="svc-block {{ $loop->first ? 'active' : '' }}" id="svc-{{ $key }}">

            {{-- Bandeau --}}
            <div class="svc-banner {{ $srv['class'] }}">
                <div class="svc-banner-icon">{{ $srv['emoji'] }}</div>
                <div>
                    <h3>{{ $srv['label'] }}</h3>
                    <p>{{ $srv['desc'] }}</p>
                </div>
            </div>

            {{-- Catégories --}}
            @foreach($srv['cats'] as $cat)
            @php
                $meta  = $catMeta[$cat] ?? ['icon'=>'fa-vial','class'=>'default','emoji'=>'🧪'];
                $items = $examensParCat[$cat] ?? collect();
                $count = $items->count();
            @endphp

            <div class="cat-admin-block open" data-service="{{ $key }}">

                <div class="cat-admin-header {{ $meta['class'] }}" onclick="toggleAdminCat(this)">
                    <div class="cat-admin-icon"><i class="fa-solid {{ $meta['icon'] }}"></i></div>
                    <span class="cat-admin-title">{{ $meta['emoji'] }} {{ $cat }}</span>
                    <span class="cat-admin-count">{{ $count }} examen{{ $count > 1 ? 's' : '' }}</span>
                    <i class="fa-solid fa-chevron-down cat-admin-chevron ms-2"></i>
                </div>

                <div class="cat-admin-body">
                    @if($count > 0)
                    <table class="exam-admin-table">
                        <thead>
                            <tr>
                                <th style="width:40%">Examen</th>
                                <th style="width:20%">Prix</th>
                                <th style="width:20%">Délai</th>
                                <th style="width:20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $examen)
                            <tr class="admin-exam-row"
                                data-cat="{{ strtolower($examen->categorie) }}"
                                data-name="{{ strtolower($examen->nom) }}">
                                <td>
                                    <div class="exam-nom">
                                        <i class="fa-solid {{ $cat === 'Échographie' ? 'fa-wave-square' : 'fa-vial' }}"></i>
                                        {{ $examen->nom }}
                                    </div>
                                </td>
                                <td>
                                    <span class="price-badge">
                                        <i class="fa-solid fa-coins"></i>
                                        {{ number_format($examen->prix) }} FCFA
                                    </span>
                                </td>
                                <td>
                                    <span class="delay-badge">
                                        <i class="fa-solid fa-clock"></i>
                                        {{ $examen->delai }}
                                    </span>
                                </td>
                                <td>
                                    <a href="/examens/{{ $examen->id }}/edit" class="btn-edit">
                                        <i class="fa-solid fa-pen"></i> Modifier
                                    </a>
                                    <form action="/examens/{{ $examen->id }}" method="POST" class="d-inline ms-1"
                                          onsubmit="return confirm('Supprimer cet examen ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-del">
                                            <i class="fa-solid fa-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div style="padding:20px 18px; color:#6B7280; font-size:13px;">
                        <i class="fa-solid fa-info-circle me-1"></i> Aucun examen dans cette catégorie.
                        <a href="/examens/create" style="color:var(--green); font-weight:600; margin-left:8px;">Ajouter →</a>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach

        </div>
        @endforeach

    </div>{{-- fin main-content --}}
</div>{{-- fin dashboard-wrapper --}}

<script>
/* ── Switcher service ── */
function switchSvc(key) {
    document.querySelectorAll('.stab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.svc-block').forEach(b => b.classList.remove('active'));
    document.querySelector('.stab.' + key).classList.add('active');
    document.getElementById('svc-' + key).classList.add('active');
}

/* ── Accordion catégorie ── */
function toggleAdminCat(header) {
    header.closest('.cat-admin-block').classList.toggle('open');
}

/* ── Recherche + filtre catégorie ── */
document.addEventListener('DOMContentLoaded', function () {
    const search    = document.getElementById('adminSearch');
    const catFilter = document.getElementById('adminCatFilter');
    const countEl   = document.getElementById('admin-count');

    function filter() {
        const q   = search.value.toLowerCase().trim();
        const cat = catFilter.value.toLowerCase().trim();
        let total = 0;

        document.querySelectorAll('.admin-exam-row').forEach(row => {
            const matchQ = !q   || row.dataset.name.includes(q);
            const matchC = !cat || row.dataset.cat === cat;
            row.style.display = (matchQ && matchC) ? '' : 'none';
            if (matchQ && matchC) total++;
        });

        // Ouvrir les blocs qui ont des résultats
        document.querySelectorAll('.cat-admin-block').forEach(block => {
            const visible = [...block.querySelectorAll('.admin-exam-row')]
                              .some(r => r.style.display !== 'none');
            block.style.display = visible ? '' : 'none';
            if (visible && q) block.classList.add('open');
        });

        // Si filtre catégorie → switcher l'onglet automatiquement
        if (cat) {
            const analysesCats = ['hématologie','bactériologie','biochimie','immuno','parasitologie'];
            const key = analysesCats.includes(cat) ? 'analyses' : 'imagerie';
            switchSvc(key);
        }

        countEl.textContent = total + ' examen(s)';
    }

    search.addEventListener('input', filter);
    catFilter.addEventListener('change', filter);

    /* Menu mobile */
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar    = document.getElementById('sidebar');
    if (menuToggle) {
        menuToggle.addEventListener('click', () => sidebar.classList.toggle('active'));
    }
});
</script>

@endsection