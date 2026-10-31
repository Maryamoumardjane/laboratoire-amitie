<section id="apropos" class="about-section container my-5">

    <!-- TITRE -->
    <div class="text-center mb-5 fade-item">
        <h2 class="about-title">🧪 À propos du laboratoire</h2>
        <p class="text-muted">Découvrez notre expertise et notre engagement pour votre santé</p>
    </div>

    <div class="row align-items-center g-5">

        <!-- TEXTE -->
        <div class="col-md-6 fade-left">

            <h4 class="fw-bold">Laboratoire de l’Amitié</h4>

            <p class="about-text mt-3">
               Le Laboratoire de l’Amitié accompagne chaque patient avec des analyses médicales fiables et rapides, dans un environnement moderne et rassurant.
            </p>

            <p class="about-text">
              Notre équipe s’engage à offrir un service de qualité basé sur la précision des résultats, l’écoute et un suivi personnalisé pour chaque besoin.
            </p>

            <ul class="about-list mt-4">
                <li>✔️ Équipe qualifiée et disponible</li>
                <li>✔️ Matériel moderne et performant</li>
                <li>✔️ Résultats rapides et sécurisés</li>
                <li>✔️ Accueil professionnel et humain</li>
            </ul>

        </div>

        <!-- VIDEO -->
        <div class="col-md-6 fade-right">
            <div class="video-box shadow-lg">
                <div class="ratio ratio-16x9">
                    <iframe 
                        src="https://www.youtube.com/embed/YOUR_VIDEO_ID"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>

    </div>

</section>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const elements = document.querySelectorAll('.fade-item, .fade-left, .fade-right');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {

            if (entry.isIntersecting) {
                entry.target.classList.add('show');
            }

        });
    }, {
        threshold: 0.2
    });

    elements.forEach(el => observer.observe(el));
});
</script>