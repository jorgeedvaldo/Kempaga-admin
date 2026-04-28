@if ($webPage == 'how_it_works_section')
    @php($how_it_works = isset($data->value) ? json_decode($data->value, true) : null)
    <div class="d-flex justify-content-end gap-3 mb-3">
        <button type="button" class="btn btn-outline-primary d-flex gap-2 align-items-center"
                data-toggle="modal" data-target="#section-view-modal-how-it-works">Section View <i
                class="tio-document-text"></i></button>

        <button type="button" class="btn btn-outline-primary d-flex gap-2 align-items-center"
                data-toggle="modal" data-target="#notes-view-modal">Notes <i class="tio-info"></i></button>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title mb-4 ">
                <span class="card-header-icon mr-2"><i class="tio-calendar"></i></span>
                <span>{{ translate('section_Title') }}</span>
            </h5>

            <form method="post" id="landing-info-title-status-form">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6">
                        <label class="form-label d-none d-lg-block">&nbsp;</label>
                        <div
                            class="maintainance-mode-toggle-bar d-flex flex-wrap justify-content-between border rounded align-items-center p-2">
                            <h5 class="text-capitalize m-0">
                                {{ translate('how_it_works_section_landing_page') }}
                                <i class="tio-info-outined" data-toggle="tooltip"
                                   title="{{ translate('You_can_turn_off/on_how_it_works_section_of_landing_page') }}"></i>
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
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="input-label" for="title">{{ translate('header_title') }}</label>
                            <input type="text" name="title" value="{{ $title }}" id="works_title"
                                   class="form-control" placeholder="{{ translate('title') }}" required>
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
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4 ">
                <span class="card-header-icon mr-2"><i class="tio-calendar"></i></span>
                <span>{{ translate($webPage) }}</span>
            </h5>
            <form method="post" enctype="multipart/form-data" id="landing-info-update-form">
                @csrf
                @method('PUT')
                <div class="row align-items-end">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="input-label" for="title">{{ translate('title') }}</label>
                            <input type="text" name="title" id="title" class="form-control"
                                   placeholder="{{ translate('title') }}" required>
                        </div>

                        <div class="form-group">
                            <label class="input-label" for="sub_title">{{ translate('sub_title') }}</label>
                            <input type="text" name="sub_title" id="sub_title" class="form-control"
                                   placeholder="{{ translate('sub_title') }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                                <label class="text-dark mb-0">{{ translate('Image') }}</label>
                                <small class="text-info"> ( {{ translate('1:1') }} )</small>
                            </div>

                            <div class="text-center mb-4">
                                <img class="border rounded-10 mx-w300 w-100" id="viewer3"
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
                        <th>{{ translate('title') }}</th>
                        <th>{{ translate('sub_title') }}</th>
                        <th>{{ translate('image') }}</th>
                        <th>{{ translate('status') }}</th>
                        <th>{{ translate('action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($how_it_works ?? [] as $key => $item)
                        <tr>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ $item['sub_title'] }}</td>
                            <td>
                                <img class="height-50px width-50px"
                                     src="{{ Helpers::onErrorImage($item['image'], dynamicStorage(path: 'storage/app/public/landing-page/how-it-works') . '/' . $item['image'], dynamicAsset(path: 'public/assets/admin/img/900x400/img1.jpg'), 'landing-page/how-it-works/') }}"
                                     alt="{{ translate('image') }}">
                            </td>
                            <td>
                                <label class="switcher" for="welcome_status_{{ $key }}">
                                    <input type="checkbox" name="welcome_status"
                                           class="switcher_input change-status"
                                           id="welcome_status_{{ $key }}"
                                           {{ $item ? ($item['status'] == 1 ? 'checked' : '') : '' }}
                                           data-route="{{ route('admin.landing-settings.landing-status-change', [$webPage, $item['id']]) }}">
                                    <span class="switcher_control"></span>
                                </label>
                            </td>
                            <td>
                                <div class="table-actions d-flex gap-2">
                                    <button type="button"
                                            class="action-btn btn btn-outline-primary edit-how-it-works"
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
<div class="modal fade" id="section-view-modal-how-it-works" tabindex="-1"
     aria-labelledby="section-view-modalLabel-how-it-works" aria-hidden="true">
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
                         src="{{ dynamicAsset(path: 'public/assets/landing/img/section-view/Frame.png') }}"
                         alt="{{ translate('image') }}">
                </div>
            </div>
        </div>
    </div>
</div>
