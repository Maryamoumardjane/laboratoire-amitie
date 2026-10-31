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

<div class="container mt-5">

    <div class="card shadow p-4">

        <h2 class="mb-4">📅 Prise de Rendez-vous</h2>

        {{-- 🔴 ERREUR --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- 🟢 SUCCÈS --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

       
            <form method="POST" action="{{ route('rendezvous.store') }}">
            @csrf

            {{-- NOM --}}
            <div class="mb-3">
                <label class="form-label">Nom complet</label>
                <input type="text" name="nom" class="form-control" required>
            </div>

           {{-- TELEPHONE --}}
<div class="mb-3">
    <label class="form-label">Téléphone</label>
    <input type="text" name="telephone" class="form-control" required>
</div>

{{-- EMAIL --}}
<div class="mb-3">
    <label class="form-label">Adresse Email</label>

    <input type="email"
           name="email"
           class="form-control"
           placeholder="exemple@gmail.com"
           required>
</div>

            {{-- EXAMEN --}}
            <div class="mb-3">
                <label class="form-label">Examen médical</label>
                <select name="examen_id" class="form-control" required>
                    <option disabled selected>-- Choisir un examen --</option>

                    @foreach($examens as $examen)
                        <option value="{{ $examen->id }}">
                            {{ $examen->nom }} ({{ $examen->categorie }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">

                {{-- DATE --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Date du rendez-vous</label>
                    
                    <input type="date" name="date_rdv" class="form-control" min="{{ date('Y-m-d') }}" required>
                </div>

                {{-- HEURE --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Heure du rendez-vous</label>
                    <input type="time" name="heure_rdv" class="form-control" required>
                </div>

            </div>

            <div class="alert alert-info">
                ⚠ Un créneau ne peut être réservé qu’une seule fois
            </div>

           

            {{-- ===== BOUTON WHATSAPP (à ajouter dans le formulaire de RDV) ===== --}}
{{-- Placez ce bloc JUSTE AVANT le bouton "Confirmer mon rendez-vous" --}}

<style>
.wa-notification-box {
    background: linear-gradient(135deg, #e8f5e9, #f1f8e9);
    border: 1.5px solid #a5d6a7;
    border-radius: 14px;
    padding: 16px 18px;
    margin-bottom: 16px;
    display: flex;
    align-items: flex-start;
    gap: 14px;
}
.wa-notification-icon {
    width: 42px; height: 42px; flex-shrink: 0;
    background: #25D366;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px;
    box-shadow: 0 4px 12px rgba(37,211,102,.3);
}
.wa-notification-text {
    font-size: 13px;
    color: #2e7d32;
    line-height: 1.5;
}
.wa-notification-text strong {
    display: block;
    font-size: 14px;
    margin-bottom: 4px;
    color: #1b5e20;
}

.wa-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #25D366;
    color: white !important;
    border: none;
    border-radius: 25px;
    padding: 10px 20px;
    font-size: 13.5px;
    font-weight: 700;
    text-decoration: none;
    transition: all .3s ease;
    box-shadow: 0 4px 14px rgba(37,211,102,.35);
    margin-top: 10px;
    cursor: pointer;
}
.wa-btn:hover {
    background: #1ebe5d;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(37,211,102,.45);
    color: white !important;
}
.wa-btn svg {
    width: 18px; height: 18px; fill: white;
}

.wa-checkbox-line {
    display: flex; align-items: center; gap: 8px;
    font-size: 13px; color: #2e7d32; margin-top: 10px;
    cursor: pointer;
}
.wa-checkbox-line input { cursor: pointer; width: 16px; height: 16px; }
</style>

{{-- ── Encadré notification WhatsApp ── --}}
<div class="wa-notification-box mb-3">
    <div class="wa-notification-icon">
        <svg viewBox="0 0 24 24" fill="white" style="width:22px;height:22px;">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </div>
    <div class="wa-notification-text">
        <strong>📲 Recevez votre confirmation par WhatsApp !</strong>
        Envoyez-nous un message WhatsApp pour recevoir automatiquement la confirmation
        ou l'annulation de votre rendez-vous directement sur votre téléphone.
        <br>
        <a href="https://wa.me/237695843149?text=Bonjour%20Laboratoire%20de%20l'Amitiée%2C%20je%20souhaite%20recevoir%20ma%20confirmation%20de%20rendez-vous%20par%20WhatsApp."
           target="_blank"
           class="wa-btn"
           id="waContactBtn">
            <svg viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            Nous envoyer un message WhatsApp
        </a>

        <label class="wa-checkbox-line">
            <input type="checkbox" name="whatsapp_consent" value="1">
            J'ai envoyé mon message WhatsApp pour recevoir mes notifications
        </label>
    </div>
</div>

            <button type="submit" class="btn btn-primary w-100">
    📅 Confirmer le rendez-vous
</button>
        </form>

    </div>

</div>

<div id="calendar"></div>


@if(session('success'))
    <div class="alert alert-success text-center fw-bold">
        ✅ {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger text-center fw-bold">
        ❌ {{ session('error') }}
    </div>
@endif




<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>



<script>
setTimeout(() => {
    let alert = document.querySelector('.alert-fixed');
    if(alert){
        alert.style.display = 'none';
    }
}, 4000); // disparaît après 4 secondes
</script>

@endsection