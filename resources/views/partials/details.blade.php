{{-- ===== SECTION SERVICES DÉTAILLÉS ===== --}}
<section class="services-details py-5" id="analyses">
<div class="container">

    <!-- TITRE SECTION -->
    <div class="text-center mb-5">
        <h2 style="color:#1a2e5a; font-weight:700;">Nos Services Médicaux</h2>
        <p class="text-muted">Des soins de qualité avec des équipements de dernière génération</p>
        <div style="width:60px; height:4px; background:linear-gradient(90deg,#2e7d32,#e65100); margin:0 auto; border-radius:2px;"></div>
    </div>

    {{-- ===== ANALYSES MÉDICALES ===== --}}
    <div class="service-block animate-on-scroll mb-5" id="analyses">
        <div class="row align-items-center g-5">

            <!-- TEXTE -->
            <div class="col-md-6">
                <div class="service-content">
                    <div class="service-badge">
                        <span class="service-icon">🔬</span>
                    </div>
                    <h3 class="service-title">Analyses Médicales</h3>
                    <p class="service-desc">
                        Nous proposons une large gamme d'analyses médicales réalisées
                        par des biologistes expérimentés avec des équipements certifiés,
                        pour des résultats fiables et rapides.
                    </p>
                    <div class="service-liste">
                        <div class="service-item">
                            <span class="item-dot" style="background:#2e7d32;"></span>
                            Bactériologie
                        </div>
                        <div class="service-item">
                            <span class="item-dot" style="background:#1a2e5a;"></span>
                            Biochimie
                        </div>
                        <div class="service-item">
                            <span class="item-dot" style="background:#e65100;"></span>
                            Immuno-hormonologie
                        </div>
                        <div class="service-item">
                            <span class="item-dot" style="background:#2e7d32;"></span>
                            Parasitologie
                        </div>
                        <div class="service-item">
                            <span class="item-dot" style="background:#1a2e5a;"></span>
                            Immuno-sérologie
                        </div>
                    </div>
                    <a href="/examens" class="service-btn mt-4">
                        Voir tous les examens →
                    </a>
                </div>
            </div>

            <!-- IMAGE -->
            <div class="col-md-6">
                <div class="service-image-box">
                    <div id="carouselAnalyses" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/bacterio.jpg') }}"
                                     class="d-block w-100 service-img" alt="Bactériologie">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/biochimie.jpg') }}"
                                     class="d-block w-100 service-img" alt="Biochimie">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselAnalyses" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselAnalyses" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                    <div class="service-image-badge">
                        ✅ Résultats certifiés
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- SÉPARATEUR -->
    <div class="service-separator"></div>

    {{-- ===== IMAGERIE MÉDICALE ===== --}}
    <div class="service-block animate-on-scroll mb-5" id="imagerie">
        <div class="row align-items-center g-5 flex-md-row-reverse">

            <!-- TEXTE -->
            <div class="col-md-6">
                <div class="service-content">
                    <div class="service-badge">
                        <span class="service-icon">🩻</span>
                    </div>
                    <h3 class="service-title">Imagerie Médicale</h3>
                    <p class="service-desc">
                        Notre service d'imagerie utilise des équipements modernes de dernière
                        génération pour des diagnostics précis et rapides.
                    </p>
                    <div class="service-liste">
                        <div class="service-item">
                            <span class="item-dot" style="background:#2e7d32;"></span>
                            Échographie standard et obstétricale
                        </div>
                        <div class="service-item">
                            <span class="item-dot" style="background:#1a2e5a;"></span>
                            ECG — Électrocardiogramme
                        </div>
                        <div class="service-item">
                            <span class="item-dot" style="background:#e65100;"></span>
                            Échographie cardiaque
                        </div>
                       
                    </div>
                    <a href="/examens" class="service-btn mt-4">
                        Voir tous les examens →
                    </a>
                </div>
            </div>

            <!-- IMAGE -->
            <div class="col-md-6">
                <div class="service-image-box">
                    <div id="carouselImagerie" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/echographie.jpg') }}"
                                     class="d-block w-100 service-img" alt="Échographie">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/ecg.jpg') }}"
                                     class="d-block w-100 service-img" alt="ECG">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselImagerie" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselImagerie" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                    <div class="service-image-badge" style="background:#1a2e5a;">
                        🏥 Équipements certifiés
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- SÉPARATEUR -->
    <div class="service-separator"></div>

    {{-- ===== CONSULTATIONS ===== --}}
    <div class="service-block animate-on-scroll" id="consultations">
        <div class="row align-items-center g-5">

            <!-- TEXTE -->
            <div class="col-md-6">
                <div class="service-content">
                    <div class="service-badge">
                        <span class="service-icon">🩺</span>
                    </div>
                    <h3 class="service-title">Consultations Spécialisées</h3>
                    <p class="service-desc">
                        Nos médecins spécialistes vous accompagnent avec des consultations
                        personnalisées dans un cadre professionnel et bienveillant.
                    </p>
                    <div class="service-liste">
                        <div class="service-item">
                            <span class="item-dot" style="background:#2e7d32;"></span>
                            Médecine générale
                        </div>
                        <div class="service-item">
                            <span class="item-dot" style="background:#1a2e5a;"></span>
                            Gynécologie
                        </div>
                        <div class="service-item">
                            <span class="item-dot" style="background:#e65100;"></span>
                            Cardiologie
                        </div>
                        <div class="service-item">
                            <span class="item-dot" style="background:#2e7d32;"></span>
                            Nutrition & Diététique
                        </div>
                        <div class="service-item">
                            <span class="item-dot" style="background:#1a2e5a;"></span>
                            Spécialistes sur rendez-vous
                        </div>
                    </div>
                    <a href="/#rendezvous" class="service-btn mt-4">
                        Prendre rendez-vous →
                    </a>
                </div>
            </div>

            <!-- IMAGE -->
            <div class="col-md-6">
                <div class="service-image-box">
                    <div id="carouselConsultations" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/gynecologie.png') }}"
                                     class="d-block w-100 service-img" alt="Gynécologie">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/cardiologie.jpg') }}"
                                     class="d-block w-100 service-img" alt="Cardiologie">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselConsultations" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselConsultations" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                    <div class="service-image-badge" style="background:#e65100;">
                        👨‍⚕️ Médecins spécialistes
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
</section>

