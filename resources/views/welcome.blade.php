<!DOCTYPE html>
<html lang="{{ session('language', 'en') }}" x-data="{ language: '{{ session('language', 'en') }}' }" x-bind:html="language">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title x-text="{
        en: 'Mama Health - Maternal Care Companion',
        it: 'Mama Health - Assistente per la Salute Materna',
        sw: 'Mama Health - Msaidizi wa Afya ya Ujauzito'
    }[language]"></title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#8A4F7D',
                        'primary-dark': '#6d3d63',
                        secondary: '#5B8C85',
                        'secondary-dark': '#467066',
                        accent: '#FF750F',
                        'accent-dark': '#e0650d'
                    }
                }
            }
        }
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* FONT SETUP */
        @font-face {
            font-family: 'FuturaLT';
            src: url('{{ asset('fonts/futura-lt/FuturaLT.ttf') }}') format('truetype');
        }
        @font-face {
            font-family: 'FuturaLT-Bold';
            src: url('{{ asset('fonts/futura-lt/FuturaLT-Bold.ttf') }}') format('truetype');
        }
        @font-face {
            font-family: 'FuturaLT-Book';
            src: url('{{ asset('fonts/futura-lt/FuturaLT-Book.ttf') }}') format('truetype');
        }

        /* Theme variables */
        :root {
            --bg: #fff;
            --bg-alt: #f9f9f9;
            --text: #111;
            --text-muted: #444;
            --primary: #8A4F7D;
            --secondary: #5B8C85;
            --border: #ddd;
        }
        body.dark {
            --bg: #1a1a1a;
            --bg-alt: #222;
            --text: #fff;
            --text-muted: #ccc;
            --primary: #b27fa6;
            --secondary: #7aa89f;
            --border: #444;
        }

        body {
            font-family: 'FuturaLT', sans-serif;
        }

        .hero-carousel {
            position: relative;
            overflow: hidden;
            min-height: 100vh;
        }

        .carousel-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .carousel-image.active {
            opacity: 1;
        }

        .hero-overlay {
            background: linear-gradient(rgba(138, 79, 125, 0.7), rgba(91, 140, 133, 0.5));
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .floating-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .service-card {
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .gradient-text {
            background: linear-gradient(135deg, #8A4F7D, #5B8C85);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .pulse-glow {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(138, 79, 125, 0.4); }
            50% { box-shadow: 0 0 0 20px rgba(138, 79, 125, 0); }
        }

        .parallax {
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
        }

        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        @keyframes fade-in {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fade-in 0.8s ease-out forwards;
        }

        * {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .mama-icon {
            background: linear-gradient(135deg, #8A4F7D, #5B8C85);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="light" :class="Alpine.store('theme').isDark ? 'dark bg-gray-900 text-white' : 'light bg-white text-gray-800'" x-data="{ language: '{{ session('language', 'en') }}', currentImage: 0, images: [
    '/images/smiley-mother-holding-kid-side-view.jpg',
    'https://images.unsplash.com/photo-1530497610245-94d3d16c913f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
    'https://images.unsplash.com/photo-1549902529-a515ecc7630f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'
] }">
   @include ('layouts.navigation')

    <!-- Hero Section with Carousel -->
    <section id="home" class="relative flex items-center justify-center hero-carousel">
        <template x-for="(image, index) in images" :key="index">
            <div class="carousel-image" :class="{ 'active': currentImage === index }" :style="{ backgroundImage: `url(${image})` }"></div>
        </template>
        <div class="hero-overlay"></div>
        <div class="container relative z-10 px-4 mx-auto text-center text-white">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 text-shadow animate-fade-in font-[FuturaLT-Bold]" x-html="{
                en: 'Maternal Care <span class=&quot;gradient-text text-white&quot;>Reimagined</span>',
                it: 'Assistenza Maternità <span class=&quot;gradient-text text-white&quot;>Rinnovata</span>',
                sw: 'Huduma ya Ujauzito <span class=&quot;gradient-text text-white&quot;>Iliyoboreshwa</span>'
            }[language]"></h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto text-shadow font-[FuturaLT-Book]" x-text="{
                en: 'Comprehensive maternal health support, personalized care tracking, and expert guidance throughout your pregnancy journey.',
                it: 'Supporto completo per la salute materna, monitoraggio personalizzato e guida esperta durante il tuo percorso di gravidanza.',
                sw: 'Msaada kamili wa afya ya ujauzito, ufuatiliaji wa huduma za kibinafsi, na mwongozo wa kitaalamu katika safari yako yote ya ujauzito.'
            }[language]"></p>
            <div class="space-x-4">
                <a href="#services" class="bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 inline-block pulse-glow font-[FuturaLT-Book]" x-text="{
                    en: 'Our Services',
                    it: 'I Nostri Servizi',
                    sw: 'Huduma Zetu'
                }[language]"></a>
                <a href="#contact" class="border-2 border-white text-white hover:bg-white hover:text-primary px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 inline-block font-[FuturaLT-Book]" x-text="{
                    en: 'Get Started',
                    it: 'Inizia',
                    sw: 'Anza Sasa'
                }[language]"></a>
            </div>
        </div>
        <div class="absolute z-10 text-white transform -translate-x-1/2 bottom-8 left-1/2 animate-bounce">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="py-20" :class="Alpine.store('theme').isDark ? 'bg-gray-800' : 'bg-white'">
        <div class="container px-4 mx-auto">
            <div class="grid items-center gap-12 md:grid-cols-2">
                <div class="space-y-6">
                    <h2 class="text-4xl font-bold mb-6 font-[FuturaLT-Bold]" :class="Alpine.store('theme').isDark ? 'text-white' : 'text-gray-800'" x-html="{
                        en: 'About <span class=&quot;gradient-text&quot;>Mama Health</span>',
                        it: 'Chi Siamo <span class=&quot;gradient-text&quot;>Mama Health</span>',
                        sw: 'Kuhusu <span class=&quot;gradient-text&quot;>Mama Health</span>'
                    }[language]"></h2>
                    <p class="text-lg leading-relaxed font-[FuturaLT-Book]" :class="Alpine.store('theme').isDark ? 'text-gray-300' : 'text-gray-600'" x-text="{
                        en: 'Mama Health is dedicated to revolutionizing maternal care through technology, compassion, and evidence-based practices. We believe every mother deserves access to quality healthcare throughout her pregnancy journey.',
                        it: 'Mama Health è dedicata a rivoluzionare l\'assistenza materna attraverso la tecnologia, la compassione e le pratiche basate sull\'evidenza. Crediamo che ogni madre meriti accesso a cure di qualità durante il suo percorso di gravidanza.',
                        sw: 'Mama Health imejikita katika kuboresha huduma za ujauzito kupitia teknolojia, huruma na mbinu zenye msingi wa uthibitisho. Tunaamini kwamba kila mama anastahili kupata huduma bora za afya katika safari yake yote ya ujauzito.'
                    }[language]"></p>
                    <p class="text-lg leading-relaxed font-[FuturaLT-Book]" :class="Alpine.store('theme').isDark ? 'text-gray-300' : 'text-gray-600'" x-text="{
                        en: 'Our team of healthcare professionals, technologists, and maternal health experts work together to create innovative solutions that empower mothers with knowledge, support, and personalized care.',
                        it: 'Il nostro team di professionisti sanitari, tecnologi ed esperti di salute materna lavora insieme per creare soluzioni innovative che danno potere alle madri con conoscenza, supporto e cure personalizzate.',
                        sw: 'Timu yetu ya wataalamu wa afya, wataalamu wa teknolojia na wataalamu wa afya ya ujauzito hufanya kazi pamoja kuunda suluhisho za uvumbuzi zinazowapa mama uwezo kwa maarifa, msaada na huduma za kibinafsi.'
                    }[language]"></p>
                    <div class="grid grid-cols-2 gap-6 mt-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary font-[FuturaLT-Bold]">5,000+</div>
                            <div class="font-[FuturaLT-Book]" :class="Alpine.store('theme').isDark ? 'text-gray-300' : 'text-gray-600'" x-text="{
                                en: 'Mothers Supported',
                                it: 'Mamme Supportate',
                                sw: 'Mama Waliosaidika'
                            }[language]"></div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary font-[FuturaLT-Bold]">98%</div>
                            <div class="font-[FuturaLT-Book]" :class="Alpine.store('theme').isDark ? 'text-gray-300' : 'text-gray-600'" x-text="{
                                en: 'Satisfaction Rate',
                                it: 'Tasso di Soddisfazione',
                                sw: 'Kiwango cha Kuridhika'
                            }[language]"></div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                         alt="Happy pregnant woman"
                         class="object-cover w-full shadow-2xl rounded-2xl h-96">
                    <div class="absolute p-6 text-white shadow-xl -bottom-6 -left-6 bg-primary rounded-xl">
                        <div class="text-2xl font-bold font-[FuturaLT-Bold]" x-text="{
                            en: '24/7',
                            it: '24/7',
                            sw: 'Saa 24'
                        }[language]"></div>
                        <div class="text-sm font-[FuturaLT-Book]" x-text="{
                            en: 'Support Available',
                            it: 'Supporto Disponibile',
                            sw: 'Msaada Unapatikana'
                        }[language]"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20" :class="Alpine.store('theme').isDark ? 'bg-gray-800' : 'bg-gray-50'">
        <div class="container px-4 mx-auto">
            <div class="mb-16 text-center">
                <h2 class="text-4xl font-bold mb-4 font-[FuturaLT-Bold]" :class="Alpine.store('theme').isDark ? 'text-white' : 'text-gray-800'" x-html="{
                    en: 'Our <span class=&quot;gradient-text&quot;>Services</span>',
                    it: 'I Nostri <span class=&quot;gradient-text&quot;>Servizi</span>',
                    sw: '<span class=&quot;gradient-text&quot;>Huduma</span> Zetu'
                }[language]"></h2>
                <p class="text-xl max-w-2xl mx-auto font-[FuturaLT-Book]" :class="Alpine.store('theme').isDark ? 'text-gray-300' : 'text-gray-600'" x-text="{
                    en: 'Comprehensive maternal health services designed to support you through every stage of your pregnancy journey.',
                    it: 'Servizi completi per la salute materna progettati per supportarti in ogni fase del tuo percorso di gravidanza.',
                    sw: 'Huduma kamili za afya ya ujauzito zilizobuniwa kukusaidia katika kila hatua ya safari yako ya ujauzito.'
                }[language]"></p>
            </div>
            <div class="grid gap-8 md:grid-cols-3">
                <div class="overflow-hidden shadow-lg service-card rounded-2xl" :class="Alpine.store('theme').isDark ? 'bg-gray-700' : 'bg-white'">
                    <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                         alt="Pregnancy Tracking"
                         class="object-cover w-full h-48">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3 font-[FuturaLT-Bold]" :class="Alpine.store('theme').isDark ? 'text-white' : 'text-gray-800'" x-text="{
                            en: 'Pregnancy Tracking',
                            it: 'Monitoraggio Gravidanza',
                            sw: 'Ufuatiliaji wa Ujauzito'
                        }[language]"></h3>
                        <p class="mb-4 font-[FuturaLT-Book]" :class="Alpine.store('theme').isDark ? 'text-gray-300' : 'text-gray-600'" x-text="{
                            en: 'Monitor your pregnancy progress, track symptoms, and receive personalized insights week by week.',
                            it: 'Monitora i progressi della tua gravidanza, tieni traccia dei sintomi e ricevi approfondimenti personalizzati settimana per settimana.',
                            sw: 'Fuatilia maendeleo yako ya ujauzito, weka rekodi ya dalili, na upate maarifa ya kibinafsi kila wiki.'
                        }[language]"></p>
                        <ul class="text-sm space-y-1 mb-6 font-[FuturaLT-Book]" :class="Alpine.store('theme').isDark ? 'text-gray-400' : 'text-gray-500'">
                            <li x-text="{
                                en: '✓ Weekly development updates',
                                it: '✓ Aggiornamenti settimanali sullo sviluppo',
                                sw: '✓ Sasisho za maendeleo kila wiki'
                            }[language]"></li>
                            <li x-text="{
                                en: '✓ Symptom and health tracking',
                                it: '✓ Monitoraggio sintomi e salute',
                                sw: '✓ Ufuatiliaji wa dalili na afya'
                            }[language]"></li>
                            <li x-text="{
                                en: '✓ Personalized recommendations',
                                it: '✓ Raccomandazioni personalizzate',
                                sw: '✓ Mapendekezo ya kibinafsi'
                            }[language]"></li>
                            <li x-text="{
                                en: '✓ Progress visualization',
                                it: '✓ Visualizzazione progressi',
                                sw: '✓ Uonyeshaji wa maendeleo'
                            }[language]"></li>
                        </ul>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-primary font-[FuturaLT-Bold]">Free</span>
                            <button class="bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-full transition-colors font-[FuturaLT-Book]" x-text="{
                                en: 'Get Started',
                                it: 'Inizia',
                                sw: 'Anza'
                            }[language]"></button>
                        </div>
                    </div>
                </div>
                <div class="overflow-hidden shadow-lg service-card rounded-2xl" :class="Alpine.store('theme').isDark ? 'bg-gray-700' : 'bg-white'">
                    <img src="https://images.unsplash.com/photo-1584515933487-779824d29309?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                         alt="Expert Consultation"
                         class="object-cover w-full h-48">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3 font-[FuturaLT-Bold]" :class="Alpine.store('theme').isDark ? 'text-white' : 'text-gray-800'" x-text="{
                            en: 'Expert Consultation',
                            it: 'Consulenza Esperta',
                            sw: 'Usaidizi wa Wataalamu'
                        }[language]"></h3>
                        <p class="mb-4 font-[FuturaLT-Book]" :class="Alpine.store('theme').isDark ? 'text-gray-300' : 'text-gray-600'" x-text="{
                            en: 'Connect with certified healthcare professionals for personalized advice and support throughout your pregnancy.',
                            it: 'Connettiti con professionisti sanitari certificati per consigli personalizzati e supporto durante la tua gravidanza.',
                            sw: 'Wasiliana na wataalamu wa afya waliosajiliwa kwa ushauri wa kibinafsi na msaada wakati wote wa ujauzito wako.'
                        }[language]"></p>
                        <ul class="text-sm space-y-1 mb-6 font-[FuturaLT-Book]" :class="Alpine.store('theme').isDark ? 'text-gray-400' : 'text-gray-500'">
                            <li x-text="{
                                en: '✓ Certified professionals',
                                it: '✓ Professionisti certificati',
                                sw: '✓ Wataalamu waliosajiliwa'
                            }[language]"></li>
                            <li x-text="{
                                en: '✓ Video consultations',
                                it: '✓ Consultazioni video',
                                sw: '✓ Mashauriano ya video'
                            }[language]"></li>
                            <li x-text="{
                                en: '✓ 24/7 availability',
                                it: '✓ Disponibilità 24/7',
                                sw: '✓ Inapatikana saa 24'
                            }[language]"></li>
                            <li x-text="{
                                en: '✓ Personalized care plans',
                                it: '✓ Piani di cura personalizzati',
                                sw: '✓ Mipango ya huduma ya kibinafsi'
                            }[language]"></li>
                        </ul>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-primary font-[FuturaLT-Bold]">$29/mo</span>
                            <button class="bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-full transition-colors font-[FuturaLT-Book]" x-text="{
                                en: 'Subscribe',
                                it: 'Sottoscrivi',
                                sw: 'Jiunge'
                            }[language]"></button>
                        </div>
                    </div>
                </div>
                <div class="overflow-hidden shadow-lg service-card rounded-2xl" :class="Alpine.store('theme').isDark ? 'bg-gray-700' : 'bg-white'">
                    e9c2b8?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                             alt="Community Support"
                                             class="object-cover w-full h-48">
                                        <div class="p-6">
                                            <h3 class="text-2xl font-bold mb-3 font-[FuturaLT-Bold]" :class="Alpine.store('theme').isDark ? 'text-white' : 'text-gray-800'" x-text="{
                                                en: 'Community Support',
                                                it: 'Supporto della Comunità',
                                                sw: 'Msaada wa Jamii'
                                            }[language]"></h3>
                                            <p class="mb-4 font-[FuturaLT-Book]" :class="Alpine.store('theme').isDark ? 'text-gray-300' : 'text-gray-600'" x-text="{
                                                en: 'Join a supportive community of mothers, share experiences, and access group resources and events.',
                                                it: 'Unisciti a una comunità di mamme, condividi esperienze e accedi a risorse ed eventi di gruppo.',
                                                sw: 'Jiunge na jamii ya mama, shiriki uzoefu na upate rasilimali na matukio ya pamoja.'
                                            }[language]"></p>
                                            <ul class="text-sm space-y-1 mb-6 font-[FuturaLT-Book]" :class="Alpine.store('theme').isDark ? 'text-gray-400' : 'text-gray-500'">
                                                <li x-text="{
                                                    en: '✓ Peer support groups',
                                                    it: '✓ Gruppi di supporto tra pari',
                                                    sw: '✓ Vikundi vya msaada'
                                                }[language]"></li>
                                                <li x-text="{
                                                    en: '✓ Community events',
                                                    it: '✓ Eventi della comunità',
                                                    sw: '✓ Matukio ya jamii'
                                                }[language]"></li>
                                                <li x-text="{
                                                    en: '✓ Resource sharing',
                                                    it: '✓ Condivisione di risorse',
                                                    sw: '✓ Kushiriki rasilimali'
                                                }[language]"></li>
                                                <li x-text="{
                                                    en: '✓ Forums & chat',
                                                    it: '✓ Forum e chat',
                                                    sw: '✓ Majukwaa na gumzo'
                                                }[language]"></li>
                                            </ul>
                                            <div class="flex items-center justify-between">
                                                <span class="text-2xl font-bold text-primary font-[FuturaLT-Bold]">Free</span>
                                                <button class="bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-full transition-colors font-[FuturaLT-Book]" x-text="{
                                                    en: 'Join Now',
                                                    it: 'Unisciti Ora',
                                                    sw: 'Jiunge Sasa'
                                                }[language]"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Contact Section -->
                        <section id="contact" class="py-20" :class="Alpine.store('theme').isDark ? 'bg-gray-900' : 'bg-white'">
                            <div class="container px-4 mx-auto">
                                <div class="max-w-2xl mx-auto mb-12 text-center">
                                    <h2 class="text-4xl font-bold mb-4 font-[FuturaLT-Bold]" :class="Alpine.store('theme').isDark ? 'text-white' : 'text-gray-800'" x-html="{
                                        en: 'Contact <span class=&quot;gradient-text&quot;>Us</span>',
                                        it: 'Contatta <span class=&quot;gradient-text&quot;>Noi</span>',
                                        sw: 'Wasiliana <span class=&quot;gradient-text&quot;>Nasi</span>'
                                    }[language]"></h2>
                                    <p class="text-xl font-[FuturaLT-Book]" :class="Alpine.store('theme').isDark ? 'text-gray-300' : 'text-gray-600'" x-text="{
                                        en: 'Have questions or need support? Reach out to our team and we’ll get back to you as soon as possible.',
                                        it: 'Hai domande o hai bisogno di supporto? Contatta il nostro team e ti risponderemo il prima possibile.',
                                        sw: 'Una maswali au unahitaji msaada? Wasiliana na timu yetu na tutakujibu haraka iwezekanavyo.'
                                    }[language]"></p>
                                </div>
                                <form class="max-w-xl p-8 mx-auto space-y-6 bg-white shadow-lg dark:bg-gray-800 rounded-2xl">
                                    <div class="grid gap-6 md:grid-cols-2">
                                        <div>
                                            <label class="block mb-2 font-[FuturaLT-Bold]" :class="Alpine.store('theme').isDark ? 'text-gray-200' : 'text-gray-700'" x-text="{
                                                en: 'Name',
                                                it: 'Nome',
                                                sw: 'Jina'
                                            }[language]"></label>
                                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-primary" required>
                                        </div>
                                        <div>
                                            <label class="block mb-2 font-[FuturaLT-Bold]" :class="Alpine.store('theme').isDark ? 'text-gray-200' : 'text-gray-700'" x-text="{
                                                en: 'Email',
                                                it: 'Email',
                                                sw: 'Barua Pepe'
                                            }[language]"></label>
                                            <input type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-primary" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block mb-2 font-[FuturaLT-Bold]" :class="Alpine.store('theme').isDark ? 'text-gray-200' : 'text-gray-700'" x-text="{
                                            en: 'Message',
                                            it: 'Messaggio',
                                            sw: 'Ujumbe'
                                        }[language]"></label>
                                        <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-primary" rows="5" required></textarea>
                                    </div>
                                    <button type="submit" class="w-full py-3 text-lg font-bold text-white rounded-full bg-primary hover:bg-primary-dark font-[FuturaLT-Bold]" x-text="{
                                        en: 'Send Message',
                                        it: 'Invia Messaggio',
                                        sw: 'Tuma Ujumbe'
                                    }[language]"></button>
                                </form>
                            </div>
                        </section>

                      @include ('layouts.footer')

                        <script>
                            // Alpine.js store for theme and language
                            document.addEventListener('alpine:init', () => {
                                Alpine.store('theme', {
                                    isDark: window.matchMedia('(prefers-color-scheme: dark)').matches,
                                    toggle() {
                                        this.isDark = !this.isDark;
                                        document.body.classList.toggle('dark', this.isDark);
                                    }
                                });
                                Alpine.store('lang', {
                                    language: '{{ session('language', 'en') }}',
                                    setLanguage(lang) {
                                        this.language = lang;
                                        document.documentElement.lang = lang;
                                        // Optionally, send AJAX to persist language in session
                                    }
                                });
                            });

                            // Carousel logic
                            document.addEventListener('alpine:init', () => {
                                Alpine.data('carousel', () => ({
                                    currentImage: 0,
                                    images: [
                                        'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
                                        'https://images.unsplash.com/photo-1530497610245-94d3d16c913f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
                                        'https://images.unsplash.com/photo-1549902529-a515ecc7630f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'
                                    ],
                                    interval: null,
                                    init() {
                                        this.start();
                                    },
                                    start() {
                                        this.interval = setInterval(() => {
                                            this.currentImage = (this.currentImage + 1) % this.images.length;
                                        }, 5000);
                                    },
                                    stop() {
                                        clearInterval(this.interval);
                                    }
                                }));
                            });
                        </script>
                    </body>
                    </html>
