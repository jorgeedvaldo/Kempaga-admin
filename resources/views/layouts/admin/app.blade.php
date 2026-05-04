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
    <script src="{{dynamicAsset(path: 'public/assets/admin/js/fontawesome.js')}}"></script>


    @stack('css_or_js')

    <script src="{{dynamicAsset(path: 'public/assets/admin')}}/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js"></script>
    <link rel="stylesheet" href="{{dynamicAsset(path: 'public/assets/admin/css/toastr.css')}}">
</head>

<body class="footer-offset">

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="loading" class="d-none">
                <div class="loader-css">
                    <img width="200" src="{{dynamicAsset(path: 'public/assets/admin/img/loader.gif')}}" alt="{{ translate('loader') }}">
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.admin.partials._front-settings')

@include('layouts.admin.partials._header')
@include('layouts.admin.partials._sidebar')

<main id="content" role="main" class="main pointer-event">
@yield('content')

@include('layouts.admin.partials._footer')
@include('layouts.admin.partials._custom-modal')

</main>

<script src="{{dynamicAsset(path: 'public/assets/admin/js/custom.js')}}"></script>

@stack('script')
<script src="{{dynamicAsset(path: 'public/assets/admin/js/vendor.min.js')}}"></script>
<script src="{{dynamicAsset(path: 'public/assets/admin/js/theme.min.js')}}"></script>
<script src="{{dynamicAsset(path: 'public/assets/admin/js/sweet_alert.js')}}"></script>
<script src="{{dynamicAsset(path: 'public/assets/admin/js/toastr.js')}}"></script>
<script src="{{dynamicAsset(path: 'public/assets/admin/js/file-size-type-validation.js')}}"></script>
<script>
    let onMultipleImageUploadExtensionError = "{{ translate('please_only_input_png_,jpg,jpeg,_webp_type_file') }}";
    let onMultipleImageUploadSizeError = "{{ translate('Image size must be less than' .readableUploadMaxFileSize('image')) }}";