<style>
/* ===== SECTION ===== */
.services-details {
    background: #f8f9fc;
}

/* ===== BLOC SERVICE ===== */
.service-block {
    padding: 40px 0;
}

/* ===== BADGE ICÔNE ===== */
.service-badge {
    width: 70px;
    height: 70px;
    border-radius: 20px;
    background: linear-gradient(135deg, #1a2e5a, #2e7d32);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    box-shadow: 0 8px 20px rgba(26,46,90,0.2);
}

.service-icon {
    font-size: 32px;
}

/* ===== TITRE ===== */
.service-title {
    font-size: 28px;
    font-weight: 700;
    color: #1a2e5a;
    margin-bottom: 16px;
}

/* ===== DESCRIPTION ===== */
.service-desc {
    color: #666;
    font-size: 15px;
    line-height: 1.8;
    margin-bottom: 20px;
}

/* ===== LISTE ===== */
.service-liste {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.service-item {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 15px;
    color: #444;
    font-weight: 500;
}

.item-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    flex-shrink: 0;
}

/* ===== BOUTON ===== */
.service-btn {
    display: inline-block;
    background: linear-gradient(135deg, #1a2e5a, #2e7d32);
    color: white !important;
    padding: 12px 28px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(26,46,90,0.2);
}

.service-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(26,46,90,0.3);
}

/* ===== IMAGE BOX ===== */
.service-image-box {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.service-img {
    height: 350px;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.service-image-box:hover .service-img {
    transform: scale(1.03);
}

/* ===== BADGE IMAGE ===== */
.service-image-badge {
    position: absolute;
    bottom: 20px;
    left: 20px;
    background: #2e7d32;
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

/* ===== SÉPARATEUR ===== */
.service-separator {
    height: 1px;
    background: linear-gradient(90deg, transparent, #e0e6f0, transparent);
    margin: 20px 0;
}
</style>