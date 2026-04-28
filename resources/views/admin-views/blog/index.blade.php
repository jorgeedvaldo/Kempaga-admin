@extends('layouts.admin.app')

@section('title', translate('Blog Setup'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 pb-2">
            <div class="d-flex flex-wrap align-items-center gap-3 pb-2">
                <img width="24" src="{{dynamicAsset(path: 'public/assets/admin/img/media/blog.png')}}" alt="{{ translate('business_setup') }}">
                <h2 class="page-header-title">{{translate('blog')}}</h2>
            </div>
            <div class="d-flex flex-wrap align-items-center gap-3">
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
                <li class="active"><a href="{{route('admin.blog.index')}}">{{translate('Blog Page Setup')}}</a></li>
                <li class=""><a href="{{route('admin.blog.download')}}">{{translate('Download Button')}}</a></li>
                <li class=""><a href="{{route('admin.blog.priority')}}">{{translate('Priority Setup')}}</a></li>
            </ul>

        </div>
        @php($blogStatus = \App\CentralLogics\helpers::get_business_settings('blog_section_status'))
        <div class="bg-white shadow rounded px-3 py-2 h--45px text-center d-flex align-items-center justify-content-between">
                <span class="text-dark">
                    <i class="tio-calendar"></i>
                    <strong>{{ translate('blog_section') }}</strong>
                    <i class="tio-info-outined cursor-pointer" data-toggle="tooltip" data-placement="top" title="{{ translate('Enabling this option will make the blog section visible on the website for viewers') }}"></i>
                </span>
            <label class="toggle-switch toggle-switch-sm">
                <input class="toggle-switch-input update-business-setting-status"
                       id="blog_section_status" type="checkbox"
                       name="blog_section_status"
                       data-name="blog_section_status"
                       data-url="{{ route('admin.business-settings.update-business-setting-status') }}"
                       data-icon="{{ dynamicAsset(path: 'public/assets/admin/svg/components/info.svg')}}"
                       data-title="{{ ($blogStatus ?? 0) == 1 ? translate('Are you sure to turn off the Blog Status?') . '? ' : translate('Are you sure to turn on the Blog Status') . '? ' }}"
                       data-sub-title="{{ ($blogStatus ?? 0) == 1 ? translate('Once you turn off this Blog, It will not be visible to the Blog list for users.') : translate('Once you turn on this Blog, It will be visible to the Blog list for users.') }}"
                       data-confirm-btn="{{ ($blogStatus ?? 0) == 1 ? translate('Yes, Off') : translate('Yes, On') }}"
                        {{ isset($blogStatus) && $blogStatus == 1 ? 'checked' : '' }}>
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

                    @php($blogTitle = \App\CentralLogics\helpers::get_business_settings('blog_intro_title'))
                    <div class="form-group">
                        <label class="input-label text-capitalize d-flex flex-wrap align-items-center column-gap-2" for="title">{{ translate('title') }}</label>
                        <input type="text" name="blog_intro_title" class="form-control" id="blog_intro_title" value="{{ $blogTitle }}" placeholder="{{ translate('Enter Title') }}" maxlength="255" required>
                        <small id="blog_intro_title_count" class="text-muted">0/255 characters</small>
                    </div>

                    @php($blogSubTitle = \App\CentralLogics\helpers::get_business_settings('blog_intro_subtitle'))
                    <div class="form-group">
                        <label class="input-label text-capitalize d-flex flex-wrap align-items-center column-gap-2" for="sub_title">{{ translate('sub_title') }}</label>
                        <textarea name="blog_intro_subtitle" id="blog_intro_subtitle" class="form-control" rows="3" placeholder="{{ translate('Enter SUb Title') }}" maxlength="255" required>{{ $blogSubTitle }}</textarea>
                        <small id="blog_intro_subtitle_count" class="text-muted">0/255 characters</small>
                    </div>

                    <div class="d-flex justify-content-end gap-3">
                        <button type="reset" class="btn btn-secondary">{{translate('reset')}}</button>
                        <button type="submit" class="btn btn-primary demo-form-submit">{{translate('save')}}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header __wrap-gap-10">
                <div class="d-flex align-items-center gap-2">
                    <h5 class="card-header-title">{{ translate('Blog_List') }}</h5>
                    <span class="badge badge-soft-secondary text-dark"> {{ $blogs->total() }}</span>
                </div>

                <div class="d-flex flex-wrap gap-3">
                    <form action="{{ url()->current() }}" method="GET">
                        <div class="input-group">
                            <input id="datatableSearch_" type="search" name="search" class="form-control mn-md-w280" placeholder="{{ translate('Search by title, description, writer') }}" aria-label="Search" value="{{ request('search') }}" autocomplete="off">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">{{ translate('search') }}</button>
                            </div>
                        </div>
                    </form>
                    <a href="{{route('admin.blog.create')}}" class="btn btn-primary">
                        <i class="tio-add"></i>
                        {{ translate('create_Blog') }}
                    </a>
                </div>
            </div>

            <div class="table-responsive datatable-custom">
                <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                    <thead class="thead-light">
                        <tr>
                            <th>{{translate('SL')}}</th>
                            <th>{{ translate('category') }}</th>
                            <th>{{ translate('title') }}</th>
                            <th>{{ translate('writer') }}</th>
                            <th>{{ translate('publish_Date') }}</th>
                            <th>
                                <div class="d-flex gap-1 align-items-baseline">{{ translate('status') }}</div>
                            </th>
                            <th class="text-center">{{ translate('action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($blogs as $key => $blog)
                        <tr>
                            <td>{{$blogs->firstitem()+$key}}</td>
                            <td>
                                <div class="p-2 {{ $blog->category_id ? ($blog->blogCategory ?  '' : 'badge badge-danger text-white' ): '' }}">
                                    {{ $blog->category_id ? ($blog->blogCategory ?  $blog->blogCategory->name : translate('Category Deleted')) : '-' }}
                                </div>
                            </td>
                            <td>
                                <div class="line-clamp mx-w300">{{$blog->title}}</div>
                            </td>
                            <td><div class="line-clamp mx-w300">{{$blog->writer ?? '-'}}</div></td>
                            <td>{{ $blog->is_published ?  \Carbon\Carbon::parse($blog->publish_date)->format('F j, Y') : 'N/A' }}</td>

                            <td>
                                <label class="switcher">
                                    <input type="checkbox" class="switcher_input change-blog-status"
                                           data-id="{{ $blog->id }}"
                                           data-icon="{{ dynamicAsset(path: 'public/assets/admin/svg/components/info.svg')}}"
                                           data-title="{{ $blog->status == 1 ? translate('Are you sure to turn off the Blog status') . '? ' : translate('Are you sure to turn on the Blog status?') . '? ' }}"
                                           data-sub-title="{{ $blog->status == 1 ? translate('Once you turn off, it will not be visible to the Blog list for users') : translate('When you turn on this Blog, It will be visible to the Blog list for users') }}"
                                           data-confirm-btn="{{ $blog->status == 1 ? translate('Yes, Off') : translate('Yes, On') }}"
                                           data-url="{{route('admin.blog.status',[$blog['id']])}}"

                                           {{$blog['status'] == 1 ? 'checked' : ''}}
                                        {{ $blog->is_published ? '' : 'disabled' }}>
                                    @if($blog->is_published)<span class="switcher_control"></span>@else <span class="switcher_control" data-toggle="tooltip" title="{{ translate('This blog is not published yet. Status change option is disabled') }}"></span> @endif

                                </label>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    @if($blog->is_draft == 1)
                                        <a class="action-btn btn btn-outline-primary" href="{{ route('admin.blog.draft-edit', [$blog['id']]) }}">
                                            <i class="fa fa-save" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                    @if($blog->is_published)
                                            <a class="action-btn btn btn-outline-info" href="{{ route('admin.blog.edit', [$blog['id']]) }}">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        @else
                                            <span class="action-btn btn btn-outline-info disabled cursor-pointer"
                                               data-toggle="tooltip" title="{{ translate('This blog is not published yet. Edit option is disabled.') }}">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </span>
                                    @endif

                                    <button class="action-btn btn btn-outline-danger delete-blog-btn"
                                            data-url="{{ route("admin.blog.delete",$blog->id) }}"
                                            data-title="{{translate('Are you sure you want to delete this Blog')}}"
                                            data-subTitle="{{ translate('Once you delete it, this will permanently remove it from the Blog list and can not be accessed.') }}"
                                            data-toggle="modal" data-target="#customDeleteModal">
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
                                        <img width="44" class="mb-2" src="{{dynamicAsset(path: 'public/assets/admin/img/media/unavailable.png')}}" alt="{{ translate('unavailable') }}">
                                        <p class="text-muted">{{ translate('Search no Result found') }}</p>
                                    </div>
                                @else
                                    <div class="d-flex flex-column gap-2 align-items-center py-8 px-3 rounded">
                                        <img width="44" class="mb-2" src="{{dynamicAsset(path: 'public/assets/admin/img/media/unavailable.png')}}" alt="{{ translate('unavailable') }}">
                                        <p class="text-muted">{{ translate('Currently no blog available in this list') }}</p>
                                        <a href="{{route('admin.blog.create')}}" class="btn btn-primary">
                                            <i class="tio-add"></i>
                                            {{ translate('create_Blog') }}
                                        </a>
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
                    {!! $blogs->links() !!}
                </div>
            </div>
        </div>

    </div>

    <!-- Status Change Modal -->
    <div class="modal fade" id="blogStatusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true" style="z-index: 999999">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="close fs-28" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-5 pt-0">
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
                             src="{{ dynamicAsset(path: 'public/assets/landing/img/section-view/section-blog.png') }}"
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
        // category status change
        $('.change-blog-status').on('change', function () {
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
            const modalElement = document.getElementById('blogStatusModal');
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

        // delete blog
        $(document).on('click', '.delete-blog-btn', function () {
            let event = $(this);
           customDelete(event);
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
            updateCharCount('#blog_intro_title', '#blog_intro_title_count', 255);

            // Initialize character count for subtitle
            updateCharCount('#blog_intro_subtitle', '#blog_intro_subtitle_count', 255);
        });
    </script>
@endpush
