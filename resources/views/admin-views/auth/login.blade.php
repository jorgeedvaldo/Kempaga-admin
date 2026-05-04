<!DOCTYPE html>
<html lang="pt-AO" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{translate('Admin')}} | {{translate('Login')}}</title>

    <link rel="shortcut icon" href="{{dynamicStorage(path: 'storage/app/public/favicon')}}/{{Helpers::get_business_settings('favicon') ?? null}}"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{dynamicAsset(path: 'public/assets/admin/js/toastr.js')}}"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Fredoka', 'sans-serif'] },
                    colors: {
                        darkBg: '#08050e', darkCard: '#110d18', lightBg: '#f8fafc', lightCard: '#ffffff',
                        brandPurple: '#872ccb', brandPurpleHover: '#6a1d9e', brandGreen: '#107123',
                        brandGreenHover: '#0b5318', brandGreenBright: '#24a13f', textMutedDark: '#a3a3a3',
                        textMutedLight: '#64748b'
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen font-sans antialiased selection:bg-brandPurple selection:text-white text-slate-900 dark:text-white transition-colors duration-300 overflow-hidden flex bg-white dark:bg-[#0c0914]">
<div class="hidden lg:flex lg:w-1/2 bg-lightBg dark:bg-darkBg relative flex-col justify-between p-12 overflow-hidden border-r border-gray-200 dark:border-gray-800">
    <div class="absolute inset-0 pointer-events-none hidden dark:block" style="background-image: radial-gradient(circle at 20% 80%, rgba(135, 44, 203, 0.08), transparent 40%), radial-gradient(circle at 80% 20%, rgba(16, 113, 35, 0.08), transparent 40%);"></div>

    <div class="relative z-10">
        <h1 class="text-4xl font-bold tracking-tight"><span class="text-brandPurple">Kem</span><span class="text-brandGreen">paga</span></h1>
    </div>

    <div class="relative z-10 max-w-lg mt-auto mb-auto">
        <span class="px-3 py-1 mb-6 inline-block rounded-full bg-brandGreen/10 dark:bg-brandGreen/20 text-brandGreen dark:text-brandGreenBright text-sm font-semibold border border-brandGreen/20">{{translate('Acesso Seguro')}}</span>
        <h2 class="text-4xl font-bold leading-tight mb-6">{{translate('A sua vida financeira')}}<br>{{translate('num só lugar.')}}</h2>
        <p class="text-textMutedLight dark:text-textMutedDark text-lg">{{translate('Gira os seus Kwanzas, Criptomoedas e divisas estrangeiras com a facilidade do Multicaixa Express. Bem-vindo de volta ao controlo do seu dinheiro.')}}</p>
    </div>

    <div class="absolute -bottom-20 -right-20 w-[400px] h-[400px] bg-brandPurple/20 dark:bg-brandPurple/10 rounded-full blur-3xl mix-blend-multiply dark:mix-blend-lighten pointer-events-none"></div>
</div>

<div class="w-full lg:w-1/2 flex flex-col relative h-screen overflow-y-auto">
    <div class="flex justify-between items-center p-6 lg:hidden">
        <h1 class="text-3xl font-bold tracking-tight"><span class="text-brandPurple">Kem</span><span class="text-brandGreen">paga</span></h1>
        <button id="theme-toggle-mobile" class="p-2 rounded-full bg-gray-100 dark:bg-gray-800 text-slate-800 dark:text-yellow-400 focus:outline-none">
            <svg id="theme-toggle-light-icon-mobile" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 4.22a1 1 0 011.415 0l.708.708a1 1 0 01-1.414 1.414l-.708-.708a1 1 0 010-1.414zM16 10a1 1 0 011 1h1a1 1 0 110-2h-1a1 1 0 01-1 1zm-4.22 4.22a1 1 0 010 1.415l-.708.708a1 1 0 01-1.414-1.414l.708-.708a1 1 0 011.415 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22-4.22a1 1 0 01-1.415 0l-.708-.708a1 1 0 011.414-1.414l.708.708a1 1 0 010 1.414zM4 10a1 1 0 01-1-1H2a1 1 0 110 2h1a1 1 0 011-1zm4.22-4.22a1 1 0 010-1.415l.708-.708a1 1 0 011.414 1.414l-.708.708a1 1 0 01-1.415 0z"></path><path d="M10 14a4 4 0 100-8 4 4 0 000 8z"></path></svg>
            <svg id="theme-toggle-dark-icon-mobile" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
        </button>
    </div>

    <div class="hidden lg:block absolute top-8 right-12 z-20">
        <button id="theme-toggle" class="p-2.5 rounded-full bg-gray-100 dark:bg-gray-800 text-slate-800 dark:text-yellow-400 border border-transparent dark:border-gray-700 hover:scale-105 transition-all focus:outline-none shadow-sm">
            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 4.22a1 1 0 011.415 0l.708.708a1 1 0 01-1.414 1.414l-.708-.708a1 1 0 010-1.414zM16 10a1 1 0 011 1h1a1 1 0 110-2h-1a1 1 0 01-1 1zm-4.22 4.22a1 1 0 010 1.415l-.708.708a1 1 0 01-1.414-1.414l.708-.708a1 1 0 011.415 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22-4.22a1 1 0 01-1.415 0l-.708-.708a1 1 0 011.414-1.414l.708.708a1 1 0 010 1.414zM4 10a1 1 0 01-1-1H2a1 1 0 110 2h1a1 1 0 011-1zm4.22-4.22a1 1 0 010-1.415l.708-.708a1 1 0 011.414 1.414l-.708.708a1 1 0 01-1.415 0z"></path><path d="M10 14a4 4 0 100-8 4 4 0 000 8z"></path></svg>
            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
        </button>
    </div>

    <div class="flex-1 flex items-center justify-center p-6 sm:p-12">
        <div class="w-full max-w-md">
            <div class="mb-10 text-center lg:text-left">
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-2">{{translate('Iniciar Sessão')}}</h2>
                <p class="text-textMutedLight dark:text-textMutedDark">{{translate('Introduza os seus dados para aceder à conta.')}}</p>
            </div>

            <form action="{{route('admin.auth.login')}}" method="post" id="form-id" class="space-y-5">
                @csrf
                <div>
                    <label for="phone" class="block text-sm font-medium text-slate-700 dark:text-gray-300 mb-2">{{translate('E-mail ou Nº de Telefone')}}</label>
                    <input type="text" id="phone" name="phone" required class="w-full px-4 py-3.5 bg-gray-50 dark:bg-[#15111f] border border-gray-200 dark:border-gray-800 rounded-xl text-slate-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brandPurple/50 focus:border-brandPurple transition-all" placeholder="{{translate('Enter your phone no.')}}">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 dark:text-gray-300 mb-2">{{translate('Palavra-passe')}}</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required class="w-full pl-4 pr-12 py-3.5 bg-gray-50 dark:bg-[#15111f] border border-gray-200 dark:border-gray-800 rounded-xl text-slate-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brandPurple/50 focus:border-brandPurple transition-all" placeholder="••••••••">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-brandPurple focus:outline-none">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </button>
                    </div>
                </div>

                @php($recaptcha = Helpers::get_business_settings('recaptcha'))
                @if(isset($recaptcha) && $recaptcha['status'] == 1)
                    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                    <input type="hidden" name="set_default_captcha" id="set_default_captcha_value" value="0">
                    <div class="hidden" id="reload-captcha">
                @else
                    <input type="hidden" name="set_default_captcha" id="set_default_captcha_value" value="1">
                    <div>
                @endif
                    <div class="grid grid-cols-2 gap-2">
                        <input type="text" class="w-full px-3 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-slate-900" name="default_captcha_value" placeholder="{{translate('Enter captcha')}}" autocomplete="off">
                        <a class="refresh-recaptcha cursor-pointer" title="{{translate('Click to refresh')}}">
                            <img src="{{ URL('/admin/auth/code/captcha/1') }}" class="h-[52px] w-full rounded-xl border border-gray-200 object-cover" id="default_recaptcha_id" alt="{{ translate('recaptcha') }}">
                        </a>
                    </div>
                </div>

                @if(env('APP_MODE')=='demo')
                    <div class="rounded-xl bg-brandPurple/10 border border-brandPurple/20 p-4 text-sm">
                        <div class="flex justify-between items-start gap-4">
                            <div>
                                <div>{{translate('Phone')}} : +8801100000000</div>
                                <div>{{translate('Password')}} : {{translate('12345678')}}</div>
                            </div>
                            <button type="button" class="px-3 py-2 rounded-lg bg-brandPurple text-white" id="copyButton">{{translate('Copy')}}</button>
                        </div>
                    </div>
                @endif

                <button type="submit" class="w-full py-4 bg-brandPurple hover:bg-brandPurpleHover text-white text-lg font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-brandPurple/20" id="signInBtn">{{translate('Entrar')}}</button>
            </form>
        </div>
    </div>
</div>

{!! Toastr::message() !!}
@if ($errors->any())
<script> @foreach($errors->all() as $error) toastr.error('{{$error}}', '', {closeButton: true, progressBar: true}); @endforeach </script>
@endif

@if(isset($recaptcha) && $recaptcha['status'] == 1)
<script src="https://www.google.com/recaptcha/api.js?render={{$recaptcha['site_key']}}"></script>
@endif
<script>
    const themeToggleBtns = document.querySelectorAll('#theme-toggle, #theme-toggle-mobile');
    const darkIcons = document.querySelectorAll('#theme-toggle-dark-icon, #theme-toggle-dark-icon-mobile');
    const lightIcons = document.querySelectorAll('#theme-toggle-light-icon, #theme-toggle-light-icon-mobile');
    const togglePasswordBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    function setInitialTheme() {
        const savedTheme = localStorage.getItem('color-theme');
        if (savedTheme === 'light') document.documentElement.classList.remove('dark');
        else document.documentElement.classList.add('dark');
        darkIcons.forEach(icon => icon.classList.add('hidden'));
        lightIcons.forEach(icon => icon.classList.add('hidden'));
        if (document.documentElement.classList.contains('dark')) lightIcons.forEach(icon => icon.classList.remove('hidden'));
        else darkIcons.forEach(icon => icon.classList.remove('hidden'));
    }

    themeToggleBtns.forEach(btn => btn?.addEventListener('click', function() {
        darkIcons.forEach(icon => icon.classList.toggle('hidden'));
        lightIcons.forEach(icon => icon.classList.toggle('hidden'));
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    }));
    setInitialTheme();

    togglePasswordBtn?.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('text-brandPurple');
    });

    $('.refresh-recaptcha').on('click', function() {
        let url = "{{ URL('/admin/auth/code/captcha') }}" + "/" + Math.random();
        document.getElementById('default_recaptcha_id').src = url;
    });

    $('#signInBtn').on('click', function (e) {
        if ($('#set_default_captcha_value').val() == '1') return true;
        e.preventDefault();
        if (typeof grecaptcha === 'undefined') {
            toastr.error('Invalid recaptcha key provided. Please check the recaptcha configuration.');
            $('#reload-captcha').removeClass('hidden');
            $('#set_default_captcha_value').val('1');
            return;
        }
        grecaptcha.ready(function () {
            grecaptcha.execute('{{$recaptcha['site_key'] ?? ''}}', {action: 'submit'}).then(function (token) {
                $('#g-recaptcha-response').val(token);
                $('#form-id').submit();
            });
        });
    });

    $('#copyButton').on('click', function() {
        $('#phone').val('+8801100000000');
        $('#password').val('12345678');
        toastr.success('Credentials copied successfully!', '', {closeButton: true, progressBar: true});
    });
</script>
</body>
</html>
