@extends('layout')

@section('content')

<div class="container mt-5">

    {{-- TITRE --}}
    <div class="text-center mb-5 fade-in">
        <h2 class="main-title">
            🏥 Nos Services Médicaux
        </h2>
        <p class="text-muted mt-3">
            Des services modernes, fiables et réalisés par des professionnels qualifiés
        </p>
    </div>

    {{-- ================= ANALYSES ================= --}}
    <div class="service-box slide-up">

        <div class="service-header">
            🔬 Analyses médicales
        </div>

        <div class="service-body">

            <p class="service-subtitle">
                Des analyses précises pour détecter et suivre les maladies efficacement.
            </p>

            <div class="row g-4">

                <div class="col-md-6 service-item">
                    <i class="fa-solid fa-bacteria icon"></i>
                    <h5 class="service-title">Bactériologie</h5>
                    <p>Détection des infections et identification des bactéries.</p>
                </div>

                <div class="col-md-6 service-item">
                    <i class="fa-solid fa-flask icon"></i>
                    <h5 class="service-title">Biochimie</h5>
                    <p>Analyse du sang pour contrôler les organes.</p>
                </div>

                <div class="col-md-6 service-item">
                    <i class="fa-solid fa-dna icon"></i>
                    <h5 class="service-title">Immuno-hormonologie</h5>
                    <p>Analyse des hormones et du système immunitaire.</p>
                </div>

                <div class="col-md-6 service-item">
                    <i class="fa-solid fa-virus icon"></i>
                    <h5 class="service-title">Parasitologie</h5>
                    <p>Détection des parasites et maladies tropicales.</p>
                </div>

                <div class="col-12 service-item">
                    <i class="fa-solid fa-shield-virus icon"></i>
                    <h5 class="service-title">Immuno-sérologie</h5>
                    <p>Recherche des infections comme VIH et hépatites.</p>
                </div>

            </div>

        </div>
    </div>

    {{-- ================= IMAGERIE ================= --}}
    <div class="service-box slide-up mt-5">

        <div class="service-header">
            🩻 Imagerie médicale
        </div>

        <div class="service-body">

            <p class="service-subtitle">
                Visualisation des organes pour un diagnostic rapide et précis.
            </p>

            <div class="row g-4">

                <div class="col-md-4 service-item">
                    <i class="fa-solid fa-wave-square icon"></i>
                    <h5 class="service-title">Échographie</h5>
                    <p>Observation des organes en temps réel.</p>
                </div>

                <div class="col-md-4 service-item">
                    <i class="fa-solid fa-heart-pulse icon"></i>
                    <h5 class="service-title">ECG</h5>
                    <p>Analyse du cœur et des anomalies cardiaques.</p>
                </div>

                <div class="col-md-4 service-item">
                    <i class="fa-solid fa-heart icon"></i>
                    <h5 class="service-title">Échographie cardiaque</h5>
                    <p>Étude complète du fonctionnement du cœur.</p>
                </div>

            </div>

        </div>
    </div>

    {{-- ================= MEDECINS ================= --}}
    <div class="container mt-5">

        <h2 class="text-center mb-5 main-title">
            👨‍⚕️ Nos Médecins Spécialistes
        </h2>

        <div class="row g-5 justify-content-center">

            {{-- DOCTEUR 1 --}}
            <div class="col-md-4">
                <div class="doctor-card text-center">

                    <div class="doctor-img-box">
                        <img src="{{ asset('images/Dr.jpg') }}" class="doctor-img">
                    </div>

                    <div class="doctor-info">
                        <h4>Dr. Marie N.</h4>
                        <span class="badge bg-success">Biologiste médical</span>

                        <p>
                            Spécialiste en analyses cliniques et microbiologie.
                            Diagnostic précis basé sur des résultats fiables.
                        </p>

                        <a href="/#rendezvous" class="btn btn-success mt-3">
    📅 Prendre rendez-vous
</a>
                    </div>

                </div>
            </div>

            {{-- DOCTEUR 2 --}}
            <div class="col-md-4">
                <div class="doctor-card text-center">

                    <div class="doctor-img-box">
                        <img src="{{ asset('images/Dr.jpg') }}" class="doctor-img">
                    </div>

                    <div class="doctor-info">
                        <h4>Dr. Paul K.</h4>
                        <span class="badge bg-primary">Radiologue</span>

                        <p>
                            Expert en imagerie médicale moderne :
                            échographie, ECG et diagnostic rapide.
                        </p>

                        <a href="/#rendezvous" class="btn btn-success mt-3">
    📅 Prendre rendez-vous
</a>
                    </div>

                </div>
            </div>

            {{-- DOCTEUR 3 --}}
            <div class="col-md-4">
                <div class="doctor-card text-center">

                    <div class="doctor-img-box">
                        <img src="{{ asset('images/Dr.jpg') }}" class="doctor-img">
                    </div>

                    <div class="doctor-info">
                        <h4>Dr. Amina S.</h4>
                        <span class="badge bg-danger">Cardiologue</span>

                        <p>
                            Spécialiste du cœur et suivi des maladies cardiovasculaires.
                        </p>

                        <a href="/#rendezvous" class="btn btn-success mt-3">
    📅 Prendre rendez-vous
</a>
                            
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@endsection

{{-- ================= STYLE ================= --}}
<style>

:root {
    --primary-blue: #1F3A5F;
    --medical-green: #0BAF87;
    --accent-orange: #F57C00;
    --light-bg: #F5F7FA;
}

body{
    font-family: 'Poppins', sans-serif;
    background-color: var(--light-bg);
}

/* TITRE */
.main-title{
    font-size: 32px;
    font-weight: 800;
    color: var(--primary-blue);
}

/* SERVICE */
.service-box{
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    background: white;
    transition: 0.4s;
}

.service-box:hover{
    transform: translateY(-10px);
}

.service-header{
    padding: 18px;
    font-size: 20px;
    font-weight: bold;
    background: linear-gradient(135deg, var(--primary-blue), var(--medical-green));
    color: white;
}

.service-body{
    padding: 25px;
}

.service-title{
    font-weight: 700;
    color: var(--primary-blue);
}

.service-item{
    text-align: center;
    padding: 20px;
    border-radius: 12px;
    transition: 0.4s;
    border: 1px solid #eee;
}

.service-item:hover{
    transform: scale(1.05);
    border-left: 4px solid var(--medical-green);
}

.icon{
    font-size: 30px;
    color: var(--medical-green);
}

.service-item:hover .icon{
    color: var(--accent-orange);
}

/* DOCTORS */
.doctor-card{
    background: white;
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: 0.4s;
}

.doctor-card:hover{
    transform: translateY(-15px) scale(1.03);
}

.doctor-img-box{
    background: linear-gradient(135deg, var(--primary-blue), var(--medical-green));
    padding: 30px;
}

.doctor-img{
    width: 220px;
    height: 220px;
    border-radius: 50%;
    border: 6px solid white;
    object-fit: cover;
    transition: 0.4s;
}

.doctor-card:hover .doctor-img{
    transform: scale(1.1);
}

.doctor-info{
    padding: 25px;
}

.badge{
    border-radius: 10px;
}

/* ANIMATION */
.slide-up{
    animation: slideUp 0.8s ease;
}

@keyframes slideUp{
    from{opacity:0; transform:translateY(40px);}
    to{opacity:1; transform:translateY(0);}
}

.fade-in{
    animation: fadeIn 1s ease;
}

@keyframes fadeIn{
    from{opacity:0;}
    to{opacity:1;}
}



</style>

