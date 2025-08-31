<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mama Health - Maternal Care Companion</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#8A4F7D',
            'primary-dark': '#6d3d63',
            secondary: '#5B8C85'
          }
        }
      }
    }
  </script>
  <style>
    .mama-gradient {
      background: linear-gradient(135deg, #8A4F7D 0%, #5B8C85 100%);
    }
  </style>
</head>
<body class="text-gray-900 bg-white dark:bg-gray-900 font-inter">
  <footer class="py-12 text-gray-800 bg-white dark:bg-gray-900 dark:text-gray-200" x-data="{ language: Alpine.store('lang')?.language || 'en' }" x-init="$watch('language', value => Alpine.store('lang').setLanguage(value))">
    <div class="container max-w-6xl px-4 mx-auto">
      <div class="grid gap-8 md:grid-cols-4">
        <div class="md:col-span-2">
          <div class="flex items-center gap-2 mb-4">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M16 30C23.732 30 30 16 30 16C30 16 23.732 2 16 2C8.26801 2 2 16 2 16C2 16 8.26801 30 16 30Z" fill="#8A4F7D"/>
              <path d="M21.5 13.5C21.5 15.1569 20.1569 16.5 18.5 16.5C16.8431 16.5 15.5 15.1569 15.5 13.5C15.5 11.8431 16.8431 10.5 18.5 10.5C20.1569 10.5 21.5 11.8431 21.5 13.5Z" fill="#FFFFFF"/>
              <path d="M16.5 18.5C16.5 20.1569 15.1569 21.5 13.5 21.5C11.8431 21.5 10.5 20.1569 10.5 18.5C10.5 16.8431 11.8431 15.5 13.5 15.5C15.1569 15.5 16.5 16.8431 16.5 18.5Z" fill="#FFFFFF"/>
              <path d="M22 19C21.5 20.5 20.5 21.5 19 22C20.5 22.5 21.5 23.5 22 25C22.5 23.5 23.5 22.5 25 22C23.5 21.5 22.5 20.5 22 19Z" fill="#FFFFFF"/>
            </svg>
            <h3 class="text-2xl font-bold text-primary" x-text="{
              en: 'Mama Health',
              es: 'Salud Mamá',
              fr: 'Santé Maman'
            }[language]"></h3>
          </div>
          <p class="mb-4 text-gray-600 dark:text-gray-400" x-text="{
            en: 'Empowering expecting mothers with personalized care and support since 2020.',
            es: 'Empoderando a futuras madres con cuidado y apoyo personalizados desde 2020.',
            fr: 'Accompagner les futures mamans avec des soins et un soutien personnalisés depuis 2020.'
          }[language]"></p>
          <div class="flex space-x-4">
            <a href="#" class="flex items-center justify-center w-10 h-10 transition-colors rounded-full bg-primary hover:bg-primary-dark">
              <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
              </svg>
            </a>
            <a href="#" class="flex items-center justify-center w-10 h-10 transition-colors rounded-full bg-primary hover:bg-primary-dark">
              <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
              </svg>
            </a>
            <a href="#" class="flex items-center justify-center w-10 h-10 transition-colors rounded-full bg-primary hover:bg-primary-dark">
              <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.083.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.748-1.378 0 0-.599 2.283-.744 2.845-.282 1.079-1.018 2.465-1.534 3.309C9.516 23.651 10.739 24 12.017 24c6.624 0 11.99-5.367 11.99-11.987C24.007 5.367 18.641.001 12.017.001z"/>
              </svg>
            </a>
          </div>
        </div>

        <div>
          <h4 class="mb-4 text-lg font-semibold text-primary" x-text="{
            en: 'Quick Links',
            es: 'Enlaces Rápidos',
            fr: 'Liens Rapides'
          }[language]"></h4>
          <ul class="space-y-2 text-gray-600 dark:text-gray-400">
            <li><a href="#home" class="transition-colors hover:text-primary" x-text="{
              en: 'Home',
              es: 'Inicio',
              fr: 'Accueil'
            }[language]"></a></li>
            <li><a href="#features" class="transition-colors hover:text-primary" x-text="{
              en: 'Features',
              es: 'Características',
              fr: 'Fonctionnalités'
            }[language]"></a></li>
            <li><a href="#about" class="transition-colors hover:text-primary" x-text="{
              en: 'About',
              es: 'Acerca',
              fr: 'À Propos'
            }[language]"></a></li>
            <li><a href="#contact" class="transition-colors hover:text-primary" x-text="{
              en: 'Contact',
              es: 'Contacto',
              fr: 'Contact'
            }[language]"></a></li>
          </ul>
        </div>

        <div>
          <h4 class="mb-4 text-lg font-semibold text-primary" x-text="{
            en: 'Contact Us',
            es: 'Contáctanos',
            fr: 'Contactez-nous'
          }[language]"></h4>
          <ul class="space-y-2 text-gray-600 dark:text-gray-400">
            <li class="flex items-center">
              <svg class="w-5 h-5 mr-2 text-primary" fill="currentColor" viewBox="0 0 24 24">
                <path d="M21 8V7l-3-2-3 2v1h-2v2h2v1l3 2 3-2v-1h2V8h-2zM12 3.5a.5.5 0 0 1-.5-.5V2h-1v1a.5.5 0 0 1-.5.5h-.5v1h2V3.5h-.5zM20 20h-7v-2h-2v2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2zM4 6v12h16V6H4z"/>
              </svg>
              <span x-text="{
                en: 'Nairobi, Kenya',
                es: 'Nairobi, Kenia',
                fr: 'Nairobi, Kenya'
              }[language]"></span>
            </li>
            <li class="flex items-center">
              <svg class="w-5 h-5 mr-2 text-primary" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
              </svg>
              <a href="mailto:info@mamahealth.com" class="transition-colors hover:text-primary">info@mamahealth.com</a>
            </li>
            <li class="flex items-center">
              <svg class="w-5 h-5 mr-2 text-primary" fill="currentColor" viewBox="0 0 24 24">
                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.24 1.02l-2.2 2.2z"/>
              </svg>
              <a href="tel:+254123456789" class="transition-colors hover:text-primary">+254 123 456 789</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="mt-8">
        <h4 class="mb-4 text-lg font-semibold text-primary" x-text="{
          en: 'Newsletter',
          es: 'Boletín',
          fr: 'Newsletter'
        }[language]"></h4>
        <p class="mb-4 text-gray-600 dark:text-gray-400" x-text="{
          en: 'Subscribe to receive updates on maternal health tips and resources.',
          es: 'Suscríbete para recibir actualizaciones sobre consejos y recursos de salud materna.',
          fr: 'Abonnez-vous pour recevoir des mises à jour sur les conseils et ressources de santé maternelle.'
        }[language]"></p>
        <div class="flex max-w-md">
          <input type="email" :placeholder="{
            en: 'Your email',
            es: 'Tu correo electrónico',
            fr: 'Votre email'
          }[language]" class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-l-md focus:outline-none focus:ring-2 focus:ring-primary">
          <button class="px-4 py-2 text-white transition-colors bg-primary rounded-r-md hover:bg-primary-dark" x-text="{
            en: 'Subscribe',
            es: 'Suscribirse',
            fr: 'S\'abonner'
          }[language]"></button>
        </div>
      </div>

      <div class="pt-8 mt-12 text-center text-gray-500 border-t border-gray-200 dark:border-gray-700 dark:text-gray-400">
        <p x-text="{
          en: '&copy; 2025 Mama Health. All Rights Reserved. Made with ❤️ for expecting mothers.',
          es: '&copy; 2025 Salud Mamá. Todos los derechos reservados. Hecho con ❤️ para futuras madres.',
          fr: '&copy; 2025 Santé Maman. Tous droits réservés. Conçu avec ❤️ pour les futures mamans.'
        }[language]"></p>
      </div>
    </div>
  </footer>

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
  </script>
</body>
</html>
