<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tontine Manager - Gestion de tontines en ligne</title>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<style>
:root {
    --primary-600: #1e40af;
    --primary-700: #1e3a8a;
    --primary-800: #1e3a8a;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-800: #1f2937;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Nunito', sans-serif;
    background-color: var(--gray-100);
    color: var(--gray-800);
    line-height: 1.6;
}

/* Header */
header {
    background-color: var(--primary-700);
    color: white;
    padding: 1rem 0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 0;
    z-index: 1000;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
}

.nav-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    display: flex;
    align-items: center;
    font-size: 1.5rem;
    font-weight: 700;
    text-decoration: none;
    color: white;
}

.logo i {
    margin-right: 0.5rem;
    font-size: 1.8rem;
}

.nav-links {
    display: flex;
    gap: 1.5rem;
}

.nav-links a {
    color: white;
    text-decoration: none;
    font-weight: 600;
    padding: 0.5rem 0;
    position: relative;
    transition: all 0.3s ease;
}

.nav-links a:hover {
    opacity: 0.9;
}

.nav-links a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background-color: white;
    transition: width 0.3s ease;
}

.nav-links a:hover::after {
    width: 100%;
}

.nav-buttons {
    display: flex;
    gap: 1rem;
}

.btn {
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-primary {
    background-color: white;
    color: var(--primary-700);
    border: 2px solid white;
}

.btn-primary:hover {
    background-color: transparent;
    color: white;
}

.btn-outline {
    background-color: transparent;
    color: white;
    border: 2px solid white;
}

.btn-outline:hover {
    background-color: white;
    color: var(--primary-700);
}

/* Hero Slider */
.hero-slider {
    width: 100%;
    height: 600px;
    position: relative;
    overflow: hidden;
}

.swiper {
    width: 100%;
    height: 100%;
}

.swiper-slide {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    padding: 0 2rem;
    background-size: cover;
    background-position: center;
}


.slide-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
    background-color: rgba(0, 0, 0, 0.5); /* Assombrissement */
    border-radius: 0.5rem;
}

.swiper-slide h1 {
    font-size: 3rem;
    margin-bottom: 1.5rem;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
}

.swiper-slide p {
    font-size: 1.25rem;
    margin-bottom: 2rem;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
}

.hero-buttons {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    margin-top: 2rem;
}

.swiper-pagination-bullet {
    background: white;
    opacity: 0.6;
    width: 12px;
    height: 12px;
}

.swiper-pagination-bullet-active {
    background: white;
    opacity: 1;
}

.swiper-button-next, .swiper-button-prev {
    color: white;
}

/* Features Section */
.features {
    padding: 5rem 0;
    background-color: white;
}

.section-title {
    text-align: center;
    margin-bottom: 3rem;
    font-size: 2.5rem;
    color: var(--primary-700);
    position: relative;
}

