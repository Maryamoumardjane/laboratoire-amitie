<section id="rendezvous" class="rdv-section py-5">
<div class="container">

    <div class="row align-items-center g-5">

        <!-- COLONNE GAUCHE — INFO -->
        <div class="col-md-5">
            <div class="rdv-info">

                <h2 class="rdv-titre rdv-anim-left">📅 Prendre Rendez-vous</h2>
                <p class="rdv-subtitle rdv-anim-left" style="transition-delay:0.1s;">
                    Réservez votre créneau en ligne en quelques clics.
                    Notre équipe vous confirmera votre rendez-vous par email.
                </p>

                <div class="rdv-avantages">
                    <div class="rdv-avantage-item rdv-anim-up" style="transition-delay:0.1s;">
                        <div class="rdv-avantage-icon">⚡</div>
                        <div>
                            <strong>Confirmation rapide</strong>
                            <p>Vous recevez un email de confirmation immédiatement</p>
                        </div>
                    </div>
                    <div class="rdv-avantage-item rdv-anim-up" style="transition-delay:0.2s;">
                        <div class="rdv-avantage-icon">🔒</div>
                        <div>
                            <strong>Créneau réservé</strong>
                            <p>Votre créneau est exclusivement réservé pour vous</p>
                        </div>
                    </div>
                    <div class="rdv-avantage-item rdv-anim-up" style="transition-delay:0.3s;">
                        <div class="rdv-avantage-icon">📥</div>
                        <div>
                            <strong>Résultats en ligne</strong>
                            <p>Téléchargez vos résultats directement sur notre site</p>
                        </div>
                    </div>
                    <div class="rdv-avantage-item rdv-anim-up" style="transition-delay:0.4s;">
                        <div class="rdv-avantage-icon">🕐</div>
                        <div>
                            <strong>Disponible 24h/24</strong>
                            <p>Prenez rendez-vous à tout moment, 7j/7</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- COLONNE DROITE — FORMULAIRE -->
        <div class="col-md-7">
            <div class="rdv-card rdv-anim-right">

                <div class="rdv-card-header">
                    <h3>🩺 Formulaire de Rendez-vous</h3>
                    <p>Remplissez tous les champs ci-dessous</p>
                </div>

                <div class="rdv-card-body">

                    @if(session('error'))
                        <div class="alert alert-danger rounded-3">❌ {{ session('error') }}</div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success rounded-3">✅ {{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('rendezvous.store') }}">
                    @csrf

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="rdv-label">👤 Nom complet</label>
                                <input type="text" name="nom" class="rdv-input"
                                       placeholder="Maryam" required>
                            </div>
                            <div class="col-md-6">
                                <label class="rdv-label">📞 Téléphone</label>
                                <input type="text" name="telephone" class="rdv-input"
                                       placeholder="+237 6XX XXX XXX" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="rdv-label">📧 Adresse Email</label>
                            <input type="email" name="email" class="rdv-input"
                                   placeholder="exemple@gmail.com" required>
                        </div>

                        {{-- ── ÉTAPE 1 : Choisir le service ── --}}
                        <div class="mb-3">
                            <label class="rdv-label">🏥 Service médical</label>
                            <select id="service-select" class="rdv-input" onchange="filtrerExamens(this)">
                                <option value="" disabled selected>-- Choisir un service --</option>

                                @php
                                    $services = [
                                        'Analyses Médicales' => [
                                            'emoji' => '🔬',
                                            'cats'  => ['Hématologie','Bactériologie','Biochimie','Immuno','Parasitologie'],
                                        ],
                                        'Imagerie Médicale' => [
                                            'emoji' => '🩻',
                                            'cats'  => ['Échographie'],
                                        ],
                                    ];
                                @endphp

                                @foreach($services as $service => $info)
                                    <option value="{{ $service }}">
                                        {{ $info['emoji'] }} {{ $service }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- ── ÉTAPE 2 : Choisir l'examen selon le service ── --}}
                        <div class="mb-3" id="examen-wrap" style="display:none;">
                            <label class="rdv-label">🔬 Examen médical</label>
                            <select name="examen_id" id="examen-select" class="rdv-input"
                                    required onchange="afficherPrix(this)">
                                <option value="" disabled selected>-- Choisir un examen --</option>

                                @php
                                    /* Grouper les examens par service puis par catégorie */
                                    $serviceMap = [
                                        'Analyses Médicales' => ['Hématologie','Bactériologie','Biochimie','Immuno','Parasitologie'],
                                        'Imagerie Médicale'  => ['Échographie'],
                                    ];
                                    $examensParCat = $examens->groupBy('categorie');

                                    $iconesCat = [
                                        'Hématologie'   => '🩸',
                                        'Bactériologie' => '🦠',
                                        'Biochimie'     => '⚗️',
                                        'Immuno'        => '🧬',
                                        'Parasitologie' => '🪱',
                                        'Échographie'   => '🩻',
                                    ];
                                @endphp

                                @foreach($serviceMap as $service => $cats)
                                    @foreach($cats as $cat)
                                        @if(isset($examensParCat[$cat]))
                                            <optgroup
                                                label="{{ $iconesCat[$cat] ?? '🧪' }} {{ $cat }}"
                                                data-service="{{ $service }}"
                                                class="exam-optgroup">
                                                @foreach($examensParCat[$cat] as $examen)
                                                    <option
                                                        value="{{ $examen->id }}"
                                                        data-prix="{{ $examen->prix }}"
                                                        data-delai="{{ $examen->delai }}"
                                                        data-service="{{ $service }}">
                                                        {{ $examen->nom }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                @endforeach

                            </select>
                        </div>

                        {{-- Prix & Délai --}}
                        <div id="prix-box" style="display:none;" class="mb-3">
                            <div class="prix-card">
                                <div class="prix-item">
                                    <span class="prix-label">💰 Prix</span>
                                    <span class="prix-valeur">
                                        <span id="prix-valeur">0</span> FCFA
                                    </span>
                                </div>
                                <div class="prix-divider"></div>
                                <div class="prix-item">
                                    <span class="prix-label">⏱ Délai</span>
                                    <span class="prix-valeur" id="delai-valeur">-</span>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="rdv-label">📅 Date du rendez-vous</label>
                                <input type="date" name="date_rdv" class="rdv-input"
                                       min="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="rdv-label">🕐 Heure du rendez-vous</label>
                                <input type="time" name="heure_rdv" class="rdv-input" required>
                            </div>
                        </div>

                        <div class="rdv-info-box mb-4">
                            ⚠️ Un créneau ne peut être réservé qu'une seule fois.
                            Vous recevrez un email de confirmation.
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


                        <button type="submit" class="rdv-btn">
                            📅 Confirmer mon rendez-vous
                        </button>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
</section>

<script>
/* ── Filtre examens selon le service choisi ── */
function filtrerExamens(serviceSelect) {
    const service     = serviceSelect.value;
    const examenWrap  = document.getElementById('examen-wrap');
    const examenSelect= document.getElementById('examen-select');
    const prixBox     = document.getElementById('prix-box');

    // Réinitialiser
    examenSelect.value = '';
    prixBox.style.display = 'none';

    if (!service) { examenWrap.style.display = 'none'; return; }

    // Afficher / masquer les optgroups selon le service
    const groups = examenSelect.querySelectorAll('optgroup');
    groups.forEach(g => {
        g.style.display = g.dataset.service === service ? '' : 'none';
        // Désactiver les options des groupes cachés pour ne pas les soumettre
        g.querySelectorAll('option').forEach(opt => {
            opt.disabled = g.dataset.service !== service;
        });
    });

    // Remettre le placeholder
    examenSelect.querySelector('option[value=""]').selected = true;

    // Afficher le select examen
    examenWrap.style.display = 'block';
    examenWrap.style.animation = 'rdvFadeIn .35s ease';
}

/* ── Afficher prix et délai ── */
function afficherPrix(select) {
    const option = select.options[select.selectedIndex];
    const prix   = option.getAttribute('data-prix');
    const delai  = option.getAttribute('data-delai');
    const box    = document.getElementById('prix-box');

    if (prix !== null && prix !== '') {
        document.getElementById('prix-valeur').textContent  = parseInt(prix).toLocaleString('fr-FR');
        document.getElementById('delai-valeur').textContent = delai ?? 'Non défini';
        box.style.display = 'block';
        box.style.animation = 'rdvFadeIn .35s ease';
    } else {
        box.style.display = 'none';
    }
}

/* ── Alertes auto-disparition ── */
setTimeout(() => {
    document.querySelectorAll('.alert').forEach(a => {
        a.style.transition = 'opacity 0.5s';
        a.style.opacity = '0';
        setTimeout(() => a.remove(), 500);
    });
}, 4000);

/* ── Animations au scroll ── */
document.addEventListener('DOMContentLoaded', function () {

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('rdv-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll(
        '#rendezvous .rdv-anim-up, #rendezvous .rdv-anim-left, #rendezvous .rdv-anim-right'
    ).forEach(el => observer.observe(el));

    new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.querySelectorAll('.rdv-avantage-item').forEach((item, i) => {
                    setTimeout(() => item.classList.add('rdv-visible'), i * 150);
                });
            }
        });
    }, { threshold: 0.2 }).observe(document.querySelector('#rendezvous .rdv-avantages'));

    window.addEventListener('scroll', () => {
        const section = document.querySelector('#rendezvous');
        if (!section) return;
        const rect     = section.getBoundingClientRect();
        const progress = 1 - (rect.top / window.innerHeight);
        if (progress > 0 && progress < 1.5) {
            const info = section.querySelector('.rdv-info');
            if (info) info.style.transform = `translateY(${progress * -8}px)`;
        }
    });
});
</script>

