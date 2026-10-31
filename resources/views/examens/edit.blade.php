@extends('layout')

@section('content')

<button class="mobile-menu-btn" id="menu-toggle">☰</button>

<div class="dashboard-wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
        <h3>🧪 LAB ADMIN</h3>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="/admin" class="nav-link">📊 Dashboard</a></li>
            <li class="nav-item"><a href="/admin/rendezvous" class="nav-link active">📅 Rendez-vous</a></li>
            <li class="nav-item"><a href="/admin/examens" class="nav-link">🔬 Examens</a></li>
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

        /* ── WRAPPER CENTRÉ ── */
        .edit-exam-wrap {
            max-width: 620px;
            margin: 30px auto;
        }

        /* ── BREADCRUMB / RETOUR ── */
        .edit-exam-back {
            display: inline-flex; align-items: center; gap: 7px;
            color: var(--blue); font-size: 13px; font-weight: 600;
            text-decoration: none; margin-bottom: 18px;
            transition: gap .2s ease;
        }
        .edit-exam-back:hover { gap: 11px; color: var(--green); }

        /* ── CARTE PRINCIPALE ── */
        .edit-exam-card {
            background: white;
            border-radius: 22px;
            box-shadow: 0 12px 40px rgba(31,58,95,.12);
            overflow: hidden;
            opacity: 0;
            transform: translateY(24px);
            animation: editFadeUp .6s cubic-bezier(.4,0,.2,1) forwards;
        }
        @keyframes editFadeUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* ── EN-TÊTE CARTE ── */
        .edit-exam-header {
            background: linear-gradient(135deg, var(--blue) 0%, #0d1f3c 100%);
            padding: 30px 32px;
            position: relative;
            overflow: hidden;
        }
        .edit-exam-header::before {
            content: '';
            position: absolute; inset: 0;
            background-image:
                radial-gradient(circle, rgba(255,255,255,.06) 1.5px, transparent 1.5px);
            background-size: 36px 36px;
            animation: editDotsDrift 25s linear infinite;
        }
        @keyframes editDotsDrift { to { transform: translate(36px,36px); } }
        .edit-exam-header::after {
            content: '';
            position: absolute; right: -30px; top: -30px;
            width: 140px; height: 140px; border-radius: 50%;
            background: rgba(255,255,255,.06);
        }
        .edit-exam-icon {
            width: 56px; height: 56px;
            background: rgba(255,255,255,.15);
            border: 2px solid rgba(255,255,255,.25);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 26px; margin-bottom: 14px;
            position: relative; z-index: 1;
            animation: editIconPop .5s cubic-bezier(.175,.885,.32,1.275) .2s both;
        }
        @keyframes editIconPop {
            from { transform: scale(0) rotate(-15deg); opacity: 0; }
            to   { transform: scale(1) rotate(0deg);   opacity: 1; }
        }
        .edit-exam-header h2 {
            color: white; font-size: 22px; font-weight: 800;
            margin: 0 0 5px; position: relative; z-index: 1;
        }
        .edit-exam-header p {
            color: rgba(255,255,255,.65); font-size: 13px;
            margin: 0; position: relative; z-index: 1;
        }

        /* ── CORPS FORMULAIRE ── */
        .edit-exam-body { padding: 32px; }

        .edit-field { margin-bottom: 22px; opacity: 0; transform: translateY(14px); animation: editFieldIn .5s ease forwards; }
        .edit-field:nth-child(1) { animation-delay: .1s; }
        .edit-field:nth-child(2) { animation-delay: .17s; }
        .edit-field:nth-child(3) { animation-delay: .24s; }
        .edit-field:nth-child(4) { animation-delay: .31s; }
        @keyframes editFieldIn { to { opacity: 1; transform: translateY(0); } }

        .edit-label {
            display: flex; align-items: center; gap: 8px;
            font-size: 12px; font-weight: 700; text-transform: uppercase;
            letter-spacing: .8px; color: var(--blue);
            margin-bottom: 8px;
        }
        .edit-label-icon {
            width: 26px; height: 26px; border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; color: white;
            background: linear-gradient(135deg, var(--green), #1a5c35);
        }

        .edit-input-wrap { position: relative; }
        .edit-input {
            width: 100%;
            border: 1.5px solid #e0e8f5;
            border-radius: 12px;
            padding: 13px 16px 13px 44px;
            font-size: 14.5px; color: var(--blue); font-weight: 600;
            background: #f8fafd;
            transition: all .3s ease;
        }
        .edit-input:focus {
            outline: none;
            border-color: var(--green);
            background: white;
            box-shadow: 0 0 0 4px rgba(46,122,79,.1);
        }
        .edit-input-prefix {
            position: absolute; left: 15px; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: 14px; pointer-events: none;
            transition: color .3s ease;
        }
        .edit-input:focus ~ .edit-input-prefix,
        .edit-input-wrap:focus-within .edit-input-prefix { color: var(--green); }

        /* Variantes couleur par champ */
        .edit-field.f-nom   .edit-label-icon { background: linear-gradient(135deg,#1565c0,#0a3880); }
        .edit-field.f-prix  .edit-label-icon { background: linear-gradient(135deg,var(--orange),#b84e10); }
        .edit-field.f-delai .edit-label-icon { background: linear-gradient(135deg,#7b1fa2,#4a0e6e); }
        .edit-field.f-cat   .edit-label-icon { background: linear-gradient(135deg,var(--green),#1a5c35); }

        /* Suffixe FCFA pour le prix */
        .edit-input-suffix {
            position: absolute; right: 15px; top: 50%; transform: translateY(-50%);
            font-size: 12px; font-weight: 700; color: #94a3b8;
            background: #eef2f7; padding: 3px 10px; border-radius: 50px;
        }

        /* ── BOUTON SUBMIT ── */
        .edit-submit-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--green), #1a5c35);
            color: white; border: none; border-radius: 14px;
            padding: 15px; font-size: 15px; font-weight: 700;
            display: flex; align-items: center; justify-content: center; gap: 9px;
            cursor: pointer; transition: all .3s ease;
            box-shadow: 0 8px 24px rgba(46,122,79,.3);
            margin-top: 6px;
            opacity: 0; transform: translateY(14px);
            animation: editFieldIn .5s ease .38s forwards;
        }
        .edit-submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 34px rgba(46,122,79,.4);
        }
        .edit-submit-btn:active { transform: translateY(-1px); }
        .edit-submit-btn i { font-size: 14px; }

        /* ── BANDEAU INFO BAS ── */
        .edit-exam-footer-note {
            display: flex; align-items: center; gap: 8px;
            font-size: 12px; color: #94a3b8;
            margin-top: 18px; justify-content: center;
        }

        @media (max-width: 600px) {
            .edit-exam-wrap { margin: 16px auto; padding: 0 12px; }
            .edit-exam-header { padding: 24px 22px; }
            .edit-exam-body { padding: 22px; }
        }
        </style>

        <div class="edit-exam-wrap">

            <a href="/admin/examens" class="edit-exam-back">
                <i class="fa-solid fa-arrow-left"></i> Retour à la liste des examens
            </a>

            <div class="edit-exam-card">

                {{-- En-tête --}}
                <div class="edit-exam-header">
                    <div class="edit-exam-icon">✏️</div>
                    <h2>Modifier l'examen</h2>
                    <p>Mettez à jour les informations de « {{ $examen->nom }} »</p>
                </div>

                {{-- Formulaire --}}
                <div class="edit-exam-body">

                    @if(session('success'))
                        <div class="alert alert-success rounded-3 mb-4">✅ {{ session('success') }}</div>
                    @endif

                    <form method="POST" action="/examens/{{ $examen->id }}">
                        @csrf
                        @method('PUT')

                        {{-- Nom --}}
                        <div class="edit-field f-nom">
                            <label class="edit-label">
                                <span class="edit-label-icon"><i class="fa-solid fa-vial"></i></span>
                                Nom de l'examen
                            </label>
                            <div class="edit-input-wrap">
                                <i class="fa-solid fa-flask-vial edit-input-prefix"></i>
                                <input type="text" name="nom" class="edit-input"
                                       value="{{ $examen->nom }}" required
                                       placeholder="Ex : Échographie Pelvienne">
                            </div>
                        </div>

                        {{-- Prix --}}
                        <div class="edit-field f-prix">
                            <label class="edit-label">
                                <span class="edit-label-icon"><i class="fa-solid fa-coins"></i></span>
                                Prix
                            </label>
                            <div class="edit-input-wrap">
                                <i class="fa-solid fa-money-bill edit-input-prefix"></i>
                                <input type="number" name="prix" class="edit-input" style="padding-right:62px;"
                                       value="{{ $examen->prix }}" required
                                       placeholder="0">
                                <span class="edit-input-suffix">FCFA</span>
                            </div>
                        </div>

                        {{-- Délai --}}
                        <div class="edit-field f-delai">
                            <label class="edit-label">
                                <span class="edit-label-icon"><i class="fa-solid fa-clock"></i></span>
                                Délai de résultat
                            </label>
                            <div class="edit-input-wrap">
                                <i class="fa-solid fa-hourglass-half edit-input-prefix"></i>
                                <input type="text" name="delai" class="edit-input"
                                       value="{{ $examen->delai }}" required
                                       placeholder="Ex : 1 heure, 3 jours…">
                            </div>
                        </div>

                        {{-- Catégorie --}}
                        <div class="edit-field f-cat">
                            <label class="edit-label">
                                <span class="edit-label-icon"><i class="fa-solid fa-layer-group"></i></span>
                                Catégorie
                            </label>
                            <div class="edit-input-wrap">
                                <i class="fa-solid fa-tag edit-input-prefix"></i>
                                <input type="text" name="categorie" class="edit-input"
                                       value="{{ $examen->categorie }}" required
                                       placeholder="Ex : Hématologie, Échographie…">
                            </div>
                        </div>

                        <button type="submit" class="edit-submit-btn">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Enregistrer les modifications
                        </button>

                    </form>

                    <div class="edit-exam-footer-note">
                        <i class="fa-solid fa-shield-halved"></i>
                        Les modifications sont appliquées immédiatement
                    </div>

                </div>
            </div>
        </div>

    </div>{{-- fin main-content --}}
</div>{{-- fin dashboard-wrapper --}}

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