.section-title::after {
    content: '';
    display: block;
    width: 80px;
    height: 4px;
    background-color: var(--primary-600);
    margin: 1rem auto 0;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.feature-card {
    background-color: var(--gray-100);
    border-radius: 0.5rem;
    padding: 2.5rem 2rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    text-align: center;
    border-top: 4px solid var(--primary-600);
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.feature-icon {
    font-size: 3rem;
    color: var(--primary-600);
    margin-bottom: 1.5rem;
}

.feature-title {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: var(--primary-700);
}

.feature-card p {
    color: var(--gray-800);
}

/* How It Works */
.how-it-works {
    padding: 5rem 0;
    background-color: var(--gray-200);
}

.steps {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 3rem;
    margin-top: 3rem;
}

.step {
    flex: 1;
    min-width: 280px;
    max-width: 320px;
    text-align: center;
    position: relative;
    padding: 2rem;
    background-color: white;
    border-radius: 0.5rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.step:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.step-number {
    width: 60px;
    height: 60px;
    background-color: var(--primary-600);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    font-weight: bold;
    margin: 0 auto 1.5rem;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.step h3 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: var(--primary-700);
}

.step p {
    color: var(--gray-800);
}

/* Testimonials */
.testimonials {
    padding: 5rem 0;
    background-color: white;
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.testimonial-card {
    background-color: var(--gray-100);
    border-radius: 0.5rem;
    padding: 2.5rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    position: relative;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.testimonial-card::before {
    content: '"';
    position: absolute;
    top: 1rem;
    left: 1.5rem;
    font-size: 5rem;
    color: var(--primary-600);
    opacity: 0.1;
    font-family: serif;
    line-height: 1;
}

.testimonial-text {
    font-style: italic;
    margin-bottom: 1.5rem;
    position: relative;
    z-index: 1;
    font-size: 1.1rem;
}

.testimonial-author {
    font-weight: bold;
    color: var(--primary-700);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.testimonial-author::before {
    content: '';
    display: inline-block;
    width: 30px;
    height: 2px;
    background-color: var(--primary-600);
}

/* CTA Section */
.cta {
    padding: 5rem 0;
    background: linear-gradient(135deg, var(--primary-600), var(--primary-800));
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.cta::before {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.cta::after {
    content: '';
    position: absolute;
    bottom: -80px;
    left: -80px;
    width: 300px;
    height: 300px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.cta .container {
    position: relative;
    z-index: 1;
}

.cta h2 {
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
}

.cta p {
    font-size: 1.25rem;
    max-width: 700px;
    margin: 0 auto 2rem;
}

/* Footer */
footer {
    background-color: var(--primary-800);
    color: white;
    padding: 3rem 0 2rem;
    text-align: center;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    text-align: left;
    margin-bottom: 2rem;
}

.footer-column h3 {
    font-size: 1.25rem;
    margin-bottom: 1.5rem;
    position: relative;
    display: inline-block;
}

.footer-column h3::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 40px;
    height: 2px;
    background-color: white;
}

.footer-column ul {
    list-style: none;
}

.footer-column ul li {
    margin-bottom: 0.75rem;
}

.footer-column ul li a {
    color: var(--gray-200);
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-column ul li a:hover {
    color: white;
}

.footer-bottom {
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.social-links {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.social-links a {
    color: white;
    font-size: 1.5rem;
    transition: transform 0.3s ease;
}

.social-links a:hover {
    transform: translateY(-3px);
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: white;
    padding: 2rem;
    border-radius: 0.5rem;
    width: 90%;
    max-width: 500px;
    position: relative;
    animation: modalFadeIn 0.3s ease;
}

@keyframes modalFadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.close-modal {
    position: absolute;
    top: 1rem;
    right: 1rem;
    font-size: 1.5rem;
    cursor: pointer;
    color: var(--gray-800);
    transition: color 0.3s ease;
}

.close-modal:hover {
    color: var(--primary-700);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: var(--gray-800);
}

.form-group input, .form-group select {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid var(--gray-200);
    border-radius: 0.25rem;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-group input:focus, .form-group select:focus {
    outline: none;
    border-color: var(--primary-600);
    box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
}

.form-title {
    margin-bottom: 1.5rem;
    color: var(--primary-700);
    text-align: center;
    font-size: 1.5rem;
}

.submit-btn {
    width: 100%;
    padding: 0.75rem;
    background-color: var(--primary-600);
    color: white;
    border: none;
    border-radius: 0.25rem;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.submit-btn:hover {
    background-color: var(--primary-700);
}

.form-header {
    background-color: var(--primary-700);
    color: white;
    padding: 1.5rem;
    margin: -2rem -2rem 2rem -2rem;
    border-radius: 0.5rem 0.5rem 0 0;
    text-align: center;
}

.error-message {
    color: #e53e3e;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}





<!-- Ajoutez ce style dans la balise <style> -->
.contact {
    padding: 5rem 0;
    background-color: white;
}

.section-subtitle {
    text-align: center;
    font-size: 1.25rem;
    color: var(--gray-800);
    max-width: 700px;
    margin: 0 auto 3rem;
}

.contact-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: start;
}

.contact-info {
    display: grid;
    gap: 1.5rem;
}

.info-card {
    display: flex;
    gap: 1.5rem;
    padding: 1.5rem;
    background-color: var(--gray-100);
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    border-left: 4px solid var(--primary-600);
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.info-icon {
    font-size: 1.5rem;
    color: var(--primary-600);
    width: 50px;
    height: 50px;
    background-color: rgba(30, 64, 175, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.info-content h3 {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
    color: var(--primary-700);
}

.info-content p {
    margin-bottom: 0.75rem;
    color: var(--gray-800);
}

.info-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--primary-600);
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s ease;
}

.info-link:hover {
    color: var(--primary-800);
}

.info-link i {
    font-size: 0.8rem;
}

.social-media {
    margin-top: 1rem;
    padding: 1.5rem;
}

.social-media h3 {
    font-size: 1.25rem;
    margin-bottom: 1rem;
    color: var(--primary-700);
}

.social-icons {
    display: flex;
    gap: 1rem;
}

.social-icon {
    width: 40px;
    height: 40px;
    background-color: var(--primary-600);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.social-icon:hover {
    background-color: var(--primary-800);
    transform: translateY(-3px);
}

.contact-form {
    background-color: var(--gray-100);
    padding: 2rem;
    border-radius: 0.5rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.contact-form .form-group {
    margin-bottom: 1.5rem;
}

.contact-form label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: var(--gray-800);
}

.contact-form input,
.contact-form textarea {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid var(--gray-200);
    border-radius: 0.25rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.contact-form textarea {
    resize: vertical;
    min-height: 120px;
}

.contact-form input:focus,
.contact-form textarea:focus {
    outline: none;
    border-color: var(--primary-600);
    box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
}

.contact-form .submit-btn {
    width: 100%;
    padding: 0.75rem;
    background-color: var(--primary-600);
    color: white;
    border: none;
    border-radius: 0.25rem;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.contact-form .submit-btn:hover {
    background-color: var(--primary-700);
}

@media (max-width: 768px) {
    .contact-container {
        grid-template-columns: 1fr;
    }

    .info-card {
        flex-direction: column;
        text-align: center;
    }

    .info-icon {
        margin: 0 auto;
    }

    .social-icons {
        justify-content: center;
    }
}




/* Tontines Section */
.tontines-section {
    padding: 5rem 0;
    background-color: var(--gray-100);
}

.tontines-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 3rem;
}

.tontine-card {
    background-color: white;
    border-radius: 0.5rem;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.tontine-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

.tontine-image {
    height: 200px;
    overflow: hidden;
}

.tontine-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.tontine-card:hover .tontine-image img {
    transform: scale(1.05);
}

.tontine-content {
    padding: 1.5rem;
}

.tontine-content h3 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: var(--primary-700);
}

.tontine-meta {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
}

.tontine-amount, .tontine-participants {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--gray-800);
}

.tontine-cta {
    text-align: center;
    padding-top: 1rem;
    border-top: 1px solid var(--gray-200);
}

.tontine-cta p {
    margin-bottom: 1rem;
    font-size: 0.9rem;
    color: var(--gray-800);
}

.tontine-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

@media (max-width: 768px) {
    .tontine-buttons {
        flex-direction: column;
    }

    .tontine-meta {
        flex-direction: column;
        gap: 0.5rem;
    }
}










/* Responsive */
@media (max-width: 768px) {
    .nav-container {
        flex-direction: column;
        gap: 1rem;
    }

    .nav-links {
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
    }

    .hero-slider {
        height: 500px;
    }

    .swiper-slide h1 {
        font-size: 2.5rem;
    }

    .hero-buttons {
        flex-direction: column;
        align-items: center;
    }

    .step {
        margin-bottom: 2rem;
    }

    .footer-content {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .footer-column h3::after {
        left: 50%;
        transform: translateX(-50%);
    }
}
</style>
</head>
<body>
<!-- Header -->
<header>
    <div class="container nav-container">
        <a href="/" class="logo">
            <i class="fas fa-hand-holding-usd"></i>
            <span>TontineManager</span>
        </a>

        <nav class="nav-links">
            <a href="#features">Fonctionnalités</a>
            <a href="#how-it-works">Fonctionnement</a>
            <a href="#testimonials">Témoignages</a>
            <a href="#faq">FAQ</a>
            <a href="#contact">Contact</a>
        </nav>

        <div class="nav-buttons">
            <button id="login-btn" class="btn btn-outline">
                <i class="fas fa-sign-in-alt"></i> Connexion
            </button>
            <button id="register-btn" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Inscription
            </button>
        </div>
    </div>
</header>

<!-- Hero Slider -->
<section class="hero-slider">
    <div class="swiper">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide" style="background-image: url('images/img-tontine1.jpg')">
                <div class="slide-content">
                    <h1>Gérez vos tontines en toute simplicité</h1>
                    <p>TontineManager est la solution complète pour organiser, suivre et gérer vos tontines en ligne, que vous soyez gestionnaire ou participant.</p>
                    <div class="hero-buttons">
                        <button id="hero-login-btn" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i> Se connecter
                        </button>
                        <button id="hero-register-btn" class="btn btn-outline">
                            <i class="fas fa-user-plus"></i> S'inscrire
                        </button>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide" style="background-image: url('images/img-tontine2.jpg')">
                <div class="slide-content">
                    <h1>Transparence et sécurité</h1>
                    <p>Suivez chaque contribution en temps réel et assurez-vous que tous les participants respectent leurs engagements.</p>
                    <div class="hero-buttons">
                        <button id="hero-login-btn2" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i> Se connecter
                        </button>
                        <button id="hero-register-btn2" class="btn btn-outline">
                            <i class="fas fa-user-plus"></i> S'inscrire
                        </button>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="swiper-slide" style="background-image: url('images/img-tontine3.jpg')">
                <div class="slide-content">
                    <h1>Notifications intelligentes</h1>
                    <p>Ne manquez plus aucune échéance grâce à nos rappels automatiques et notifications personnalisées.</p>
                    <div class="hero-buttons">
                        <button id="hero-login-btn3" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i> Se connecter
                        </button>
                        <button id="hero-register-btn3" class="btn btn-outline">
                            <i class="fas fa-user-plus"></i> S'inscrire
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="features">
    <div class="container">
        <h2 class="section-title">Nos fonctionnalités</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="feature-title">Gestion des membres</h3>
                <p>Ajoutez et gérez facilement les participants à vos tontines avec des outils dédiés. Visualisez les profils et historiques de chaque membre.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <h3 class="feature-title">Suivi des paiements</h3>
                <p>Visualisez en temps réel les paiements effectués et ceux en attente. Générez des rapports détaillés pour une transparence totale.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bell"></i>
                </div>
                <h3 class="feature-title">Notifications intelligentes</h3>
                <p>Recevez des alertes pour les échéances importantes et les activités récentes. Personnalisez les rappels selon vos préférences.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="feature-title">Analyses et rapports</h3>
                <p>Accédez à des tableaux de bord intuitifs et des analyses détaillées pour suivre la santé de votre tontine.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="feature-title">Sécurité renforcée</h3>
                <p>Vos données sont protégées avec des mesures de sécurité avancées et un cryptage de bout en bout.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3 class="feature-title">Accès mobile</h3>
                <p>Gérez votre tontine depuis n'importe où avec notre interface optimisée pour tous les appareils.</p>
            </div>
        </div>
    </div>
</section>

<!-- Tontines Section -->
<section id="tontines" class="tontines-section">
    <div class="container">
        <h2 class="section-title">Dernières Tontines</h2>
        <p class="section-subtitle">Rejoignez une communauté en pleine croissance</p>

        <div class="tontines-grid">
            @foreach($tontines as $tontine)
            <div class="tontine-card">
                <div class="tontine-content">
                    <h3>{{ $tontine->name }}</h3>
                    <div class="tontine-meta">
                        <span class="tontine-amount">
                            <i class="fas fa-money-bill-wave"></i> {{ number_format($tontine->amount_per_participant, 0, ',', ' ') }} FCFA
                        </span>
                        <span class="tontine-participants">
                            <i class="fas fa-users"></i> {{ $tontine->active_participants_count }} participants
                        </span>
                    </div>
                    <div class="tontine-cta">
                        <p>Connectez-vous pour voir les détails et participer</p>
                        <div class="tontine-buttons">
                            <a href="{{ route('login') }}" class="btn btn-outline">
                                <i class="fas fa-sign-in-alt"></i> Se connecter
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                <i class="fas fa-user-plus"></i> S'inscrire
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('tontines.public') }}" class="btn btn-primary px-8 py-3" style="margin-top: 2rem; color: var(--gray-800)">
                <i class="fas fa-list mr-2"></i> Voir toutes les tontines
            </a>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section id="how-it-works" class="how-it-works">
    <div class="container">
        <h2 class="section-title">Comment ça marche</h2>
        <div class="steps">
            <div class="step">
                <div class="step-number">1</div>
                <h3>Créez un compte</h3>
                <p>Inscrivez-vous en tant que gestionnaire ou participant en quelques clics. La validation est instantanée.</p>
            </div>

            <div class="step">
                <div class="step-number">2</div>
                <h3>Rejoignez ou créez une tontine</h3>
                <p>Participez à une tontine existante ou lancez la vôtre en définissant les règles, montants et fréquences de paiement.</p>
            </div>

            <div class="step">
                <div class="step-number">3</div>
                <h3>Gérez simplement</h3>
                <p>Suivez les paiements, les tours et les bénéficiaires en temps réel. Notre système automatise les tâches complexes.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="testimonials">
    <div class="container">
        <h2 class="section-title">Témoignages</h2>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <p class="testimonial-text">"TontineManager a révolutionné la gestion de notre tontine familiale. Plus de disputes sur qui a payé ou non! L'interface est intuitive et les rapports très détaillés."</p>
                <p class="testimonial-author">- Marie D., gestionnaire</p>
            </div>

            <div class="testimonial-card">
                <p class="testimonial-text">"En tant que participant, je peux voir clairement où en est la tontine et quand sera mon tour. La transparence est totale et les notifications m'aident à ne rien oublier."</p>
                <p class="testimonial-author">- Jean P., participant</p>
            </div>

            <div class="testimonial-card">
                <p class="testimonial-text">"L'outil parfait pour nos tontines d'entreprise. Les notifications nous rappellent les échéances et tout est traçable. Un gain de temps considérable pour notre service RH."</p>
                <p class="testimonial-author">- Aminata S., Responsable RH</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta">
    <div class="container">
        <h2>Prêt à simplifier la gestion de vos tontines?</h2>
        <p>Rejoignez des milliers d'utilisateurs qui font déjà confiance à TontineManager pour une gestion transparente et sans stress.</p>
        <div class="hero-buttons">
            <button id="cta-register-btn" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Commencer maintenant
            </button>
        </div>
    </div>
</section>

<!-- Ajoutez cette section juste avant le CTA Section (avant <section class="cta">) -->

<!-- Contact Section -->
<section id="contact" class="contact">
    <div class="container">
        <h2 class="section-title">Contactez-nous</h2>
        <p class="section-subtitle">Une question, une suggestion ? Notre équipe est là pour vous répondre.</p>

        <div class="contact-container">
            <div class="contact-info">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-content">
                        <h3>Email</h3>
                        <p>contact@tontinemanager.com</p>
                        <a href="mailto:contact@tontinemanager.com" class="info-link">Envoyer un email <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="info-content">
                        <h3>Téléphone</h3>
                        <p>+33 1 23 45 67 89</p>
                        <a href="tel:+33123456789" class="info-link">Appeler maintenant <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="info-content">
                        <h3>Adresse</h3>
                        <p>123 Rue de la Tontine<br>75015 Paris, France</p>
                        <a href="https://maps.google.com" target="_blank" class="info-link">Voir sur la carte <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="social-media">
                    <h3>Réseaux sociaux</h3>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <form id="contactForm" action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="contact-name">Votre nom</label>
                        <input type="text" id="contact-name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="contact-email">Votre email</label>
                        <input type="email" id="contact-email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="contact-subject">Sujet</label>
                        <input type="text" id="contact-subject" name="subject" required>
                    </div>

                    <div class="form-group">
                        <label for="contact-message">Votre message</label>
                        <textarea id="contact-message" name="message" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane"></i> Envoyer le message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="footer-content">
            <div class="footer-column">
                <h3>TontineManager</h3>
                <p>La solution complète pour gérer vos tontines en ligne avec transparence et efficacité.</p>
            </div>

            <div class="footer-column">
                <h3>Liens rapides</h3>
                <ul>
                    <li><a href="#features">Fonctionnalités</a></li>
                    <li><a href="#how-it-works">Comment ça marche</a></li>
                    <li><a href="#testimonials">Témoignages</a></li>
                    <li><a href="#faq">FAQ</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Légal</h3>
                <ul>
                    <li><a href="#">Conditions d'utilisation</a></li>
                    <li><a href="#">Politique de confidentialité</a></li>
                    <li><a href="#">Mentions légales</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Contact</h3>
                <ul>
                    <li><i class="fas fa-envelope"></i> contact@tontinemanager.com</li>
                    <li><i class="fas fa-phone"></i> +33 1 23 45 67 89</li>
                    <li><i class="fas fa-map-marker-alt"></i> Paris, France</li>
                </ul>
            </div>
        </div>

        <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>

        <div class="footer-bottom">
            <p>&copy; <span id="year"></span> TontineManager. Tous droits réservés.</p>
        </div>
    </div>
</footer>

<!-- Login Modal -->
<div id="login-modal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <div class="form-header">
            <h2>Connexion</h2>
        </div>
        <form id="login-form" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
                @error('password')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group flex items-center">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Se souvenir de moi</label>
            </div>

            <button type="submit" class="submit-btn">
                Connexion
            </button>

            @if (Route::has('password.request'))
            <div class="text-center mt-4">
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800">
                    Mot de passe oublié?
                </a>
            </div>
            @endif
        </form>
    </div>
</div>

<!-- Register Modal -->
<div id="register-modal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <div class="form-header">
            <h2>Inscription</h2>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nom complet</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                <span class="error-message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Adresse Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                <span class="error-message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Numéro de téléphone</label>
                <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required>
                @error('phone')
                <span class="error-message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="role">Rôle</label>
                <select id="role" name="role" required>
                    <option value="manager">Manager</option>
                    <option value="participant">Participant</option>
                </select>
                @error('role')
                <span class="error-message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                @error('password')
                <span class="error-message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">Confirmer le mot de passe</label>
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>

            <button type="submit" class="submit-btn">
                S'inscrire
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
// Set current year in footer
document.getElementById('year').textContent = new Date().getFullYear();

// Initialize Swiper
const swiper = new Swiper('.swiper', {
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});

// Modal functionality
const loginModal = document.getElementById('login-modal');
const registerModal = document.getElementById('register-modal');
const loginBtns = [
    document.getElementById('login-btn'),
    document.getElementById('hero-login-btn'),
    document.getElementById('hero-login-btn2'),
    document.getElementById('hero-login-btn3')
];
const registerBtns = [
    document.getElementById('register-btn'),
    document.getElementById('hero-register-btn'),
    document.getElementById('hero-register-btn2'),
    document.getElementById('hero-register-btn3'),
    document.getElementById('cta-register-btn')
];
const closeBtns = document.querySelectorAll('.close-modal');

// Open login modal
loginBtns.forEach(btn => {
    if (btn) {
        btn.addEventListener('click', () => {
            loginModal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });
    }
});

// Open register modal
registerBtns.forEach(btn => {
    if (btn) {
        btn.addEventListener('click', () => {
            registerModal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });
    }
});

// Close modals
closeBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        loginModal.style.display = 'none';
        registerModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
});

// Close modal when clicking outside
window.addEventListener('click', (e) => {
    if (e.target === loginModal) {
        loginModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    if (e.target === registerModal) {
        registerModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        const targetId = this.getAttribute('href');
        if (targetId === '#') return;

        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 80,
                behavior: 'smooth'
            });
        }
    });
});
</script>
</body>
</html>
