@extends('layouts.admin.app')

@section('title', translate('Report Disputes'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex align-items-center gap-3 pb-2">
            <img width="24" src="{{dynamicAsset(path: 'public/assets/admin/img/media/business-setup.png')}}" alt="{{ translate('business_setup') }}">
            <h2 class="page-header-title">{{translate('Business Setup')}}</h2>
        </div>

        <div class="inline-page-menu my-4">
            @include('admin-views.business-settings.partial._business-setup-tabs')
        </div>

        <div class="card mb-3">
            <form action="{{route('admin.business-settings.report-disputes-status')}}" method="post" id="report_disputes_status_form">
                @csrf
                <div class="card-header">
                    <div class="d-flex flex-wrap flex-grow-1 justify-content-between">
                        <div>
                            <h5 class="mb-0 text-capitalize d-flex align-items-center gap-1">{{translate('report_disputes')}}</h5>
                            <span>{{ translate('Enable customer reports and dispute resolution features for your platform.') }}</span>
                        </div>
                        <div>
                            @php($reportStatus=\App\CentralLogics\helpers::get_business_settings('report_disputes_status'))
                            <label class="switcher mx-auto">
                                <input type="checkbox" class="switcher_input"  name="report_disputes_status" id="report_disputes_status"
                                       onclick="toogleStatusModal(event,'report_disputes_status','green-info.svg','green-info.svg',
                                           '{{translate('Enable the Status')}}?','{{translate('Disable the Status')}}?',
                                           `<p>{{translate('Are you sure you want to enable the Disputes feature')}}?</p>`,
                                                `<p>{{translate('Are you sure you want to disable the Disputes feature')}}?</p>`)"

                                    {{ isset($reportStatus) && $reportStatus == 1 ? 'checked': '' }}>
                                <span class="switcher_control"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <form action="{{route('admin.business-settings.disputes-reason-time-update')}}" method="post">
                    @csrf
                    <div class="row g-lg-3 g-2 align-items-center">
                        <div class="col-xxl-5 col-lg-5">
                            <h6 class="mb-1">{{ translate('Setup Report Disputes Time') }}</h6>
                            <span class="mb-0">{{ translate('Define how long customers and agent can report disputes after completing a transaction.') }}</span>
                        </div>
                        @php($reportDisputeTime=\App\CentralLogics\helpers::get_business_settings('report_dispute_time'))
                        @php($reportDisputeTimeType=\App\CentralLogics\helpers::get_business_settings('report_dispute_time_type'))
                        <div class="col-xxl-7 col-lg-7">
                            <div class="bg-light p-4 rounded">
                                <label class="input-label fw-normal text-muted fz-14" for="">{{ translate('Report Disputes Time') }}</label>
                                <div class="d-flex border">
                                    <input type="number" class="form-control border-0" name="report_dispute_time" value="{{ $reportDisputeTime }}" step="1" min="1" placeholder="Ex: 5" required>
                                    <div>
                                        <select name="report_dispute_time_type" id="" class="bg-soft-secondary px-2 border-0 h-100">
                                            <option value="day" {{ $reportDisputeTimeType == 'day' ? 'selected' : '' }}>{{ translate('day') }}</option>
                                            <option value="hour" {{ $reportDisputeTimeType == 'hour' ? 'selected' : '' }}>{{ translate('hour') }}</option>
                                            <option value="minute" {{ $reportDisputeTimeType == 'minute' ? 'selected' : '' }}>{{ translate('minute') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-3">
                        <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}" class="btn btn-primary demo-form-submit">{{translate('save')}}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <form action="{{route('admin.business-settings.disputes-reason-store')}}" method="post">
                    @csrf
                    <div class="row g-lg-3 g-2 align-items-center">
                        <div class="col-xxl-5 col-lg-5">
                            <h6 class="mb-1">{{ translate('Setup Report Disputes Reasons') }}</h6>
                            <span class="mb-0">{{ translate('Here you can set the reasons that customers or Agent choose when Report Fraud and Disputes send.') }}</span>
                        </div>
                        <div class="col-xxl-7 col-lg-7">
                            <div class="bg-light p-4 rounded">
                                <label class="input-label fw-normal text-muted fz-14" for="">{{ translate('Report Disputes Reason') }}
                                    <i class="tio-info text-muted" data-toggle="tooltip" data-placement="top" title="{{ translate('Provide a reason for your report or dispute to help customers or agents review the issue accurately.') }}"></i>
                                </label>
                                <div class="d-flex border">
                                    <input type="text" class="form-control border-0" name="reason" maxlength="150" id="reason" required>
                                    <div>
                                        <select name="user_type" id="" class="bg-soft-secondary px-2 border-0 h-100">
                                            <option value="customer">{{ translate('Customer') }}</option>
                                            <option value="agent">{{ translate('Agent') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-1">
                                    <small id="reason_text_count" class="text-muted text-right">0/150</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-4">
                        <button type="reset" class="btn btn-secondary">{{translate('reset')}}</button>
                        <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}" class="btn btn-primary demo-form-submit">{{translate('submit')}}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header d-flex justify-content-end __wrap-gap-10">
                        <div class="flex-grow-1 d-flex align-items-center">
                            <h5 class="card-header-title">{{ translate('Report_List') }}</h5>
                            <span class="badge badge-soft-secondary text-dark ml-2">{{ $disputeReasons->total() }}</span>
                        </div>
                        <div class="min-w-140">
                            <select name="user_type" class="form-control" id="user_type_select" >
                                <option value="all" {{ ($queryParam['user_type'] ?? '') == 'all' ? 'selected' : '' }}>{{ translate('All') }}</option>
                                <option value="customer" {{ ($queryParam['user_type'] ?? '') == 'customer' ? 'selected' : '' }}>{{ translate('customer') }}</option>
                                <option value="agent" {{ ($queryParam['user_type'] ?? '') == 'agent' ? 'selected' : '' }}>{{ translate('agent') }}</option>
                            </select>
                        </div>

                        <form action="{{ url()->current() }}" method="get" class="d-flex gap-2 align-items-center" id="search_form">
                            <input type="hidden" name="user_type" id="user_type_hidden" value="{{ $queryParam['user_type'] ?? 'all' }}">

                            <div class="input-group">
                                <input id="datatableSearch_" type="search" name="search" class="form-control mn-md-w280"
                                       placeholder="{{ translate('Search with reason') }}" aria-label="Search"
                                       value="{{ $queryParam['search'] ?? '' }}" autocomplete="off">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">{{ translate('Search') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive datatable-custom">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table table-striped">
                            <thead class="thead-light">
                            <tr>
                                <th>{{translate('SL')}}</th>
                                <th>{{translate('Report Reason')}}</th>
                                <th>{{translate('Reason for Whom')}}</th>
                                <th>{{translate('status')}}</th>
                                <th class="text-center">{{translate('Action')}}</th>
                            </thead>

                            <tbody>
                            @forelse($disputeReasons as $key => $disputeReason)
                                <tr>
                                    <td>{{ $disputeReasons->firstitem()+$key }}</td>
                                    <td class="text-wrap min-w-260 text-capitalize">{{ $disputeReason->reason }}</td>
                                    <td class="text-capitalize">{{ $disputeReason->user_type }}</td>
                                    <td>
                                        <label class="switcher">
                                            <input type="checkbox" class="switcher_input change-reason-status"
                                                   data-id="{{ $disputeReason->id }}"
                                                   data-icon="{{ dynamicAsset(path: 'public/assets/admin/svg/components/info.svg')}}"
                                                   data-title="{{ $disputeReason->status == 1 ? translate('Are you sure to turn off the Reason status') . '? ' : translate('Are you sure to turn on the Reason status?') . '? ' }}"
                                                   data-sub-title="{{ $disputeReason->status == 1 ? translate('Once you turn off, it will not be visible to the Dispute Reason list for users') : translate('When you turn on this FAQ, It will be visible to the Dispute Reason list for users') }}"
                                                   data-confirm-btn="{{ $disputeReason->status == 1 ? translate('Yes, Off') : translate('Yes, On') }}"
                                                   data-url="{{route('admin.business-settings.disputes-reason-status',[$disputeReason['id']])}}"

                                                {{$disputeReason['status'] == 1 ? 'checked' : ''}}>
                                            <span class="switcher_control"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button class="action-btn btn btn-outline-info open-edit-modal"
                                                    type="button"
                                                    data-toggle="modal"
                                                    data-target="#editReasonModal"
                                                    data-id="{{ $disputeReason->id }}"
                                                    data-reason="{{ $disputeReason->reason }}"
                                                    data-user_type="{{ $disputeReason->user_type }}"
                                            >
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button>
                                            <button class="action-btn btn btn-outline-danger delete-reason"
                                                    data-route="{{route('admin.business-settings.disputes-reason-delete', [$disputeReason['id']])}}">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        <img class="mt-5" src="{{ dynamicAsset(path: 'public/assets/admin/svg/illustrations/empty-table.svg') }}" alt="empty-table-image">
                                        <p class="my-2">{{ translate('No Report Reasons Yet') }}</p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="table-responsive mt-4 px-3">
                            <div class="d-flex justify-content-end">
                                {!! $disputeReasons->links() !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="toggle-status-modal">
        <div class="modal-dialog status-warning-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="tio-clear"></span>
                    </button>
                </div>
                <div class="modal-body pb-5 pt-0">
                    <div class="max-349 mx-auto mb-5">
                        <div>
                            <div class="text-center">
                                <img id="toggle-status-image" alt="{{ translate('image') }}" class="mb-3">
                                <h5 class="modal-title" id="toggle-status-title"></h5>
                            </div>
                            <div class="text-center" id="toggle-status-message">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="button" id="toggle-status-ok-button" class="btn btn-primary min-w-120 mr-3" data-dismiss="modal">
                                {{translate('Ok')}}
                            </button>
                            <button id="reset_btn" type="reset" class="btn btn-warning min-w-120" data-dismiss="modal">
                                {{translate("Cancel")}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- edit reason Modal -->
    <div class="modal fade" id="editReasonModal" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header px-2 pt-3 pb-0">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="tio-clear"></span>
                    </button>
                </div>

                <div class="card-body">
                    <form action="{{route('admin.business-settings.disputes-reason-update')}}" method="post">
                        @csrf
                        <input type="hidden" name="reason_id" id="reason_id" value="">
                        <div class="row g-lg-3 g-2 align-items-center">
                            <div class="col-xxl-5 col-lg-5">
                                <h6 class="mb-1">{{ translate('Edit Report Disputes Reasons') }}</h6>
                                <span class="mb-0">{{ translate('Here you can set the reasons that customers or Agent choose when Report Fraud and Disputes send.') }}</span>
                            </div>
                            <div class="col-xxl-7 col-lg-7">
                                <div class="">
                                    <label class="input-label fw-normal text-muted fz-14" for="">{{ translate('Report Disputes Reason') }}
                                        <i class="tio-info text-muted" data-toggle="tooltip" data-placement="top" title="{{ translate('Provide a reason for your report or dispute to help customers or agents review the issue accurately.') }}"></i>
                                    </label>
                                    <div class="d-flex border">
                                        <input type="text" class="form-control border-0" name="reason" id="edit_reason" value="" maxlength="255" required>
                                        <div>
                                            <select name="user_type" id="edit_user_type" class="bg-soft-secondary px-2 border-0 h-100">
                                                <option value="customer">{{ translate('Customer') }}</option>
                                                <option value="agent">{{ translate('Agent') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-5">
                            <button id="reset_btn" type="reset" class="btn btn-secondary min-w-120" data-dismiss="modal">
                                {{ translate('Cancel') }}
                            </button>
                            <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}" class="btn btn-primary min-w-120 demo-form-submit">{{translate('updated')}}</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <!-- Status Change Modal -->
    <div class="modal fade" id="faqStatusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
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


@endsection

@push('script_2')
    <script>

        function toogleStatusModal(e, toggle_id, on_image, off_image, on_title, off_title, on_message, off_message) {
            e.preventDefault();
            if ($('#'+toggle_id).is(':checked')) {
                $('#toggle-status-title').empty().append(on_title);
                $('#toggle-status-message').empty().append(on_message);
                $('#toggle-status-image').attr('src', "{{dynamicAsset(path: 'public/assets/admin/svg/illustrations')}}/"+on_image);
                $('#toggle-status-ok-button').attr('toggle-ok-button', toggle_id);
            } else {
                $('#toggle-status-title').empty().append(off_title);
                $('#toggle-status-message').empty().append(off_message);
                $('#toggle-status-image').attr('src', "{{dynamicAsset(path: 'public/assets/admin/svg/illustrations')}}/"+off_image);
                $('#toggle-status-ok-button').attr('toggle-ok-button', toggle_id);
            }
            $('#toggle-status-modal').modal('show');
        }
        $('#toggle-status-ok-button').on('click', function (){
            var toggle_id = $('#toggle-status-ok-button').attr('toggle-ok-button');
            if ($('#'+toggle_id).is(':checked')) {
                $('#'+toggle_id).prop('checked', false);
                $('#'+toggle_id).val(0);
            } else {
                $('#'+toggle_id).prop('checked', true);
                $('#'+toggle_id).val(1);
            }
            $('#report_disputes_status_form').submit();
        });

        $(".delete-reason").on('click', function (){
            let route = $(this).data('route');
            swal({
                title: "{{ translate('Are you sure') }}?",
                text: "{{ translate('You will not be able to revert this') }} !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                showCancelButton: true,
            })
                .then((result) => {
                    console.log(result);
                    if (result.value === true) {
                        window.location.href = route;
                    }
                });
        });

        $(document).ready(function () {
            $('#user_type_select').on('change', function () {
                let selectedValue = $(this).val();
                $('#user_type_hidden').val(selectedValue);
                $('#search_form').submit();
            });
        });

        $(document).on('click', '.open-edit-modal', function () {
            const button = $(this);
            const modal = $('#editReasonModal');

            modal.find('#reason_id').val(button.data('id'));
            modal.find('#edit_reason').val(button.data('reason'));
            modal.find('#edit_user_type').val(button.data('user_type')); // This selects the correct option

        });


        $(document).ready(function () {
            // Function to update character count
            function updateCharCount(inputSelector, countSelector, maxLength) {
                $(inputSelector).on('input', function () {
                    const charCount = $(this).val().length;
                    $(countSelector).text(`${charCount}/${maxLength}`);
                });

                // Update the count on page load (for pre-filled values)
                const initialCount = $(inputSelector).val().length;
                $(countSelector).text(`${initialCount}/${maxLength}`);
            }

            // Initialize character count for deny Note
            updateCharCount('#reason', '#reason_text_count', 150);
        });

        $('.change-reason-status').on('change', function () {
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

    </script>
@endpush
