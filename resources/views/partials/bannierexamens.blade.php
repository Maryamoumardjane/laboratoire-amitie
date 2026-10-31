<section id="banniereexamens" class="cta-examens-section mt-5">
<div class="container-fluid px-0">

    <div class="cta-examens-box">

        <!-- DÉCORATION FOND -->
        <div class="cta-examens-circle circle1"></div>
        <div class="cta-examens-circle circle2"></div>

        <!-- ICÔNES FLOTTANTES -->
        <a href="/examens"><i class="fa-solid fa-microscope cta-examens-icon icon1 anim-zoom"></i></a>
        <a href="/examens"><i class="fa-solid fa-vial-circle-check cta-examens-icon icon2 anim-zoom" style="animation-delay:0.15s;"></i></a>
        <a href="/examens"><i class="fa-solid fa-syringe cta-examens-icon icon3 anim-zoom" style="animation-delay:0.3s;"></i></a>
        <a href="/examens"><i class="fa-solid fa-flask cta-examens-icon icon4 anim-zoom" style="animation-delay:0.45s;"></i></a>

        <!-- BADGE HORAIRES — haut à gauche -->
        <div class="cta-examens-badge anim-slide-left">
            <i class="fa-solid fa-clock"></i>
            <span>Ouvert 24h/24 - 7j/7</span>
        </div>

        <!-- POINTS FORTS — haut à droite -->
        <div class="cta-examens-points anim-slide-right">
            <div class="cta-examens-point">
                <span>✅</span>
                <span>Analyses certifiées</span>
            </div>
            <div class="cta-examens-point">
                <span>⚡</span>
                <span>Résultats rapides</span>
            </div>
            <div class="cta-examens-point">
                <span>🔒</span>
                <span>100% sécurisé</span>
            </div>
        </div>

        <!-- CONTENU CENTRÉ -->
        <div class="cta-examens-center">

            <span class="cta-examens-tag anim-fade-up" style="animation-delay:0.1s;">
                🔬 Laboratoire de l'Amitié
            </span>

            <h2 class="cta-examens-title anim-fade-up" style="animation-delay:0.2s;">
                Examens médicaux fiables,<br>
                <span class="cta-examens-accent">rapides et sécurisés</span>
            </h2>

            <p class="cta-examens-desc anim-fade-up" style="animation-delay:0.3s;">
                Le Laboratoire de l'Amitié vous garantit des analyses précises
                avec des résultats rapides et sécurisés, réalisés par des
                professionnels qualifiés.
            </p>

            <a href="/examens" class="cta-examens-btn anim-fade-up" style="animation-delay:0.4s;">
                🔬 Voir les examens
            </a>

        </div>

        <!-- VAGUE -->
        <div class="cta-examens-wave">
            <svg viewBox="0 0 1200 80" preserveAspectRatio="none">
                <path d="M0,40 C300,80 900,0 1200,40 L1200,80 L0,80 Z"
                      fill="rgba(255,255,255,0.06)"/>
            </svg>
        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll(
        '.anim-fade-up, .anim-slide-left, .anim-slide-right, .anim-zoom'
    ).forEach(el => observer.observe(el));

    const box = document.querySelector('.cta-examens-box');
    if (box) observer.observe(box);

    const pointsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.querySelectorAll('.cta-examens-point').forEach((point, i) => {
                    setTimeout(() => point.classList.add('visible'), i * 150);
                });
                pointsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    const pointsContainer = document.querySelector('.cta-examens-points');
    if (pointsContainer) pointsObserver.observe(pointsContainer);

    window.addEventListener('scroll', function () {
        const section = document.querySelector('#banniereexamens');
        if (!section) return;
        const rect = section.getBoundingClientRect();
        const progress = 1 - (rect.top / window.innerHeight);
        if (progress > 0 && progress < 1.5) {
            section.querySelectorAll('.cta-examens-circle').forEach((circle, i) => {
                circle.style.transform = `translateY(${progress * (i === 0 ? 30 : -20)}px)`;
            });
            section.querySelectorAll('.cta-examens-icon').forEach((icon, i) => {
                icon.style.marginTop = `${progress * (i % 2 === 0 ? 15 : -15)}px`;
            });
        }
    });

    const titre = document.querySelector('.cta-examens-title');
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

<style>
@keyframes titleReveal {
    0%   { opacity:0; transform:translateY(30px) scale(0.95); filter:blur(4px); }
    100% { opacity:1; transform:translateY(0) scale(1); filter:blur(0); }
}
</style>

</section>