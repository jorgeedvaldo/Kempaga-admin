@if ($webPage == 'screenshots')
    @php($screenshots = isset($data->value) ? json_decode($data->value, true) : null)

        <?php
        if (is_array($screenshots)) {
            $screenshots = array_reverse($screenshots);
        }
        ?>

    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between gap-3 mb-3">
                <h5 class="card-title mb-3">
                    <span class="card-header-icon mr-2"><i class="tio-calendar"></i></span>
                    <span>{{ translate('header_section') }} ({{ translate('default') }})</span>
                </h5>
                <button type="button" class="btn btn-outline-primary d-flex gap-2 align-items-center"
                        data-toggle="modal" data-target="#section-view-modal-screenshots">Section View <i
                        class="tio-document-text"></i></button>
            </div>

            <form method="post" id="landing-info-title-status-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="web_page" value="screenshots">
                <div class="row">
                    <div class="col-lg-12">
                        <div
                            class="d-flex flex-wrap justify-content-between border rounded align-items-center p-2 mb-5">
                            <h5 class="text-capitalize m-0">
                                {{ translate('screenshot_section_landing_page') }}
                                <i class="tio-info-outined" data-toggle="tooltip"
                                   title="{{ translate('You_can_turn_off/on_screenshot_section_of_landing_page') }}"></i>
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

    <div class="card mb-3" id="landing_page_screenshot_image_section">
        <div class="card-body">
            <h5 class="card-title mb-4">
                <span class="card-header-icon mr-2"><i class="tio-calendar"></i></span>
                <span>{{ translate('image_Section') }}</span>
            </h5>

            <form method="post" enctype="multipart/form-data" id="landing-info-update-form">
                @csrf
                @method('PUT')
                <div class="row align-items-end">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="d-flex flex-column align-items-center text-center">
                                <h4 class="mb-20 pb-1">{{ translate('Screenshot Image') }}</h4>

                                <div class="upload-file new auto profile-image-upload-file screenshot-image-upload-file">
                                    <!-- Edit -->
                                    <button type="button" class="upload-file__edit-btn btn rounded-circle btn-outline-primary" aria-label="add file">
                                        <i class="tio-edit"></i>
                                    </button>
                                    <!-- Edit End -->
                                    <input type="hidden" name="id" id="existing_image_id" value="">
                                    <input type="file" name="image" class="upload-file__input"
                                           accept=".{{ implode(',.', array_column(IMAGE_EXTENSIONS, 'key')) }}"
                                           data-maxFileSize="{{ readableUploadMaxFileSize('image') }}"
                                           required>
                                    <div
                                        class="upload-file__img banner w-100 h-100 border-gray d-flex justify-content-center align-items-center mw-100 p-0 bg-white">
                                        <div class="upload-file__textbox text-center">
                                            <img height="34" src="{{dynamicAsset(path: 'public/assets/admin/img/upload.svg')}}" alt=""
                                                 class="svg ratio-2">
                                            <h6 class="mt-2 fw-semibold">
                                                <span class="text-info">{{ translate('Click to upload') }}</span>
                                                <br>
                                                {{ translate('or drag and drop') }}
                                            </h6>
                                        </div>
                                        <img class="upload-file__img__img h-100 ratio-2" width="180" height="180" loading="lazy" alt="">
                                    </div>

                                </div>

                                <div class="mt-3 text-center">
                                    <label class="text-dark fs-14 mb-1">{{ translate('Min Size for Better Resolution 300x620 px') }}</label>
                                    <p class="mb-0 fs-12">
                                        {{ implode(', ', array_column(IMAGE_EXTENSIONS, 'key')) }} : Max {{ readableUploadMaxFileSize('image') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3">
                    <button type="reset" class="btn btn-secondary upload-file__reset-btn">{{ translate('reset') }}</button>
                    <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                            class="btn btn-primary demo-form-submit">{{ translate('save') }}</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <div class="table-responsive table-header-sticky">
                <table id="example"
                       class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                    <thead class="thead-light">
                    <tr>
                        <th>{{ translate('SL') }}</th>
                        <th>{{ translate('image') }}</th>
                        <th class="text-center">{{ translate('status') }}</th>
                        <th class="text-center">{{ translate('action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($screenshots ?? [] as $key => $item)
                        @php($imgSrc = \App\CentralLogics\Helpers::onErrorImage($item['image'], dynamicStorage(path: 'storage/app/public/landing-page/screenshots') . '/' . $item['image'], dynamicAsset(path: 'public/assets/admin/img/900x400/img1.jpg'), 'landing-page/screenshots/'))
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                <img class="max-width-180px max-height-180px ss-img-preview cursor-pointer"
                                     src="{{ $imgSrc }}"
                                     alt="{{ translate('image') }}">
                            </td>
                            <td>
                                <label class="switcher mx-auto" for="welcome_status_{{ $key }}">
                                    <input type="checkbox" name="welcome_status"
                                           class="switcher_input change-status"
                                           id="welcome_status_{{ $key }}"
                                           {{ $item ? ($item['status'] == 1 ? 'checked' : '') : '' }}
                                           data-route="{{ route('admin.landing-settings.landing-status-change', [$webPage, $item['id']]) }}">
                                    <span class="switcher_control"></span>
                                </label>
                            </td>
                            <td>
                                <div class="table-actions d-flex gap-2 justify-content-center">
                                    <button type="button"
                                            class="action-btn btn btn-outline-primary edit-screenshots"
                                            data-img="{{ $imgSrc }}" data-id="{{ $item['id'] }}">
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

    <!-- Screenshot - Image Preview Modal -->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg position-relative">
            <div class="modal-content text-center p-0">
                <div class="modal-body position-relative p-0">
                    <div class="d-flex align-items-center justify-content-between mb-2 px-3 py-2">
                        <h5 class="img_name text-white mb-0"></h5>
                        <button type="button" class="btn-close bg-transparent border-0 fs-24 p-0 btn-close-white"
                                data-dismiss="modal" aria-label="Close">
                            <i class="tio-clear"></i>
                        </button>
                    </div>

                    <div class="mx-4 max-height-700px">
                        <img id="preview-image" src="" class="img-fluid rounded user-select-none" alt="preview">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="modal fade" id="section-view-modal-screenshots" tabindex="-1"
     aria-labelledby="section-view-modalLabel-screenshots" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close fs-28" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <img width="100%"
                         src="{{ dynamicAsset(path: 'public/assets/landing/img/section-view/screenshots.png') }}"
                         alt="{{ translate('image') }}">
                </div>
            </div>
        </div>
    </div>
</div>
