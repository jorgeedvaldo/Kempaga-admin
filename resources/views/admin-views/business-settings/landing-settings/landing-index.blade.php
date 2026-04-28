@extends('layouts.admin.app')

@section('title', translate('landing page settings'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex align-items-center gap-3 pb-2">
            <img width="24" src="{{ dynamicAsset(path: 'public/assets/admin/img/media/business-setup.png') }}"
                 alt="{{ translate('business_setup') }}">
            <h2 class="page-header-title">{{ translate('Landing_Page_Setup') }}</h2>
        </div>

        <div class="inline-page-menu my-4">
            @include('admin-views.business-settings.landing-settings.partial._landing-setup-tabs')
        </div>
        @include('admin-views.business-settings.landing-settings.partial._landing-intro-section')

        @include('admin-views.business-settings.landing-settings.partial._landing-feature')
        @php($feature = isset($data->value) ? json_decode($data->value, true) : null)

        @include('admin-views.business-settings.landing-settings.partial._landing-screenshots')
        @php($screenshots = isset($data->value) ? json_decode($data->value, true) : null)

        <?php
        if (is_array($screenshots)) {
            $screenshots = array_reverse($screenshots);
        }
        ?>
        @include('admin-views.business-settings.landing-settings.partial._landing-choose-us')
        @php($why_choose_us = isset($data->value) ? json_decode($data->value, true) : null)

        @include('admin-views.business-settings.landing-settings.partial._landing-agent-reg')
        @php($agent_registration = isset($data->value) ? json_decode($data->value, true) : null)

        @include('admin-views.business-settings.landing-settings.partial._landing-how-it-works')
        @php($how_it_works = isset($data->value) ? json_decode($data->value, true) : null)

        @include('admin-views.business-settings.landing-settings.partial._landing-app-download')
        @php($download = isset($data->value) ? json_decode($data->value, true) : null)

        @include('admin-views.business-settings.landing-settings.partial._landing-business-statistics')
        @php($business_download = isset($businessStatsDownloadData->value) ? json_decode($businessStatsDownloadData->value, true) : null)
        @php($testimonial = isset($testimonialData->value) ? json_decode($testimonialData->value, true) : null)


        @include('admin-views.business-settings.landing-settings.partial._landing-contact-us')
        @php($contact_us = isset($data->value) ? json_decode($data->value, true) : null)

    </div>
    <!-- Notes View Modal -->
    <div class="modal fade" id="notes-view-modal" tabindex="-1" aria-labelledby="notes-view-modalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close fs-28" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center mb-4">
                        <img width="58" src="{{ dynamicAsset(path: 'public/assets/landing/img/media/notes.png') }}"
                             alt="{{ translate('image') }}">
                    </div>

                    <h5 class="mb-3">{{ translate('For Title and Headline') }} </h5>

                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li>{{ translate('1. To include a text color just use  ** around the text **  you want to use colour') }}
                        </li>
                        <li>{{ translate('2. To include a text background just use  ## around the text ##  you want to use background colour') }}
                        </li>
                        <li>{{ translate('3. To include a text bold just use  @@ around the text @@  you want to use bold') }}
                        </li>
                        <li>{{ translate('4. If you want to break the line just use  %%  from where you want to break') }}
                        </li>
                    </ul>

                    <div class="d-flex justify-content-center mt-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">{{ translate('Choose') }} <span
                                        class="bg-primary text-white">{{ Helpers::get_business_settings('business_name') }}</span>
                                    for <br>{{ translate('Secure And Convenient Digital Payments') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script_2')
    <script>
        "use strict";

        $('#landing-info-update-form').on('submit', function (event) {
            event.preventDefault();

            var form = $('#landing-info-update-form')[0];
            var formData = new FormData(form);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.landing-settings.set-landing-information') }}?web_page={{ $webPage }}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (response) {
                    if (response.errors.length > 0) {
                        response.errors.forEach((value, key) => {
                            toastr.error(value.message);
                        });
                    } else {
                        toastr.success('{{ translate('successfully_updated') }}');
                        setTimeout(() => {
                            location.reload()
                        }, 1000);
                    }
                },
                error: function (jqXHR, exception) {
                    toastr.error(jqXHR.responseJSON.message);
                }
            });
        });

        $('#landing-info-update-form2').on('submit', function (event) {
            event.preventDefault();

            var form = $('#landing-info-update-form2')[0];
            var formData = new FormData(form);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.landing-settings.set-landing-information') }}?web_page={{ $webPage }}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (response) {
                    if (response.errors.length > 0) {
                        response.errors.forEach((value, key) => {
                            toastr.error(value.message);
                        });
                    } else {
                        toastr.success('{{ translate('successfully_updated') }}');
                        setTimeout(() => {
                            location.reload()
                        }, 1000);
                    }
                },
                error: function (jqXHR, exception) {
                    toastr.error(jqXHR.responseJSON.message);
                }
            });
        });

        $('#landing-info-update-form3').on('submit', function (event) {
            event.preventDefault();

            var form = $('#landing-info-update-form3')[0];
            var formData = new FormData(form);
            // Set header if need any otherwise remove setup part
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.landing-settings.set-landing-information') }}?web_page={{ $webPage }}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (response) {
                    if (response.errors.length > 0) {
                        response.errors.forEach((value, key) => {
                            toastr.error(value.message);
                        });
                    } else {
                        toastr.success('{{ translate('successfully_updated') }}');
                        setTimeout(() => {
                            location.reload()
                        }, 1000);
                    }
                },
                error: function (jqXHR, exception) {
                    toastr.error(jqXHR.responseJSON.message);
                }
            });
        });

        $('#landing-info-update-form4').on('submit', function (event) {
            event.preventDefault();

            var form = $('#landing-info-update-form4')[0];
            var formData = new FormData(form);

            // Set header if need any otherwise remove setup part
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.landing-settings.set-landing-information') }}?web_page={{ $webPage }}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (response) {
                    if (response.errors.length > 0) {
                        response.errors.forEach((value, key) => {
                            toastr.error(value.message);
                        });
                    } else {
                        toastr.success('{{ translate('successfully_updated') }}');
                        setTimeout(() => {
                            location.reload()
                        }, 1000);
                    }
                },
                error: function (jqXHR, exception) {
                    toastr.error(jqXHR.responseJSON.message);
                }
            });
        });

        $('#landing-info-update-form-rating').on('submit', function (event) {
            event.preventDefault();

            var form = $('#landing-info-update-form-rating')[0];
            var formData = new FormData(form);
            // Set header if need any otherwise remove setup part
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.landing-settings.set-landing-information') }}?web_page={{ $webPage }}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (response) {
                    if (response.errors.length > 0) {
                        response.errors.forEach((value, key) => {
                            toastr.error(value.message);
                        });
                    } else {
                        toastr.success('{{ translate('successfully_updated') }}');
                        setTimeout(() => {
                            location.reload()
                        }, 1000);
                    }
                },
                error: function (jqXHR, exception) {
                    toastr.error(jqXHR.responseJSON.message);
                }
            });
        });

        $('#landing-info-title-status-form').on('submit', function (event) {
            event.preventDefault();

            var form = $('#landing-info-title-status-form')[0];
            var formData = new FormData(form);
            // Set header if need any otherwise remove setup part
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.landing-settings.set-landing-title-status') }}?web_page={{ $webPage }}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (response) {
                    if (response.errors.length > 0) {
                        response.errors.forEach((value, key) => {
                            toastr.error(value.message);
                        });
                    } else {
                        toastr.success('{{ translate('successfully_updated') }}');
                        setTimeout(() => {
                            location.reload()
                        }, 1000);
                    }
                },
                error: function (jqXHR, exception) {
                    toastr.error(jqXHR.responseJSON.message);
                }
            });
        });

        function readURLCustom(input, view_id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#' + view_id).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            readURLCustom(this, 'viewer1');
        });

        $("#customFileEg2").change(function () {
            readURLCustom(this, 'middle_image_id');
        });

        $("#customFileEg3").change(function () {
            readURLCustom(this, 'viewer3');
        });

        $("#customFileEg4").change(function () {
            readURLCustom(this, 'viewer4');
        });

        $("#customFileEg5").change(function () {
            readURLCustom(this, 'viewer5');
        });

        $("#customFileEg6").change(function () {
            readURLCustom(this, 'viewer6');
        });

        $("#customFileEg7").change(function () {
            readURLCustom(this, 'viewer7');
        });

        $("#customFileEg8").change(function () {
            readURLCustom(this, 'viewer8');
        });
    </script>

    <script>
            //feature
            $(document).on("click",".edit-feature", function () {
                var key = $(this).data("key");

                var featureData = @json($feature ?? []);

                var selectedFeature = featureData[key];

                if (selectedFeature) {
                    $("#title").val(selectedFeature.title);
                    $("#sub_title").val(selectedFeature.sub_title);

                    setSafeImage(
                        "#viewer3",
                        "{{ dynamicStorage(path: 'storage/app/public/landing-page/feature') }}/" + selectedFeature.image,
                        "{{ dynamicAsset(path: 'public/assets/admin/img/900x400/img1.jpg') }}"
                    );


                    if ($("#id").length === 0) {
                        $("<input>")
                            .attr("type", "hidden")
                            .attr("id", "id")
                            .attr("name", "id")
                            .appendTo("#landing-info-update-form");
                    }

                    $("#id").val(selectedFeature.id);

                    $("html, body").animate({
                        scrollTop: $("#landing-info-update-form").offset().top
                    }, 500);
                }
            });

            //why choose us
            $(document).on("click",".edit-why-choose-us", function () {
                var key = $(this).data("key");
                var chooseUsData = @json($why_choose_us ?? []);

                var selectedChooseUs = chooseUsData[key];
                console.log(chooseUsData)

                if (selectedChooseUs) {

                    $("#title").val(selectedChooseUs.title);
                    $("#sub_title").val(selectedChooseUs.sub_title);

                    setSafeImage(
                        "#viewer3",
                        "{{ dynamicStorage(path: 'storage/app/public/landing-page/why-choose-us') }}/" + selectedChooseUs.image,
                        "{{ dynamicAsset(path: 'public/assets/admin/img/900x400/img1.jpg') }}"
                    );

                    if ($("#id").length === 0) {
                        $("<input>")
                            .attr("type", "hidden")
                            .attr("id", "id")
                            .attr("name", "id")
                            .appendTo("#landing-info-update-form");
                    }

                    $("#id").val(selectedChooseUs.id);

                    $("html, body").animate({
                        scrollTop: $("#landing-info-update-form").offset().top
                    }, 500);
                }
            });

            //How it works
            $(document).on("click",".edit-how-it-works", function () {
                var key = $(this).data("key");
                var worksData = @json($how_it_works ?? []);

                var selectedWorks = worksData[key];

                if (selectedWorks) {

                    $("#title").val(selectedWorks.title);
                    $("#sub_title").val(selectedWorks.sub_title);

                    setSafeImage(
                        "#viewer3",
                        "{{ dynamicStorage(path: 'storage/app/public/landing-page/how-it-works') }}/" + selectedWorks.image,
                        "{{ dynamicAsset(path: 'public/assets/admin/img/900x400/img1.jpg') }}"
                    );

                    if ($("#id").length === 0) {
                        $("<input>")
                            .attr("type", "hidden")
                            .attr("id", "id")
                            .attr("name", "id")
                            .appendTo("#landing-info-update-form");
                    }

                    $("#id").val(selectedWorks.id);

                    $("html, body").animate({
                        scrollTop: $("#landing-info-update-form").offset().top
                    }, 500);
                }
            });

            //Testimonial
            $(document).on("click",".edit-testimonial", function () {
                var key = $(this).data("key");
                var worksData = @json($testimonial ?? []);

                console.log(worksData)

                var selectedTestimonial = worksData[key];

                if (selectedTestimonial) {

                    $("#rating").val(selectedTestimonial.rating);
                    $('#rating').val(selectedTestimonial.rating).trigger('change');
                    $("#name").val(selectedTestimonial.name);
                    $("#opinion").val(selectedTestimonial.opinion);
                    $("#user_type").val(selectedTestimonial.user_type);

                    setSafeImage(
                        "#viewer3",
                        "{{ dynamicStorage(path: 'storage/app/public/landing-page/testimonial') }}/" + selectedTestimonial.image,
                        "{{ dynamicAsset(path: 'public/assets/admin/img/900x400/img1.jpg') }}"
                    );

                    if ($("#id").length === 0) {
                        $("<input>")
                            .attr("type", "hidden")
                            .attr("id", "id")
                            .attr("name", "id")
                            .appendTo("#landing-info-update-form2");
                    }

                    $("#id").val(selectedTestimonial.id);

                    $("html, body").animate({
                        scrollTop: $("#landing-info-update-form2").offset().top
                    }, 500);
                }
            });

        // screenshot image preview modal
        $('.ss-img-preview').on('click', function () {
            const imgPath = this.src;
            const fileName = imgPath.split('/').pop();
            const previewImg = $('#preview-image');
            const imgName = $('.img_name');

            previewImg.attr('src', imgPath);
            imgName.text(fileName);

            $('#imagePreviewModal').modal('show');
        });

        // screenshot edit image viewer
        $(document).on('click', '.edit-screenshots', function (e) {
            e.preventDefault();

            const id = $(this).data('id');
            const imageUrl = $(this).data('img');
            const $wrapper = $('.upload-file.new');
            const $img = $wrapper.find('.upload-file__img__img');
            const $input = $wrapper.find('.upload-file__input');
            const $textBox = $wrapper.find('.upload-file__textbox');
            const existingImageId = $wrapper.find('#existing_image_id');

            $input.removeAttr('required');
            $img.attr('src', imageUrl).show();
            $img.data('original-src', imageUrl);

            $textBox.hide();
            $wrapper.addClass('active');
            existingImageId.val(id);

            $("html, body").animate({
                scrollTop: $('#landing_page_screenshot_image_section').offset().top
            }, 500);
        });

        $(document).on('click', '.upload-file__reset-btn', function (e) {
            e.preventDefault();
            const $wrapper = $('.upload-file.new');
            const $input = $wrapper.find('.upload-file__input');
            const $img = $wrapper.find('.upload-file__img__img');
            const $textBox = $wrapper.find('.upload-file__textbox');
            const existingImageSrc = $img.data('original-src');

            $input.val('');
            $input.attr('required', !existingImageSrc);

            if (existingImageSrc && existingImageSrc.trim() !== '') {
                $img.attr('src', existingImageSrc).show();
                $textBox.hide();
            } else {
                $img.attr('src', '').hide();
                $textBox.show();
                $wrapper.removeClass('active');
            }
        });

            /**
             * Safely sets an image source with automatic fallback handling.
             *
             * @param {string|HTMLElement|jQuery} element - The image element or selector.
             * @param {string} imagePath - The main image path to try loading.
             * @param {string} fallbackPath - The default image if main path fails.
             */
            function setSafeImage(element, imagePath, fallbackPath) {
                const $el = $(element);

                // Prevent duplicate error handler binding
                $el.off('error.setSafeImage').on('error.setSafeImage', function() {
                    if ($(this).attr('src') !== fallbackPath) {
                        $(this).attr('src', fallbackPath);
                    }
                });

                // Attempt to load main image
                $el.attr('src', imagePath);
            }

    </script>
    <script src="{{ dynamicAsset(path: 'public/assets/admin/js/image-upload.js') }}"></script>
@endpush
