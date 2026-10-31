<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratoire de l'Amitié</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('css/baniere.css') }}">
    <link rel="stylesheet" href="{{ asset('css/services.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bannierexamens.css') }}">
    <link rel="stylesheet" href="{{ asset('css/apropos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/avantages.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
      <link rel="stylesheet" href="{{ asset('css/rendezvous.css') }}">
    <link rel="stylesheet" href="{{ asset('css/examens.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/localisation.css') }}">
</head>

<body>

<!-- ===== NAVBAR ===== -->
<nav class="main-navbar fixed-top">

    <!-- TOP BAR -->
    <div class="navbar-top">
        <div class="container">
            <div class="top-bar-inner">
                <div class="top-item">🕒 Lun - Dim, 24/7</div>
                <div class="top-item urgent-notice">
                    🚨 Urgence prélèvement à domicile ou au bureau 🚑
                </div>
                <div class="top-item">📞 +237 6XX XXX XXX</div>
            </div>
        </div>
    </div>

    <!-- BOTTOM NAV -->
    <div class="navbar-bottom">
        <div class="container nav-bottom-inner">

            <!-- LOGO -->
            <a href="/" class="logo-box">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo">
                <span>Laboratoire de l'Amitié</span>
            </a>

            <!-- BURGER MOBILE -->
            <button class="burger-btn" id="burgerBtn" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <!-- MENU -->
            <div class="nav-menu" id="navMenu">

                <!-- BOUTON FERMER MOBILE -->
                <button class="nav-close-btn" id="navCloseBtn">✕</button>

                <a href="/" class="nav-link-item">Accueil</a>
                <a href="/#services" class="nav-link-item">Services</a>
                <a href="/#apropos" class="nav-link-item">À propos</a>
                <a href="/#banniereexamens" class="nav-link-item">Examens</a>
                <a href="/#contact" class="nav-link-item">Contact</a>
                <a href="/#faq" class="nav-link-item">FAQ</a>

                <a href="/#rendezvous" class="btn-rdv">
                    📅 Rendez-vous <span class="badge-24">24/7</span>
                </a>

            </div>

        </div>
    </div>

</nav>

<!-- OVERLAY MOBILE -->
<div class="nav-overlay" id="navOverlay"></div>

<!-- CONTENU -->
<main>
    @yield('content')
</main>

<!-- WHATSAPP FLOTTANT -->
<a href="https://wa.me/237XXXXXXXXX?text=Bonjour%20Laboratoire%20de%20l'Amiti%C3%A9"
   target="_blank"
   class="whatsapp-float"
   title="WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- FOOTER -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-inner">
            <div class="footer-brand">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" height="45">
                <span>Laboratoire de l'Amitié</span>
            </div>
            <div class="footer-links">
                <a href="/">Accueil</a>
                <a href="/examens">Examens</a>
                <a href="/contact">Contact</a>
                <a href="/resultats/telecharger">Mes résultats</a>
            </div>
            <div class="footer-contact">
                📍 Yaoundé, Cameroun &nbsp;|&nbsp; 📞 +237 675 85 82 39
            </div>
        </div>
        <div class="footer-bottom">
            © {{ date('Y') }} Laboratoire de l'Amitié. Tous droits réservés.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// ===== BURGER MENU =====
const burgerBtn   = document.getElementById('burgerBtn');
const navMenu     = document.getElementById('navMenu');
const navOverlay  = document.getElementById('navOverlay');
const navCloseBtn = document.getElementById('navCloseBtn');

function openMenu() {
    navMenu.classList.add('open');
    navOverlay.classList.add('show');
    burgerBtn.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeMenu() {
    navMenu.classList.remove('open');
    navOverlay.classList.remove('show');
    burgerBtn.classList.remove('active');
    document.body.style.overflow = '';
}

burgerBtn.addEventListener('click', openMenu);
navCloseBtn.addEventListener('click', closeMenu);
navOverlay.addEventListener('click', closeMenu);

// Fermer au clic sur un lien
document.querySelectorAll('.nav-link-item, .btn-rdv').forEach(link => {
    link.addEventListener('click', closeMenu);
});

// ===== NAVBAR COMPACT AU SCROLL =====
window.addEventListener('scroll', function () {
    const nav = document.querySelector('.main-navbar');
    if (window.scrollY > 60) {
        nav.classList.add('compact');
    } else {
        nav.classList.remove('compact');
    }
});

// ===== PADDING BODY DYNAMIQUE =====
function adjustPadding() {
    const navbar = document.querySelector('.main-navbar');
    document.body.style.paddingTop = navbar.offsetHeight + 'px';
}
window.addEventListener('load', adjustPadding);
window.addEventListener('resize', adjustPadding);

// ===== ANIMATIONS AU SCROLL =====
document.addEventListener('DOMContentLoaded', function () {
    const elements = document.querySelectorAll('.animate-on-scroll');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });
    elements.forEach(el => observer.observe(el));
});
</script>

</body>
</html>