</script>

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
        document.querySelectorAll('input[type="checkbox"][size]').forEach((checkbox) => {
            const size = checkbox.getAttribute('size');
            if (size) {
                checkbox.style.width = `${size}px`;
                checkbox.style.height = `${size}px`;
            }
        });

        document.querySelectorAll('.upload-file__input').forEach(function(input) {
            input.addEventListener('change', function(event) {
                var file = event.target.files[0];
                var card = event.target.closest('.upload-file');
                var textbox = card.querySelector('.upload-file__textbox');
                var imgElement = card.querySelector('.upload-file__img__img');
                var prevSrc = textbox.querySelector('img').src;
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        imgElement.src = e.target.result;
                        $(card).find('.remove-img-icon').removeClass('d-none');
                        textbox.style.display = 'none';
                        imgElement.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
                // Remove image
                $(card).find('.remove-img-icon').on('click', function() {
                    $(card).find('.upload-file__input').val('');
                    $(card).find('.upload-file__img__img').attr('src', '');
                    textbox.querySelector('img').src = prevSrc
                    textbox.style.display = 'block';
                    imgElement.style.display = 'none';
                    $(card).find('.remove-img-icon').addClass('d-none');
                });
            });
        });

        $(document).ready(function () {
            $('.upload-file.new').each(function () {
                const $wrapper = $(this);
                const $input = $wrapper.find('.upload-file__input');
                const $img = $wrapper.find('.upload-file__img__img');
                const $textBox = $wrapper.find('.upload-file__textbox');
                const $removeBtn = $wrapper.find('.upload-file__remove-btn');
                const $editBtn = $wrapper.find('.upload-file__edit-btn');

                //  If already has image (e.g., from backend)
                if ($img.attr('src') && $img.attr('src').trim() !== '') {
                    $wrapper.addClass('active');
                    $img.show();
                    $textBox.hide();
                }

                // On file upload
                $input.on('change', function () {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            $img.attr('src', e.target.result).show();
                            $textBox.hide();
                            $wrapper.addClass('active');
                        };
                        reader.readAsDataURL(this.files[0]);
                    }
                });

                //  On edit button click → trigger re-upload
                $editBtn.on('click', function (e) {
                    e.preventDefault();
                    $input.trigger('click');
                });

                //  On image remove
                $removeBtn.on('click', function (e) {
                    e.preventDefault();
                    $input.val(''); // clear file input
                    $img.attr('src', '').hide();
                    $textBox.show();
                    $wrapper.removeClass('active');
                });
            });
        });

        $('.admin-logout-btn').on('click', function (e) {
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
                    location.href='{{route('admin.auth.logout')}}';
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

        $('.js-clipboard').each(function () {
            var clipboard = $.HSCore.components.HSClipboard.init(this);
        });

    });

    $('.form-alert').on('click', function (){
        let id = $(this).data('id');
        let message = $(this).data('message');
        form_alert(id, message)
    });

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
                $('#'+id).submit()
            }
        })
    }

    $('.change-status').on('click', function (){
        location.href = $(this).data('route');
    });

    //change status with confirmation

    $(".status-change").change(function() {
        var value = $(this).val();
        let url = $(this).data('url');
        status_change(this, url);
    });

    function status_change(t, url) {
        let checked = $(t).prop("checked");
        let status = checked === true ? 1 : 0;

        Swal.fire({
            title: 'Are you sure?',
            text: 'Want to change status',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#014f5b',
            cancelButtonColor: 'default',
            cancelButtonText: '{{translate("No")}}',
            confirmButtonText: '{{translate("Yes")}}',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    data: {
                        status: status
                    },
                    success: function (data, status) {
                        toastr.success("{{translate('Status changed successfully')}}");
                    },
                    error: function (data) {
                        toastr.error("{{translate('Status changed failed')}}");
                    }
                });
            }
            else if (result.dismiss) {
                if (status == 1) {
                    $(t).prop('checked', false);
                } else if (status == 0) {
                    $(t).prop('checked', true);
                }
                toastr.info("{{translate("Status has not changed")}}");
            }
        });
    }

    $(document).on('ready', function () {
        $('.js-toggle-password').each(function () {
            new HSTogglePassword(this).init()
        });

        $('.js-validate').each(function () {
            $.HSCore.components.HSValidation.init($(this));
        });
    });

    $('.update-business-setting-status').on('change', function () {
        updateBusinessSettingLevel(this)
    })

    //change business setting status
    function updateBusinessSettingLevel(obj) {

        let url = $(obj).data('url');
        let iconContent = $(obj).data('icon');
        let titleContent = $(obj).data('title');
        let subTitleContent = $(obj).data('sub-title');
        let confirmBtnContent = $(obj).data('confirm-btn');
        let cancelBtnContent = $(obj).data('cancel-btn');


        let value = $(obj).prop('checked') === true ? 1 : 0;
        let name = $(obj).data('name');
        let checked = $(obj).prop("checked");
        let status = checked === true ? 1 : 0;

        // Show custom modal
        const modalElement = document.getElementById('customModal');
        let bootstrapModal = new bootstrap.Modal(modalElement);
        bootstrapModal.show();


        if (iconContent) {
            $("#icon").attr('src', iconContent);
        }
        if (titleContent) {
            $("#modalTitle").html(titleContent);
        }
        if (subTitleContent) {
            $("#subTitle").html(subTitleContent);
        }
        if (confirmBtnContent) {
            $("#modalConfirmBtn").html(confirmBtnContent);
        }
        if (cancelBtnContent) {
            $("#modalCancelBtn").html(cancelBtnContent);
        }

        let confirmBtn = document.getElementById("modalConfirmBtn");
        let cancelBtn = document.getElementById("modalCancelBtn");


        // // When the user clicks on OK button
        confirmBtn.onclick = function () {
            $.ajax({
                url: url,
                data: {value: value, name: name},
                success: function () {
                    toastr.success("{{ translate('status_changed_successfully') }}");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                },
                error: function () {
                    resetCheckbox();
                    toastr.error("{{ translate('status_change_failed') }}");
                }
            });
            bootstrapModal.hide();
        }

        // When the user clicks on Cancel button
        cancelBtn.onclick = function () {
            bootstrapModal.hide();
            resetCheckbox();
        }
        modalElement.addEventListener('hidden.bs.modal', function () {
            resetCheckbox();
        });

        function resetCheckbox() {
            if (status === 1) {
                $('#' + obj.id).prop('checked', false);
            } else if (status === 0) {
                $('#' + obj.id).prop('checked', true);
            }
        }
    }
    function customDelete(event){
        let blogDeleteUrl = event.data('url');
        let blogTitle = event.data('title');
        let blogSubTitle = event.data('subTitle');

        // Set the category ID in a global variable or pass it directly during confirmation
        $('#customConfirmDeleteBtn').data('url', blogDeleteUrl);
        $('#customDeleteTitle').html( blogTitle);
        $('#customDeleteSubtitle').html(blogSubTitle);
    }

    $(document).on('click','#customConfirmDeleteBtn', function () {
        let blogUrl = $(this).data('url');
        $.ajax({
            url: blogUrl,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                $('#customDeleteModal').modal('hide');

                toastr.success(response.message);

                setTimeout(function () {
                    location.reload();
                }, 1000);

            },
            error: function (xhr) {
                $('#customDeleteModal').modal('hide');
                toastr.error('Failed to delete.');
            }
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

    function call_demo() {
        toastr.info('This option is disabled for demo!', {
            CloseButton: true,
            ProgressBar: true
        });
    }
    $('.demo-form-submit').click(function() {
        if ('{{ env('APP_MODE') }}' == 'demo') {
            call_demo();
        }
    });
</script>

<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="{{dynamicAsset(path: 'public/assets/admin')}}/vendor/babel-polyfill/polyfill.min.js"><\/script>');
</script>

<script>

    var initialImages = [];
    $(window).on('load', function() {
        $("form").find('img').each(function (index, value) {
            initialImages.push(value.src);
        })
    })

    $(document).ready(function() {
        $('form').on('reset', function(e) {
            $("form").find('img').each(function (index, value) {
                $(value).attr('src', initialImages[index]);
            });

            $(this).find('.upload-file').each(function() {
                var card = $(this);
                var input = card.find('.upload-file__input');
                var textbox = card.find('.upload-file__textbox');
                var imgElement = card.find('.upload-file__img__img');
                var removeIcon = card.find('.remove-img-icon');

                input.val('');

                if (!imgElement.attr('src')) {
                    textbox.show();
                    imgElement.hide();
                    removeIcon.addClass('d-none');
                    card.removeClass('active');
                } else {
                    textbox.hide();
                    imgElement.show();
                    removeIcon.removeClass('d-none');
                }
            });
        })
    });
</script>
</body>
</html>
