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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Fredoka', 'sans-serif'],
                    },
                    colors: {
                        darkBg: '#08050e',
                        darkCard: '#110d18',
                        lightBg: '#f8fafc',
                        lightCard: '#ffffff',
                        brandPurple: '#872ccb',
                        brandPurpleHover: '#6a1d9e',
                        brandGreen: '#107123',
                        brandGreenHover: '#0b5318',
                        brandGreenBright: '#24a13f',
                        textMutedDark: '#a3a3a3',
                        textMutedLight: '#64748b'
                    }
                }
            }
        }
    </script>
    <style>
        :root {
            --brand-purple: #872ccb;
            --brand-purple-hover: #6a1d9e;
            --brand-green: #107123;
            --brand-green-bright: #24a13f;
            --dark-bg: #08050e;
            --dark-card: #110d18;
            --muted: #7e8699;
        }

        body {
            min-height: 100vh;
            background: #0a0711;
        }

        .login-layout { min-height: 100vh; }

        .branding-panel {
            position: relative;
            overflow: hidden;
            background: radial-gradient(circle at 20% 80%, rgba(135, 44, 203, 0.16), transparent 35%),
                        radial-gradient(circle at 80% 20%, rgba(16, 113, 35, 0.16), transparent 35%),
                        linear-gradient(140deg, #0f0a19, #08050e 45%);
            color: #fff;
        }

        .branding-badge {
            display: inline-block;
            border: 1px solid rgba(36, 161, 63, 0.3);
            background: rgba(36, 161, 63, 0.1);
            color: var(--brand-green-bright);
            border-radius: 999px;
            padding: .4rem .9rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .form-panel { background: #ffffff; }
        .login-card-shell {
            width: 100%;
            max-width: 440px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(17, 13, 24, 0.08);
            border: 1px solid #edf0f6;
            padding: 2rem;
            background: #fff;
        }

        .input-field,
        .form-control-lg.input-field {
            border-radius: 12px;
            border: 1px solid #e7eaf3;
            background: #f8fafd;
            min-height: 52px;
        }

        .input-field:focus {
            border-color: var(--brand-purple);
            box-shadow: 0 0 0 .2rem rgba(135, 44, 203, 0.15);
            background: #fff;
        }

        .sign-in-button {
            width: 100%;
            border: none;
            border-radius: 12px;
            padding: .95rem 1rem;
            background: var(--brand-purple);
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            transition: .25s ease;
            box-shadow: 0 12px 24px rgba(135, 44, 203, 0.25);
        }

        .sign-in-button:hover { background: var(--brand-purple-hover); }

        .divider-text {
            color: var(--muted);
            font-size: .88rem;
            font-weight: 500;
        }

        .social-btn {
            border: 1px solid #e7eaf3;
            border-radius: 12px;
            background: #fff;
            font-weight: 600;
            color: #283046;
            padding: .75rem;
        }

        .social-btn:hover { background: #f8fafd; }

        @media (max-width: 991.98px) {
            .form-panel { background: #f5f7fb; }
            .login-card-shell {
                box-shadow: none;
                border: 1px solid #e6ebf2;
            }
        }
    </style>
</head>
<body class="min-h-screen font-sans antialiased selection:bg-brandPurple selection:text-white text-slate-900 dark:text-white transition-colors duration-300 overflow-hidden flex">

<div class="hidden lg:flex lg:w-1/2 bg-lightBg dark:bg-darkBg relative flex-col justify-between p-12 overflow-hidden border-r border-gray-200 dark:border-gray-800">
    <div class="absolute inset-0 pointer-events-none hidden dark:block" style="background-image: radial-gradient(circle at 20% 80%, rgba(135, 44, 203, 0.08), transparent 40%), radial-gradient(circle at 80% 20%, rgba(16, 113, 35, 0.08), transparent 40%);"></div>

    <div class="relative z-10">
        <h1 class="text-4xl font-bold tracking-tight">
            <span class="text-brandPurple">Kem</span><span class="text-brandGreen">paga</span>
        </h1>
    </div>

    <div class="relative z-10 max-w-lg mt-auto mb-auto">
        <span class="px-3 py-1 mb-6 inline-block rounded-full bg-brandGreen/10 dark:bg-brandGreen/20 text-brandGreen dark:text-brandGreenBright text-sm font-semibold border border-brandGreen/20">
            {{translate('Acesso Seguro')}}
        </span>
        <h2 class="text-4xl font-bold leading-tight mb-6">
            {{translate('A sua vida financeira')}}<br>{{translate('num só lugar.')}}
        </h2>
        <p class="text-textMutedLight dark:text-textMutedDark text-lg">
            {{translate('Gira os seus Kwanzas, Criptomoedas e divisas estrangeiras com a facilidade do Multicaixa Express. Bem-vindo de volta ao controlo do seu dinheiro.')}}
        </p>
    </div>

    <div class="absolute -bottom-20 -right-20 w-[400px] h-[400px] bg-brandPurple/20 dark:bg-brandPurple/10 rounded-full blur-3xl mix-blend-multiply dark:mix-blend-lighten pointer-events-none"></div>
</div>

<div class="w-full lg:w-1/2 flex flex-col bg-white dark:bg-[#0c0914] relative h-screen overflow-y-auto">
    <div class="flex justify-between items-center p-6 lg:hidden">
        <h1 class="text-3xl font-bold tracking-tight">
            <span class="text-brandPurple">Kem</span><span class="text-brandGreen">paga</span>
        </h1>

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
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-medium text-slate-700 dark:text-gray-300">{{translate('Palavra-passe')}}</label>
                    </div>
                    <div class="relative">
                        <input type="password" id="password" name="password" required class="w-full pl-4 pr-12 py-3.5 bg-gray-50 dark:bg-[#15111f] border border-gray-200 dark:border-gray-800 rounded-xl text-slate-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brandPurple/50 focus:border-brandPurple transition-all" placeholder="••••••••">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-brandPurple focus:outline-none">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </button>
<body>
<main id="content" role="main" class="main login-layout d-flex">
    <section class="branding-panel d-none d-lg-flex col-lg-6 py-5 px-5 flex-column justify-content-between">
        <div>
            <h1 class="text-white font-weight-bold mb-0" style="font-size: 2.25rem; letter-spacing: -.5px;">
                <span style="color: var(--brand-purple);">Kem</span><span style="color: var(--brand-green-bright);">paga</span>
            </h1>
        </div>

        <div class="my-auto" style="max-width: 500px;">
            <span class="branding-badge">{{translate('Secure Access')}}</span>
            <h2 class="text-white font-weight-bold mb-4" style="font-size: 2.5rem; line-height: 1.2;">
                {{translate('Your financial life')}}<br>{{translate('in one place')}}
            </h2>
            <p class="mb-0" style="font-size: 1.05rem; color: rgba(255,255,255,.72);">
                {{translate('Manage your wallets, transfers, and foreign currencies with a modern and secure platform. Welcome back to control of your money.')}}
            </p>
        </div>

        <div style="width: 360px; height: 360px; border-radius: 999px; background: rgba(135,44,203,.2); filter: blur(20px); position: absolute; right: -120px; bottom: -120px;"></div>
    </section>

    <section class="form-panel col-12 col-lg-6 d-flex align-items-center justify-content-center py-5 px-3 px-sm-4">
        <div class="login-card-shell">
            <div class="text-center text-lg-left mb-4">
                <h2 class="font-weight-bold mb-2" style="font-size: 1.9rem;">{{translate('sign in')}}</h2>
                <p class="mb-0" style="color: var(--muted);">{{translate('Enter your credentials to access the dashboard.')}}</p>
            </div>

            <form action="{{route('admin.auth.login')}}" method="post" id="form-id">
                @csrf

                <div class="js-form-message form-group">
                    <label class="font-weight-semibold mb-2" for="phone">{{translate('Phone number')}}</label>
                    <input type="text" class="form-control form-control-lg input-field" name="phone" id="phone" required
                           tabindex="1" placeholder="{{translate('Enter your phone no.')}}"
                           data-msg="{{translate('Please enter a valid phone number.')}}">
                </div>

                <div class="js-form-message form-group">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="font-weight-semibold mb-0" for="signupSrPassword">{{translate('Password')}}</label>
                    </div>
                    <div class="input-group input-group-merge">
                        <input type="password" class="js-toggle-password form-control form-control-lg input-field"
                               name="password" id="signupSrPassword" placeholder="{{translate('Enter your password')}}"
                               aria-label="8+ characters required" required
                               data-msg="{{translate('Your password is invalid. Please try again.')}}"
                               data-hs-toggle-password-options='{"target": "#changePassTarget","defaultClass": "tio-hidden-outlined","showClass": "tio-visible-outlined","classChangeTarget": "#changePassIcon"}'>
                        <div id="changePassTarget" class="input-group-append">
                            <a class="input-group-text bg-transparent" href="javascript:">
                                <i id="changePassIcon" class="tio-visible-outlined"></i>
                            </a>
                        </div>
                    </div>
                </div>

                @php($recaptcha = Helpers::get_business_settings('recaptcha'))
                @if(isset($recaptcha) && $recaptcha['status'] == 1)
                    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                    <input type="hidden" name="set_default_captcha" id="set_default_captcha_value" value="0" >
                    <div class="row d-none" id="reload-captcha">
                        <div class="col-6 pr-0">
                            <input type="text" class="form-control form-control-lg border-none" name="default_captcha_value" value="" placeholder="{{translate('Enter captcha')}}" autocomplete="off">
                        </div>
                        <div class="col-6 input-icons bg-white rounded cursor-pointer" data-toggle="tooltip" title="{{translate('Click to refresh')}}">
                        <div class="col-6 input-icons bg-white rounded cursor-pointer" data-toggle="tooltip" data-placement="right" title="{{translate('Click to refresh')}}">
                            <a class="refresh-recaptcha">
                                <img src="{{ URL('/admin/auth/code/captcha/1') }}" class="input-field h-75 rounded-10 border-bottom-0 width-90-percent" id="default_recaptcha_id" alt="{{ translate('recaptcha') }}">
                                <i class="tio-refresh icon"></i>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="row p-2">
                        <div class="col-6 pr-0">
                            <input type="text" class="form-control form-control-lg border-none" name="default_captcha_value" value="" placeholder="{{translate('Enter captcha')}}" autocomplete="off">
                        </div>
                        <div class="col-6 input-icons bg-white rounded cursor-pointer" data-toggle="tooltip" title="{{translate('Click to refresh')}}">
                        <div class="col-6 input-icons bg-white rounded cursor-pointer" data-toggle="tooltip" data-placement="right" title="{{translate('Click to refresh')}}">
                            <a class="refresh-recaptcha">
                                <img src="{{ URL('/admin/auth/code/captcha/1') }}" class="input-field h-75 rounded-10 border-bottom-0 width-90-percent" id="default_recaptcha_id" alt="{{ translate('recaptcha') }}">
                                <i class="tio-refresh icon"></i>
                            </a>
                        </div>
                    </div>
                @endif

                @if(env('APP_MODE')=='demo')
                    <div class="card-footer rounded bg-brandPurple/10 border border-brandPurple/20">
                        <div class="row">
                    <div class="card-footer rounded mt-3" style="background: #f8f6fd; border: 1px dashed #d8c7ee;">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <span>{{translate('Phone')}} : +8801100000000</span><br>
                                <span>{{translate('Password')}} : {{translate('12345678')}}</span>
                            </div>
                            <div class="col-2">
                            <div class="col-2 text-right">
                                <span class="btn btn-primary" id="copyButton"><i class="tio-copy"></i></span>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="pt-2">
                    <button type="submit" class="w-full py-4 bg-brandPurple hover:bg-brandPurpleHover text-white text-lg font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-brandPurple/20" id="signInBtn">
                        {{translate('Entrar')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
                <div class="mt-4">
                    <button type="submit" class="sign-in-button" id="signInBtn">{{translate('sign_in')}}</button>
                </div>
            </form>
        </div>
    </section>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{dynamicAsset(path: 'public/assets/admin/js/toastr.js')}}"></script>
{!! Toastr::message() !!}

@if ($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', '', {closeButton: true, progressBar: true});
        @endforeach
    </script>
@endif

<script>
    const themeToggleBtns = document.querySelectorAll('#theme-toggle, #theme-toggle-mobile');
    const darkIcons = document.querySelectorAll('#theme-toggle-dark-icon, #theme-toggle-dark-icon-mobile');
    const lightIcons = document.querySelectorAll('#theme-toggle-light-icon, #theme-toggle-light-icon-mobile');

    function setInitialTheme() {
        const savedTheme = localStorage.getItem('color-theme');
        if (savedTheme === 'light') {
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.add('dark');
        }

        darkIcons.forEach(icon => icon.classList.add('hidden'));
        lightIcons.forEach(icon => icon.classList.add('hidden'));

        if (document.documentElement.classList.contains('dark')) {
            lightIcons.forEach(icon => icon.classList.remove('hidden'));
        } else {
            darkIcons.forEach(icon => icon.classList.remove('hidden'));
        }
    }

    themeToggleBtns.forEach(btn => {
        btn?.addEventListener('click', function() {
            darkIcons.forEach(icon => icon.classList.toggle('hidden'));
            lightIcons.forEach(icon => icon.classList.toggle('hidden'));

            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });
    });

    setInitialTheme();

    const togglePasswordBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    togglePasswordBtn?.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('text-brandPurple');
    });
</script>
                    return;
                }

                grecaptcha.ready(function () {
                    grecaptcha.execute('{{$recaptcha['site_key']}}', {action: 'submit'}).then(function (token) {
                        $('#g-recaptcha-response').val(token);
                        $('#form-id').submit();
                    });
                });

@if(isset($recaptcha) && $recaptcha['status'] == 1)
<script src="https://www.google.com/recaptcha/api.js?render={{$recaptcha['site_key']}}"></script>
<script>
    $(document).ready(function() {
        $('#signInBtn').click(function (e) {
            if( $('#set_default_captcha_value').val() == 1){
                $('#form-id').submit();
                return true;
            }

            e.preventDefault();
            if (typeof grecaptcha === 'undefined') {
                toastr.error('Invalid recaptcha key provided. Please check the recaptcha configuration.');
                $('#reload-captcha').removeClass('d-none');
                $('#set_default_captcha_value').val('1');
                return;
            }

            grecaptcha.ready(function () {
                grecaptcha.execute('{{$recaptcha['site_key']}}', {action: 'submit'}).then(function (token) {
                    $('#g-recaptcha-response').val(token);
                    $('#form-id').submit();
                });
            });
        });
    });
</script>
@endif
<script type="text/javascript">
    $('.refresh-recaptcha').on('click', function() {
        var $url = "{{ URL('/admin/auth/code/captcha') }}";
        var $url = $url + "/" + Math.random();
        document.getElementById('default_recaptcha_id').src = $url;
        console.log('url: '+ $url);
    });
</script>

<script>
    $('.refresh-recaptcha').on('click', function() {
        var $url = "{{ URL('/admin/auth/code/captcha') }}";
        $url = $url + "/" + Math.random();
        document.getElementById('default_recaptcha_id').src = $url;
    });
</script>

@if(env('APP_MODE')=='demo')
<script>
    $('#copyButton').on('click', function() {
        $('#phone').val('+8801100000000');
        $('#password').val('12345678');
        toastr.success('Credentials copied successfully!', '', {closeButton: true, progressBar: true});
    });
    <script>
        $('#copyButton').on('click', function() {
            $('#phone').val('+8801100000000');
            $('#signupSrPassword').val('12345678');
            toastr.success('Credentials copied successfully!', '', {
                closeButton: true,
                progressBar: true
            });
        });
    </script>
@endif

<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="{{ dynamicAsset(path: 'public/assets/admin') }}/vendor/babel-polyfill/polyfill.min.js"><\\/script>');
</script>
@endif
</body>
</html>
