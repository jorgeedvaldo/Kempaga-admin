@extends('layouts.admin.app')

@section('title', translate('Report Disputes'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex align-items-center gap-3 mb-3">
            <img width="22" src="{{ dynamicAsset(path: 'public/assets/admin/img/media/business-setup.png') }}"
                alt="{{ translate('report_disputes') }}">
            <h1 class="page-header-title">{{ translate('report_disputes') }}</h1>
        </div>

        <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom gap-3 mb-5">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ $transactionType == 'pending' ? 'active' : '' }}"
                        href="{{ url()->current() }}?trx_type=pending">
                        {{ translate('Pending') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $transactionType == 'approved' ? 'active' : '' }}"
                        href="{{ url()->current() }}?trx_type=approved">
                        {{ translate('Approved') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $transactionType == 'disputed' ? 'active' : '' }}"
                        href="{{ url()->current() }}?trx_type=disputed">
                        {{ translate('Disputed') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $transactionType == 'denied' ? 'active' : '' }}"
                        href="{{ url()->current() }}?trx_type=denied">
                        {{ translate('Denied') }}
                    </a>
                </li>
            </ul>
        </div>

        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header d-flex justify-content-end __wrap-gap-10">
                        <div class="flex-grow-1 d-flex align-items-center">
                            <h5 class="card-header-title">{{ translate('Report_List') }}</h5>
                            <span class="badge badge-soft-secondary text-dark ml-2">{{ $disputes->total() }}</span>
                        </div>
                        <div class="min-w-140">
                            <select name="sender_type" class="form-control" id="sender_type_select">
                                <option value="all" {{ ($senderType ?? '') == 'all' ? 'selected' : '' }}>
                                    {{ translate('All') }}</option>
                                <option value="customer" {{ ($senderType ?? '') == 'customer' ? 'selected' : '' }}>
                                    {{ translate('customer') }}</option>
                                <option value="agent" {{ ($senderType ?? '') == 'agent' ? 'selected' : '' }}>
                                    {{ translate('agent') }}</option>
                            </select>
                        </div>
                        <div>
                            <form action="{{ request()->url() }}" method="GET">
                                @foreach (request()->except('search', 'page') as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach

                                <div class="input-group">
                                    <input id="datatableSearch_" type="search" name="search"
                                        class="form-control mn-md-w280"
                                        placeholder="{{ translate('Search by name, reason, comment transaction id') }}"
                                        aria-label="Search" value="{{ $search }}" autocomplete="off">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">
                                            {{ translate('Search') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive datatable-custom">
                        <table
                            class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{ translate('SL') }}</th>
                                    <th>{{ translate('Sender') }}</th>
                                    <th>{{ translate('Sender_Type') }}</th>
                                    <th>{{ translate('Amount') }}</th>
                                    <th>{{ translate('Transaction_Id') }}</th>
                                    <th>{{ translate('status') }}</th>
                                    <th>{{ translate('Sending_Time') }}</th>
                                    <th>{{ translate('Report_Reason') }}</th>
                                    <th>{{ translate('Comments') }}</th>
                                    @if ($disputes->contains('status', 'denied'))
                                        <th>{{ translate('Deny_Note') }}</th>
                                    @endif
                                    @if (!$disputes->contains('status', 'disputed'))
                                        <th class="text-center">{{ translate('Action') }}</th>
                                    @endif
                            </thead>

                            <tbody>
                                @forelse($disputes as $key => $dispute)
                                    @php
                                        $reasons = is_array($dispute->report_reason)
                                            ? $dispute->report_reason
                                            : json_decode($dispute->report_reason, true);
                                    @endphp
                                    <tr>
                                        <td>{{ $disputes->firstitem() + $key }}</td>
                                        <td>
                                            <a class="d-block text-dark"
                                                @if ($dispute?->sender?->type == 1) href="{{ route('admin.agent.view', [$dispute?->sender?->id]) }}"
                                            @elseif($dispute?->sender?->type == 2)
                                                href="{{ route('admin.customer.view', [$dispute?->sender?->id]) }}" @endif>
                                                {{ $dispute?->sender?->f_name . ' ' . $dispute?->sender?->l_name }}
                                                {{ $dispute?->sender?->phone }}
                                            </a>
                                        </td>
                                        <td class="text-capitalize">{{ $dispute->sender_type }}</td>
                                        <td>{{ \App\CentralLogics\helpers::set_symbol($dispute->amount) }}</td>
                                        <td>{{ $dispute->trx_id }}</td>
                                        <td class="text-capitalize">{{ $dispute->status }}</td>
                                        <td>{{ $dispute->sending_time }}</td>
                                        <td>
                                            <div class="line-clamp clamp-2 max-width-180px">
                                                @if (is_array($reasons) && count(array_filter($reasons)))
                                                    {!! implode('<br>', array_map('e', $reasons)) !!}
                                                @elseif(!is_array($reasons) && !empty($dispute->report_reason))
                                                    {{ e($dispute->report_reason) }}
                                                @else
                                                    N/A
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="line-clamp clamp-2 max-width-180px">
                                                {{ !empty($dispute->comment) ? $dispute->comment : 'N/A' }}
                                            </div>
                                        </td>
                                        @if ($dispute->status == 'denied')
                                            <td>
                                                <div class="line-clamp clamp-2 max-width-180px">
                                                    {{ $dispute->denied_note }}
                                                </div>
                                            </td>
                                        @endif
                                        @if (!$disputes->contains('status', 'disputed'))
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    @if ($dispute->status != 'approved' && $dispute->status != 'disputed')
                                                        <button type="button"
                                                            class="btn btn-success btn-success-dark btn-sm open-approve-modal"
                                                            data-toggle="modal" data-target="#reportApproveModal"
                                                            data-id="{{ $dispute->id }}"
                                                            data-sender="{{ $dispute->sender?->f_name }} {{ $dispute->sender?->l_name }}"
                                                            data-amount="{{ \App\CentralLogics\helpers::set_symbol($dispute->amount) }}"
                                                            data-sender_type="{{ $dispute->sender_type }}"
                                                            data-trx="{{ $dispute->trx_id }}"
                                                            data-time="{{ $dispute->sending_time }}"
                                                            data-comment="{{ $dispute->comment }}"
                                                            data-reasons="{{ json_encode(is_array($reasons) ? $reasons : []) }}">
                                                            {{ translate('Approve') }}
                                                        </button>
                                                    @endif

                                                    @if ($dispute->status != 'pending' && $dispute->status != 'disputed')
                                                        <button type="button"
                                                            class="btn btn-primary btn-sm open-dispute-modal"
                                                            data-toggle="modal" data-target="#reportDisputeModal"
                                                            data-id="{{ $dispute->id }}"
                                                            data-sender="{{ $dispute->sender?->f_name }} {{ $dispute->sender?->l_name }}"
                                                            data-amount="{{ \App\CentralLogics\helpers::set_symbol($dispute->amount) }}"
                                                            data-sender_type="{{ $dispute->sender_type }}"
                                                            data-trx="{{ $dispute->trx_id }}"
                                                            data-time="{{ $dispute->sending_time }}"
                                                            data-comment="{{ $dispute->comment }}"
                                                            data-reasons="{{ json_encode(is_array($reasons) ? $reasons : []) }}">
                                                            {{ translate('Disputes') }}
                                                        </button>
                                                    @endif

                                                    @if ($dispute->status != 'disputed' && $dispute->status != 'denied')
                                                        <button type="button"
                                                            class="btn btn-warning btn-sm open-deny-modal"
                                                            data-toggle="modal" data-target="#reportDenyModal"
                                                            data-id="{{ $dispute->id }}"
                                                            data-sender="{{ $dispute->sender?->f_name }} {{ $dispute->sender?->l_name }}"
                                                            data-amount="{{ \App\CentralLogics\helpers::set_symbol($dispute->amount) }}"
                                                            data-sender_type="{{ $dispute->sender_type }}"
                                                            data-trx="{{ $dispute->trx_id }}"
                                                            data-time="{{ $dispute->sending_time }}"
                                                            data-comment="{{ $dispute->comment }}"
                                                            data-reasons="{{ json_encode(is_array($reasons) ? $reasons : []) }}">
                                                            {{ translate('Deny') }}
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        @endif

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted">
                                            <img class="mt-5"
                                                src="{{ dynamicAsset(path: 'public/assets/admin/svg/illustrations/empty-table.svg') }}"
                                                alt="empty-table-image">
                                            @if ($transactionType == 'pending')
                                                <p class="my-2">{{ translate('No Pending Report Yet') }}</p>
                                            @elseif($transactionType == 'approved')
                                                <p class="my-2">{{ translate('No Approved Report Yet') }}</p>
                                            @elseif($transactionType == 'disputed')
                                                <p class="my-2">{{ translate('No Disputed Report Yet') }}</p>
                                            @elseif($transactionType == 'denied')
                                                <p class="my-2">{{ translate('No Denied Report Yet') }}</p>
                                            @else
                                                <p class="my-2">{{ translate('No Report Yet') }}</p>
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mt-4 px-3">
                        <div class="d-flex justify-content-end">
                            {!! $disputes->links() !!}
                            <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="reportApproveModal" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header px-2 pt-3 pb-0">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="tio-clear"></span>
                    </button>
                </div>
                <div class="modal-body pt-2">
                    <div class="card shadow-none border mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-2">
                                <h3 class="mb-0"> {{ translate('Report_Details') }}</h3>
                                <p class="mb-0">Sending Time : <span class="text-dark" data-field="time"></span></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-2">
                                <p class="mb-0">Sender : <span class="text-dark" data-field="sender"></span></p>
                                <p class="mb-0">Amount : <span class="text-dark" data-field="amount"></span></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                <p class="mb-0 text-capitalize">Sender Type : <span class="text-dark"
                                        data-field="sender_type"></span></p>
                                <p class="mb-0">Transaction Id : <span class="text-dark" data-field="trx"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-none border bg-fafafa mb-3">
                        <div class="card-body">
                            <h3 class="mb-3 font-weight-normal"> {{ translate('Report_Reason') }}</h3>
                            <div class="reason-content"></div>
                        </div>
                    </div>
                    <div class="card shadow-none border bg-fafafa">
                        <div class="card-body">
                            <h3 class="mb-3 font-weight-normal"> {{ translate('comment') }}</h3>
                            <div class="comment"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 mb-3">
                    <div class="d-flex justify-content-end gap-2">
                        <button id="reset_btn" type="reset" class="btn btn-secondary min-w-120" data-dismiss="modal">
                            {{ translate('Cancel') }}
                        </button>
                        <form action="{{ route('admin.disputes.change-status') }}" method="POST">
                            @csrf
                            <input type="hidden" name="dispute_id" id="approve_dispute_id">
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="btn btn-success btn-success-dark min-w-120">
                                {{ translate('Yes, Approve') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reportDisputeModal" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header px-2 pt-3 pb-0">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="tio-clear"></span>
                    </button>
                </div>
                <div class="modal-body pt-2">
                    <div class="card shadow-none border mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-2">
                                <h3 class="mb-0"> {{ translate('Report_Details') }}</h3>
                                <p class="mb-0">Sending Time : <span class="text-dark" data-field="time"></span></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-2">
                                <p class="mb-0">Sender : <span class="text-dark" data-field="sender"></span></p>
                                <p class="mb-0">Amount : <span class="text-dark" data-field="amount"></span></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                <p class="mb-0 text-capitalize">Sender Type : <span class="text-dark"
                                        data-field="sender_type"></span></p>
                                <p class="mb-0">Transaction Id : <span class="text-dark" data-field="trx"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-none border bg-fafafa mb-3">
                        <div class="card-body">
                            <h3 class="mb-3 font-weight-normal"> {{ translate('Report_Reason') }}</h3>
                            <div class="reason-content"></div>
                        </div>
                    </div>
                    <div class="card shadow-none border bg-fafafa">
                        <div class="card-body">
                            <h3 class="mb-3 font-weight-normal"> {{ translate('comment') }}</h3>
                            <div class="comment"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 mb-3">
                    <div class="d-flex justify-content-end gap-2">
                        <button id="reset_btn" type="reset" class="btn btn-secondary min-w-120" data-dismiss="modal">
                            {{ translate('Cancel') }}
                        </button>
                        <form id="disputeForm" action="{{ route('admin.disputes.change-status') }}" method="POST">
                            @csrf
                            <input type="hidden" name="dispute_id" id="dispute_dispute_id">
                            <input type="hidden" name="status" value="disputed">
                            <button type="submit" class="btn btn-primary min-w-120" id="disputeSubmitBtn">
                                {{ translate('Yes, Dispute') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reportDenyModal" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header px-2 pt-3 pb-0">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="tio-clear"></span>
                    </button>
                </div>
                <div class="modal-body pt-2">
                    <div class="card shadow-none border mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-2">
                                <h3 class="mb-0"> {{ translate('Report_Details') }}</h3>
                                <p class="mb-0">Sending Time : <span class="text-dark" data-field="time"></span></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-2">
                                <p class="mb-0">Sender : <span class="text-dark" data-field="sender"></span></p>
                                <p class="mb-0">Amount : <span class="text-dark" data-field="amount"></span></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                <p class="mb-0 text-capitalize">Sender Type : <span class="text-dark"
                                        data-field="sender_type"></span></p>
                                <p class="mb-0">Transaction Id : <span class="text-dark" data-field="trx"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-none border bg-fafafa mb-3">
                        <div class="card-body">
                            <h3 class="mb-3 font-weight-normal"> {{ translate('Report_Reason') }}</h3>
                            <div class="reason-content"></div>
                        </div>
                    </div>
                    <div class="card shadow-none border bg-fafafa">
                        <div class="card-body">
                            <h3 class="mb-3 font-weight-normal"> {{ translate('comment') }}</h3>
                            <div class="comment"></div>
                        </div>
                    </div>

                    <form action="{{ route('admin.disputes.change-status') }}" method="POST" id="denyForm">
                        @csrf
                        <input type="hidden" name="dispute_id" id="deny_dispute_id">
                        <input type="hidden" name="status" value="denied">
                        <div class="mt-4">
                            <label class="input-label font-weight-bold" for=""> {{ translate('deny_note') }} <span class="text-danger">*</span></label>
                            <textarea name="denied_note" id="deny_note_text" rows="3" placeholder="Type Deny Note..." maxlength="150" class="form-control" required></textarea>
                            <div class="d-flex justify-content-end">
                                <small id="deny_note_text_count" class="text-muted text-right">0/150</small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 mb-3">
                    <div class="d-flex justify-content-end gap-2">
                        <button id="reset_btn" type="reset" form="denyForm" class="btn btn-secondary min-w-120" data-dismiss="modal">
                            {{ translate('Cancel') }}
                        </button>
                        <button type="submit" form="denyForm"  class="btn btn-warning min-w-120">
                            {{ translate('Yes, Deny') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script_2')
    <script>
        $(document).ready(function() {
            $("#sender_type_select").on('change', function() {
                const urlParams = new URLSearchParams(window.location.search);

                const trxType = urlParams.get('trx_type') ?? 'pending';
                const search = urlParams.get('search') ?? '';

                const senderType = $(this).val();

                // Redirect to the new URL
                location.href = "{{ route('admin.disputes.index') }}" +
                    '?trx_type=' + encodeURIComponent(trxType) +
                    '&sender_type=' + encodeURIComponent(senderType) +
                    (search ? '&search=' + encodeURIComponent(search) : '');
            });
        });

        $(document).ready(function() {
            // Function to update character count
            function updateCharCount(inputSelector, countSelector, maxLength) {
                $(inputSelector).on('input', function() {
                    const charCount = $(this).val().length;
                    $(countSelector).text(`${charCount}/${maxLength}`);
                });

                // Update the count on page load (for pre-filled values)
                const initialCount = $(inputSelector).val().length;
                $(countSelector).text(`${initialCount}/${maxLength}`);
            }

            // Initialize character count for deny Note
            updateCharCount('#deny_note_text', '#deny_note_text_count', 150);
        });

        $(document).on('click', '.open-approve-modal', function() {
            const button = $(this);
            const modal = $('#reportApproveModal');

            modal.find('#approve_dispute_id').val(button.data('id')); // Set hidden input
            modal.find('.modal-body span[data-field="time"]').text(button.data('time'));
            modal.find('.modal-body span[data-field="sender"]').text(button.data('sender'));
            modal.find('.modal-body span[data-field="amount"]').text(button.data('amount'));
            modal.find('.modal-body span[data-field="sender_type"]').text(button.data('sender_type'));
            modal.find('.modal-body span[data-field="trx"]').text(button.data('trx'));

            const reasons = button.data('reasons') ?? [];
            let reasonHtml = '';
            if (Array.isArray(reasons)) {
                reasonHtml = reasons.map(r => `<p class="mb-1">• ${r}</p>`).join('');
            }

            modal.find('.modal-body .reason-content').html(reasonHtml);
            modal.find('.modal-body .comment').html(button.data('comment'));
        });

        $(document).on('click', '.open-dispute-modal', function() {
            const button = $(this);
            const modal = $('#reportDisputeModal');

            modal.find('#dispute_dispute_id').val(button.data('id')); // Set hidden input
            modal.find('span[data-field="time"]').text(button.data('time'));
            modal.find('span[data-field="sender"]').text(button.data('sender'));
            modal.find('span[data-field="amount"]').text(button.data('amount'));
            modal.find('span[data-field="sender_type"]').text(button.data('sender_type'));
            modal.find('span[data-field="trx"]').text(button.data('trx'));

            const reasons = button.data('reasons') ?? [];
            let reasonHtml = '';
            if (Array.isArray(reasons)) {
                reasonHtml = reasons.map(r => `<p class="mb-1">• ${r}</p>`).join('');
            }

            modal.find('.reason-content').html(reasonHtml);
            modal.find('.modal-body .comment').html(button.data('comment'));
        });
        document.getElementById('disputeForm').addEventListener('submit', function () {
            const btn = document.getElementById('disputeSubmitBtn');
            btn.disabled = true;
            btn.innerHTML = '{{ translate('Processing...') }}'; // Optional: show a loading text
        });

        $(document).on('click', '.open-deny-modal', function() {
            const button = $(this);
            const modal = $('#reportDenyModal');

            modal.find('#deny_dispute_id').val(button.data('id')); // Set hidden input
            modal.find('[data-field="time"]').text(button.data('time'));
            modal.find('[data-field="sender"]').text(button.data('sender'));
            modal.find('[data-field="amount"]').text(button.data('amount'));
            modal.find('[data-field="sender_type"]').text(button.data('sender_type'));
            modal.find('[data-field="trx"]').text(button.data('trx'));

            const reasons = button.data('reasons') ?? [];
            let reasonHtml = '';
            if (Array.isArray(reasons)) {
                reasonHtml = reasons.map(r => `<p class="mb-1">• ${r}</p>`).join('');
            }

            modal.find('.reason-content').html(reasonHtml);
            modal.find('.modal-body .comment').html(button.data('comment'));
        });
    </script>
@endpush
