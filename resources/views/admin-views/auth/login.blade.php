<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{translate('Admin')}} | {{translate('Login')}}</title>

    <link rel="shortcut icon" href="{{dynamicStorage(path: 'storage/app/public/favicon')}}/{{Helpers::get_business_settings('favicon') ?? null}}"/>

    <link rel="stylesheet" href="{{dynamicAsset(path: 'public/assets/admin/css/fonts/google/google.css')}}">
    <link rel="stylesheet" href="{{dynamicAsset(path: 'public/assets/admin/css/vendor.min.css')}}">
    <link rel="stylesheet" href="{{dynamicAsset(path: 'public/assets/admin/vendor/icon-set/style.css')}}">
    <link rel="stylesheet" href="{{dynamicAsset(path: 'public/assets/admin/css/theme.minc619.css?v=1.0')}}">
    <link rel="stylesheet" href="{{dynamicAsset(path: 'public/assets/admin/css/style.css')}}">
    <link rel="stylesheet" href="{{dynamicAsset(path: 'public/assets/admin/css/toastr.css')}}">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

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
                        <div class="col-6 input-icons bg-white rounded cursor-pointer" data-toggle="tooltip" data-placement="right" title="{{translate('Click to refresh')}}">
                            <a class="refresh-recaptcha">
                                <img src="{{ URL('/admin/auth/code/captcha/1') }}" class="input-field h-75 rounded-10 border-bottom-0 width-90-percent" id="default_recaptcha_id" alt="{{ translate('recaptcha') }}">
                                <i class="tio-refresh icon"></i>
                            </a>
                        </div>
                    </div>
                @endif

                @if(env('APP_MODE')=='demo')
                    <div class="card-footer rounded mt-3" style="background: #f8f6fd; border: 1px dashed #d8c7ee;">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <span>{{translate('Phone')}} : +8801100000000</span><br>
                                <span>{{translate('Password')}} : {{translate('12345678')}}</span>
                            </div>
                            <div class="col-2 text-right">
                                <span class="btn btn-primary" id="copyButton"><i class="tio-copy"></i></span>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="mt-4">
                    <button type="submit" class="sign-in-button" id="signInBtn">{{translate('sign_in')}}</button>
                </div>
            </form>
        </div>
    </section>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{dynamicAsset(path: 'public/assets/admin/js/vendor.min.js')}}"></script>
<script src="{{dynamicAsset(path: 'public/assets/admin/js/theme.min.js')}}"></script>
<script src="{{dynamicAsset(path: 'public/assets/admin/js/toastr.js')}}"></script>
{!! Toastr::message() !!}

@if ($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', '', {
            closeButton: true,
            progressBar: true
        });
        @endforeach
    </script>
@endif

<script>
    $(document).on('ready', function () {

        $('.js-toggle-password').each(function () {
            new HSTogglePassword(this).init()
        });

        $('.js-validate').each(function () {
            $.HSCore.components.HSValidation.init($(this));
        });
    });
</script>

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

                window.onerror = function(message) {
                    var errorMessage = 'An unexpected error occurred. Please check the recaptcha configuration';
                    if (message.includes('Invalid site key')) {
                        errorMessage = 'Invalid site key provided. Please check the recaptcha configuration.';
                    } else if (message.includes('not loaded in api.js')) {
                        errorMessage = 'reCAPTCHA API could not be loaded. Please check the recaptcha API configuration.';
                    }

                    $('#reload-captcha').removeClass('d-none');
                    $('#set_default_captcha_value').val('1');

                    toastr.error(errorMessage)
                    return true;
                };
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


@if(env('APP_MODE')=='demo')
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
</body>
</html>
