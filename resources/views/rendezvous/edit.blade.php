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
            --red:    #dc3545;
        }

        .edit-rdv-wrap { max-width: 720px; margin: 30px auto; }

        .edit-rdv-back {
            display: inline-flex; align-items: center; gap: 7px;
            color: var(--blue); font-size: 13px; font-weight: 600;
            text-decoration: none; margin-bottom: 18px;
            transition: gap .2s ease;
        }
        .edit-rdv-back:hover { gap: 11px; color: var(--green); }

        .edit-rdv-card {
            background: white;
            border-radius: 22px;
            box-shadow: 0 12px 40px rgba(31,58,95,.12);
            overflow: hidden;
            opacity: 0; transform: translateY(24px);
            animation: rdvFadeUp .6s cubic-bezier(.4,0,.2,1) forwards;
        }
        @keyframes rdvFadeUp { to { opacity: 1; transform: translateY(0); } }

        /* ── EN-TÊTE ── */
        .edit-rdv-header {
            background: linear-gradient(135deg, var(--blue) 0%, #0d1f3c 100%);
            padding: 30px 32px;
            position: relative; overflow: hidden;
            display: flex; align-items: center; gap: 18px;
        }
        .edit-rdv-header::before {
            content: ''; position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,.06) 1.5px, transparent 1.5px);
            background-size: 36px 36px;
            animation: rdvDotsDrift 25s linear infinite;
        }
        @keyframes rdvDotsDrift { to { transform: translate(36px,36px); } }
        .edit-rdv-header::after {
            content: ''; position: absolute; right: -30px; top: -30px;
            width: 140px; height: 140px; border-radius: 50%;
            background: rgba(255,255,255,.06);
        }
        .edit-rdv-icon {
            width: 56px; height: 56px; flex-shrink: 0;
            background: rgba(255,255,255,.15);
            border: 2px solid rgba(255,255,255,.25);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 26px; position: relative; z-index: 1;
            animation: rdvIconPop .5s cubic-bezier(.175,.885,.32,1.275) .2s both;
        }
        @keyframes rdvIconPop {
            from { transform: scale(0) rotate(-15deg); opacity: 0; }
            to   { transform: scale(1) rotate(0deg);   opacity: 1; }
        }
        .edit-rdv-header-text { position: relative; z-index: 1; }
        .edit-rdv-header h2 { color: white; font-size: 21px; font-weight: 800; margin: 0 0 4px; }
        .edit-rdv-header p  { color: rgba(255,255,255,.65); font-size: 13px; margin: 0; }

        /* Badge statut actuel dans le header */
        .edit-rdv-status-badge {
            position: absolute; top: 24px; right: 28px; z-index: 2;
            font-size: 11px; font-weight: 700; padding: 6px 14px;
            border-radius: 50px; display: flex; align-items: center; gap: 6px;
            backdrop-filter: blur(6px);
        }
        .edit-rdv-status-badge.en_attente { background: rgba(232,103,26,.25); color: #ffd9b3; border: 1px solid rgba(232,103,26,.4); }
        .edit-rdv-status-badge.confirme   { background: rgba(46,122,79,.3);  color: #b3f0c9; border: 1px solid rgba(46,122,79,.5); }
        .edit-rdv-status-badge.annule     { background: rgba(220,53,69,.25); color: #ffb3ba; border: 1px solid rgba(220,53,69,.4); }

        /* ── CORPS ── */
        .edit-rdv-body { padding: 32px; }

        .edit-rdv-section-title {
            font-size: 11px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 1.2px; color: #94a3b8;
            margin: 0 0 14px; padding-bottom: 8px;
            border-bottom: 2px solid #eef2f7;
            display: flex; align-items: center; gap: 7px;
        }
        .edit-rdv-section-title i { color: var(--green); }
        .edit-rdv-section-title:not(:first-child) { margin-top: 26px; }

        .edit-field { margin-bottom: 18px; opacity: 0; transform: translateY(14px); animation: rdvFieldIn .5s ease forwards; }
        .edit-field:nth-of-type(1) { animation-delay: .08s; }
        .edit-field:nth-of-type(2) { animation-delay: .13s; }
        .edit-field:nth-of-type(3) { animation-delay: .18s; }
        .edit-field:nth-of-type(4) { animation-delay: .23s; }
        .edit-field:nth-of-type(5) { animation-delay: .28s; }
        .edit-field:nth-of-type(6) { animation-delay: .33s; }
        .edit-field:nth-of-type(7) { animation-delay: .38s; }
        @keyframes rdvFieldIn { to { opacity: 1; transform: translateY(0); } }

        .edit-label {
            display: flex; align-items: center; gap: 8px;
            font-size: 12px; font-weight: 700; text-transform: uppercase;
            letter-spacing: .8px; color: var(--blue); margin-bottom: 8px;
        }
        .edit-label-icon {
            width: 26px; height: 26px; border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; color: white;
            background: linear-gradient(135deg, var(--green), #1a5c35);
        }

        .edit-input-wrap { position: relative; }
        .edit-input, select.edit-input {
            width: 100%;
            border: 1.5px solid #e0e8f5;
            border-radius: 12px;
            padding: 12px 16px 12px 44px;
            font-size: 14.5px; color: var(--blue); font-weight: 600;
            background: #f8fafd;
            transition: all .3s ease;
            appearance: none;
        }
        .edit-input:focus {
            outline: none; border-color: var(--green); background: white;
            box-shadow: 0 0 0 4px rgba(46,122,79,.1);
        }
        .edit-input-prefix {
            position: absolute; left: 15px; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: 14px; pointer-events: none; z-index: 2;
        }
        .edit-input-wrap:focus-within .edit-input-prefix { color: var(--green); }

        select.edit-input {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%231F3A5F' d='M1 1l5 5 5-5'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 36px;
        }

        /* Variantes couleur icônes */
        .edit-field.f-nom   .edit-label-icon { background: linear-gradient(135deg,#1565c0,#0a3880); }
        .edit-field.f-tel   .edit-label-icon { background: linear-gradient(135deg,#00897b,#00574b); }
        .edit-field.f-email .edit-label-icon { background: linear-gradient(135deg,var(--orange),#b84e10); }
        .edit-field.f-exam  .edit-label-icon { background: linear-gradient(135deg,#7b1fa2,#4a0e6e); }
        .edit-field.f-date  .edit-label-icon,
        .edit-field.f-heure .edit-label-icon { background: linear-gradient(135deg,var(--green),#1a5c35); }
        .edit-field.f-statut .edit-label-icon { background: linear-gradient(135deg,var(--blue),#0d1f3c); }

        /* Sélecteur visuel de statut (radio-pills) */
        .statut-pills { display: flex; gap: 10px; flex-wrap: wrap; }
        .statut-pill {
            flex: 1; min-width: 140px;
            position: relative;
            border: 2px solid #e0e8f5; border-radius: 13px;
            padding: 13px 16px; cursor: pointer;
            display: flex; align-items: center; gap: 9px;
            transition: all .25s ease; background: #f8fafd;
        }
        .statut-pill input { position: absolute; opacity: 0; pointer-events: none; }
        .statut-pill-icon { font-size: 17px; }
        .statut-pill-label { font-size: 13px; font-weight: 700; color: #475569; }

        .statut-pill:hover { border-color: #c5d3ea; transform: translateY(-2px); }

        .statut-pill.en_attente.checked { border-color: var(--orange); background: #fff3e8; box-shadow: 0 4px 14px rgba(232,103,26,.18); }
        .statut-pill.en_attente.checked .statut-pill-label { color: var(--orange); }

        .statut-pill.confirme.checked { border-color: var(--green); background: #eaf6ee; box-shadow: 0 4px 14px rgba(46,122,79,.18); }
        .statut-pill.confirme.checked .statut-pill-label { color: var(--green); }

        .statut-pill.annule.checked { border-color: var(--red); background: #fdeced; box-shadow: 0 4px 14px rgba(220,53,69,.18); }
        .statut-pill.annule.checked .statut-pill-label { color: var(--red); }

        /* Ligne date/heure côte à côte */
        .edit-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

        /* ── BOUTON SUBMIT ── */
        .edit-submit-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--green), #1a5c35);
            color: white; border: none; border-radius: 14px;
            padding: 15px; font-size: 15px; font-weight: 700;
            display: flex; align-items: center; justify-content: center; gap: 9px;
            cursor: pointer; transition: all .3s ease;
            box-shadow: 0 8px 24px rgba(46,122,79,.3);
            margin-top: 8px;
            opacity: 0; transform: translateY(14px);
            animation: rdvFieldIn .5s ease .45s forwards;
        }
        .edit-submit-btn:hover { transform: translateY(-3px); box-shadow: 0 14px 34px rgba(46,122,79,.4); }
        .edit-submit-btn:active { transform: translateY(-1px); }

        .edit-rdv-footer-note {
            display: flex; align-items: center; gap: 8px; justify-content: center;
            font-size: 12px; color: #94a3b8; margin-top: 16px;
        }

        @media (max-width: 600px) {
            .edit-rdv-wrap { margin: 16px auto; padding: 0 12px; }
            .edit-rdv-header { padding: 22px; flex-wrap: wrap; }
            .edit-rdv-body { padding: 20px; }
            .edit-row-2 { grid-template-columns: 1fr; }
            .edit-rdv-status-badge { position: static; margin-top: 10px; display: inline-flex; }
        }
        </style>

        @php
            $statutLabels = [
                'en_attente' => ['icon' => '⏳', 'label' => 'En attente'],
                'confirme'   => ['icon' => '✅', 'label' => 'Confirmé'],
                'annule'     => ['icon' => '❌', 'label' => 'Annulé'],
            ];
            $current = $statutLabels[$rdv->statut] ?? $statutLabels['en_attente'];
        @endphp

        <div class="edit-rdv-wrap">

            <a href="/admin/rendezvous" class="edit-rdv-back">
                <i class="fa-solid fa-arrow-left"></i> Retour à la liste des rendez-vous
            </a>

            <div class="edit-rdv-card">

                {{-- En-tête --}}
                <div class="edit-rdv-header">
                    <span class="edit-rdv-status-badge {{ $rdv->statut }}">
                        {{ $current['icon'] }} {{ $current['label'] }}
                    </span>
                    <div class="edit-rdv-icon">📅</div>
                    <div class="edit-rdv-header-text">
                        <h2>Modifier le rendez-vous</h2>
                        <p>{{ $rdv->nom }} — {{ \Carbon\Carbon::parse($rdv->date_rdv)->format('d/m/Y') }}</p>
                    </div>
                </div>

                {{-- Formulaire --}}
                <div class="edit-rdv-body">

                    @if(session('success'))
                        <div class="alert alert-success rounded-3 mb-4">✅ {{ session('success') }}</div>
                    @endif

                    <form method="POST" action="/rendezvous/{{ $rdv->id }}">
                        @csrf
                        @method('PUT')

                        <div class="edit-rdv-section-title">
                            <i class="fa-solid fa-user"></i> Informations du patient
                        </div>

                        {{-- Nom --}}
                        <div class="edit-field f-nom">
                            <label class="edit-label">
                                <span class="edit-label-icon"><i class="fa-solid fa-user"></i></span>
                                Nom complet
                            </label>
                            <div class="edit-input-wrap">
                                <i class="fa-solid fa-user edit-input-prefix"></i>
                                <input type="text" name="nom" value="{{ $rdv->nom }}" class="edit-input" required>
                            </div>
                        </div>

                        {{-- Téléphone --}}
                        <div class="edit-field f-tel">
                            <label class="edit-label">
                                <span class="edit-label-icon"><i class="fa-solid fa-phone"></i></span>
                                Téléphone
                            </label>
                            <div class="edit-input-wrap">
                                <i class="fa-solid fa-phone edit-input-prefix"></i>
                                <input type="text" name="telephone" value="{{ $rdv->telephone }}" class="edit-input" required>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="edit-field f-email">
                            <label class="edit-label">
                                <span class="edit-label-icon"><i class="fa-solid fa-envelope"></i></span>
                                Adresse email
                            </label>
                            <div class="edit-input-wrap">
                                <i class="fa-solid fa-envelope edit-input-prefix"></i>
                                <input type="email" name="email" value="{{ $rdv->email }}" class="edit-input" required>
                            </div>
                        </div>

                        <div class="edit-rdv-section-title">
                            <i class="fa-solid fa-stethoscope"></i> Détails du rendez-vous
                        </div>

                        {{-- Examen --}}
                        <div class="edit-field f-exam">
                            <label class="edit-label">
                                <span class="edit-label-icon"><i class="fa-solid fa-vial"></i></span>
                                Examen médical
                            </label>
                            <div class="edit-input-wrap">
                                <i class="fa-solid fa-vial edit-input-prefix"></i>
                                <select name="examen_id" class="edit-input" required>
                                    @foreach($examens as $examen)
                                        <option value="{{ $examen->id }}"
                                            {{ $rdv->examen_id == $examen->id ? 'selected' : '' }}>
                                            {{ $examen->nom }}
                                            @if(isset($examen->categorie)) ({{ $examen->categorie }}) @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Date + Heure --}}
                        <div class="edit-row-2">
                            <div class="edit-field f-date">
                                <label class="edit-label">
                                    <span class="edit-label-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                    Date
                                </label>
                                <div class="edit-input-wrap">
                                    <i class="fa-solid fa-calendar-days edit-input-prefix"></i>
                                    <input type="date" name="date_rdv" value="{{ $rdv->date_rdv }}" class="edit-input" required>
                                </div>
                            </div>
                            <div class="edit-field f-heure">
                                <label class="edit-label">
                                    <span class="edit-label-icon"><i class="fa-solid fa-clock"></i></span>
                                    Heure
                                </label>
                                <div class="edit-input-wrap">
                                    <i class="fa-solid fa-clock edit-input-prefix"></i>
                                    <input type="time" name="heure_rdv" value="{{ $rdv->heure_rdv }}" class="edit-input" required>
                                </div>
                            </div>
                        </div>

                        <div class="edit-rdv-section-title">
                            <i class="fa-solid fa-circle-check"></i> Statut du rendez-vous
                        </div>

                        {{-- Statut en pills visuelles --}}
                        <div class="edit-field f-statut">
                            <div class="statut-pills">
                                @foreach($statutLabels as $value => $info)
                                <label class="statut-pill {{ $value }} {{ $rdv->statut == $value ? 'checked' : '' }}"
                                       onclick="selectStatut(this, '{{ $value }}')">
                                    <input type="radio" name="statut" value="{{ $value }}"
                                           {{ $rdv->statut == $value ? 'checked' : '' }}>
                                    <span class="statut-pill-icon">{{ $info['icon'] }}</span>
                                    <span class="statut-pill-label">{{ $info['label'] }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="edit-submit-btn">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Enregistrer les modifications
                        </button>

                    </form>

                    <div class="edit-rdv-footer-note">
                        <i class="fa-solid fa-shield-halved"></i>
                        Un email sera envoyé au patient si le statut change
                    </div>

                </div>
            </div>
        </div>

    </div>{{-- fin main-content --}}
</div>{{-- fin dashboard-wrapper --}}

<script>
function selectStatut(label, value) {
    document.querySelectorAll('.statut-pill').forEach(p => p.classList.remove('checked'));
    label.classList.add('checked');
}

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