<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tontine Manager - Gestion de tontines en ligne</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
      z-index: 100;
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

    /* Hero Section */
    .hero {
      padding: 5rem 0;
      background: linear-gradient(135deg, var(--primary-600), var(--primary-800));
      color: white;
      text-align: center;
    }

    .hero h1 {
      font-size: 3rem;
      margin-bottom: 1.5rem;
    }

    .hero p {
      font-size: 1.25rem;
      max-width: 700px;
      margin: 0 auto 2rem;
    }

    .hero-buttons {
      display: flex;
      justify-content: center;
      gap: 1.5rem;
      margin-top: 2rem;
    }

    /* Features Section */
    .features {
      padding: 5rem 0;
    }

    .section-title {
      text-align: center;
      margin-bottom: 3rem;
      font-size: 2rem;
      color: var(--primary-700);
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
    }

    .feature-card {
      background-color: white;
      border-radius: 0.5rem;
      padding: 2rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-5px);
    }

    .feature-icon {
      font-size: 2.5rem;
      color: var(--primary-600);
      margin-bottom: 1rem;
    }

    .feature-title {
      font-size: 1.25rem;
      margin-bottom: 1rem;
      color: var(--primary-700);
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
      gap: 2rem;
      margin-top: 3rem;
    }

    .step {
      flex: 1;
      min-width: 250px;
      max-width: 300px;
      text-align: center;
      position: relative;
    }

    .step-number {
      width: 50px;
      height: 50px;
      background-color: var(--primary-600);
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      font-weight: bold;
      margin: 0 auto 1rem;
    }

    .step:not(:last-child)::after {
      content: "";
      position: absolute;
      top: 25px;
      right: -30px;
      width: 30px;
      height: 2px;
      background-color: var(--primary-600);
    }

    /* Testimonials */
    .testimonials {
      padding: 5rem 0;
    }

    .testimonials-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
    }

    .testimonial-card {
      background-color: white;
      border-radius: 0.5rem;
      padding: 2rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .testimonial-text {
      font-style: italic;
      margin-bottom: 1rem;
    }

    .testimonial-author {
      font-weight: bold;
      color: var(--primary-700);
    }

    /* CTA Section */
    .cta {
      padding: 5rem 0;
      background: linear-gradient(135deg, var(--primary-600), var(--primary-800));
      color: white;
      text-align: center;
    }

    .cta h2 {
      font-size: 2rem;
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
      padding: 2rem 0;
      text-align: center;
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
    }

    .close-modal {
      position: absolute;
      top: 1rem;
      right: 1rem;
      font-size: 1.5rem;
      cursor: pointer;
      color: var(--gray-800);
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 600;
    }

    .form-group input, .form-group select {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid var(--gray-200);
      border-radius: 0.25rem;
      font-size: 1rem;
    }

    .form-title {
      margin-bottom: 1.5rem;
      color: var(--primary-700);
      text-align: center;
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
      padding: 1rem;
      margin: -2rem -2rem 2rem -2rem;
      border-radius: 0.5rem 0.5rem 0 0;
    }



    .error-message {
      color: #e53e3e;
      font-size: 0.875rem;
      margin-top: 0.25rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2.5rem;
      }

      .hero-buttons {
        flex-direction: column;
        align-items: center;
      }

      .step:not(:last-child)::after {
        display: none;
      }

      .step {
        margin-bottom: 2rem;
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

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
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
  </section>

  <!-- Features Section -->
  <section class="features">
    <div class="container">
      <h2 class="section-title">Nos fonctionnalités</h2>
      <div class="features-grid">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-users"></i>
          </div>
          <h3 class="feature-title">Gestion des membres</h3>
          <p>Ajoutez et gérez facilement les participants à vos tontines avec des outils dédiés.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-money-bill-wave"></i>
          </div>
          <h3 class="feature-title">Suivi des paiements</h3>
          <p>Visualisez en temps réel les paiements effectués et ceux en attente.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-bell"></i>
          </div>
          <h3 class="feature-title">Notifications</h3>
          <p>Recevez des alertes pour les échéances importantes et les activités récentes.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works Section -->
  <section class="how-it-works">
    <div class="container">
      <h2 class="section-title">Comment ça marche</h2>
      <div class="steps">
        <div class="step">
          <div class="step-number">1</div>
          <h3>Créez un compte</h3>
          <p>Inscrivez-vous en tant que gestionnaire ou participant en quelques clics.</p>
        </div>
        <div class="step">
          <div class="step-number">2</div>
          <h3>Rejoignez ou créez une tontine</h3>
          <p>Participez à une tontine existante ou lancez la vôtre en définissant les règles.</p>
        </div>
        <div class="step">
          <div class="step-number">3</div>
          <h3>Gérez simplement</h3>
          <p>Suivez les paiements, les tours et les bénéficiaires en temps réel.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="testimonials">
    <div class="container">
      <h2 class="section-title">Témoignages</h2>
      <div class="testimonials-grid">
        <div class="testimonial-card">
          <p class="testimonial-text">"TontineManager a simplifié la gestion de notre tontine familiale. Plus de disputes sur qui a payé ou non!"</p>
          <p class="testimonial-author">- Marie D., gestionnaire</p>
        </div>
        <div class="testimonial-card">
          <p class="testimonial-text">"En tant que participant, je peux voir clairement où en est la tontine et quand sera mon tour. Très transparent!"</p>
          <p class="testimonial-author">- Jean P., participant</p>
        </div>
        <div class="testimonial-card">
          <p class="testimonial-text">"L'outil parfait pour nos tontines d'entreprise. Les notifications nous rappellent les échéances et tout est traçable."</p>
          <p class="testimonial-author">- Aminata S., RH</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta">
    <div class="container">
      <h2>Prêt à simplifier la gestion de vos tontines?</h2>
      <p>Rejoignez des centaines d'utilisateurs qui font déjà confiance à TontineManager.</p>
      <div class="hero-buttons">
        <button id="cta-register-btn" class="btn btn-primary">
          <i class="fas fa-user-plus"></i> Commencer maintenant
        </button>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container">
      <p>&copy; <span id="year"></span> TontineManager. Tous droits réservés.</p>
    </div>
  </footer>

  <!-- Login Modal -->
  <div id="login-modal" class="modal">
    <div class="modal-content">
      <span class="close-modal">&times;</span>
      <div class="form-header">
        <h2 class="text-white text-xl font-bold">Connexion</h2>
      </div>
      <form id="login-form" action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
          <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
          <input id="email" type="email"
            class="w-full border border-gray-300 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none @error('email') border-red-500 @enderror"
            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

          @error('email')
            <p class="error-message">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group">
          <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Mot de passe</label>
          <input id="password" type="password"
            class="w-full border border-gray-300 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none @error('password') border-red-500 @enderror"
            name="password" required autocomplete="current-password">
          @error('password')
            <p class="error-message">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group flex items-center">
            <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember" class="ml-2 text-gray-700 text-sm">Se souvenir de moi</label>
          </div>

        <div class="flex items-center justify-between">
          <button type="submit" class="submit-btn">
            Connexion
          </button>

          @if (Route::has('password.request'))
            <a class="text-sm text-blue-600 hover:text-blue-800" href="{{ route('password.request') }}">
              Mot de passe oublié?
            </a>
          @endif
        </div>
      </form>
    </div>
  </div>

  <!-- Register Modal -->
  <div id="register-modal" class="modal">
    <div class="modal-content">
      <span class="close-modal">&times;</span>
      <div class="form-header">
        <h2 class="text-white text-xl font-bold">Inscription</h2>
      </div>
      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
          <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
          <input id="name" type="text"
            class="w-full border border-gray-300 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none @error('name') border-red-500 @enderror"
            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

          @error('name')
            <span class="error-message" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Adresse Email</label>
          <input id="email" type="email"
            class="w-full border border-gray-300 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none @error('email') border-red-500 @enderror"
            name="email" value="{{ old('email') }}" required autocomplete="email">

          @error('email')
            <span class="error-message" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Numéro de téléphone</label>
          <input id="phone" type="text"
            class="w-full border border-gray-300 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none @error('phone') border-red-500 @enderror"
            name="phone" value="{{ old('phone') }}" required>

          @error('phone')
            <span class="error-message" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Rôle</label>
          <select id="role"
            class="w-full border border-gray-300 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none @error('role') border-red-500 @enderror"
            name="role" required>
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
          <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Mot de passe</label>
          <input id="password" type="password"
            class="w-full border border-gray-300 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none @error('password') border-red-500 @enderror"
            name="password" required autocomplete="new-password">

          @error('password')
            <span class="error-message" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">Confirmer le mot de passe</label>
          <input id="password-confirm" type="password"
            class="w-full border border-gray-300 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none"
            name="password_confirmation" required autocomplete="new-password">
        </div>

        <button type="submit" class="submit-btn">
          S'inscrire
        </button>
      </form>
    </div>
  </div>

  <script>
    // Set current year in footer
    document.getElementById('year').textContent = new Date().getFullYear();

    // Modal functionality
    const loginModal = document.getElementById('login-modal');
    const registerModal = document.getElementById('register-modal');
    const loginBtns = [document.getElementById('login-btn'), document.getElementById('hero-login-btn')];
    const registerBtns = [document.getElementById('register-btn'), document.getElementById('hero-register-btn'), document.getElementById('cta-register-btn')];
    const closeBtns = document.querySelectorAll('.close-modal');

    // Open login modal
    loginBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        loginModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
      });
    });

    // Open register modal
    registerBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        registerModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
      });
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
  </script>
</body>
</html>
