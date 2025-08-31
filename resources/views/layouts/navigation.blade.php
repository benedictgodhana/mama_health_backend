<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mama Health - Maternal Care Companion</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    /* Custom Tailwind configuration */
    :root {
      --color-primary: #8A4F7D;
      --color-secondary: #5B8C85;
      --color-accent: #FF750F;
    }

    .mama-gradient {
      background: linear-gradient(135deg, #8A4F7D 0%, #5B8C85 100%);
    }

    .heartbeat {
      animation: heartbeat 1.5s ease-in-out infinite both;
    }

    @keyframes heartbeat {
      from {
        transform: scale(1);
        transform-origin: center center;
        animation-timing-function: ease-out;
      }
      10% {
        transform: scale(0.91);
        animation-timing-function: ease-in;
      }
      17% {
        transform: scale(0.98);
        animation-timing-function: ease-out;
      }
      33% {
        transform: scale(0.87);
        animation-timing-function: ease-in;
      }
      45% {
        transform: scale(1);
        animation-timing-function: ease-out;
      }
    }
  </style>
</head>
<body class="flex flex-col items-center min-h-screen text-gray-900 bg-white dark:bg-gray-900 font-inter">
  <header id="header" x-data="{ language: Alpine.store('lang')?.language || 'en' }" class="fixed top-0 left-0 right-0 z-50 max-w-6xl px-4 py-3 mx-auto transition-all duration-300 border-b shadow-sm bg-white/85 dark:bg-gray-900/85 backdrop-blur-lg border-gray-200/50 dark:border-gray-700/50" :class="{ 'py-2': scrolled }" x-init="$watch('language', value => Alpine.store('lang').setLanguage(value))">
    <div class="flex items-center justify-between gap-4">
      <div class="flex items-center gap-2">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M16 30C23.732 30 30 16 30 16C30 16 23.732 2 16 2C8.26801 2 2 16 2 16C2 16 8.26801 30 16 30Z" fill="#8A4F7D"/>
          <path d="M21.5 13.5C21.5 15.1569 20.1569 16.5 18.5 16.5C16.8431 16.5 15.5 15.1569 15.5 13.5C15.5 11.8431 16.8431 10.5 18.5 10.5C20.1569 10.5 21.5 11.8431 21.5 13.5Z" fill="#FFFFFF"/>
          <path d="M16.5 18.5C16.5 20.1569 15.1569 21.5 13.5 21.5C11.8431 21.5 10.5 20.1569 10.5 18.5C10.5 16.8431 11.8431 15.5 13.5 15.5C15.1569 15.5 16.5 16.8431 16.5 18.5Z" fill="#FFFFFF"/>
          <path d="M22 19C21.5 20.5 20.5 21.5 19 22C20.5 22.5 21.5 23.5 22 25C22.5 23.5 23.5 22.5 25 22C23.5 21.5 22.5 20.5 22 19Z" fill="#FFFFFF"/>
        </svg>
        <h1 x-text="{
          en: 'Mama Health',
          es: 'Salud Mamá',
          fr: 'Santé Maman'
        }[language]" class="text-xl font-semibold text-[#8A4F7D] transition-all duration-300" :class="{ 'text-lg': scrolled }"></h1>
      </div>
      <nav class="flex items-center gap-4">
        <a href="#home" x-text="{ en: 'Home', es: 'Inicio', fr: 'Accueil' }[language]" class="text-[#8A4F7D] hover:text-gray-900 dark:hover:text-gray-100 font-medium text-sm transition-colors"></a>
        <a href="#features" x-text="{ en: 'Features', es: 'Características', fr: 'Fonctionnalités' }[language]" class="text-[#8A4F7D] hover:text-gray-900 dark:hover:text-gray-100 font-medium text-sm transition-colors"></a>
        <a href="#about" x-text="{ en: 'About', es: 'Acerca', fr: 'À Propos' }[language]" class="text-[#8A4F7D] hover:text-gray-900 dark:hover:text-gray-100 font-medium text-sm transition-colors"></a>
        <a href="#contact" x-text="{ en: 'Contact', es: 'Contacto', fr: 'Contact' }[language]" class="text-[#8A4F7D] hover:text-gray-900 dark:hover:text-gray-100 font-medium text-sm transition-colors"></a>
        @auth
          <a href="{{ url('/dashboard') }}" x-text="{ en: 'Dashboard', es: 'Tablero', fr: 'Tableau de bord' }[language]" class="px-4 py-1.5 text-gray-900 dark:text-gray-100 border border-gray-200 hover:border-gray-300 dark:border-gray-600 dark:hover:border-gray-500 rounded-sm text-sm transition-colors"></a>
        @else
          <a href="{{ route('login') }}" x-text="{ en: 'Log in', es: 'Iniciar sesión', fr: 'Connexion' }[language]" class="px-4 py-1.5 text-gray-900 dark:text-gray-100 border border-transparent hover:border-gray-200 dark:hover:border-gray-600 rounded-sm text-sm transition-colors"></a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}" x-text="{ en: 'Get Started', es: 'Comenzar', fr: 'Commencer' }[language]" class="px-4 py-1.5 text-white bg-[#8A4F7D] hover:bg-[#6d3d63] rounded-sm text-sm transition-colors"></a>
          @endif
        @endauth
      </nav>
      <div class="flex items-center gap-4">
        <button class="text-[#8A4F7D] hover:scale-110 transition-transform" x-text="Alpine.store('theme').isDark ? '🌙' : '☀️'" @click="Alpine.store('theme').toggleTheme()"></button>
        <button class="text-[#8A4F7D] hover:scale-110 transition-transform" @click="language = language === 'en' ? 'es' : language === 'es' ? 'fr' : 'en'" x-text="{
          en: '🇪🇸/🇫🇷',
          es: '🇬🇧/🇫🇷',
          fr: '🇬🇧/🇪🇸'
        }[language]"></button>
      </div>
    </div>
  </header>


  <script>
    // Initialize Alpine.js stores
    document.addEventListener('alpine:init', () => {
      Alpine.store('lang', {
        language: localStorage.getItem('language') || 'en',
        setLanguage(lang) {
          this.language = lang;
          localStorage.setItem('language', lang);
        }
      });

      Alpine.store('theme', {
        isDark: localStorage.getItem('theme') === 'dark',
        toggleTheme() {
          this.isDark = !this.isDark;
          localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
          document.documentElement.classList.toggle('dark', this.isDark);
        }
      });
    });

    // Scroll effect for header
    window.addEventListener('scroll', () => {
      const header = document.getElementById('header');
      header.classList.toggle('scrolled', window.scrollY > 50);
    });
  </script>
</body>
</html>
