{{-- ================= CARTES SERVICES ================= --}}
<section id="services" class="services-hero py-5">
<div class="container">

    <div class="text-center mb-5">
        <span class="services-tag">Nos Spécialités</span>
        <h2 class="services-main-title">🏥 Nos Services Médicaux</h2>
        <p class="text-muted">Des soins de qualité avec des équipements de dernière génération</p>
        <div class="title-bar"></div>
    </div>

    <div class="row g-4">

        {{-- ANALYSES --}}
        <div class="col-md-4">
            <div class="service-hero-card">
                <div class="service-hero-img">
                    <img src="{{ asset('images/analyse.jpg') }}" alt="Analyses">
                    <div class="service-hero-overlay">
                        <span class="service-hero-icon">🔬</span>
                    </div>
                </div>
                <div class="service-hero-body">
                    <h4>Analyses Médicales</h4>
                    <p>Bactériologie, biochimie, immunologie et autres examens précis.</p>
                    <a href="#analyses" class="service-hero-btn">
                        Voir plus <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- IMAGERIE --}}
        <div class="col-md-4">
            <div class="service-hero-card">
                <div class="service-hero-img">
                    <img src="{{ asset('images/imagerie.jpg') }}" alt="Imagerie">
                    <div class="service-hero-overlay" style="background:linear-gradient(135deg,rgba(26,46,90,0.85),rgba(230,81,0,0.7));">
                        <span class="service-hero-icon">🩻</span>
                    </div>
                </div>
                <div class="service-hero-body">
                    <h4>Imagerie Médicale</h4>
                    <p>Échographie, ECG et examens d'imagerie spécialisés.</p>
                    <a href="#imagerie" class="service-hero-btn">
                        Voir plus <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- CONSULTATIONS --}}
        <div class="col-md-4">
            <div class="service-hero-card">
                <div class="service-hero-img">
                    <img src="{{ asset('images/consultation.jpg') }}" alt="Consultations">
                    <div class="service-hero-overlay" style="background:linear-gradient(135deg,rgba(46,125,50,0.85),rgba(26,46,90,0.7));">
                        <span class="service-hero-icon">🩺</span>
                    </div>
                </div>
                <div class="service-hero-body">
                    <h4>Consultations Spécialisées</h4>
                    <p>Médecins spécialistes qualifiés à votre écoute.</p>
                    <a href="#consultations" class="service-hero-btn">
                        Voir plus <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
</section>

