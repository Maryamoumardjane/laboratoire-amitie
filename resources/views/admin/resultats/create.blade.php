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

        /* ── EN-TÊTE PAGE ── */
        .upload-page-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 26px; flex-wrap: wrap; gap: 12px;
        }
        .upload-page-header h1 {
            font-size: 22px; font-weight: 800; color: var(--blue); margin: 0;
            display: flex; align-items: center; gap: 10px;
        }
        .upload-back-btn {
            display: inline-flex; align-items: center; gap: 8px;
            background: #1c2a30; color: white; border: none;
            border-radius: 10px; padding: 10px 18px;
            font-size: 13px; font-weight: 700; text-decoration: none;
            transition: all .3s ease;
        }
        .upload-back-btn:hover { background: #0d1518; color: white; transform: translateX(-3px); }

        /* ── WRAPPER CENTRÉ ── */
        .upload-wrap { max-width: 640px; margin: 0; }

        .upload-card {
            background: white;
            border-radius: 22px;
            box-shadow: 0 12px 40px rgba(31,58,95,.12);
            overflow: hidden;
            opacity: 0; transform: translateY(24px);
            animation: upFadeUp .6s cubic-bezier(.4,0,.2,1) forwards;
        }
        @keyframes upFadeUp { to { opacity: 1; transform: translateY(0); } }

        /* ── EN-TÊTE CARTE ── */
        .upload-card-header {
            background: linear-gradient(135deg, var(--green) 0%, #1a5c35 100%);
            padding: 28px 32px;
            position: relative; overflow: hidden;
        }
        .upload-card-header::before {
            content: ''; position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,.07) 1.5px, transparent 1.5px);
            background-size: 36px 36px;
            animation: upDotsDrift 25s linear infinite;
        }
        @keyframes upDotsDrift { to { transform: translate(36px,36px); } }
        .upload-card-header::after {
            content: ''; position: absolute; right: -30px; top: -30px;
            width: 140px; height: 140px; border-radius: 50%;
            background: rgba(255,255,255,.07);
        }
        .upload-card-icon {
            width: 56px; height: 56px;
            background: rgba(255,255,255,.15);
            border: 2px solid rgba(255,255,255,.25);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 26px; margin-bottom: 14px;
            position: relative; z-index: 1;
            animation: upIconPop .5s cubic-bezier(.175,.885,.32,1.275) .2s both;
        }
        @keyframes upIconPop {
            from { transform: scale(0) rotate(-15deg); opacity: 0; }
            to   { transform: scale(1) rotate(0deg);   opacity: 1; }
        }
        .upload-card-header h2 { color: white; font-size: 21px; font-weight: 800; margin: 0 0 5px; position: relative; z-index: 1; }
        .upload-card-header p  { color: rgba(255,255,255,.7); font-size: 13px; margin: 0; position: relative; z-index: 1; }

        /* ── CORPS ── */
        .upload-body { padding: 32px; }

        .edit-field { margin-bottom: 22px; opacity: 0; transform: translateY(14px); animation: upFieldIn .5s ease forwards; }
        .edit-field:nth-of-type(1) { animation-delay: .1s; }
        .edit-field:nth-of-type(2) { animation-delay: .18s; }
        @keyframes upFieldIn { to { opacity: 1; transform: translateY(0); } }

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
        .edit-field.f-patient .edit-label-icon { background: linear-gradient(135deg,#7b1fa2,#4a0e6e); }
        .edit-field.f-file    .edit-label-icon { background: linear-gradient(135deg,#1565c0,#0a3880); }

        .edit-input-wrap { position: relative; }
        select.edit-input {
            width: 100%;
            border: 1.5px solid #e0e8f5;
            border-radius: 12px;
            padding: 13px 36px 13px 44px;
            font-size: 14px; color: var(--blue); font-weight: 600;
            background: #f8fafd;
            transition: all .3s ease;
            appearance: none; cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%231F3A5F' d='M1 1l5 5 5-5'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
        }
        select.edit-input:focus {
            outline: none; border-color: var(--green); background-color: white;
            box-shadow: 0 0 0 4px rgba(46,122,79,.1);
        }
        .edit-input-prefix {
            position: absolute; left: 15px; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: 14px; pointer-events: none; z-index: 1;
        }
        .edit-input-wrap:focus-within .edit-input-prefix { color: var(--green); }

        /* ── ZONE DROP FICHIER ── */
        .dropzone {
            border: 2.5px dashed #cfdcef;
            border-radius: 16px;
            padding: 32px 20px;
            text-align: center;
            background: #f8fafd;
            cursor: pointer;
            transition: all .3s ease;
            position: relative;
        }
        .dropzone:hover, .dropzone.dragover {
            border-color: var(--green);
            background: #eef8f1;
        }
        .dropzone input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer;
        }
        .dropzone-icon {
            width: 56px; height: 56px; margin: 0 auto 12px;
            background: linear-gradient(135deg, #1565c0, #0a3880);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; color: white;
            transition: transform .3s ease;
        }
        .dropzone:hover .dropzone-icon { transform: translateY(-4px) scale(1.05); }
        .dropzone-title { font-size: 14.5px; font-weight: 700; color: var(--blue); margin-bottom: 4px; }
        .dropzone-sub { font-size: 12px; color: #94a3b8; }
        .dropzone-filename {
            display: none; align-items: center; gap: 10px; justify-content: center;
            margin-top: 14px; padding: 10px 16px;
            background: white; border: 1.5px solid #b7dfc5; border-radius: 10px;
            font-size: 13px; font-weight: 600; color: var(--green);
        }
        .dropzone-filename.show { display: flex; }
        .dropzone-filename i { font-size: 16px; }

        /* ── ENCADRÉ INFO ── */
        .upload-info-box {
            display: flex; align-items: flex-start; gap: 14px;
            background: linear-gradient(135deg, #eef6ff, #e3f0fe);
            border: 1.5px solid #c9e0fb;
            border-radius: 14px;
            padding: 16px 18px;
            margin-bottom: 24px;
            opacity: 0; transform: translateY(14px);
            animation: upFieldIn .5s ease .26s forwards;
        }
        .upload-info-icon {
            width: 38px; height: 38px; flex-shrink: 0;
            background: linear-gradient(135deg, #1565c0, #0a3880);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 17px; color: white;
        }
        .upload-info-text { font-size: 13px; color: #1e3a5f; line-height: 1.5; }
        .upload-info-text strong { color: var(--blue); }

        /* ── BOUTON SUBMIT ── */
        .edit-submit-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--green), #1a5c35);
            color: white; border: none; border-radius: 14px;
            padding: 15px; font-size: 15px; font-weight: 700;
            display: flex; align-items: center; justify-content: center; gap: 9px;
            cursor: pointer; transition: all .3s ease;
            box-shadow: 0 8px 24px rgba(46,122,79,.3);
            opacity: 0; transform: translateY(14px);
            animation: upFieldIn .5s ease .34s forwards;
        }
        .edit-submit-btn:hover { transform: translateY(-3px); box-shadow: 0 14px 34px rgba(46,122,79,.4); }
        .edit-submit-btn:active { transform: translateY(-1px); }
        .edit-submit-btn:disabled {
            opacity: .6; cursor: not-allowed; transform: none; box-shadow: none;
        }

        .upload-footer-note {
            display: flex; align-items: center; gap: 8px; justify-content: center;
            font-size: 12px; color: #94a3b8; margin-top: 16px;
        }

        @media (max-width: 600px) {
            .upload-card-header { padding: 22px; }
            .upload-body { padding: 22px; }
        }
        </style>

        {{-- En-tête page --}}
        <div class="upload-page-header">
            <h1>📤 Uploader un résultat</h1>
            <a href="/admin/resultats" class="upload-back-btn">
                <i class="fa-solid fa-arrow-left"></i> Retour
            </a>
        </div>

        <div class="upload-wrap">
            <div class="upload-card">

                {{-- En-tête carte --}}
                <div class="upload-card-header">
                    <div class="upload-card-icon">📤</div>
                    <h2>Envoyer un résultat d'examen</h2>
                    <p>Le patient recevra un code unique par email pour le télécharger</p>
                </div>

                {{-- Corps --}}
                <div class="upload-body">

                    @if(session('error'))
                        <div class="alert alert-danger rounded-3 mb-4">❌ {{ session('error') }}</div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success rounded-3 mb-4">✅ {{ session('success') }}</div>
                    @endif

                    <form method="POST" action="/admin/resultats" enctype="multipart/form-data" id="uploadForm">
                        @csrf

                        {{-- Patient --}}
                        <div class="edit-field f-patient">
                            <label class="edit-label">
                                <span class="edit-label-icon"><i class="fa-solid fa-user-check"></i></span>
                                Patient (RDV confirmé)
                            </label>
                            <div class="edit-input-wrap">
                                <i class="fa-solid fa-user edit-input-prefix"></i>
                                <select name="rendezvous_id" class="edit-input" required>
                                    <option value="" disabled selected>-- Choisir un patient --</option>
                                    @foreach($rendezvous as $rdv)
                                        <option value="{{ $rdv->id }}">
                                            {{ $rdv->nom }} — {{ \Carbon\Carbon::parse($rdv->date_rdv)->format('d/m/Y') }}
                                            ({{ $rdv->examen->nom ?? 'Examen' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Fichier PDF --}}
                        <div class="edit-field f-file">
                            <label class="edit-label">
                                <span class="edit-label-icon"><i class="fa-solid fa-file-pdf"></i></span>
                                Fichier PDF du résultat
                            </label>

                            <label class="dropzone" id="dropzone">
                                <input type="file" name="fichier_pdf" id="fileInput" accept=".pdf" required>
                                <div class="dropzone-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                <div class="dropzone-title">Cliquez ou glissez le fichier ici</div>
                                <div class="dropzone-sub">Format PDF uniquement — Taille max : 10 MB</div>
                                <div class="dropzone-filename" id="filenamePreview">
                                    <i class="fa-solid fa-file-circle-check"></i>
                                    <span id="filenameText"></span>
                                </div>
                            </label>
                        </div>

                        {{-- Encadré info --}}
                        <div class="upload-info-box">
                            <div class="upload-info-icon"><i class="fa-solid fa-envelope-circle-check"></i></div>
                            <div class="upload-info-text">
                                Un <strong>code unique</strong> sera automatiquement envoyé par email
                                au patient pour télécharger son résultat en toute sécurité.
                            </div>
                        </div>

                        <button type="submit" class="edit-submit-btn" id="submitBtn">
                            <i class="fa-solid fa-paper-plane"></i>
                            Uploader et envoyer le code
                        </button>

                    </form>

                    <div class="upload-footer-note">
                        <i class="fa-solid fa-lock"></i>
                        Le fichier est stocké de manière sécurisée et confidentielle
                    </div>

                </div>
            </div>
        </div>

    </div>{{-- fin main-content --}}
</div>{{-- fin dashboard-wrapper --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* Menu mobile */
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar    = document.getElementById('sidebar');
    if (menuToggle) {
        menuToggle.addEventListener('click', () => sidebar.classList.toggle('active'));
    }

    /* Dropzone fichier */
    const dropzone   = document.getElementById('dropzone');
    const fileInput  = document.getElementById('fileInput');
    const preview    = document.getElementById('filenamePreview');
    const filenameTx = document.getElementById('filenameText');

    fileInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            filenameTx.textContent = this.files[0].name;
            preview.classList.add('show');
        } else {
            preview.classList.remove('show');
        }
    });

    ['dragenter', 'dragover'].forEach(evt => {
        dropzone.addEventListener(evt, e => {
            e.preventDefault();
            dropzone.classList.add('dragover');
        });
    });
    ['dragleave', 'drop'].forEach(evt => {
        dropzone.addEventListener(evt, e => {
            e.preventDefault();
            dropzone.classList.remove('dragover');
        });
    });
    dropzone.addEventListener('drop', e => {
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            fileInput.dispatchEvent(new Event('change'));
        }
    });

    /* Empêcher double soumission */
    const form = document.getElementById('uploadForm');
    const btn  = document.getElementById('submitBtn');
    form.addEventListener('submit', function () {
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Envoi en cours…';
    });
});
</script>

@endsection