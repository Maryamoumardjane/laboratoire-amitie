@extends('layout')

@section('content')

{{-- ===== STYLES ===== --}}
<style>
:root {
    --blue:   #1F3A5F;
    --green:  #2E7A4F;
    --orange: #E8671A;
    --white:  #FFFFFF;
    --bg:     #F5F8FA;
    --soft:   #EEF2F7;
    --muted:  #6B7280;
}

/* ── HERO ────────────────────────────────────────── */
.exam-hero {
    background: linear-gradient(135deg, var(--blue) 0%, #0d1f3c 60%, #1a3a1f 100%);
    padding: 56px 0 40px;
    position: relative; overflow: hidden;
}
.exam-hero::before {
    content: ''; position: absolute; inset: 0;
    background-image:
        radial-gradient(circle,rgba(255,255,255,.07) 1.5px,transparent 1.5px),
        radial-gradient(circle,rgba(255,255,255,.04) 1.5px,transparent 1.5px);
    background-size: 44px 44px, 72px 72px;
    background-position: 0 0, 22px 22px;
    animation: dotsDrift 28s linear infinite; pointer-events: none;
}
@keyframes dotsDrift { to { transform: translate(44px,44px); } }
.exam-hero-tag {
    display: inline-block;
    background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.25);
    color: #fff; font-size: 11px; font-weight: 700; letter-spacing: 2px;
    text-transform: uppercase; padding: 5px 18px; border-radius: 50px;
    margin-bottom: 14px; backdrop-filter: blur(4px);
}
.exam-hero h1 { color: #fff; font-size: 36px; font-weight: 800; margin-bottom: 10px; line-height: 1.2; }
.exam-hero p  { color: rgba(255,255,255,.72); font-size: 15px; margin: 0; }
.exam-hero-bar { width: 70px; height: 4px; border-radius: 4px; background: linear-gradient(90deg,var(--orange),var(--green)); margin: 14px auto 0; }
.exam-stats { display: flex; justify-content: center; gap: 32px; margin-top: 28px; flex-wrap: wrap; }
.exam-stat { text-align: center; }
.exam-stat-num { font-size: 28px; font-weight: 800; background: linear-gradient(135deg,var(--orange),#f59e0b); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
.exam-stat-lbl { font-size: 12px; color: rgba(255,255,255,.6); margin-top: 2px; }

/* ── FILTRES ─────────────────────────────────────── */
.exam-filters-wrap {
    background: var(--white); border-radius: 20px;
    box-shadow: 0 8px 32px rgba(31,58,95,.10);
    padding: 24px 28px; margin-top: -28px; position: relative; z-index: 10;
}
.exam-filters-wrap label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--blue); margin-bottom: 6px; display: block; }
.exam-filters-wrap .form-control { border: 1.5px solid #e0e8f5; border-radius: 12px; padding: 10px 16px; font-size: 14px; color: var(--blue); transition: border-color .3s,box-shadow .3s; }
.exam-filters-wrap .form-control:focus { border-color: var(--green); box-shadow: 0 0 0 3px rgba(46,122,79,.12); outline: none; }
.exam-count-badge { display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg,var(--blue),var(--green)); color: #fff; font-size: 12px; font-weight: 700; padding: 6px 16px; border-radius: 50px; box-shadow: 0 4px 12px rgba(31,58,95,.2); }

/* ── ONGLETS DE SERVICE (boutons pilule, comme la capture) ── */
.service-tabs {
    display: flex; justify-content: center; gap: 14px;
    margin: 32px 0 28px; flex-wrap: wrap;
}
.service-tab {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 12px 22px; border-radius: 50px;
    font-weight: 700; font-size: 14.5px; cursor: pointer;
    border: none; background: #eef2f7; color: var(--blue);
    box-shadow: 0 2px 8px rgba(31,58,95,.06);
    transition: all .3s ease;
}
.service-tab:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(31,58,95,.14); }
.service-tab.active.analyses {
    background: linear-gradient(135deg, #e3f3e9, #d8eee0);
    color: var(--green);
    box-shadow: 0 4px 16px rgba(46,122,79,.18);
}
.service-tab.active.imagerie {
    background: linear-gradient(135deg, #1565c0, #0a3880);
    color: #fff;
    box-shadow: 0 6px 20px rgba(21,101,192,.32);
}
.service-tab-icon { font-size: 17px; line-height: 1; }
.service-tab-count {
    font-size: 12px; font-weight: 700;
    padding: 2px 11px; border-radius: 50px;
    background: rgba(31,58,95,.08); color: var(--blue);
}
.service-tab.active.analyses .service-tab-count { background: rgba(46,122,79,.16); color: var(--green); }
.service-tab.active.imagerie .service-tab-count { background: rgba(255,255,255,.25); color: #fff; }

.service-block { display: none; }
.service-block.active { display: block; }

/* ── CATÉGORIES ──────────────────────────────────── */
.cat-section { margin-bottom: 28px; }
.cat-header {
    display: flex; align-items: center; gap: 14px;
    background: linear-gradient(135deg,var(--blue),#0d1f3c);
    color: #fff; padding: 14px 22px; border-radius: 14px 14px 0 0;
    cursor: pointer; user-select: none; position: relative; overflow: hidden;
    transition: filter .3s ease;
}
.cat-header::after { content: ''; position: absolute; right: -16px; top: -16px; width: 80px; height: 80px; border-radius: 50%; background: rgba(255,255,255,.06); }
.cat-header:hover { filter: brightness(1.12); }
.cat-header.hematologie { background: linear-gradient(135deg,#7b1fa2,#4a0e6e); }
.cat-header.bacterio    { background: linear-gradient(135deg,#1F3A5F,#0d1f3c); }
.cat-header.biochimie   { background: linear-gradient(135deg,#1a5c35,#0d3320); }
.cat-header.immuno      { background: linear-gradient(135deg,#b84e10,#7a2e00); }
.cat-header.parasito    { background: linear-gradient(135deg,#00695c,#003d33); }
.cat-header.echographie { background: linear-gradient(135deg,#1565c0,#0a3880); }
.cat-header.default     { background: linear-gradient(135deg,#37474f,#1c2a30); }

.cat-header-icon { width: 42px; height: 42px; border-radius: 12px; background: rgba(255,255,255,.15); display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; border: 1.5px solid rgba(255,255,255,.2); }
.cat-header-text h4   { font-size: 16px; font-weight: 700; margin: 0 0 2px; }
.cat-header-text small { font-size: 12px; color: rgba(255,255,255,.65); }
.cat-header-chevron { margin-left: auto; font-size: 14px; transition: transform .35s ease; }
.cat-section.open .cat-header-chevron { transform: rotate(180deg); }

.cat-body {
    border: 1.5px solid #e0e8f5; border-top: none;
    border-radius: 0 0 14px 14px; overflow: hidden;
    max-height: 0; transition: max-height .5s cubic-bezier(.4,0,.2,1);
}
.cat-section.open .cat-body { max-height: 9999px; }

/* ── BLOC TYPES ÉCHOGRAPHIE ──────────────────────── */
.echo-types-block {
    background: linear-gradient(135deg,#f0f5ff,#e8f0fe);
    border-bottom: 2px solid #dce6f5;
    padding: 22px 24px;
}
.echo-types-title {
    font-weight: 800; font-size: 13px; color: var(--blue);
    text-transform: uppercase; letter-spacing: 1.5px;
    margin-bottom: 18px; display: flex; align-items: center; gap: 8px;
}
.echo-types-title i { color: var(--green); font-size: 15px; }

.echo-types-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

.echo-types-col-label {
    font-size: 11px; font-weight: 700; text-transform: uppercase;
    letter-spacing: 1px; color: var(--muted);
    margin-bottom: 10px; padding-bottom: 6px;
    border-bottom: 2px solid #dce6f5;
}

.echo-type-item {
    display: flex; align-items: center; gap: 10px;
    background: white; border: 1.5px solid #e0e8f5;
    border-radius: 10px; padding: 9px 14px;
    margin-bottom: 7px; font-size: 13.5px; color: var(--blue);
    transition: all .25s ease; cursor: default;
}
.echo-type-item:hover { background: #e8f0fe; border-color: #99b8e8; transform: translateX(5px); }
.echo-type-icon {
    width: 32px; height: 32px; border-radius: 8px;
    background: linear-gradient(135deg,#1565c0,#0a3880);
    color: #fff; display: flex; align-items: center; justify-content: center;
    font-size: 13px; flex-shrink: 0;
}

.echo-special-box {
    margin-top: 14px;
    background: linear-gradient(135deg,#1F3A5F,#0d1f3c);
    border-radius: 12px; padding: 14px 16px;
}
.echo-special-title {
    color: rgba(255,255,255,.65); font-size: 10px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 1.5px;
    margin-bottom: 10px; display: flex; align-items: center; gap: 6px;
}
.echo-special-title i { color: var(--orange); }
.echo-special-item {
    color: white; font-size: 13px; font-weight: 600;
    display: flex; align-items: center; gap: 8px; margin-bottom: 8px;
}
.echo-special-item:last-child { margin-bottom: 0; }
.echo-special-item i { color: var(--orange); font-size: 14px; }

/* ── TABLEAU ─────────────────────────────────────── */
.exam-table { width: 100%; border-collapse: collapse; margin: 0; }
.exam-table thead tr  { background: var(--soft); }
.exam-table thead th  { padding: 12px 18px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--blue); border-bottom: 2px solid #dce6f5; }
.exam-table tbody .exam-row { border-bottom: 1px solid #f0f4f8; transition: background .2s ease; }
.exam-table tbody .exam-row:hover { background: #f0f6ff; }
.exam-table tbody .exam-row td { padding: 13px 18px; font-size: 14px; color: #334155; vertical-align: middle; }

.exam-name { display: flex; align-items: center; gap: 8px; font-weight: 600; color: var(--blue); }
.exam-name i { color: var(--green); font-size: 13px; }

.price-badge { display: inline-flex; align-items: center; gap: 5px; background: linear-gradient(135deg,#e8f5ee,#d4eddb); color: var(--green); font-weight: 700; font-size: 13px; padding: 4px 12px; border-radius: 50px; border: 1px solid #b7dfc5; }
.delay-badge { display: inline-flex; align-items: center; gap: 5px; background: #fef3e2; color: #92400e; font-size: 12px; font-weight: 600; padding: 4px 12px; border-radius: 50px; border: 1px solid #f6d28d; }

/* ── NO RESULT ───────────────────────────────────── */
.no-result { text-align: center; padding: 48px 20px; display: none; }
.no-result i { font-size: 48px; color: #dce6f5; margin-bottom: 12px; }
.no-result p { color: var(--muted); font-size: 15px; }

/* ── ANIMATIONS ──────────────────────────────────── */
.sa-up { opacity: 0; transform: translateY(40px); transition: opacity .7s ease,transform .7s ease; }
.sa-up.on { opacity: 1; transform: none; }

/* ── RESPONSIVE ──────────────────────────────────── */
@media (max-width: 768px) {
    .exam-hero h1       { font-size: 26px; }
    .exam-stats         { gap: 20px; }
    .exam-filters-wrap  { padding: 16px; margin-top: -16px; }
    .echo-types-grid    { grid-template-columns: 1fr; }
    .service-tab        { font-size: 13px; padding: 10px 16px; }
}
</style>

{{-- ===== HERO ===== --}}
<div class="exam-hero text-center">
    <div class="container" style="position:relative;z-index:1;">
        <span class="exam-hero-tag">📋 Catalogue</span>
        <h1>🧪 Liste des Examens</h1>
        <p>Consultez nos tarifs et délais pour chaque analyse disponible au laboratoire</p>
        <div class="exam-hero-bar"></div>
        <div class="exam-stats">
            <div class="exam-stat">
                <div class="exam-stat-num">{{ $examens->flatten()->count() }}</div>
                <div class="exam-stat-lbl">Examens disponibles</div>
            </div>
            <div class="exam-stat">
                <div class="exam-stat-num">{{ count($categories) }}</div>
                <div class="exam-stat-lbl">Catégories</div>
            </div>
            <div class="exam-stat">
                <div class="exam-stat-num">24h</div>
                <div class="exam-stat-lbl">Résultats express</div>
            </div>
        </div>
    </div>
</div>

{{-- ===== FILTRES ===== --}}
<div class="container">
    <div class="exam-filters-wrap sa-up">
        <div class="row align-items-end g-3">
            <div class="col-md-5">
                <label><i class="fa-solid fa-magnifying-glass me-1"></i> Rechercher</label>
                <input type="text" id="searchInput" class="form-control" placeholder="Nom d'examen…">
            </div>
            <div class="col-md-4">
                <label><i class="fa-solid fa-filter me-1"></i> Catégorie</label>
                <select id="categoryFilter" class="form-control">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 text-md-end">
                <span class="exam-count-badge">
                    <i class="fa-solid fa-vial"></i>
                    <span id="visibleCount">{{ $examens->flatten()->count() }}</span> examen(s)
                </span>
            </div>
        </div>
    </div>

    {{-- ===== BOUTONS DE SERVICE ===== --}}
    @php
        $serviceTabsMap = [
            'analyses' => [
                'label' => 'Analyses Médicales',
                'emoji' => '🔬',
                'cats'  => ['Hématologie', 'Bactériologie', 'Biochimie', 'Immuno', 'Parasitologie'],
            ],
            'imagerie' => [
                'label' => 'Imagerie Médicale',
                'emoji' => '🩻',
                'cats'  => ['Échographie'],
            ],
        ];
    @endphp

    <div class="service-tabs">
        @foreach($serviceTabsMap as $key => $srv)
        @php
            $cnt = 0;
            foreach ($srv['cats'] as $c) {
                $cnt += isset($examens[$c]) ? count($examens[$c]) : 0;
            }
        @endphp
        <button type="button"
                class="service-tab {{ $key }} {{ $loop->first ? 'active' : '' }}"
                onclick="switchServiceTab('{{ $key }}')">
            <span class="service-tab-icon">{{ $srv['emoji'] }}</span>
            {{ $srv['label'] }}
            <span class="service-tab-count">{{ $cnt }}</span>
        </button>
        @endforeach
    </div>
</div>

{{-- ===== LISTE PAR CATÉGORIE (groupée par service) ===== --}}
<div class="container my-4">

    <div id="noResult" class="no-result">
        <i class="fa-solid fa-flask-vial"></i>
        <p>Aucun examen trouvé pour votre recherche.</p>
    </div>

    @php
        function getCatMeta(string $cat): array {
            $c = mb_strtolower(trim($cat));
            if (str_contains($c, 'matolog'))
                return ['icon' => 'fa-droplet',     'class' => 'hematologie', 'emoji' => '🩸'];
            if (str_contains($c, 'bact'))
                return ['icon' => 'fa-bacteria',    'class' => 'bacterio',    'emoji' => '🦠'];
            if (str_contains($c, 'bioch'))
                return ['icon' => 'fa-flask',       'class' => 'biochimie',   'emoji' => '⚗️'];
            if (str_contains($c, 'immuno') || str_contains($c, 'hormon') || str_contains($c, 'serolog'))
                return ['icon' => 'fa-dna',         'class' => 'immuno',      'emoji' => '🧬'];
            if (str_contains($c, 'parasit'))
                return ['icon' => 'fa-bug',         'class' => 'parasito',    'emoji' => '🪱'];
            if (str_contains($c, 'echo') || str_contains($c, 'imagerie') || str_contains($c, 'graph'))
                return ['icon' => 'fa-wave-square', 'class' => 'echographie', 'emoji' => '🩻'];
            if (str_contains($c, 'ecg') || str_contains($c, 'cardio'))
                return ['icon' => 'fa-heart-pulse', 'class' => 'echographie', 'emoji' => '❤️'];
            return ['icon' => 'fa-vial',            'class' => 'default',     'emoji' => '🧪'];
        }

        function getCatServiceKey(string $cat, array $map): string {
            foreach ($map as $key => $info) {
                if (in_array($cat, $info['cats'])) return $key;
            }
            return 'analyses';
        }

        $echoCol1 = [
            ['fa-baby',           'Obstétricale'],
            ['fa-venus',          'Pelvienne'],
            ['fa-circle-dot',     'Pelvienne (endovaginale)'],
            ['fa-circle-nodes',   'Abdominale'],
            ['fa-arrows-up-down', 'Abdomino-pelvienne'],
            ['fa-circle',         'Prostatique'],
            ['fa-bullseye',       'Prostatique (endorectale)'],
        ];
        $echoCol2 = [
            ['fa-mars',               'Testiculaire'],
            ['fa-kidneys',            'Rénale, vésicale et Prostatique'],
            ['fa-circle-half-stroke', 'Mammaire'],
            ['fa-hand-dots',          'Parties molles'],
            ['fa-ellipsis',           'Autre (à préciser)'],
        ];
    @endphp

    @foreach($serviceTabsMap as $skey => $sinfo)
    <div class="service-block {{ $loop->first ? 'active' : '' }}" id="service-block-{{ $skey }}">

        @foreach($examens as $categorie => $items)
            @continue(getCatServiceKey($categorie, $serviceTabsMap) !== $skey)
            @php
                $meta   = getCatMeta($categorie);
                $count  = count($items);
                $isEcho = in_array($meta['class'], ['echographie']);
            @endphp

            <div class="cat-section open sa-up" data-cat="{{ $categorie }}" data-service="{{ $skey }}">

                <div class="cat-header {{ $meta['class'] }}" onclick="toggleCat(this)">
                    <div class="cat-header-icon">
                        <i class="fa-solid {{ $meta['icon'] }}"></i>
                    </div>
                    <div class="cat-header-text">
                        <h4>{{ $meta['emoji'] }} {{ $categorie }}</h4>
                        <small>{{ $count }} examen{{ $count > 1 ? 's' : '' }}</small>
                    </div>
                    <i class="fa-solid fa-chevron-down cat-header-chevron"></i>
                </div>

                <div class="cat-body">

                    @if($isEcho)
                    <div class="echo-types-block">
                        <div class="echo-types-title">
                            <i class="fa-solid fa-list-check"></i>
                            Types d'examens échographiques disponibles
                        </div>
                        <div class="echo-types-grid">
                            <div>
                                <div class="echo-types-col-label">Gynéco-obstétrical & Abdominal</div>
                                @foreach($echoCol1 as $ex)
                                <div class="echo-type-item">
                                    <div class="echo-type-icon"><i class="fa-solid {{ $ex[0] }}"></i></div>
                                    <span>{{ $ex[1] }}</span>
                                </div>
                                @endforeach
                            </div>
                            <div>
                                <div class="echo-types-col-label">Autres examens</div>
                                @foreach($echoCol2 as $ex)
                                <div class="echo-type-item">
                                    <div class="echo-type-icon"><i class="fa-solid {{ $ex[0] }}"></i></div>
                                    <span>{{ $ex[1] }}</span>
                                </div>
                                @endforeach
                                <div class="echo-special-box">
                                    <div class="echo-special-title">
                                        <i class="fa-solid fa-star"></i> Inclus également
                                    </div>
                                    <div class="echo-special-item">
                                        <i class="fa-solid fa-heart-pulse"></i> ECG
                                    </div>
                                    <div class="echo-special-item">
                                        <i class="fa-solid fa-heart"></i> Echo Cœur
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($count > 0)
                    <table class="exam-table">
                        <thead>
                            <tr>
                                <th style="width:55%">Examen</th>
                                <th style="width:25%">Prix</th>
                                <th style="width:20%">Délai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $exam)
                            <tr class="exam-row"
                                data-category="{{ $exam->categorie }}"
                                data-service="{{ $skey }}"
                                data-name="{{ strtolower($exam->nom) }}">
                                <td>
                                    <div class="exam-name">
                                        <i class="fa-solid {{ $isEcho ? 'fa-wave-square' : 'fa-vial' }}"></i>
                                        {{ $exam->nom }}
                                    </div>
                                </td>
                                <td>
                                    <span class="price-badge">
                                        <i class="fa-solid fa-coins"></i>
                                        {{ number_format($exam->prix) }} FCFA
                                    </span>
                                </td>
                                <td>
                                    <span class="delay-badge">
                                        <i class="fa-solid fa-clock"></i>
                                        {{ $exam->delai }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif

                </div>
            </div>
        @endforeach

    </div>
    @endforeach

</div>

{{-- ===== JAVASCRIPT ===== --}}
<script>
/* ── Switch service ── */
function switchServiceTab(key) {
    document.querySelectorAll('.service-tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.service-block').forEach(b => b.classList.remove('active'));
    document.querySelector('.service-tab.' + key).classList.add('active');
    document.getElementById('service-block-' + key).classList.add('active');

    const visibleRows = document.querySelectorAll(`#service-block-${key} .exam-row`);
    document.getElementById('visibleCount').textContent = visibleRows.length;
}

/* ── Accordion ── */
function toggleCat(header) {
    header.closest('.cat-section').classList.toggle('open');
}

/* ── Filtres ── */
document.addEventListener('DOMContentLoaded', function () {

    const searchInput    = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const visibleCount   = document.getElementById('visibleCount');
    const noResult       = document.getElementById('noResult');

    function filter() {
        const q   = searchInput.value.toLowerCase().trim();
        const cat = categoryFilter.value.toLowerCase().trim();

        if (cat) {
            const section = document.querySelector(`.cat-section[data-cat="${categoryFilter.value}"]`);
            if (section) switchServiceTab(section.dataset.service);
        }

        const activeBlock = document.querySelector('.service-block.active');
        const allSections = activeBlock.querySelectorAll('.cat-section');
        let total = 0;

        allSections.forEach(section => {
            const sectionCat = section.dataset.cat.toLowerCase();
            const rows       = section.querySelectorAll('.exam-row');
            let visible      = 0;

            rows.forEach(row => {
                const matchQ = !q   || row.dataset.name.includes(q);
                const matchC = !cat || row.dataset.category.toLowerCase() === cat || sectionCat === cat;
                row.style.display = (matchQ && matchC) ? '' : 'none';
                if (matchQ && matchC) visible++;
            });

            const isEchoSection = sectionCat.includes('echo') || sectionCat.includes('imagerie');

            if (visible > 0 || (isEchoSection && (!q && !cat))) {
                section.style.display = '';
                if (q || cat) section.classList.add('open');
            } else if (isEchoSection && q) {
                const echoTypes = ['obstetricale','pelvienne','abdominale','testiculaire',
                    'renale','vesicale','prostatique','mammaire','parties molles','ecg','coeur'];
                const matchEcho = echoTypes.some(t => t.includes(q));
                section.style.display = matchEcho ? '' : (visible > 0 ? '' : 'none');
            } else {
                section.style.display = (visible > 0 || (!q && !cat)) ? '' : 'none';
            }

            total += visible;
        });

        visibleCount.textContent = total;
        noResult.style.display   = (total === 0 && (q || cat)) ? 'block' : 'none';
    }

    searchInput.addEventListener('input',     filter);
    categoryFilter.addEventListener('change', filter);

    /* ── Animations scroll ── */
    const obs = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('on'); obs.unobserve(e.target); }
        });
    }, { threshold: 0.08 });

    document.querySelectorAll('.sa-up').forEach((el, i) => {
        el.style.transitionDelay = (i * 0.06) + 's';
        obs.observe(el);
    });
});
</script>

@endsection