{{-- ================= DÉTAILS SERVICES ================= --}}
<section class="services-detail-section py-5">
<div class="container">

    <div class="row">

        {{-- CONTENU PRINCIPAL --}}
        <div class="col-lg-9">

            <div class="text-center mb-5 fade-in">
                <h2 class="main-title">🏥 Nos Services en Détail</h2>
                <p class="text-muted mt-3">
                    Le Laboratoire de l'Amitié offre une gamme complète de services pour
                    le diagnostic, le traitement et le suivi de la santé, adaptés à chaque patient.
                </p>
            </div>

            {{-- ===== ANALYSES ===== --}}
            <div id="analyses" class="service-detail-box slide-up">
                <div class="service-detail-header">
                    <div class="service-detail-header-icon">🔬</div>
                    <div>
                        <h3>Analyses Médicales</h3>
                        <p>Des analyses précises pour détecter et suivre les maladies efficacement.</p>
                    </div>
                </div>
                <div class="service-detail-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="service-detail-item" onclick="openPanel('bacterio')">
                                <div class="sdi-icon"><i class="fa-solid fa-bacteria"></i></div>
                                <div class="sdi-content">
                                    <h5>Bactériologie</h5>
                                    <p>Détection des infections et identification des bactéries.</p>
                                </div>
                                <i class="bi bi-chevron-right sdi-arrow"></i>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="service-detail-item" onclick="openPanel('biochimie')">
                                <div class="sdi-icon"><i class="fa-solid fa-flask"></i></div>
                                <div class="sdi-content">
                                    <h5>Biochimie</h5>
                                    <p>Analyse du sang pour contrôler les organes.</p>
                                </div>
                                <i class="bi bi-chevron-right sdi-arrow"></i>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="service-detail-item" onclick="openPanel('immuno')">
                                <div class="sdi-icon"><i class="fa-solid fa-dna"></i></div>
                                <div class="sdi-content">
                                    <h5>Immuno-hormonologie</h5>
                                    <p>Analyse des hormones et du système immunitaire.</p>
                                </div>
                                <i class="bi bi-chevron-right sdi-arrow"></i>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="service-detail-item" onclick="openPanel('parasito')">
                                <div class="sdi-icon"><i class="fa-solid fa-virus"></i></div>
                                <div class="sdi-content">
                                    <h5>Parasitologie</h5>
                                    <p>Détection des parasites et maladies tropicales.</p>
                                </div>
                                <i class="bi bi-chevron-right sdi-arrow"></i>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="service-detail-item" onclick="openPanel('serologie')">
                                <div class="sdi-icon"><i class="fa-solid fa-shield-virus"></i></div>
                                <div class="sdi-content">
                                    <h5>Immuno-sérologie</h5>
                                    <p>Recherche des infections comme VIH et hépatites.</p>
                                </div>
                                <i class="bi bi-chevron-right sdi-arrow"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ===== IMAGERIE ===== --}}
            <div id="imagerie" class="service-detail-box slide-up mt-4">
                <div class="service-detail-header" style="background:linear-gradient(135deg,#1a2e5a,#0d1f3c);">
                    <div class="service-detail-header-icon">🩻</div>
                    <div>
                        <h3>Imagerie Médicale</h3>
                        <p>Visualisation des organes pour un diagnostic rapide et précis.</p>
                    </div>
                </div>
                <div class="service-detail-body">
                    <div class="row g-3">

                        {{-- Échographie — ouvre le panel avec liste complète --}}
                        <div class="col-md-4">
                            <div class="service-detail-item" onclick="openPanel('echographie')">
                                <div class="sdi-icon" style="background:linear-gradient(135deg,#1a2e5a,#243b6e);">
                                    <i class="fa-solid fa-wave-square"></i>
                                </div>
                                <div class="sdi-content">
                                    <h5>Échographie</h5>
                                    <p>Obstétricale, abdominale, pelvienne et bien plus.</p>
                                </div>
                                <i class="bi bi-chevron-right sdi-arrow"></i>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="service-detail-item" onclick="openPanel('ecg')">
                                <div class="sdi-icon" style="background:linear-gradient(135deg,#1a2e5a,#243b6e);">
                                    <i class="fa-solid fa-heart-pulse"></i>
                                </div>
                                <div class="sdi-content">
                                    <h5>ECG</h5>
                                    <p>Analyse du cœur et anomalies cardiaques.</p>
                                </div>
                                <i class="bi bi-chevron-right sdi-arrow"></i>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="service-detail-item" onclick="openPanel('echo_cardiaque')">
                                <div class="sdi-icon" style="background:linear-gradient(135deg,#1a2e5a,#243b6e);">
                                    <i class="fa-solid fa-heart"></i>
                                </div>
                                <div class="sdi-content">
                                    <h5>Écho. cardiaque</h5>
                                    <p>Étude complète du fonctionnement du cœur.</p>
                                </div>
                                <i class="bi bi-chevron-right sdi-arrow"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ===== CONSULTATIONS ===== --}}
            <div id="consultations" class="service-detail-box slide-up mt-4">
                <div class="service-detail-header" style="background:linear-gradient(135deg,#2e7d32,#1b5e20);">
                    <div class="service-detail-header-icon">🩺</div>
                    <div>
                        <h3>Consultations Spécialisées</h3>
                        <p>Consultation avec des médecins spécialistes qualifiés.</p>
                    </div>
                </div>
                <div class="service-detail-body">
                    <div class="row g-3">

                        <div class="col-md-4">
                            <div class="service-detail-item">
                                <div class="sdi-icon" style="background:linear-gradient(135deg,#2e7d32,#1b5e20);">
                                    <i class="fa-solid fa-user-doctor"></i>
                                </div>
                                <div class="sdi-content">
                                    <h5>Médecine générale</h5>
                                    <p>Consultation pour tous types de pathologies.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="service-detail-item">
                                <div class="sdi-icon" style="background:linear-gradient(135deg,#2e7d32,#1b5e20);">
                                    <i class="fa-solid fa-heart"></i>
                                </div>
                                <div class="sdi-content">
                                    <h5>Cardiologie</h5>
                                    <p>Suivi des maladies cardiovasculaires.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="service-detail-item">
                                <div class="sdi-icon" style="background:linear-gradient(135deg,#2e7d32,#1b5e20);">
                                    <i class="fa-solid fa-stethoscope"></i>
                                </div>
                                <div class="sdi-content">
                                    <h5>Spécialistes</h5>
                                    <p>Consultations spécialisées selon vos besoins.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        {{-- SIDEBAR --}}
        <div class="col-lg-3">
            @include('partials.sidebar')
        </div>

    </div>
