<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="_token" content="{{csrf_token()}}">
    <link rel="icon" type="image/x-icon" href="{{dynamicAsset(path: 'public/assets/icons/favicon.ico')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{dynamicAsset(path: 'public/assets/icons/favicon-16x16.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{dynamicAsset(path: 'public/assets/icons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{dynamicAsset(path: 'public/assets/icons/favicon-48x48.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{dynamicAsset(path: 'public/assets/icons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{dynamicAsset(path: 'public/assets/icons/android-chrome-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{dynamicAsset(path: 'public/assets/icons/android-chrome-512x512.png')}}">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{dynamicAsset(path: 'public/assets/admin/css/vendor.min.css')}}">
    <link rel="stylesheet" href="{{dynamicAsset(path: 'public/assets/admin/vendor/icon-set/style.css')}}">
    <link rel="stylesheet" href="{{dynamicAsset(path: 'public/assets/admin/css/custom.css')}}">

    <link rel="stylesheet" href="{{dynamicAsset(path: 'public/assets/admin/css/theme.minc619.css?v=1.0')}}">
    <link rel="stylesheet" href="{{dynamicAsset(path: 'public/assets/admin/css/style.css')}}">

    <link rel="stylesheet" href="{{dynamicAsset(path: 'public/assets/admin/css/custom-helper.css')}}">

    @stack('css_or_js')
    <script
        src="{{dynamicAsset(path: 'public/assets/admin/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js')}}"></script>
    <link rel="stylesheet" href="{{dynamicAsset(path: 'public/assets/admin/css/toastr.css')}}">

    <style>
        :root {
            --primary: #0078D7;
            --primary-dark: #0050B3;

            --secondary: #39B54A;
            --secondary-dark: #00843D;

            --dark: #0B1D33;
            --white: #FFFFFF;

            --background: #F5F7FA;
            --surface: #FFFFFF;

            --text-primary: #111827;
            --text-secondary: #6B7280;
            --text-muted: #9CA3AF;

            --border: #E5E7EB;

            --success: #39B54A;
            --warning: #F59E0B;
            --danger: #E11D48;
            --info: #0078D7;

            --gradient-primary: linear-gradient(135deg, #0078D7 0%, #39B54A 100%);
            --gradient-dark: linear-gradient(135deg, #0B1D33 0%, #0050B3 100%);
            --gradient-soft: linear-gradient(135deg, #F5F7FA 0%, #EAF7EF 100%);
        }

        /* Overriding theme colors using new variables */
        .btn-primary, .btn--primary {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
        }
        .btn-primary:hover, .btn--primary:hover {
            background-color: var(--primary-dark) !important;
            border-color: var(--primary-dark) !important;
        }
        .text-primary { color: var(--primary) !important; }
        .bg-primary { background-color: var(--primary) !important; }
        
        .navbar-vertical-aside {
            background-color: var(--dark) !important;
        }
        
        .nav-subtitle {
            color: var(--text-muted) !important;
        }

        /* Adjusting sidebar active states to match secondary/green brand */
        .navbar-vertical .active > .nav-link, 
        .navbar-vertical .nav-link.active, 
        .navbar-vertical .nav-link.show, 
        .navbar-vertical .show > .nav-link {
            color: var(--secondary) !important;
        }
    </style>
</head>

<body class="footer-offset">

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="loading" class="d-none">
                <div class="loader-css">
                    <img width="200" src="{{dynamicAsset(path: 'public/assets/admin/img/loader.gif')}}" alt="{{translate('gif')}}">
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.merchant.partials._front-settings')
@include('layouts.merchant.partials._header')
@include('layouts.merchant.partials._sidebar')

<main id="content" role="main" class="main pointer-event">
    @yield('content')

    @include('layouts.merchant.partials._footer')

</main>

<script src="{{dynamicAsset(path: 'public/assets/admin/js/custom.js')}}"></script>

@stack('script')
<script src="{{dynamicAsset(path: 'public/assets/admin/js/vendor.min.js')}}"></script>
<script src="{{dynamicAsset(path: 'public/assets/admin/js/theme.min.js')}}"></script>
<script src="{{dynamicAsset(path: 'public/assets/admin/js/sweet_alert.js')}}"></script>
<script src="{{dynamicAsset(path: 'public/assets/admin/js/toastr.js')}}"></script>
<script src="{{dynamicAsset(path: 'public/assets/admin/js/file-size-type-validation.js')}}"></script>


{!! Toastr::message() !!}

@if ($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif

<script>
    "use strict";
    $(document).on('ready', function () {

        $('.merchant-logout-btn').on('click', function (e) {
            e.preventDefault();
            logOut();
        });

        function logOut(){
            Swal.fire({
                title: '{{translate('Do you want to logout?')}}',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonColor: '#014F5B',
                cancelButtonColor: '#363636',
                confirmButtonText: `Yes`,
                denyButtonText: `Don't Logout`,
            }).then((result) => {
                if (result.value) {
                    location.href='{{route('merchant.auth.logout')}}';
                } else{
                    Swal.fire('Canceled', '', 'info')
                }
            })
        }

        if (window.localStorage.getItem('hs-builder-popover') === null) {
            $('#builderPopover').popover('show')
                .on('shown.bs.popover', function () {
                    $('.popover').last().addClass('popover-dark')
                });

            $(document).on('click', '#closeBuilderPopover', function () {
                window.localStorage.setItem('hs-builder-popover', true);
                $('#builderPopover').popover('dispose');
            });
        } else {
            $('#builderPopover').on('show.bs.popover', function () {
                return false
            });
        }

        $('.js-navbar-vertical-aside-toggle-invoker').click(function () {
            $('.js-navbar-vertical-aside-toggle-invoker i').tooltip('hide');
        });

        var megaMenu = new HSMegaMenu($('.js-mega-menu'), {
            desktop: {
                position: 'left'
            }
        }).init();

        var sidebar = $('.js-navbar-vertical-aside').hsSideNav();

        $('.js-nav-tooltip-link').tooltip({boundary: 'window'})

        $(".js-nav-tooltip-link").on("show.bs.tooltip", function (e) {
            if (!$("body").hasClass("navbar-vertical-aside-mini-mode")) {
                return false;
            }
        });

        $('.js-hs-unfold-invoker').each(function () {
            var unfold = new HSUnfold($(this)).init();
        });

        $('.js-form-search').each(function () {
            new HSFormSearch($(this)).init()
        });

        $('.js-select2-custom').each(function () {
            var select2 = $.HSCore.components.HSSelect2.init($(this));
        });

        $('.js-daterangepicker').daterangepicker();

        $('.js-daterangepicker-times').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'M/DD hh:mm A'
            }
        });

        var start = moment();
        var end = moment();

        function cb(start, end) {
            $('#js-daterangepicker-predefined .js-daterangepicker-predefined-preview').html(start.format('MMM D') + ' - ' + end.format('MMM D, YYYY'));
        }

        $('#js-daterangepicker-predefined').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        $('.js-clipboard').each(function () {
            var clipboard = $.HSCore.components.HSClipboard.init(this);
        });
    });
</script>

<script>
    function form_alert(id, message) {
        Swal.fire({
            title: 'Are you sure?',
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#014F5B',
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#' + id).submit()
            }
        })
    }
</script>

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

@stack('script_2')
<audio id="myAudio">
    <source src="{{dynamicAsset(path: 'public/assets/admin/sound/notification.mp3')}}" type="audio/mpeg">
</audio>

<script>
    var audio = document.getElementById("myAudio");

    function playAudio() {
        audio.play();
    }

    function pauseAudio() {
        audio.pause();
    }
</script>

<script>
    function call_demo() {
        toastr.info('This option is disabled for demo!', {
            CloseButton: true,
            ProgressBar: true
        });
    }
</script>

<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="{{dynamicAsset(path: 'public/assets/admin/vendor/babel-polyfill/polyfill.min.js')}}"><\/script>');
</script>
</body>
</html>
