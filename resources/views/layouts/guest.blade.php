<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mama Health') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#8A4F7D',
                        'primary-dark': '#6d3d63',
                        secondary: '#5B8C85'
                    },
                    fontFamily: {
                        sans: ['FuturaLT', 'FuturaLT-Book', 'FuturaLT-Bold', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif']
                    }
                }
            }
        }
    </script>
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
<body
  class="font-sans antialiased text-gray-900 bg-white bg-center bg-cover dark:bg-gray-900"
  style="background-image: url('/images/smiley-mother-holding-kid-side-view.jpg');"
  x-data="{ language: '{{ session('language', 'en') }}' }">
    <div class="flex flex-col items-center min-h-screen pt-6 sm:justify-center sm:pt-0">
        <div class="flex w-full max-w-5xl overflow-hidden rounded-lg ">

            <!-- Main Content -->
            <div class="flex flex-col items-center w-full p-6 ">
                <!-- Card Container -->
                <div class="w-full p-6 border rounded-lg sm:max-w-md bg-white/85 backdrop-blur-lg border-gray-200/50 ">
                    <!-- Logo -->
                    <div class="flex justify-center mb-6">
                        <img src="/images/logo.jpeg" alt="Mama Health Logo" class="w-auto h-16 heartbeat">
                    </div>

                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</body>
</html>
