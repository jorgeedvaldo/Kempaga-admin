<!DOCTYPE html>
<html lang="pt" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#0078D7">
    <title>@yield('title', 'Kempaga Pay')</title>
    <link rel="icon" href="{{ dynamicAsset(path: 'public/assets/icons/favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Fredoka', 'sans-serif'] },
                    colors: {
                        primary:      '#0078D7',
                        primaryHover: '#0050B3',
                        success:      '#39B54A',
                        dark:         '#0B1D33',
                        card:         '#0f1e35',
                        surface:      '#162032',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/assets/admin') }}/css/toastr.css">
    <style>
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button { -webkit-appearance: none; }
        input[type=number] { -moz-appearance: textfield; }
        @keyframes fadeUp { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
        .fade-up { animation: fadeUp .4s cubic-bezier(.16,1,.3,1) both; }
        @keyframes pop { 0%,100%{transform:scale(1)} 50%{transform:scale(1.12)} }
        .pop { animation: pop .18s ease; }
        @keyframes checkDraw { to { stroke-dashoffset: 0; } }
        .check-path { stroke-dasharray: 60; stroke-dashoffset: 60; animation: checkDraw .6s .4s ease forwards; }
        @keyframes scaleBounce { 0%{transform:scale(0);opacity:0} 70%{transform:scale(1.08)} 100%{transform:scale(1);opacity:1} }
        .success-ring { animation: scaleBounce .5s .1s ease both; }
        select option { background: #1e293b; color: white; }
    </style>
</head>
<body class="min-h-screen font-sans antialiased bg-gray-100 dark:bg-dark transition-colors duration-300 flex flex-col items-center justify-center p-4 py-8 gap-4">

    <div class="w-full max-w-sm fade-up">
        @yield('content')
    </div>

    <p class="text-xs text-gray-400 dark:text-gray-600 text-center flex items-center gap-1.5">
        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
        Pagamento seguro por <strong class="text-gray-500 dark:text-gray-500">Kempaga</strong> &bull; Encriptação SSL
    </p>

    <script src="{{ dynamicAsset(path: 'public/assets/admin/js/vendor.min.js') }}"></script>
    <script src="{{ dynamicAsset(path: 'public/assets/admin/js/sweet_alert.js') }}"></script>
    <script src="{{ dynamicAsset(path: 'public/assets/admin/js/toastr.js') }}"></script>
    {!! Toastr::message() !!}

    @if ($errors->any())
        <script>
            @foreach($errors->all() as $error)
            toastr.error('{{ $error }}', '', { CloseButton: true, ProgressBar: true });
            @endforeach
        </script>
    @endif

    <script>
        (function () {
            var t = localStorage.getItem('kempaga-theme');
            if (t === 'light') document.documentElement.classList.remove('dark');
            else document.documentElement.classList.add('dark');
        })();

        function cancelPayment(route) {
            Swal.fire({
                title: '{{ translate("Cancelar pagamento?") }}',
                text: '{{ translate("Tem a certeza que deseja cancelar?") }}',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0078D7',
                cancelButtonColor: '#6B7280',
                confirmButtonText: '{{ translate("Sim, cancelar") }}',
                cancelButtonText: '{{ translate("Não") }}',
                reverseButtons: true
            }).then(function (r) {
                if (r.value) location.href = route;
            });
        }
    </script>

    @stack('script')
</body>
</html>
