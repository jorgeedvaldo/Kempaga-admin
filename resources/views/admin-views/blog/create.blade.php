@extends('layouts.admin.app')

@section('title', translate('Blog Setup'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex justify-content-between gap-2 align-items-center flex-wrap">
            <div class="d-flex flex-wrap align-items-center gap-3 pb-2">
                <img width="24" src="{{dynamicAsset(path: 'public/assets/admin/img/media/blog.png')}}"
                     alt="{{ translate('business_setup') }}">
                <h2 class="page-header-title">{{translate('Create New Blog')}}</h2>
            </div>
        </div>

        <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data" id="blog-form">
            @csrf
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="d-flex gap-2 align-items-baseline justify-content-between">
                                    <label class="input-label">
                                        {{ translate('category') }}
                                        <i class="tio-info-outined cursor-pointer" data-toggle="tooltip" data-placement="top" title="{{ translate('Select a category from the dropdown menu to assign this blog. If no categories are available or want to add a new category, please add it from the Manage Category section.') }}"></i>
                                    </label>
                                    <button type="button" class="btn btn-link text-decoration-underline p-0"
                                            data-toggle="offcanvas">
                                        <i class="tio-add"></i>
                                        {{ translate('manage_Category') }}
                                    </button>
                                </div>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="" selected disabled>{{ translate('Select Category') }}</option>
                                    @foreach($categories->where('status', 1) as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="input-label">{{ translate('writer') }}</label>
                                <input type="text" name="writer" class="form-control" value="{{ old('writer') }}"
                                       placeholder="Ex: John Milar" maxlength="50">
                            </div>
                            <div class="form-group">
                                <label class="input-label">{{ translate('publish_Date') }}</label>
                                <input type="date" name="publish_date" class="form-control"
                                       value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <label class="text-dark mb-0">{{ translate('Thumbnail') }}<span class="text-danger"> *</span></label>

                                    <p class="mx-w180">{{ implode(', ', array_column(IMAGE_EXTENSIONS, 'key')) }} : Max {{ readableUploadMaxFileSize('image') }}
                                        <strong>({{ translate('Ratio') }} 2:1)</strong>
                                    </p>
                                    <div class="upload-file new auto profile-image-upload-file">
                                        <!-- Edit -->
                                        <button type="button"
                                                class="upload-file__edit-btn btn rounded-circle btn-outline-primary"
                                                aria-label="add file">
                                            <i class="tio-edit"></i>
                                        </button>
                                        <!-- Edit End -->
                                        <input type="file" name="image" class="upload-file__input"
                                               accept=".{{ implode(',.', array_column(IMAGE_EXTENSIONS, 'key')) }}"
                                               data-maxFileSize="{{ readableUploadMaxFileSize('image') }}"
                                               required>
                                        <div
                                            class="upload-file__img banner border-gray d-flex justify-content-center align-items-center mw-100 w-360 h-180 p-0 bg-light">
                                            <div class="upload-file__textbox text-center">
                                                <img height="34"
                                                     src="{{dynamicAsset(path: 'public/assets/admin/img/upload.svg')}}"
                                                     alt="" class="svg ratio-2">
                                                <h6 class="mt-2 fw-semibold">
                                                    <span class="text-info">{{ translate('Click to upload') }}</span>
                                                    <br>
                                                    {{ translate('or drag and drop') }}
                                                </h6>
                                            </div>
                                            <img class="upload-file__img__img h-100 ratio-2" width="180" height="180"
                                                 loading="lazy" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 p-4 bg-soft-secondary rounded">

                        <div class="form-group">
                            <label class="input-label" for="title">{{translate('title')}}<span
                                    class="text-danger"> *</span></label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                                   placeholder="{{translate('title')}}" maxlength="255" required>
                        </div>

                        <div class="">
                            <label class="input-label" for="title">{{translate('description')}}<span
                                    class="text-danger"> *</span></label>
                            <div id="editor"
                                 class="min-h200 bg-white"></div>
                            <textarea class="editor form-control d-none" name="description" id="hiddenArea"></textarea>
                        </div>
                    </div>

                    <!-- Hidden input fields to store status and draft -->
                    <input type="hidden" name="status" id="status" value="1"> <!-- Default status -->
                    <input type="hidden" name="is_draft" id="is_draft" value="0"> <!-- Default draft -->

                    <div class="d-flex justify-content-end gap-3 mt-3 flex-wrap">
                        <button type="reset" class="btn btn-secondary"><i class="fa fa-repeat mr-1"
                                                                          aria-hidden="true"></i>{{ translate('reset') }}
                        </button>
                        <button type="button" class="btn btn-outline-primary demo-form-submit save-draft"><i
                                class="fa fa-save mr-1" aria-hidden="true"></i> {{ translate('Save_to_Draft') }}
                        </button>
                        <button type="submit" class="btn btn-primary demo-form-submit publish"><i
                                class="fa fa-check-circle-o mr-1" aria-hidden="true"></i>{{ translate('publish') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>

        @include('admin-views.blog.category.index')
    </div>

@endsection

@push('script_2')
    <script src="{{dynamicAsset(path: 'public/assets/admin/js/image-upload.js')}}"></script>
    <script src="{{ dynamicAsset(path: 'public/assets/admin/js/quill-editor.js') }}"></script>

    <script>

        $(document).ready(function () {
            var bn_quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                        ['blockquote', 'code-block'],
                        ['link', 'image', 'video', 'formula'],

                        [{'header': 1}, {'header': 2}],               // custom button values
                        [{'list': 'ordered'}, {'list': 'bullet'}, {'list': 'check'}],
                        [{'script': 'sub'}, {'script': 'super'}],      // superscript/subscript
                        [{'indent': '-1'}, {'indent': '+1'}],          // outdent/indent
                        [{'direction': 'rtl'}],                         // text direction

                        [{'size': ['small', false, 'large', 'huge']}],  // custom dropdown
                        [{'header': [1, 2, 3, 4, 5, 6, false]}],

                        [{'color': []}, {'background': []}],          // dropdown with defaults from theme
                        [{'font': []}],
                        [{'align': []}],

                        ['clean']
                    ]
                }
            });

            $('#blog-form').on('submit', function () {
                var myEditor = document.querySelector('#editor');
                $('#hiddenArea').val(myEditor.children[0].innerHTML);
            });
        });


        $(function () {
            'use strict'

            $('[data-toggle="offcanvas"]').on('click', function () {
                $('body').append('<div class="offcanvas-overlay-index active"></div>')
                $('.offcanvas-collapse').toggleClass('open')
            });
            $('body').on('click', '.offcanvas-overlay-index, .offcanvas-close', function () {
                $('body').find('.offcanvas-overlay-index').remove();
                $('.offcanvas-collapse').removeClass('open')
            });
        })

        // add category
        $('#categoryForm').on('submit', function (e) {
            e.preventDefault();

            $('#datatableSearch').val('');
            let form = $(this);
            let formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    form[0].reset();
                    toastr.success(response.message);

                    $('table tbody').html(response.html);

                    let countCategory = $('.category-count');
                    countCategory.text(response.count);
                },
                error: function (response) {
                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        Object.keys(errors).forEach(function (key) {
                            toastr.error(errors[key][0]); // Show each validation error
                        });
                    } else {
                        toastr.error(response.responseJSON.message || 'Something went wrong!');
                    }
                }
            });
        });
        $('#updateCategoryForm').on('submit', function (e) {
            e.preventDefault();

            $('#datatableSearch').val('');
            let formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    $('#editModal').modal('hide');

                    toastr.success(response.message);

                    $('table tbody').html(response.html);

                    let countCategory = $('.category-count');
                    countCategory.text(response.count);
                },
                error: function (response) {
                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        Object.keys(errors).forEach(function (key) {
                            toastr.error(errors[key][0]); // Show each validation error
                        });
                    } else {
                        toastr.error(response.responseJSON.message || 'Something went wrong!');
                    }
                }
            });
        });

        // delete category
        $(document).on('click', '.delete-category-btn', function () {
            let categoryId = $(this).data('id');
            // Set the category ID in a global variable or pass it directly during confirmation
            $('#confirmDelete').data('id', categoryId);
        });

        $(document).on('click', '#confirmDelete', function () {
            let categoryId = $(this).data('id');
            let searchQuery = $('#datatableSearch').val();
            let url = '{{ route("admin.blog.category.delete", ":id") }}';
            url = url.replace(':id', categoryId);

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    search: searchQuery,
                },
                success: function (response) {
                    $('#deleteModal').modal('hide');
                    toastr.success(response.message);
                    $('table tbody').html(response.html);
                    $('.category-count').text(response.count);
                },
                error: function (xhr, status, error) {
                    $('#deleteModal').modal('hide');
                    toastr.error('Failed to delete the category.');
                }

            });
        });

        //edit category
        $(document).on('click', '.edit-category-btn', function () {
            let updateCategoryName = $(this).data('name');
            let categoryUpdateUrl = $(this).data('url');

            $('#updateCategoryName').val(updateCategoryName);
            $("#updateCategoryForm").attr('action', categoryUpdateUrl);
            $('#updateCategoryName').data('original', updateCategoryName);

        });

        $(document).on('reset', '#updateCategoryForm', function (e) {
            e.preventDefault(); // prevent default reset behavior (which clears the form)

            // Restore original data
            let input = $('#updateCategoryName');
            let originalValue = input.data('original');

            input.val(originalValue);
        });

        // search category
        let debounceTimer;
        $('.datatable-search').on('input paste cut keyup change click', function () {

            clearTimeout(debounceTimer);
            let searchQuery = $("input[name='search']").val();

            debounceTimer = setTimeout(function () {
                $.ajax({
                    url: '{{ route("admin.blog.category.search") }}',
                    method: 'GET',
                    data: {search: searchQuery},
                    beforeSend: function () {
                        $('#offcanvasLoader').fadeIn(100);
                    },
                    success: function (response) {
                        $('table tbody').html(response.html);

                        let countCategory = $('.category-count');
                        countCategory.text(response.count);
                    },
                    error: function () {
                        toastr.error('Failed to fetch categories!');
                    },
                    complete: function () {
                        $('#offcanvasLoader').fadeOut(100);

                    }
                });
            }, 300); // Wait for 300ms before triggering the request
        });



        $(document).ready(function () {
            // Handle save to draft button
            $('.save-draft').on('click', function () {
                $('#status').val(0); // Set status to 0 for drafts
                $('#is_draft').val(1); // Mark as draft
                $('#blog-form').submit(); // Submit the form
            });

            // Handle publish button
            $('.publish').on('click', function () {
                $('#status').val(1); // Set status to 1 for published
                $('#is_draft').val(0); // Ensure it's not a draft
                $('#blog-form').submit(); // Submit the form
            });
        });

        //Status change
        $(document).on('change', '.change-category-status', function () {
            handleCategoryStatusChange(this);
        });

        function handleCategoryStatusChange(checkboxEl) {
            const $checkbox = $(checkboxEl);
            const categoryStatusUrl = $checkbox.data('url');
            const $modal = $('#categoryStatusModal');

            if (!categoryStatusUrl || !$modal.length) {
                console.warn('Missing URL or modal element.');
                $checkbox.prop('checked', !$checkbox.prop('checked'));
                return;
            }

            const isChecked = $checkbox.prop('checked');
            const prevChecked = !isChecked;
            let confirmed = false;

            // Cache modal elements
            const $icon = $('#icon');
            const $title = $('#modalTitle');
            const $subTitle = $('#subTitle');
            const $confirmBtn = $('#modalConfirmBtn');
            const $cancelBtn = $('#modalCancelBtn');

            // Fill modal content
            $icon.attr('src', $checkbox.data('icon') || '');
            $title.text($checkbox.data('title') || '');
            $subTitle.text($checkbox.data('sub-title') || '');
            $confirmBtn.text($checkbox.data('confirm-btn') || 'Yes');
            $cancelBtn.text($checkbox.data('cancel-btn') || 'Cancel');

            // Show modal (Bootstrap 5 native OR Bootstrap 4 jQuery)
            let bsModal = null;
            try {
                if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    // ✅ Bootstrap 5+
                    const modalEl = $modal.get(0);
                    bsModal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl, {
                        backdrop: true,
                        keyboard: true
                    });
                    bsModal.show();
                } else {
                    // ✅ Bootstrap 4 fallback
                    $modal.modal({ backdrop: true, keyboard: true }).modal('show');
                }
            } catch (e) {
                $modal.modal('show');
            }

            // Handle confirm
            $confirmBtn.off('.statusChange').on('click.statusChange', function () {
                $confirmBtn.prop('disabled', true);
                $cancelBtn.prop('disabled', true);

                $.ajax({
                    url: categoryStatusUrl,
                    method: 'GET', // change if needed
                    data: { status: isChecked ? 1 : 0 },
                    success(response) {
                        confirmed = true;
                        if (response.html) $('table tbody').html(response.html);
                        toastr.success(response.message || 'Status updated');
                    },
                    error(xhr) {
                        toastr.error(xhr.responseJSON?.message || 'Status change failed');
                        $checkbox.prop('checked', prevChecked);
                    },
                    complete() {
                        $confirmBtn.prop('disabled', false);
                        $cancelBtn.prop('disabled', false);
                        if (bsModal && bsModal.hide) bsModal.hide();
                        else $modal.modal('hide');
                    }
                });
            });

            // Handle cancel
            $cancelBtn.off('.statusChange').on('click.statusChange', function () {
                $checkbox.prop('checked', prevChecked);
                if (bsModal && bsModal.hide) bsModal.hide();
                else $modal.modal('hide');
            });

            // Revert if modal closed without confirmation
            $modal.one('hidden.bs.modal', function () {
                if (!confirmed) $checkbox.prop('checked', prevChecked);
            });
        }


    </script>

@endpush
