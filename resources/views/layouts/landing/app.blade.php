<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ dynamicAsset(path: 'public/assets/icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ dynamicAsset(path: 'public/assets/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ dynamicAsset(path: 'public/assets/icons/favicon-16x16.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ dynamicAsset(path: 'public/assets/icons/favicon.ico') }}">
    
    <title>@yield('title')</title>
    <meta name="_token" content="{{csrf_token()}}">
    
    <!-- Fonte 'Fredoka' -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Configuração do Tailwind -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Fredoka', 'sans-serif'],
                    },
                    colors: {
                        darkBg: '#000000',
                        darkCard: '#0a0a0c',
                        lightBg: '#f8fafc',
                        lightCard: '#ffffff',
                        brandBlue: '#0066cc',
                        brandBlueHover: '#0052a3', 
                        brandGreen: '#33a337',
                        brandGreenHover: '#267a29',  
                        brandGreenBright: '#4ade80', 
                        textMutedDark: '#a3a3a3',
                        textMutedLight: '#64748b'
                    }
                }
            }
        }
    </script>

    <style>
        .bg-pattern-dark {
            background-image: 
                radial-gradient(circle at 0% 0%, rgba(0, 102, 204, 0.15), transparent 40%),
                radial-gradient(circle at 100% 100%, rgba(51, 163, 55, 0.1), transparent 40%);
        }
        .gradient-text {
            background: linear-gradient(to right, #0066cc, #4ade80);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        /* Custom styles for existing components if needed */
        .selection\:bg-brandBlue::selection { background-color: #0066cc; color: white; }
    </style>

    @stack('css_or_js')
</head>
<body class="min-h-screen font-sans antialiased selection:bg-brandBlue selection:text-white bg-lightBg dark:bg-darkBg dark:bg-pattern-dark text-slate-900 dark:text-white transition-colors duration-300 overflow-x-hidden">

    @include('layouts.landing.partials._header')

    <main>
        @yield('content')
    </main>

    @include('layouts.landing.partials._footer')

    <script src="{{dynamicAsset(path: 'public/assets/landing/js/jquery-3.6.0.min.js')}}"></script>
    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        function setInitialTheme() {
            const savedTheme = localStorage.getItem('color-theme');
            if (savedTheme === 'light') {
                document.documentElement.classList.remove('dark');
                darkIcon?.classList.remove('hidden');
                lightIcon?.classList.add('hidden');
            } else {
                document.documentElement.classList.add('dark');
                lightIcon?.classList.remove('hidden');
                darkIcon?.classList.add('hidden');
            }
        }

        themeToggleBtn?.addEventListener('click', function() {
            darkIcon?.classList.toggle('hidden');
            lightIcon?.classList.toggle('hidden');

            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });

        setInitialTheme();
    </script>

    @stack('script_2')
    
    <script src="{{dynamicAsset(path: 'public/assets/admin')}}/js/toastr.js"></script>
    {!! Toastr::message() !!}
</body>
</html>
