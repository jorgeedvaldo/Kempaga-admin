@if ($webPage == 'intro_section')
    <div class="d-flex justify-content-end gap-3 mb-3">
        <button type="button" class="btn btn-outline-primary d-flex gap-2 align-items-center" data-toggle="modal"
                data-target="#section-view-modal-intro">Section View <i class="tio-document-text"></i></button>

        <button type="button" class="btn btn-outline-primary d-flex gap-2 align-items-center" data-toggle="modal"
                data-target="#notes-view-modal">Notes <i class="tio-info"></i></button>
    </div>

    <div class="card mb-5">
        <div class="card-body">
            <h5 class="card-title mb-4">
                <span class="card-header-icon mr-2"><i class="tio-calendar"></i></span>
                <span>{{ translate('header_Intro_Section') }} ({{ translate('default') }})</span>
            </h5>
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" id="landing-info-title-status-form">
                        @csrf
                        @method('PUT')
                        <div
                            class="d-flex flex-wrap justify-content-between border rounded align-items-center p-2 mb-5">
                            <h5 class="text-capitalize m-0">
                                {{ translate('intro_section_landing_page') }}
                                <i class="tio-info-outined" data-toggle="tooltip"
                                   title="{{ translate('You_can_turn_off/on_intro_section_of_landing_page') }}"></i>
                            </h5>
                            <label class="toggle-switch toggle-switch-sm">
                                <input type="checkbox" class="status toggle-switch-input" value="1"
                                       name="status" {{ $status == '1' ? 'checked' : '' }}>
                                <span class="toggle-switch-label text mb-0">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                            </label>
                        </div>
                        <div class="d-flex justify-content-end gap-3">
                            <button type="reset" class="btn btn-secondary">{{ translate('reset') }}</button>
                            <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                                    class="btn btn-primary demo-form-submit">{{ translate('save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-5">
        <div class="card-body">
            <h5 class="card-title mb-4">
                <span class="card-header-icon mr-2"><i class="tio-calendar"></i></span>
                <span>{{ translate($webPage) }}</span>
            </h5>

            <form method="post" enctype="multipart/form-data" id="landing-info-update-form4">
                @csrf
                @method('PUT')
                <div class="row align-items-end">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="input-label" for="title">{{ translate('title') }}</label>
                            <input type="text" name="title" value="{{ $intro['title'] }}" id="title"
                                   class="form-control" placeholder="{{ translate('title') }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="input-label" for="sub_title">{{ translate('Sub_title') }}</label>
                            <input type="text" name="description" value="{{ $intro['description'] }}"
                                   id="sub_title" class="form-control" placeholder="{{ translate('sub_title') }}"
                                   required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="input-label" for="button_name">{{ translate('button_name') }}</label>
                            <input type="text" value="{{ $intro['button_name'] }}" name="button_name"
                                   id="button_name" class="form-control" placeholder="{{ translate('button_name') }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="input-label" for="download_link">{{ translate('download_link') }}</label>
                            <input type="text" value="{{ $intro['download_link'] }}" name="download_link"
                                   id="download_link" class="form-control"
                                   placeholder="{{ translate('download_link') }}" required>
                        </div>
                    </div>
                    <input type="hidden" name="type" value="intro_section_form">
                </div>

                <div class="d-flex justify-content-end gap-3">
                    <button type="reset" class="btn btn-secondary">{{ translate('reset') }}</button>
                    <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                            class="btn btn-primary demo-form-submit">{{ translate('save') }}</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-5">
        <div class="card-body">
            <h5 class="card-title mb-4">
                <span class="card-header-icon mr-2"><i class="tio-calendar"></i></span>
                <span>{{ translate('user_rating_and_count') }}</span>
            </h5>

            <form method="post" enctype="multipart/form-data" id="landing-info-update-form-rating">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-4">
                        <div class="bg-light p-3 rounded h-100">
                            <div class="form-group">
                                <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                                    <label class="text-dark mb-0">{{ translate('Reviewer Icon') }}</label>
                                    <small class="text-info">( {{ translate('1:1') }} )</small>
                                </div>

                                <div class="text-center mb-4">
                                    <img class="mx-w160 w-100" id="viewer1"
                                         src="{{ $imageSource['review_user_icon'] }}"
                                         alt="{{ translate('image') }}" />
                                </div>

                                <input type="hidden" name="type" value="review_and_rating">

                                <div class="custom-file">
                                    <input type="file" name="review_user_icon" id="customFileEg1"
                                           class="custom-file-input"
                                           accept=".{{ implode(',.', array_column(IMAGE_EXTENSIONS, 'key')) }}"
                                           data-maxFileSize="{{ readableUploadMaxFileSize('image') }}">
                                    <label class="custom-file-label"
                                           for="customFileEg1">{{ translate('choose') }}
                                        {{ translate('file') }}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="input-label"
                                       for="reviewer_name">{{ translate('reviewer_name') }}</label>
                                <input type="text" name="reviewer_name"
                                       value="{{ $userRatingData['reviewer_name'] }}" id="reviewer_name"
                                       class="form-control" placeholder="{{ translate('reviewer_name') }}" required>
                            </div>

                            <div class="form-group">
                                <label class="input-label" for="rating">{{ translate('rating') }}</label>
                                <input type="number" min="1" max="5" step="any"
                                       value="{{ $userRatingData['rating'] }}" name="rating" id="rating"
                                       class="form-control" placeholder="{{ translate('rating') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="bg-light p-3 rounded h-100">
                            <div class="row">
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                                            <label class="text-dark mb-0">{{ translate('User 1 Image') }}</label>
                                            <small class="text-info">( {{ translate('1:1') }} )</small>
                                        </div>

                                        <div class="text-center mb-4">
                                            <img class="mx-w160 w-100" id="middle_image_id"
                                                 src="{{ $imageSource['user_image_one'] }}"
                                                 alt="{{ translate('image') }}" />
                                        </div>

                                        <div class="custom-file">
                                            <input type="file" name="user_image_one" id="customFileEg2"
                                                   class="custom-file-input"
                                                   accept=".{{ implode(',.', array_column(IMAGE_EXTENSIONS, 'key')) }}"
                                                   data-maxFileSize="{{ readableUploadMaxFileSize('image') }}">
                                            <label class="custom-file-label"
                                                   for="customFileEg2">{{ translate('choose') }}
                                                {{ translate('file') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                                            <label class="text-dark mb-0">{{ translate('User 2 Image') }}</label>
                                            <small class="text-info">( {{ translate('1:1') }} )</small>
                                        </div>

                                        <div class="text-center mb-4">
                                            <img class="mx-w160 w-100" id="viewer3"
                                                 src="{{ $imageSource['user_image_two'] }}"
                                                 alt="{{ translate('image') }}" />
                                        </div>

                                        <div class="custom-file">
                                            <input type="file" name="user_image_two" id="customFileEg3"
                                                   class="custom-file-input"
                                                   accept=".{{ implode(',.', array_column(IMAGE_EXTENSIONS, 'key')) }}"
                                                   data-maxFileSize="{{ readableUploadMaxFileSize('image') }}">
                                            <label class="custom-file-label"
                                                   for="customFileEg3">{{ translate('choose') }}
                                                {{ translate('file') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                                            <label class="text-dark mb-0">{{ translate('User 3 Image') }}</label>
                                            <small class="text-info">( {{ translate('1:1') }} )</small>
                                        </div>

                                        <div class="text-center mb-4">
                                            <img class="mx-w160 w-100" id="viewer4"
                                                 src="{{ $imageSource['user_image_three'] }}"
                                                 alt="{{ translate('image') }}" />
                                        </div>

                                        <div class="custom-file">
                                            <input type="file" name="user_image_three" id="customFileEg4"
                                                   class="custom-file-input"
                                                   accept=".{{ implode(',.', array_column(IMAGE_EXTENSIONS, 'key')) }}"
                                                   data-maxFileSize="{{ readableUploadMaxFileSize('image') }}">
                                            <label class="custom-file-label"
                                                   for="customFileEg4">{{ translate('choose') }}
                                                {{ translate('file') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="total_user_count">{{ translate('total_user_count') }}</label>
                                        <input type="number" name="total_user_count"
                                               value="{{ $userRatingData['total_user_count'] }}"
                                               id="total_user_count" class="form-control"
                                               placeholder="{{ translate('total_user_count') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="total_user_content">{{ translate('total_user_content') }}</label>
                                        <input type="text" value="{{ $userRatingData['total_user_content'] }}"
                                               name="total_user_content" id="total_user_content"
                                               class="form-control"
                                               placeholder="{{ translate('total_user_content') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-3">
                    <button type="reset" class="btn btn-secondary">{{ translate('reset') }}</button>
                    <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                            class="btn btn-primary demo-form-submit">{{ translate('save') }}</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">
                <span class="card-header-icon mr-2"><i class="tio-calendar"></i></span>
                <span>{{ translate('image_Section') }}</span>
            </h5>

            <form method="post" enctype="multipart/form-data" id="landing-info-update-form3">
                @csrf
                @method('PUT')
                <div class="d-flex flex-wrap gap-3 align-items-end">
                    <div>
                        <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                            <h6 class="text-dark mb-0">{{ translate('Left Image') }}</h6>
                        </div>

                        <div class="text-center mb-4">
                            <img class="mx-w160 w-100" id="viewer6"
                                 src="{{ $imageSource['intro_left_image'] }}" alt="{{ translate('image') }}" />
                        </div>

                        <div class="custom-file">
                            <input type="file" name="intro_left_image" id="customFileEg6"
                                   class="custom-file-input"
                                   accept=".{{ implode(',.', array_column(IMAGE_EXTENSIONS, 'key')) }}"
                                   data-maxFileSize="{{ readableUploadMaxFileSize('image') }}">
                            <label class="custom-file-label" for="customFileEg6">{{ translate('choose') }}
                                {{ translate('file') }}</label>
                        </div>
                    </div>

                    <div>
                        <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                            <h6 class="text-dark mb-0">{{ translate('Middle Image') }}</h6>
                        </div>

                        <div class="text-center mb-4">
                            <img class="mx-w160 w-100" id="viewer7"
                                 src="{{ $imageSource['intro_middle_image'] }}" alt="{{ translate('image') }}" />
                        </div>

                        <div class="custom-file">
                            <input type="file" name="intro_middle_image" id="customFileEg7"
                                   class="custom-file-input"
                                   accept=".{{ implode(',.', array_column(IMAGE_EXTENSIONS, 'key')) }}"
                                   data-maxFileSize="{{ readableUploadMaxFileSize('image') }}">
                            <label class="custom-file-label" for="customFileEg7">{{ translate('choose') }}
                                {{ translate('file') }}</label>
                        </div>
                    </div>

                    <div>
                        <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                            <h6 class="text-dark mb-0">{{ translate('Right Image') }}</h6>
                        </div>

                        <div class="text-center mb-4">
                            <img class="mx-w160 w-100" id="viewer8"
                                 src="{{ $imageSource['intro_right_image'] }}"alt="{{ translate('image') }}" />
                        </div>

                        <div class="custom-file">
                            <input type="file" name="intro_right_image" id="customFileEg8"
                                   class="custom-file-input"
                                   accept=".{{ implode(',.', array_column(IMAGE_EXTENSIONS, 'key')) }}"
                                   data-maxFileSize="{{ readableUploadMaxFileSize('image') }}">
                            <label class="custom-file-label" for="customFileEg8">{{ translate('choose') }}
                                {{ translate('file') }}</label>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <h6 class="mb-0">{{ translate('Min Size for Better Resolution 300x620 px') }}</h6>
                    <small>{{ translate('Image format : '.implode(', ', array_column(IMAGE_EXTENSIONS, 'key')) .' | Maximum size : '.readableUploadMaxFileSize('image')) }}</small>
                </div>

                <input type="hidden" name="type" value="intro_section_form">

                <div class="d-flex justify-content-end gap-3 mt-3">
                    <button type="reset" class="btn btn-secondary">{{ translate('reset') }}</button>
                    <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                            class="btn btn-primary demo-form-submit">{{ translate('save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endif

<div class="modal fade" id="section-view-modal-intro" tabindex="-1"
     aria-labelledby="section-view-modalLabel-intro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close fs-28" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <img width="100%" src="{{ dynamicAsset(path: 'public/assets/landing/img/section-view/intro.png') }}"
                         alt="{{ translate('image') }}">
                </div>
            </div>
        </div>
    </div>
</div>
