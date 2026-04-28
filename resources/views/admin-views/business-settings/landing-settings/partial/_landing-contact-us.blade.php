@if ($webPage == 'contact_us_section')
    @php($contact_us = isset($data->value) ? json_decode($data->value, true) : null)
    <div class="d-flex justify-content-end gap-3 mb-3">
        <button type="button" class="btn btn-outline-primary d-flex gap-2 align-items-center"
                data-toggle="modal" data-target="#section-view-modal-contact">Section View <i
                class="tio-document-text"></i></button>

        <button type="button" class="btn btn-outline-primary d-flex gap-2 align-items-center"
                data-toggle="modal" data-target="#notes-view-modal">Notes <i class="tio-info"></i></button>
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
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="input-label" for="title">{{ translate('title') }}</label>
                            <input type="text" name="title" value="{{ $contact_us['title'] }}"
                                   id="title" class="form-control" placeholder="{{ translate('title') }}"
                                   required>
                        </div>
                    </div>
                    <div class="col-lg-6 ">
                        <div class="form-group">
                            <label class="input-label" for="sub_title">{{ translate('sub_title') }}</label>
                            <input type="text" value="{{ $contact_us['sub_title'] }}" name="sub_title"
                                   id="sub_title" class="form-control"
                                   placeholder="{{ translate('sub_title') }}" required>
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
<div class="modal fade" id="section-view-modal-contact" tabindex="-1"
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
                         src="{{ dynamicAsset(path: 'public/assets/landing/img/section-view/contact.png') }}"
                         alt="{{ translate('image') }}">
                </div>
            </div>
        </div>
    </div>
</div>
