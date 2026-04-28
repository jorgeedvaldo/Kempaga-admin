<div class="modal fade" id="customModal">
    <div class="modal-dialog status-warning-modal">
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
                            <img alt="" class="mb-4" id="icon"
                                 src="{{dynamicAsset(path: 'public/assets/admin-module/img/svg/blocked_customer.svg')}}">
                            <h5 class="modal-title mb-3" id="modalTitle">{{translate("Are you sure?")}}</h5>
                        </div>
                        <div class="text-center mb-4 pb-2">
                            <p id="subTitle">{{translate("Want to change status")}}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="button" class="btn btn-secondary min-w-120" id="modalCancelBtn">{{translate('Cancel')}}</button>
                        <button type="button" class="btn btn-primary min-w-120" id="modalConfirmBtn">{{translate('Ok')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




{{--Custom delete modal--}}
<div class="modal fade" id="customDeleteModal" tabindex="-1" role="dialog" aria-labelledby="customDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="">
                <div class="modal-header">
                    <button type="button" class="close fs-28" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <img src="{{ dynamicAsset(path: 'public/assets/admin/svg/components/delete.svg') }}" alt="Delete Icon" style="width: 50px;">
                    </div>
                    <h4><span id="customDeleteTitle">{{ translate('Are you sure you want to delete') }}</span>?</h4>
                    <p class="text-muted" id="customDeleteSubtitle">{{ translate('Once you delete it, this will permanently remove it from the Blog list and can not be accessed.') }}</p>
                </div>
                <div class="d-flex justify-content-center gap-3 my-3 flex-wrap">
                    <button type="button" id="customConfirmDeleteBtn" class="btn btn-danger">{{ translate('Yes') }}, {{ translate('Delete') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('Not Now') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>