</div>
</section>

{{-- PANEL MODAL --}}
<div id="analysisPanel" class="analysis-panel">
    <div class="panel-content">
        <button class="close-panel" onclick="closePanel()">
            <i class="bi bi-x-lg"></i>
        </button>
        <div id="panelBody"></div>
    </div>
</div>

{{-- BANNIÈRE EXAMENS --}}
@include('partials.bannierexamens')

{{-- À PROPOS --}}
@include('partials.apropos')

{{-- MÉDECINS --}}
<section class="medecins-section py-5">
<div class="container">

    <div class="text-center mb-5">
        <span class="services-tag">Notre Équipe</span>
        <h2 class="main-title">👨‍⚕️ Nos Médecins Spécialistes</h2>
        <div class="title-bar"></div>
    </div>

    <div class="row g-4 justify-content-center">

        @foreach ([
            ['nom' => 'Dr. Marie N.', 'specialite' => 'Biologiste médical', 'color' => '#2e7d32'],
            ['nom' => 'Dr. Paul K.',  'specialite' => 'Radiologue',          'color' => '#1a2e5a'],
            ['nom' => 'Dr. Amina S.','specialite' => 'Cardiologue',          'color' => '#e65100']
        ] as $doc)

        <div class="col-md-4">
            <div class="doctor-card-new">
                <div class="doctor-img-wrapper" style="background:linear-gradient(135deg, {{ $doc['color'] }}, #0d1f3c);">
                    <img src="{{ asset('images/Dr.jpg') }}" class="doctor-img-new" alt="{{ $doc['nom'] }}">
                    <div class="doctor-badge" style="background:{{ $doc['color'] }};">
                        {{ $doc['specialite'] }}
                    </div>
                </div>
                <div class="doctor-body">
                    <h4>{{ $doc['nom'] }}</h4>
                    <p>Médecin expérimenté offrant des soins de qualité et un suivi personnalisé.</p>
                    <a href="/#rendezvous" class="doctor-btn" style="background:{{ $doc['color'] }};">
                        📅 Prendre rendez-vous
                    </a>
                </div>
            </div>
        </div>

        @endforeach

    </div>
</div>
</section>

