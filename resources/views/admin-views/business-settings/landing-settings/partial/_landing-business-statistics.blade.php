@if ($webPage == 'business_statistics')
    @php($business_download = isset($businessStatsDownloadData->value) ? json_decode($businessStatsDownloadData->value, true) : null)
    <div class="d-flex justify-content-end gap-3 mb-3">
        <button type="button" class="btn btn-outline-primary d-flex gap-2 align-items-center"
                data-toggle="modal" data-target="#section-view-modal-business-statistics">Section View <i
                class="tio-document-text"></i></button>

        <button type="button" class="btn btn-outline-primary d-flex gap-2 align-items-center"
                data-toggle="modal" data-target="#notes-view-modal">Notes <i class="tio-info"></i></button>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title mb-4">
                <span class="card-header-icon mr-2"><i class="tio-calendar"></i></span>
                <span>{{ translate('header_section') }} ({{ translate('default') }})</span>
            </h5>

            <form method="post" id="landing-info-title-status-form">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-12">
                        <div
                            class="maintainance-mode-toggle-bar d-flex flex-wrap justify-content-between border rounded align-items-center p-2 mb-5">
                            <h5 class="text-capitalize m-0">
                                {{ translate('business_statistics_landing_page') }}
                                <i class="tio-info-outined" data-toggle="tooltip"
                                   title="{{ translate('You_can_turn_off/on_business_statistics_of_landing_page') }}"></i>
                            </h5>
                            <label class="toggle-switch toggle-switch-sm">
                                <input type="checkbox" class="status toggle-switch-input" value="1"
                                       name="status" {{ $status == '1' ? 'checked' : '' }}>
                                <span class="toggle-switch-label text mb-0">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                            </label>
                        </div>
                    </div>
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
                <span>{{ translate('Business Download') }}</span>
            </h5>

            <form method="post" enctype="multipart/form-data" id="landing-info-update-form">
                @csrf
                @method('PUT')
                <div class="row gy-3 align-items-end">
                    <div class="col-lg-6">
                        <div>
                            <label class="input-label" for="title">{{ translate('title') }}</label>
                            <input type="text" name="title" value="{{ $business_download['title'] }}"
                                   id="title" class="form-control" placeholder="{{ translate('title') }}"
                                   required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label class="input-label" for="sub_title">{{ translate('sub_title') }}</label>
                            <input type="text" value="{{ $business_download['sub_title'] }}"
                                   name="sub_title" id="sub_title" class="form-control"
                                   placeholder="{{ translate('sub_title') }}" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <h5 class="card-title mb-3">
                            <span class="card-header-icon mr-2"><i class="tio-calendar"></i></span>
                            <span>{{ translate('Download App') }}</span>
                        </h5>

                        <div class="bg-light rounded p-3">
                            <div class="form-group">
                                <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                                    <label class="text-dark mb-0">{{ translate('Download Icon') }}</label>
                                    <small class="text-info">( {{ translate('1:1') }} )</small>
                                </div>

                                <div class="text-center mb-4">
                                    <img class="mx-w160 w-100" id="viewer1"
                                         src="{{ Helpers::onErrorImage($business_download['download_icon'], dynamicStorage(path: 'storage/app/public/landing-page/business-statistics') . '/' . $business_download['download_icon'], dynamicAsset(path: 'public/assets/admin/img/900x400/img1.jpg'), 'landing-page/business-statistics/') }}"
                                         alt="{{ translate('image') }}" />
                                </div>

                                <div class="custom-file">
                                    <input type="file" name="download_icon" id="customFileEg1"
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
                                       for="download_count">{{ translate('download_count') }}</label>
                                <input type="number" name="download_count"
                                       value="{{ $business_download['download_count'] }}" id="download_count"
                                       class="form-control" placeholder="{{ translate('download_count') }}"
                                       required>
                                <input type="hidden" name="type" value="business_statistics_download">
                            </div>

                            <div>
                                <label class="input-label"
                                       for="download_description">{{ translate('download_description') }}</label>
                                <textarea class="form-control" name="download_description" id="download_description" rows="4"
                                          placeholder="{{ translate('download_sort_description') }}">{{ $business_download['download_sort_description'] }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <h5 class="card-title mb-3">
                            <span class="card-header-icon mr-2"><i class="tio-calendar"></i></span>
                            <span>{{ translate('Total Ratings') }}</span>
                        </h5>

                        <div class="bg-light rounded p-3">
                            <div class="form-group">
                                <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                                    <label class="text-dark mb-0">{{ translate('Review Icon') }}</label>
                                    <small class="text-info">( {{ translate('1:1') }} )</small>
                                </div>

                                <div class="text-center mb-4">
                                    <img class="mx-w160 w-100" id="viewer5"
                                         src="{{ Helpers::onErrorImage($business_download['review_icon'], dynamicStorage(path: 'storage/app/public/landing-page/business-statistics') . '/' . $business_download['review_icon'], dynamicAsset(path: 'public/assets/admin/img/900x400/img1.jpg'), 'landing-page/business-statistics/') }}"
                                         alt="{{ translate('image') }}" />
                                </div>

                                <div class="custom-file">
                                    <input type="file" name="review_icon" id="customFileEg5"
                                           class="custom-file-input"
                                           accept=".{{ implode(',.', array_column(IMAGE_EXTENSIONS, 'key')) }}"
                                           data-maxFileSize="{{ readableUploadMaxFileSize('image') }}">
                                    <label class="custom-file-label"
                                           for="customFileEg5">{{ translate('choose') }}
                                        {{ translate('file') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input-label"
                                       for="review_count">{{ translate('review_count') }}</label>
                                <input type="number" name="review_count"
                                       value="{{ $business_download['review_count'] }}" id="review_count"
                                       class="form-control" placeholder="{{ translate('review_count') }}"
                                       required>
                            </div>
                            <div>
                                <label class="input-label"
                                       for="review_description">{{ translate('review_description') }}</label>
                                <textarea class="form-control" name="review_description" id="review_description" rows="4"
                                          placeholder="{{ translate('review_sort_description') }}">{{ $business_download['review_sort_description'] }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <h5 class="card-title mb-3">
                            <span class="card-header-icon mr-2"><i class="tio-calendar"></i></span>
                            <span>{{ translate('Total Count') }}</span>
                        </h5>

                        <div class="bg-light rounded p-3">
                            <div class="form-group">
                                <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                                    <label class="text-dark mb-0">{{ translate('Country Icon') }}</label>
                                    <small class="text-info">( {{ translate('1:1') }} )</small>
                                </div>

                                <div class="text-center mb-4">
                                    <img class="mx-w160 w-100" id="viewer4"
                                         src="{{ Helpers::onErrorImage($business_download['country_icon'], dynamicStorage(path: 'storage/app/public/landing-page/business-statistics') . '/' . $business_download['country_icon'], dynamicAsset(path: 'public/assets/admin/img/900x400/img1.jpg'), 'landing-page/business-statistics/') }}"
                                         alt="{{ translate('image') }}" />
                                </div>

                                <div class="custom-file">
                                    <input type="file" name="country_icon" id="customFileEg4"
                                           class="custom-file-input"
                                           accept=".{{ implode(',.', array_column(IMAGE_EXTENSIONS, 'key')) }}"
                                       data-maxFileSize="{{ readableUploadMaxFileSize('image') }}">
                                    <label class="custom-file-label"
                                           for="customFileEg4">{{ translate('choose') }}
                                        {{ translate('file') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input-label"
                                       for="country_count">{{ translate('country_count') }}</label>
                                <input type="number" name="country_count"
                                       value="{{ $business_download['country_count'] }}" id="country_count"
                                       class="form-control" placeholder="{{ translate('country_count') }}"
                                       required>
                            </div>
                            <div>
                                <label class="input-label"
                                       for="country_description">{{ translate('country_description') }}</label>
                                <textarea class="form-control" name="country_description" id="country_description" rows="4"
                                          placeholder="{{ translate('country_sort_description') }}">{{ $business_download['country_sort_description'] }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                    <button type="reset" class="btn btn-secondary">{{ translate('reset') }}</button>
                    <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                            class="btn btn-primary demo-form-submit">{{ translate('save') }}</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        @php($testimonial = isset($testimonialData->value) ? json_decode($testimonialData->value, true) : null)
        <div class="card-body">
            <h5 class="card-title mb-4">
                <span class="card-header-icon mr-2"><i class="tio-calendar"></i></span>
                <span>{{ translate('testimonial') }}</span>
            </h5>

            <form method="post" enctype="multipart/form-data" id="landing-info-update-form2">
                @csrf
                @method('PUT')
                <div class="row justify-content-center align-items-end">
                    <div class="col-lg-8 col-xxl-9">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="input-label" for="name">{{ translate('Reviewer Name') }}
                                        <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                           placeholder="{{ translate('name') }}" required>
                                    <input type="hidden" name="type" value="testimonial">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="rating">{{ translate('rating') }}</label>
                                    <select name="rating" id="rating"
                                            class="form-control js-select2-custom" required>
                                        <option value="0.5">{{ translate('0.5') }}</option>
                                        <option value="1">{{ translate('1') }}</option>
                                        <option value="1.5">{{ translate('1.5') }}</option>
                                        <option value="2">{{ translate('2') }}</option>
                                        <option value="2.5">{{ translate('2.5') }}</option>
                                        <option value="3">{{ translate('3') }}</option>
                                        <option value="3.5">{{ translate('3.5') }}</option>
                                        <option value="4">{{ translate('4') }}</option>
                                        <option value="4.5">{{ translate('4.5') }}</option>
                                        <option value="5">{{ translate('5') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="user_type">{{ translate('user_type') }}</label>
                                    <input type="text" name="user_type" id="user_type"
                                           class="form-control" placeholder="{{ translate('user_type') }}"
                                           required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="input-label" for="opinion">{{ translate('Review') }} <span
                                            class="text-danger">*</span></label>
                                    <textarea name="opinion" id="opinion" class="form-control" rows="4"
                                              placeholder="{{ translate('Ex: Very Good Company') }}" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xxl-3">
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                                <label class="text-dark mb-0">{{ translate('Reviewer Image') }}</label>
                                <small class="text-info">( {{ translate('1:1') }} )</small>
                            </div>

                            <div class="text-center mb-4">
                                <img class="border rounded-10 mx-w300 w-100 contain-twoByOne p-3" id="viewer3"
                                     src="{{ dynamicAsset(path: 'public/assets/admin/img/900x400/img1.jpg') }}"
                                     alt="{{ translate('image') }}" />
                            </div>

                            <div class="custom-file">
                                <input type="file" name="image" id="customFileEg3"
                                       class="custom-file-input"
                                       accept=".{{ implode(',.', array_column(IMAGE_EXTENSIONS, 'key')) }}"
                                       data-maxFileSize="{{ readableUploadMaxFileSize('image') }}">
                                <label class="custom-file-label" for="customFileEg3">{{ translate('choose') }}
                                    {{ translate('file') }}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3">
                    <button type="reset" class="btn btn-secondary">{{ translate('reset') }}</button>
                    <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                            class="btn btn-primary demo-form-submit">{{ translate('save') }}</button>
                </div>
            </form>
        </div>

        <div class="card-body p-30">
            <div class="table-responsive">
                <table id="example"
                       class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                    <thead class="thead-light">
                    <tr>
                        <th>{{ translate('Reviewer Image') }}</th>
                        <th>{{ translate('Reviewer Name') }}</th>
                        <th>{{ translate('opinion') }}</th>
                        <th>{{ translate('rating') }}</th>
                        <th>{{ translate('User_Type') }}</th>
                        <th>{{ translate('status') }}</th>
                        <th>{{ translate('action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($testimonial ?? [] as $key => $item)
                        <tr>
                            <td>
                                <img class="width-50px height-50px"
                                     src="{{ Helpers::onErrorImage($item['image'], dynamicStorage(path: 'storage/app/public/landing-page/testimonial') . '/' . $item['image'], dynamicAsset(path: 'public/assets/admin/img/900x400/img1.jpg'), 'landing-page/testimonial/') }}"
                                     alt="{{ translate('image') }}">
                            </td>
                            <td>{{ $item['name'] }}</td>
                            <td>
                                <div class="word-break">{{ $item['opinion'] }}</div>
                            </td>
                            <td>{{ $item['rating'] }}</td>
                            <td>{{ $item['user_type'] }}</td>
                            <td>
                                <label class="switcher" for="welcome_status_{{ $key }}">
                                    <input type="checkbox" name="welcome_status"
                                           class="switcher_input change-status"
                                           data-route="{{ route('admin.landing-settings.landing-status-change', [$webPage, $item['id']]) }}"
                                           id="welcome_status_{{ $key }}"
                                        {{ $item ? ($item['status'] == 1 ? 'checked' : '') : '' }}>
                                    <span class="switcher_control"></span>
                                </label>
                            </td>
                            <td>
                                <div class="table-actions d-flex gap-2">
                                    <button type="button"
                                            class="action-btn btn btn-outline-primary edit-testimonial"
                                            data-key="{{ $key }}">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>

                                    <button type="button" data-id="delete-{{ $item['id'] }}"
                                            data-message="{{ translate('want_to_delete_this') }}?"
                                            class="action-btn btn btn-outline-danger form-alert">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </button>
                                    <form
                                        action="{{ route('admin.landing-settings.delete-landing-information', [$webPage, $item['id']]) }}"
                                        method="post" id="delete-{{ $item['id'] }}" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
<div class="modal fade" id="section-view-modal-business-statistics" tabindex="-1"
     aria-labelledby="section-view-modalLabel-business-statistics" aria-hidden="true">
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
                         src="{{ dynamicAsset(path: 'public/assets/landing/img/section-view/business-statistics.png') }}"
                         alt="{{ translate('image') }}">
                </div>
            </div>
        </div>
    </div>
</div>