<style>
/* ── Animations de base ── */
.rdv-anim-up    { opacity:0; transform:translateY(40px);  transition:opacity .7s ease,transform .7s ease; }
.rdv-anim-left  { opacity:0; transform:translateX(-50px); transition:opacity .7s ease,transform .7s ease; }
.rdv-anim-right { opacity:0; transform:translateX(50px);  transition:opacity .8s ease,transform .8s ease; }

.rdv-anim-up.rdv-visible,
.rdv-anim-left.rdv-visible,
.rdv-anim-right.rdv-visible { opacity:1; transform:none; }

.rdv-card.rdv-visible {
    box-shadow: 0 20px 60px rgba(31,58,95,.18), 0 0 40px rgba(46,122,79,.08);
}

/* ── Animation apparition select examen & prix ── */
@keyframes rdvFadeIn {
    from { opacity:0; transform:translateY(-8px); }
    to   { opacity:1; transform:translateY(0); }
}

/* ── Style optgroup ── */
#examen-select optgroup {
    font-weight: 700;
    color: #1F3A5F;
    background: #f0f5ff;
    font-size: 13px;
}
#examen-select option {
    font-weight: 400;
    color: #334155;
    padding-left: 12px;
    background: #ffffff;
}
#examen-select optgroup[style*="display: none"],
#examen-select optgroup[style*="display:none"] {
    display: none !important;
}
</style>