<script>
function openPanel(type) {
    const data = {
        bacterio: {
            img: '/images/analyse.jpg',
            titre: '🔬 Bactériologie',
            icons: ['fa-microscope', 'fa-bacteria', 'fa-vial'],
            desc: ['La bactériologie étudie les bactéries responsables d\'infections humaines.', 'Elle permet d\'identifier les germes et de proposer un traitement adapté et efficace.']
        },
        biochimie: {
            img: '/images/analyse.jpg',
            titre: '🧪 Biochimie',
            icons: ['fa-flask', 'fa-heart-pulse'],
            desc: ['Analyse des composants chimiques du sang pour évaluer le fonctionnement des organes.', 'Permet de détecter diabète, troubles rénaux et hépatiques.']
        },
        immuno: {
            img: '/images/analyse.jpg',
            titre: '🧬 Immuno-hormonologie',
            icons: ['fa-dna', 'fa-shield-virus'],
            desc: ['Étude des hormones et du système immunitaire.', 'Permet de détecter les déséquilibres hormonaux et les maladies auto-immunes.']
        },
        parasito: {
            img: '/images/analyse.jpg',
            titre: '🦠 Parasitologie',
            icons: ['fa-bug', 'fa-microscope'],
            desc: ['Détection des parasites responsables de maladies tropicales.', 'Permet de diagnostiquer le paludisme, la bilharziose et autres infections parasitaires.']
        },
        serologie: {
            img: '/images/analyse.jpg',
            titre: '🛡️ Immuno-sérologie',
            icons: ['fa-shield-virus', 'fa-vial'],
            desc: ['Détection des anticorps et antigènes dans le sang.', 'Utilisée pour diagnostiquer VIH, hépatites B et C, et autres infections virales.']
        },

        /* ── ÉCHOGRAPHIE : panel enrichi avec tous les types ── */
        echographie: {
            img: '/images/imagerie.jpg',
            titre: '🩻 Échographie',
            icons: ['fa-wave-square', 'fa-baby', 'fa-venus'],
            desc: [
                'L\'échographie utilise les ultrasons pour visualiser les organes internes en temps réel, de manière indolore et sans radiation.'
            ],
            examens: {
                col1: [
                    { icon: 'fa-baby',          label: 'Obstétricale' },
                    { icon: 'fa-venus',          label: 'Pelvienne' },
                    { icon: 'fa-circle-dot',     label: 'Pelvienne (endovaginale)' },
                    { icon: 'fa-stomach',        label: 'Abdominale' },
                    { icon: 'fa-arrows-up-down', label: 'Abdomino-pelvienne' },
                    { icon: 'fa-circle',         label: 'Prostaque' },
                    { icon: 'fa-circle-nodes',   label: 'Prostaque (endorectale)' },
                ],
                col2: [
                    { icon: 'fa-mars',           label: 'Testiculaire' },
                    { icon: 'fa-kidney',         label: 'Rénale, vésicale et Prostatique' },
                    { icon: 'fa-circle-half-stroke', label: 'Mammaire' },
                    { icon: 'fa-hand-dots',      label: 'Parties molles' },
                    { icon: 'fa-ellipsis',       label: 'Autre (à préciser)' },
                ],
                special: [
                    { icon: 'fa-heart-pulse', label: 'ECG' },
                    { icon: 'fa-heart',       label: 'Echo Cœur' },
                ]
            }
        },

        ecg: {
            img: '/images/imagerie.jpg',
            titre: '❤️ ECG',
            icons: ['fa-heart-pulse', 'fa-wave-square'],
            desc: ['L\'ECG analyse l\'activité électrique du cœur.', 'Il détecte les troubles cardiaques, arythmies et infarctus.']
        },
        echo_cardiaque: {
            img: '/images/imagerie.jpg',
            titre: '💓 Échographie cardiaque',
            icons: ['fa-heart', 'fa-stethoscope'],
            desc: ['Étude complète du fonctionnement du cœur par ultrasons.', 'Permet de détecter malformations et insuffisances cardiaques.']
        }
    };

    const d = data[type];
    if (!d) return;

    const colors = ['#1F3A5F', '#2E7A4F', '#E8671A'];
    const iconsHtml = d.icons.map((i, idx) =>
        `<div style="width:40px;height:40px;background:${colors[idx % 3]};color:white;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;">
            <i class="fa-solid ${i}"></i>
         </div>`
    ).join('');

    const descHtml = d.desc.map(p => `<p>${p}</p>`).join('');

    /* ── Bloc examens spécial Échographie ── */
    let examensHtml = '';
    if (d.examens) {
        const makeItem = item =>
            `<div class="echo-exam-item">
                <i class="fa-solid ${item.icon} echo-exam-icon"></i>
                <span>${item.label}</span>
            </div>`;

        examensHtml = `
        <div class="echo-examens-block">
            <div class="echo-examens-title">
                <i class="fa-solid fa-list-check"></i> Types d'examens disponibles
            </div>
            <div class="echo-examens-grid">
                <div class="echo-col">
                    ${d.examens.col1.map(makeItem).join('')}
                </div>
                <div class="echo-col">
                    ${d.examens.col2.map(makeItem).join('')}
                    <div class="echo-special-box">
                        ${d.examens.special.map(item =>
                            `<div class="echo-special-item">
                                <i class="fa-solid ${item.icon}"></i> ${item.label}
                             </div>`
                        ).join('')}
                    </div>
                </div>
            </div>
        </div>`;
    }

    document.getElementById('panelBody').innerHTML = `
        <img src="${d.img}" class="panel-img" alt="${d.titre}">
        <div class="panel-body-content">
            <h3>${d.titre}</h3>
            <div class="panel-icons">${iconsHtml}</div>
            ${descHtml}
            ${examensHtml}
            <a href="/#rendezvous" onclick="closePanel()"
               style="display:inline-block;background:linear-gradient(135deg,#1a2e5a,#2e7d32);color:white;padding:12px 24px;border-radius:25px;font-weight:600;text-decoration:none;margin-top:16px;">
                📅 Prendre rendez-vous
            </a>
        </div>
    `;

    document.getElementById('analysisPanel').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closePanel() {
    document.getElementById('analysisPanel').classList.remove('active');
    document.body.style.overflow = '';
}

document.getElementById('analysisPanel').addEventListener('click', function(e) {
    if (e.target === this) closePanel();
});

/* Animations scroll */
document.addEventListener('DOMContentLoaded', function () {
    const elements = document.querySelectorAll('.fade-in, .slide-up, .service-detail-item');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('show'), i * 80);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    elements.forEach(el => observer.observe(el));
});
</script>

