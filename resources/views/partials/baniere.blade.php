<section class="cta-section" style="margin-top: 40px;" id="banniere-cta">
<div class="container-fluid px-0">

    <div class="cta-box">

        <!-- DÉCORATION -->
        <div class="cta-bg-circle circle1"></div>
        <div class="cta-bg-circle circle2"></div>

        <!-- ICÔNES FLOTTANTES -->
        <i class="fa-solid fa-heart-pulse cta-float-icon icon1 anim-zoom"></i>
        <i class="fa-solid fa-stethoscope cta-float-icon icon2 anim-zoom" style="animation-delay:0.15s;"></i>
        <i class="fa-solid fa-flask cta-float-icon icon3 anim-zoom" style="animation-delay:0.3s;"></i>
        <i class="fa-solid fa-microscope cta-float-icon icon4 anim-zoom" style="animation-delay:0.45s;"></i>

        <!-- BADGE + POINTS -->
        <div class="cta-top-bar">
            <div class="cta-badge anim-slide-left">
                <i class="fa-solid fa-clock"></i>
                <span>Ouvert Lundi - Dimanche, 24h/24</span>
            </div>
            <div class="cta-points anim-slide-right">
                <div class="cta-point"><span>✅</span><span>Résultats fiables et rapides</span></div>
                <div class="cta-point"><span>📥</span><span>Téléchargement en ligne</span></div>
                <div class="cta-point"><span>🏠</span><span>Prélèvement à domicile</span></div>
            </div>
        </div>

        <!-- CONTENU CENTRÉ -->
        <div class="cta-center" style="position:relative; z-index:2; text-align:center;">

            <span class="cta-tag anim-fade-up" style="animation-delay:0.1s;">
                🏥 Laboratoire de l'Amitié
            </span>

            <h2 class="cta-title anim-fade-up" style="animation-delay:0.2s;">
                Besoin d'un examen<br>
                <span class="cta-title-accent">médical rapide ?</span>
            </h2>

            <p class="cta-desc anim-fade-up" style="animation-delay:0.3s;">
                Notre équipe de professionnels vous accompagne pour tous vos examens médicaux
                avec une prise en charge rapide, fiable et sécurisée.
                Résultats précis dans les meilleurs délais.
            </p>

            <a href="#rendezvous" class="cta-btn-primary anim-fade-up" style="animation-delay:0.4s;">
                📅 Réserver maintenant
            </a>

        </div>

        <!-- VAGUE -->
        <div class="cta-wave">
            <svg viewBox="0 0 1200 80" preserveAspectRatio="none">
                <path d="M0,40 C300,80 900,0 1200,40 L1200,80 L0,80 Z"
                      fill="rgba(255,255,255,0.06)"/>
            </svg>
        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ===== OBSERVER PRINCIPAL =====
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('#banniere-cta .anim-fade-up, #banniere-cta .anim-slide-left, #banniere-cta .anim-slide-right, #banniere-cta .anim-zoom')
        .forEach(el => observer.observe(el));

    const box = document.querySelector('#banniere-cta .cta-box');
    if (box) observer.observe(box);

    // ===== POINTS EN CASCADE =====
    const pointsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.querySelectorAll('.cta-point').forEach((point, i) => {
                    setTimeout(() => point.classList.add('visible'), i * 150);
                });
                pointsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    const pointsContainer = document.querySelector('#banniere-cta .cta-points');
    if (pointsContainer) pointsObserver.observe(pointsContainer);

    // ===== PARALLAX =====
    window.addEventListener('scroll', function () {
        const section = document.querySelector('#banniere-cta');
        if (!section) return;
        const rect = section.getBoundingClientRect();
        const progress = 1 - (rect.top / window.innerHeight);
        if (progress > 0 && progress < 1.5) {
            section.querySelectorAll('.cta-bg-circle').forEach((circle, i) => {
                circle.style.transform = `translateY(${progress * (i === 0 ? 30 : -20)}px)`;
            });
            section.querySelectorAll('.cta-float-icon').forEach((icon, i) => {
                icon.style.marginTop = `${progress * (i % 2 === 0 ? 15 : -15)}px`;
            });
        }
    });

    // ===== TITRE REVEAL =====
    const titre = document.querySelector('#banniere-cta .cta-title');
    if (titre) {
        new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'titleReveal 0.8s ease forwards';
                }
            });
        }, { threshold: 0.5 }).observe(titre);
    }

});
</script>

</section>