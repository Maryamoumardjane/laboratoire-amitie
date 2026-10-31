@php
    $totalExamens    = \App\Models\Examen::count();
    $totalRendezvous = \App\Models\RendezVous::count();
@endphp

<section class="compteur-section py-5">
    <div class="container">

        <div class="row g-4 text-center">

            <!-- PATIENTS -->
            <div class="col-md-3 col-6">
                <div class="compteur-card">
                    <div class="compteur-icon">👥</div>
                    <h2 class="compteur-nombre" data-target="{{ $totalRendezvous }}">0</h2>
                    <p class="compteur-label">Patients servis</p>
                </div>
            </div>

            <!-- EXAMENS -->
            <div class="col-md-3 col-6">
                <div class="compteur-card">
                    <div class="compteur-icon">🔬</div>
                    <h2 class="compteur-nombre" data-target="{{ $totalExamens }}">0</h2>
                    <p class="compteur-label">Types d'examens</p>
                </div>
            </div>

            <!-- ANNÉES -->
            <div class="col-md-3 col-6">
                <div class="compteur-card">
                    <div class="compteur-icon">🏆</div>
                    <h2 class="compteur-nombre" data-target="10">0</h2>
                    <p class="compteur-label">Années d'expérience</p>
                </div>
            </div>

            <!-- SATISFACTION -->
            <div class="col-md-3 col-6">
                <div class="compteur-card">
                    <div class="compteur-icon">⭐</div>
                    <h2 class="compteur-nombre" data-target="98">0</h2>
                    <p class="compteur-label">% de satisfaction</p>
                </div>
            </div>

        </div>

    </div>
</section>

<style>
/* ===== SECTION COMPTEUR ===== */
.compteur-section {
    background: linear-gradient(135deg, #1a2e5a 0%, #0d1f3c 100%);
    position: relative;
    overflow: hidden;
}

.compteur-section::before {
    content: "";
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(46,125,50,0.1) 0%, transparent 60%);
}

/* ===== CARTE ===== */
.compteur-card {
    padding: 30px 20px;
    border-radius: 16px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    transition: transform 0.3s ease, background 0.3s ease;
    backdrop-filter: blur(10px);
}

.compteur-card:hover {
    transform: translateY(-8px);
    background: rgba(255,255,255,0.1);
}

/* ===== ICÔNE ===== */
.compteur-icon {
    font-size: 42px;
    margin-bottom: 12px;
}

/* ===== NOMBRE ===== */
.compteur-nombre {
    font-size: 52px;
    font-weight: 800;
    color: #ffffff;
    margin: 0;
    line-height: 1;
    background: linear-gradient(135deg, #ffffff, #a5d6a7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* ===== LABEL ===== */
.compteur-label {
    color: rgba(255,255,255,0.7);
    font-size: 14px;
    font-weight: 500;
    margin: 10px 0 0;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* ===== LIGNE DÉCORATIVE ===== */
.compteur-card::after {
    content: "";
    display: block;
    width: 40px;
    height: 3px;
    background: linear-gradient(90deg, #2e7d32, #e65100);
    margin: 12px auto 0;
    border-radius: 2px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const compteurs = document.querySelectorAll('.compteur-nombre');

    const animerCompteur = (el) => {
        const target  = parseInt(el.getAttribute('data-target'));
        const duree   = 2000; // 2 secondes
        const step    = target / (duree / 16);
        let current   = 0;

        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            el.textContent = Math.floor(current).toLocaleString('fr-FR');
        }, 16);
    };

    // Déclencher l'animation au scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animerCompteur(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    compteurs.forEach(el => observer.observe(el));

});
</script>