{{-- ── CSS du bloc Échographie (ajouté inline pour ne pas toucher au fichier CSS principal) ── --}}
<style>
/* Bloc liste examens */
.echo-examens-block {
    background: #f0f4ff;
    border: 1.5px solid #dce6f5;
    border-radius: 14px;
    padding: 18px 20px;
    margin-top: 16px;
}
.echo-examens-title {
    font-weight: 700;
    font-size: 13px;
    color: #1F3A5F;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.echo-examens-title i { color: #2E7A4F; }

.echo-examens-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 6px 20px;
}
.echo-col { display: flex; flex-direction: column; gap: 7px; }

.echo-exam-item {
    display: flex;
    align-items: center;
    gap: 9px;
    font-size: 13.5px;
    color: #1F3A5F;
    padding: 6px 10px;
    border-radius: 8px;
    background: white;
    border: 1px solid #e0e8f5;
    transition: background .2s ease, transform .2s ease;
}
.echo-exam-item:hover {
    background: #e8f0fe;
    transform: translateX(4px);
}
.echo-exam-icon {
    color: #2E7A4F;
    font-size: 13px;
    width: 18px;
    flex-shrink: 0;
}

/* Encadré spécial ECG / Echo Cœur */
.echo-special-box {
    margin-top: 10px;
    background: linear-gradient(135deg, #1F3A5F, #1a2e5a);
    border-radius: 10px;
    padding: 10px 14px;
    display: flex;
    flex-direction: column;
    gap: 7px;
}
.echo-special-item {
    color: white;
    font-size: 13px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}
.echo-special-item i { color: #E8671A; }

@media (max-width: 500px) {
    .echo-examens-grid { grid-template-columns: 1fr; }
}
</style>