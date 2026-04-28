@extends('layouts.admin.app')

@section('title', translate('Blog Edit'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex justify-content-between gap-2 align-items-center">
            <div class="d-flex align-items-center gap-3 pb-2">
                <h2 class="page-header-title">{{translate('Edit Draft Blog')}} ({{ translate('ID'). ' # '. $blog->readable_id }})</h2>
            </div>
            <a class="btn btn-outline-primary" href="{{ route('admin.blog.draft-preview', $blog->id) }}" target="_blank">
                {{ translate('View Preview') }}
                <i class="fa fa-eye" aria-hidden="true"></i>
            </a>
        </div>

        <form action="{{ route('admin.blog.update', [$blog['id']]) }}" method="POST" enctype="multipart/form-data" id="blog-form">
            @csrf
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="d-flex gap-2 align-items-baseline justify-content-between">
                                    <label class="input-label">{{ translate('category') }}</label>
                                </div>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="" selected disabled>{{ translate('Select Category') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $blog->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="input-label">{{ translate('writer') }}</label>
                                <input type="text" name="writer" class="form-control" placeholder="First Name" value="{{ $blog->draft_data['writer'] }}" maxlength="100">
                            </div>
                            <div class="form-group">
                                <label class="input-label">{{ translate('publish_Date') }}</label>
                                <input type="date" name="publish_date" value="{{ date('Y-m-d', strtotime($blog->draft_data['publish_date'])) }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <label class="text-dark mb-0">{{ translate('Thumbnail') }}<span class="text-danger"> *</span></label>

                                    <p class="mx-w180">{{ implode(', ', array_column(IMAGE_EXTENSIONS, 'key')) }} : Max {{ readableUploadMaxFileSize('image') }}
                                        <strong>({{ translate('Ratio') }} 2:1)</strong>
                                    </p>
                                    <div class="upload-file auto profile-image-upload-file new">

                                        <button type="button" class="upload-file__edit-btn btn rounded-circle btn-outline-primary" aria-label="add file">
                                            <i class="tio-edit"></i>
                                        </button>
                                        <input type="file" name="image" class="upload-file__input"
                                               accept=".{{ implode(',.', array_column(IMAGE_EXTENSIONS, 'key')) }}"
                                               data-maxFileSize="{{ readableUploadMaxFileSize('image') }}">

                                        <div class="upload-file__img banner border-gray d-flex justify-content-center align-items-center mw-100 w-360 h-180 p-0 bg-light">
                                            <div class="upload-file__textbox text-center" @if($blog->draft_data['image']) style="display:none;" @endif>

                                                <img height="34"
                                                     src="{{dynamicAsset(path: 'public/assets/admin/img/upload.svg')}}"
                                                     alt="" class="svg ratio-2">
                                                <h6 class="mt-2 fw-semibold">
                                                    <span class="text-info">{{ translate('Click to upload') }}</span>
                                                    <br>
                                                    {{ translate('or drag and drop') }}
                                                </h6>
                                            </div>
                                            <img class="upload-file__img__img h-100 ratio-2" width="180" height="180" @if($blog->draft_data['image']) style="display: block" @endif src="{{ $blog['draft_image_fullpath'] }}" loading="lazy" alt="">
                                        </div>
                                        <a href="javascript:void(0)" class="remove-img-icon d-none">
                                            <i class="tio-clear"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 p-4 bg-soft-secondary rounded">

                        <div class="form-group">
                            <label class="input-label" for="title">{{translate('title')}}<span class="text-danger"> *</span></label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $blog->draft_data['title'] }}" placeholder="{{translate('title')}}" maxlength="255" required>
                        </div>

                        <div class="">
                            <label class="input-label" for="title">{{translate('description')}}<span class="text-danger"> *</span></label>
                            <div id="editor" class="min-h200 bg-white">{!! $blog->draft_data['description'] !!}</div>
                            <textarea class="editor form-control d-none" name="description" id="hiddenArea">{!! $blog->draft_data['description'] !!}</textarea>
                        </div>
                    </div>

                    <!-- Hidden input fields to store status and draft -->
                    <input type="hidden" name="status" id="status" value="1"> <!-- Default status -->
                    <input type="hidden" name="is_draft" id="is_draft" value="0"> <!-- Default draft -->
                    <input type="hidden" name="clear_draft" id="clear_draft" value="0"> <!-- Default draft -->

                    <div class="d-flex justify-content-end gap-3 mt-3 flex-wrap">
                        <button type="reset" class="btn btn-secondary clear-draft"><i class="fa fa-times-circle mr-1" aria-hidden="true"></i>{{ translate('Clear Draft') }}</button>
                        <button type="button" class="btn btn-outline-primary demo-form-submit save-draft"><i class="fa fa-save mr-1" aria-hidden="true"></i>{{ translate('Save_to_Draft') }}</button>
                        <button type="submit" class="btn btn-primary demo-form-submit publish"><i class="fa fa-check-circle-o mr-1" aria-hidden="true"></i>{{ translate('update & publish') }}</button>
                    </div>
                </div>
            </div>
        </form>

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

                        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
                        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                        [{ 'direction': 'rtl' }],                         // text direction

                        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                        [{ 'font': [] }],
                        [{ 'align': [] }],

                        ['clean']
                    ]
                }
            });

            $('#blog-form').on('submit', function () {
                var myEditor = document.querySelector('#editor');
                $('#hiddenArea').val(myEditor.children[0].innerHTML);
            });
        });

        $(document).ready(function () {
            $('.clear-draft').on('click', function () {
                $('#clear_draft').val(1); // Set status to 1 for published
                $('#blog-form').submit(); // Submit the form
            });

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

    </script>
@endpush
