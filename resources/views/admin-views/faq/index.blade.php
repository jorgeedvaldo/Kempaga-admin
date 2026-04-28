@extends('layouts.admin.app')

@section('title', translate('FAQ Setup'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between gap-2 align-items-center flex-wrap">
            <div class="d-flex align-items-center gap-3 pb-2">
                <img width="24" src="{{dynamicAsset(path: 'public/assets/admin/img/media/faq.svg')}}" alt="{{ translate('business_setup') }}">
                <h2 class="page-header-title">{{translate('FAQ')}}</h2>
            </div>
           <div class="d-flex flex-wrap gap-3">
               <button type="button" class="btn btn-outline-primary d-flex gap-2 align-items-center" data-toggle="modal" data-target="#section-view-modal">
                   {{ translate('Section_View') }}
                   <i class="tio-document-text"></i>
               </button>
               <button type="button" class="btn btn-outline-primary d-flex gap-2 align-items-center" data-toggle="modal" data-target="#notes-view-modal">
                   {{ translate('Notes') }}
                   <i class="tio-info"></i>
               </button>
           </div>
        </div>

        <div class="inline-page-menu my-4">
            <ul class="list-unstyled">
                <li class="active"><a href="{{route('admin.faq.index')}}">{{translate('FAQ Page Setup')}}</a></li>
                <li class=""><a href="{{route('admin.faq.download')}}">{{translate('Download Button')}}</a></li>
                <li class=""><a href="{{route('admin.faq.priority')}}">{{translate('Priority Setup')}}</a></li>
            </ul>

        </div>
        @php($faqStatus = \App\CentralLogics\helpers::get_business_settings('faq_section_status'))
        <div class="bg-white shadow rounded px-3 py-2 h--45px text-center d-flex align-items-center justify-content-between">
                <span class="text-dark">
                    <i class="tio-calendar"></i>
                    <strong>{{ translate('faq_section') }}</strong>
                    <i class="tio-info-outined cursor-pointer" data-toggle="tooltip" data-placement="top" title="{{ translate('Enabling this option will make the faq section visible on the both landing website and app for viewers') }}"></i>
                </span>
            <label class="toggle-switch toggle-switch-sm">
                <input class="toggle-switch-input update-business-setting-status"
                       id="faq_section_status" type="checkbox"
                       name="faq_section_status"
                       data-name="faq_section_status"
                       data-url="{{ route('admin.business-settings.update-business-setting-status') }}"
                       data-icon="{{ dynamicAsset(path: 'public/assets/admin/svg/components/info.svg')}}"
                       data-title="{{ ($faqStatus ?? 0) == 1 ? translate('Are you sure to turn off the FAQ Status?') . '? ' : translate('Are you sure to turn on the FAQ Status') . '? ' }}"
                       data-sub-title="{{ ($faqStatus ?? 0) == 1 ? translate('Once you turn off this FAQ, It will not be visible to the FAQ list for users.') : translate('Once you turn on this FAQ, It will be visible to the FAQ list for users.') }}"
                       data-confirm-btn="{{ ($faqStatus ?? 0) == 1 ? translate('Yes, Off') : translate('Yes, On') }}"
                        {{ isset($faqStatus) && $faqStatus == 1 ? 'checked' : '' }}>
                <span class="toggle-switch-label text p-0">
                    <span class="toggle-switch-indicator"></span>
                </span>
            </label>
        </div>


        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0 text-capitalize d-flex align-items-center gap-1">
                    <i class="tio-browser-window"></i>
                    {{translate('Intro_Section')}}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.business-settings.update-business-setting-data') }}" method="post">
                    @csrf

                    @php($faqTitle = \App\CentralLogics\helpers::get_business_settings('faq_intro_title'))
                    <div class="form-group">
                        <label class="input-label text-capitalize d-flex flex-wrap align-items-center column-gap-2" for="title">{{ translate('title') }}</label>
                        <input type="text" name="faq_intro_title" class="form-control" id="faq_intro_title" value="{{ $faqTitle }}" placeholder="{{ translate('Enter Title') }}" maxlength="255" required>
                        <small id="faq_intro_title_count" class="text-muted">0/255 characters</small>
                    </div>

                    @php($faqSubTitle = \App\CentralLogics\helpers::get_business_settings('faq_intro_subtitle'))
                    <div class="form-group">
                        <label class="input-label text-capitalize d-flex flex-wrap align-items-center column-gap-2" for="sub_title">{{ translate('sub_title') }}</label>
                        <textarea name="faq_intro_subtitle" id="faq_intro_subtitle" class="form-control" rows="3" placeholder="{{ translate('Enter SUb Title') }}" maxlength="255" required>{{ $faqSubTitle }}</textarea>
                        <small id="faq_intro_subtitle_count" class="text-muted">0/255 characters</small>
                    </div>

                    <div class="d-flex justify-content-end gap-3">
                        <button type="reset" class="btn btn-secondary">{{translate('reset')}}</button>
                        <button type="submit" class="btn btn-primary demo-form-submit">{{translate('save')}}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0 text-capitalize d-flex align-items-center gap-1">
                    <i class="tio-browser-window"></i>
                    {{translate('FAQ Setup')}}
                </h5>
            </div>
            <div class="card-body">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="">
                                        <h4>{{ translate('Setup Question & Answer') }}</h4>
                                        <p>{{ translate('Here you can set FAQ question & answer') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="rounded-bg">
                                    <form action="{{ route('admin.faq.store') }}" method="POST" enctype="multipart/form-data" id="faq-form">
                                        @csrf
                                        <div class="form-group">
                                            <div class="d-flex gap-2 align-items-baseline justify-content-between">
                                                <label class="input-label">
                                                    {{ translate('category') }}
                                                    <i class="tio-info-outined cursor-pointer" data-toggle="tooltip" data-placement="top" title="{{ translate('Select a category from the dropdown menu to assign this FAQ. If no categories are available or want to add a new category, please add it from the Manage Category section.') }}"></i>
                                                </label>

                                                <button type="button" class="btn btn-link text-decoration-underline p-0" data-toggle="offcanvas">
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
                                            <label class="input-label" for="question">{{translate('Question')}}<span class="text-danger"> *</span></label>
                                            <textarea class="editor form-control" name="question" placeholder="{{ translate('Type question here') }}" rows="3" required>{{ old('question') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-label" for="answer">{{translate('Answer')}}<span class="text-danger"> *</span></label>
                                            <textarea class="editor form-control" name="answer" placeholder="{{ translate('Type answer here') }}" rows="5" required>{{ old('answer') }}</textarea>
                                        </div>
                                        <div class="d-flex justify-content-end gap-3 mt-3 flex-wrap">
                                            <button type="reset" class="btn btn-secondary">{{translate('reset')}}</button>
                                            <button type="submit" class="btn btn-primary demo-form-submit">{{translate('submit')}}</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('admin-views.faq.category.index')
            </div>
        </div>


        <div class="card mt-3">
            <div class="card-header __wrap-gap-10">
                <div class="d-flex align-items-center gap-2">
                    <h5 class="card-header-title">{{ translate('Question & Answer List') }}</h5>
                    <span class="badge badge-soft-secondary text-dark"> {{ $faqs->total() }}</span>
                </div>

                <div class="d-flex flex-wrap gap-3">
                    <form action="{{ url()->current() }}" method="GET">
                        <div class="input-group">
                            <input id="datatableSearch_" type="search" name="search" class="form-control mn-md-w340" placeholder="{{ translate('search by question, answer, category') }}" aria-label="Search" value="{{ request('search') }}" autocomplete="off">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">{{ translate('search') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive datatable-custom">
                <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                    <thead class="thead-light">
                        <tr>
                            <th>{{translate('SL')}}</th>
                            <th>{{translate('Id')}}</th>
                            <th>{{ translate('category') }}</th>
                            <th>{{ translate('question') }}</th>
                            <th>{{ translate('answer') }}</th>
                            <th>
                                <div class="d-flex gap-1 align-items-baseline">{{ translate('status') }}</div>
                            </th>
                            <th class="text-center">{{ translate('action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($faqs as $key => $faq)
                        <tr>
                            <td>{{$faqs->firstitem()+$key}}</td>
                            <td>{{$faq->readable_id}}</td>
                            <td>
                                <div class="{{ $faq->category_id ? ($faq->faqCategory ?  '' : 'badge badge-danger text-white p-2' ): '' }}">
                                    {{ $faq->category_id ? ($faq->faqCategory ?  $faq->faqCategory->name : translate('Category Deleted')) : '-' }}
                                </div>
                            </td>
                            <td>
                                <div class="line-clamp mx-w300">{{$faq->question}}</div>
                            </td>
                            <td>
                                <div class="line-clamp clamp-2 mx-w300">{{$faq->answer}}</div>
                            </td>

                            <td>
                                <label class="switcher">
                                    <input type="checkbox" class="switcher_input change-faq-status"
                                           data-id="{{ $faq->id }}"
                                           data-icon="{{ dynamicAsset(path: 'public/assets/admin/svg/components/info.svg')}}"
                                           data-title="{{ $faq->status == 1 ? translate('Are you sure to turn off the FAQ status') . '? ' : translate('Are you sure to turn on the FAQ status?') . '? ' }}"
                                           data-sub-title="{{ $faq->status == 1 ? translate('Once you turn off, it will not be visible to the FAQ list for users') : translate('When you turn on this FAQ, It will be visible to the FAQ list for users') }}"
                                           data-confirm-btn="{{ $faq->status == 1 ? translate('Yes, Off') : translate('Yes, On') }}"
                                           data-url="{{route('admin.faq.status',[$faq['id']])}}"

                                           {{$faq['status'] == 1 ? 'checked' : ''}}>
                                    <span class="switcher_control"></span>
                                </label>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="action-btn btn btn-outline-primary show-faq-btn" data-id="{{ $faq->id }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </button>
                                    <button class="action-btn btn btn-outline-info edit-faq-btn" data-id="{{ $faq->id }}">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>

                                    <button class="action-btn btn btn-outline-danger delete-faq-btn" data-id="{{ $faq->id }}" data-toggle="modal" data-target="#deleteFAQModal">
                                        <i class="tio-add-to-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">
                                @if(request('search'))
                                    <div class="d-flex flex-column gap-2 align-items-center py-8 px-3 rounded">
                                        <img width="44" class="mb-2" src="{{dynamicAsset(path: 'public/assets/admin/svg/components/faq.svg')}}" alt="{{ translate('unavailable') }}">
                                        <p class="text-muted">{{ translate('Search no Result found') }}</p>
                                    </div>
                                @else
                                    <div class="d-flex flex-column gap-2 align-items-center py-8 px-3 rounded">
                                        <img width="44" class="mb-2" src="{{dynamicAsset(path: 'public/assets/admin/svg/components/faq.svg')}}" alt="{{ translate('unavailable') }}">
                                        <p class="text-muted">{{ translate('Currently no FAQ available in this list') }}</p>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="table-responsive mt-4 px-3">
                <div class="d-flex justify-content-end">
                    {!! $faqs->links() !!}
                </div>
            </div>
        </div>

    </div>

    <!-- Status Change Modal -->
    <div class="modal fade" id="faqStatusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true" style="z-index: 999999">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="close fs-28" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-5 pt-0 ">
                    <div class="max-349 mx-auto">
                        <div>
                            <div class="text-center">
                                <img alt="" class="mb-4" id="icon-image"
                                     src="{{dynamicAsset(path: 'public/assets/admin-module/img/svg/blocked_customer.svg')}}">
                                <h5 class="modal-title mb-3" id="modal-title">{{translate("Are you sure?")}}</h5>
                            </div>
                            <div class="text-center mb-4 pb-2">
                                <p id="sub-title">{{translate("Want to change status")}}</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-3">
                            <button type="button" class="btn btn-secondary min-w-120" id="modal-cancel-btn">{{translate('Not Now')}}</button>
                            <button type="button" class="btn btn-primary min-w-120" id="modal-confirm-btn">{{translate('Ok')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete FAQ Confirmation Modal -->
    <div class="modal fade" id="deleteFAQModal" tabindex="-1" role="dialog" aria-labelledby="deleteFAQModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content pb-4">
                <div class="modal-header">
                    <button type="button" class="close fs-28" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center mx-350">
                    <div class="mb-3">
                        <img src="{{ dynamicAsset(path: 'public/assets/admin/svg/components/delete.svg') }}" alt="Delete Icon" style="width: 50px;">
                    </div>
                    <h4>{{ translate('Are you sure you want to delete this FAQ') }}?</h4>
                    <p class="text-muted mb-0">{{ translate('Once you delete it, this will permanently remove it from the FAQ list and can not be accessed') }}.</p>
                </div>
                <div class="d-flex justify-content-center gap-3 my-3 flex-wrap">
                    <button type="button" id="confirmFAQDelete" class="btn btn-danger">Yes, Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Not Now</button>
                </div>
            </div>
        </div>
    </div>

    <!-- edit FAQ Modal -->
    <div class="modal fade" id="editFAQModal" tabindex="-1" role="dialog" aria-labelledby="editFAQModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>

    <!-- show FAQ Modal -->
    <div class="modal fade" id="showFAQModal" tabindex="-1" role="dialog" aria-labelledby="showFAQModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>

    <!-- Section View Modal -->
    <div class="modal fade" id="section-view-modal" tabindex="-1"
         aria-labelledby="section-view-modalLabel-contact" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close fs-28" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <img width="100%" height="100%"
                             src="{{ dynamicAsset(path: 'public/assets/landing/img/section-view/section-faq.png') }}"
                             alt="{{ translate('image') }}">
                    </div>
                </div>
            </div>
        </div>
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
        // faq status change
        $('.change-faq-status').on('change', function () {
            let categoryId = $(this).data('id');
            let url = $(this).data('url');
            let iconContent = $(this).data('icon');
            let titleContent = $(this).data('title');
            let subTitleContent = $(this).data('sub-title');
            let confirmBtnContent = $(this).data('confirm-btn');
            let cancelBtnContent = $(this).data('cancel-btn');

            let checkbox = $(this);  // Store the checkbox element
            let initialStatus = checkbox.prop('checked') === true ? 0 : 1; // Store the initial status (checked or unchecked)
            let status = initialStatus === 1 ? 0 : 1;  // Toggle the status (opposite of the initial one)

            // Show custom modal
            const modalElement = document.getElementById('faqStatusModal');
            let bootstrapModal = new bootstrap.Modal(modalElement);
            bootstrapModal.show();

            if (iconContent) {
                $("#icon-image").attr('src', iconContent);
            }
            if (titleContent) {
                $("#modal-title").html(titleContent);
            }
            if (subTitleContent) {
                $("#sub-title").html(subTitleContent);
            }
            if (confirmBtnContent) {
                $("#modal-confirm-btn").html(confirmBtnContent);
            }
            if (cancelBtnContent) {
                $("#modal-cancel-btn").html(cancelBtnContent);
            }

            let confirmBtn = document.getElementById("modal-confirm-btn");
            let cancelBtn = document.getElementById("modal-cancel-btn");


            confirmBtn.onclick = function () {
                $.ajax({
                    url: url,
                    data: {status: status},
                    success: function (response) {
                        toastr.success(response.message);

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
                checkbox.prop('checked', initialStatus);
            }

        });

        //edit faq
        $(document).on('click', '.edit-faq-btn', function () {
            let faqId = $(this).data('id');
            const url = "{{ route('admin.faq.edit', ':id') }}".replace(':id', faqId);

            // Fetch FAQ data
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    $('#editFAQModal .modal-content').html(response);
                    $('#editFAQModal').modal('show');
                },
                error: function (xhr) {
                }
            });
        });

        //show faq
        $(document).on('click', '.show-faq-btn', function () {
            let faqId = $(this).data('id');
            const url = "{{ route('admin.faq.details', ':id') }}".replace(':id', faqId);
            // Fetch FAQ data
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    $('#showFAQModal .modal-content').html(response);
                    $('#showFAQModal').modal('show');
                },
                error: function (xhr) {
                }
            });
        });

        // delete faq
        $(document).on('click', '.delete-faq-btn', function () {
            let faqId = $(this).data('id');

            // Set the category ID in a global variable or pass it directly during confirmation
            $('#confirmFAQDelete').data('id', faqId);
        });

        $('#confirmFAQDelete').on('click', function () {
            let faqId = $(this).data('id');
            const url = "{{ route('admin.faq.delete', ':id') }}".replace(':id', faqId);
            $.ajax({
                url: url,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    $('#deleteFAQModal').modal('hide');

                    toastr.success(response.message);

                    setTimeout(function () {
                        location.reload();
                    }, 1000);

                },
                error: function (xhr) {
                    $('#deleteFAQModal').modal('hide');
                    toastr.error('Failed to delete the category.');
                }
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
        });

        let faqCategoryEditFormOriginalData = {};


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

                    $('#faqCategoryTable tbody').html(response.html);

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
        // add  category
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

                    $('#faqCategoryTable tbody').html(response.html);

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
            let url = '{{ route("admin.faq.category.delete", ":id") }}';
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
                    $('#faqCategoryTable tbody').html(response.html);
                    $('.category-count').text(response.count);
                },
                error: function (xhr, status, error) {
                    $('#deleteModal').modal('hide');
                    toastr.error('Failed to delete the category.');
                }

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
                        if (response.html) $('#faqCategoryTable tbody').html(response.html);
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

        // search category
        let debounceTimer;

        $(document).on('input paste cut keyup change click', '.datatable-search', function () {
            clearTimeout(debounceTimer);

            let $input = $(this);
            let searchQuery = $input.closest('form').find("input[name='search']").val();
            let $container = $input.closest('.search-table'); // or a more specific wrapper if needed
            let $tbody = $container.find('tbody');
            let $count = $container.find('.category-count');

            debounceTimer = setTimeout(function () {
                $.ajax({
                    url: '{{ route("admin.faq.category.search") }}',
                    method: 'GET',
                    data: { search: searchQuery },
                    beforeSend: function () {
                        $('#offcanvasLoader').fadeIn(100);
                    },
                    success: function (response) {
                        // Update only the table body inside this container
                        $tbody.html(response.html);

                        // Update count badge
                        $count.text(response.count);
                    },
                    error: function () {
                        toastr.error('Failed to fetch categories!');
                    },
                    complete: function () {
                        $('#offcanvasLoader').fadeOut(100);
                    }
                });
            }, 300);
        });


        $(document).ready(function () {
            // Function to update character count
            function updateCharCount(inputSelector, countSelector, maxLength) {
                $(inputSelector).on('input', function () {
                    const charCount = $(this).val().length;
                    $(countSelector).text(`${charCount}/${maxLength} characters`);
                });

                // Update the count on page load (for pre-filled values)
                const initialCount = $(inputSelector).val().length;
                $(countSelector).text(`${initialCount}/${maxLength} characters`);
            }

            // Initialize character count for title
            updateCharCount('#faq_intro_title', '#faq_intro_title_count', 255);

            // Initialize character count for subtitle
            updateCharCount('#faq_intro_subtitle', '#faq_intro_subtitle_count', 255);
        });
    </script>
@endpush
