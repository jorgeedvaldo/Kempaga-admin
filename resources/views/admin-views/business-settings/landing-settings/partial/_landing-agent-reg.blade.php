@if ($webPage == 'agent_registration_section')
    @php($agent_registration = isset($data->value) ? json_decode($data->value, true) : null)
    <div class="d-flex justify-content-end gap-3 mb-3">
        <button type="button" class="btn btn-outline-primary d-flex gap-2 align-items-center"
                data-toggle="modal" data-target="#section-view-modal-agent-registration">Section View <i
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
                                {{ translate('agent_registration_section_landing_page') }}
                                <i class="tio-info-outined" data-toggle="tooltip"
                                   title="{{ translate('You_can_turn_off/on_agent_registration_section_of_landing_page') }}"></i>
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
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">
                <span class="card-header-icon mr-2"><i class="tio-calendar"></i></span>
                <span>{{ translate($webPage) }}</span>
            </h5>
            <form method="post" enctype="multipart/form-data" id="landing-info-update-form">
                @csrf
                @method('PUT')
                <div class="row align-items-end">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="input-label" for="title">{{ translate('title') }}</label>
                            <input type="text" name="title" value="{{ $agent_registration['title'] }}"
                                   id="title" class="form-control" placeholder="{{ translate('title') }}"
                                   required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                            <label class="text-dark mb-0">{{ translate('Background Image') }}</label>
                            <small class="text-info"> ( {{ translate('5:1') }} )</small>
                        </div>
                        <div class="text-center mb-4">
                            <img class="border rounded-10 mx-w300 w-100" id="viewer3"
                                 src="{{ Helpers::onErrorImage($agent_registration['banner'], dynamicStorage(path: 'storage/app/public/landing-page/agent-registration') . '/' . $agent_registration['banner'], dynamicAsset(path: 'public/assets/admin/img/900x400/img1.jpg'), 'landing-page/agent-registration/') }}" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="banner" id="customFileEg3"
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
    </div>
@endif
<div class="modal fade" id="section-view-modal-agent-registration" tabindex="-1"
     aria-labelledby="section-view-modalLabel-agent-registration" aria-hidden="true">
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
                         src="{{ dynamicAsset(path: 'public/assets/landing/img/section-view/agent-reg.png') }}"
                         alt="{{ translate('image') }}">
                </div>
            </div>
        </div>
    </div>
</div>

