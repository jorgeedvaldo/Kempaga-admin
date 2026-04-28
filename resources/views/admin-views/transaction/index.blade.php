@extends('layouts.admin.app')

@section('title', translate('transaction List'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex align-items-center gap-3 mb-3">
            <img width="22" src="{{dynamicAsset(path: 'public/assets/admin/img/media/lending.png')}}" alt="{{ translate('transaction') }}">
            <h1 class="page-header-title">{{translate('transaction')}}</h1>
        </div>

        <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom gap-3 mb-3">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{$trx_type=='all'?'active':''}}"
                        href="{{url()->current()}}?trx_type=all">
                        {{translate('all')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$trx_type=='debit'?'active':''}}"
                        href="{{url()->current()}}?trx_type=debit">
                        {{translate('debit')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$trx_type=='credit'?'active':''}}"
                        href="{{url()->current()}}?trx_type=credit">
                        {{translate('credit')}}
                    </a>
                </li>
            </ul>
        </div>

        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header justify-cntent-end flex-wrap gap-3">
                        <div class="flex-grow-1">
                            <div class="d-flex flex-wrap gap-4">
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="card-header-title">{{translate('transaction Table')}}</h5>
                                    <span class="badge badge-soft-secondary text-dark">{{ $transactions->total() }}</span>
                                </div>
                                <div>
                                    <form action="{{ request()->url() }}" method="GET">
                                        @foreach (request()->except('search', 'page') as $key => $value)
                                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                        @endforeach

                                        <div class="input-group">
                                            <input id="datatableSearch_" type="search" name="search" class="form-control mn-md-w280"
                                                   placeholder="{{ translate('Search by id, sender & receiver info') }}" aria-label="Search"
                                                   value="{{ $search }}" autocomplete="off">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ translate('Search') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-items-center flex-wrap gap-3 flex-grow-1">
                            <div>
                                <button type="button" class="btn btn-primary" data-toggle="dropdown" aria-expanded="true">
                                    <span class="mr-2"><i class="tio-download-to"></i></span>
                                    {{translate('Download')}}
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2"
                                           href="{{ route('admin.transaction.export', array_merge(request()->all(), ['export_type' => 'csv'])) }}">                                            <img width="20" src="{{dynamicAsset(path: 'public/assets/admin/img/media/csv.png')}}" alt="{{ translate('csv') }}">
                                            <span>{{ translate('CSV') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2"
                                           href="{{ route('admin.transaction.export', array_merge(request()->all(), ['export_type' => 'excel'])) }}">
                                            <img width="20" src="{{ dynamicAsset(path: 'public/assets/admin/img/media/excel.png') }}" alt="{{ translate('excel') }}">
                                            <span>{{ translate('Excel') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="filter-dropdown-wrapper position-relative">
                                <button type="button" class="btn btn-primary filter_btn" data-toggle="dropdown" aria-expanded="true">
                                    <span class="mr-2 position-relative">
                                        <i class="tio-filter"></i>
                                        <span class="active-filter-dot"></span>
                                    </span>
                                    {{ translate('Filter') }}
                                </button>

                                <ul class="dropdown-menu filter-dropdown p-0">
                                    <div class="d-flex justify-content-between align-items-center gap-3 p-3 bg-fafafa">
                                        <h4>{{ translate('Filter_Statement') }}</h4>
                                        <button type="button" class="close filter_close_btn">
                                            <span aria-hidden="true" class="tio-clear"></span>
                                        </button>
                                    </div>
                                    <div class="p-4">
                                        <form action="{{ url()->current() }}" method="get" id="filter-form">

                                            <input type="hidden" name="start_date" id="start_date" value="{{ request('start_date') }}">
                                            <input type="hidden" name="end_date" id="end_date" value="{{ request('end_date') }}">
                                            <input type="hidden" name="search" id="" value="{{ request('search') }}">
                                            <input type="hidden" name="trx_type" id="" value="{{ request('trx_type') }}">

                                            <div class="form-group">
                                                <label class="input-label">{{ translate('Date Range') }}</label>
                                                <select name="date_type" id="date_range_selector" class="form-control js-select2-custom">
                                                    <option value="all" {{ request('date_type') == 'all' ? 'selected' : '' }}>{{ translate('All') }}</option>
                                                    <option value="last_30" {{ request('date_type') == 'last_30' ? 'selected' : '' }}>{{ translate('Last 30 Days') }}</option>
                                                    <option value="custom" {{ request('date_type') == 'custom' ? 'selected' : '' }}>{{ translate('Custom') }}</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-0 custom-date-range" style="display: none;">
                                                <label class="input-label">{{ translate('Custom Date Range') }}</label>
                                                <div class="position-relative">
                                                    <input type="text"
                                                           class="form-control js-daterangepicker date_format"
                                                           name="date_range_display"
                                                           id="date_range_input"
                                                           value="{{ request('start_date') && request('end_date') ? request('start_date') . ' - ' . request('end_date') : '' }}">
                                                    <div class="data-icon-wrapper"><i class="tio-calendar"></i></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="input-label">{{ translate('Transaction Type') }}</label>
                                                <select name="transaction_type" id="" class="form-control js-select2-custom">
                                                    <option value="all" {{ request('transaction_type') == 'all' ? 'selected' : '' }}>{{ translate('All') }}</option>
                                                    <option value="{{ CASH_IN }}" {{ request('transaction_type') == CASH_IN ? 'selected' : '' }}>{{ translate('Cash In') }}</option>
                                                    <option value="{{ CASH_OUT }}" {{ request('transaction_type') == CASH_OUT ? 'selected' : '' }}>{{ translate('Cash Out') }}</option>
                                                    <option value="{{ SEND_MONEY }}" {{ request('transaction_type') == SEND_MONEY ? 'selected' : '' }}>{{ translate('Send Money') }}</option>
                                                    <option value="{{ RECEIVED_MONEY }}" {{ request('transaction_type') == RECEIVED_MONEY ? 'selected' : '' }}>{{ translate('Received Money') }}</option>
                                                    <option value="{{ ADD_MONEY }}" {{ request('transaction_type') == ADD_MONEY ? 'selected' : '' }}>{{ translate('Add Money') }}</option>
                                                    <option value="{{ WITHDRAW }}" {{ request('transaction_type') == WITHDRAW ? 'selected' : '' }}>{{ translate('Withdraw') }}</option>
                                                    <option value="{{ PAYMENT }}" {{ request('transaction_type') == PAYMENT ? 'selected' : '' }}>{{ translate('Payment') }}</option>
                                                    <option value="{{ ADDED_DISPUTE_MONEY }}" {{ request('transaction_type') == ADDED_DISPUTE_MONEY ? 'selected' : '' }}>{{ translate('Added Dispute Money') }}</option>
                                                    <option value="{{ DEDUCTED_DISPUTE_MONEY }}" {{ request('transaction_type') == DEDUCTED_DISPUTE_MONEY ? 'selected' : '' }}>{{ translate('Deducted Dispute Money') }}</option>
                                                </select>
                                            </div>

                                            <div class="w-100 d-flex gap-3 mt-5">
                                                <a href="{{ url()->current() }}" class="btn btn-secondary flex-grow-1">{{ translate('Reset') }}</a>
                                                <button type="submit" class="btn btn-warning flex-grow-1 filter_submit">{{ translate('Filter') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive datatable-custom">
                        <table
                            class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table table-striped">
                            <thead class="thead-light">
                            <tr>
                                <th>{{translate('SL')}}</th>
                                <th>{{translate('Transaction Id')}}</th>
                                <th>{{translate('Sender')}}</th>
                                <th>{{translate('Receiver')}}</th>
                                <th>{{translate('Debit')}}</th>
                                <th>{{translate('Credit')}}</th>
                                <th>{{translate('Charge')}}</th>
                                <th>{{translate('Type')}}</th>
                                <th>{{translate('Balance')}}</th>
                                <th>{{translate('Time')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($transactions as $key=>$transaction)
                                @php($route = [0 => 'admin', 1 => 'agent', 2 => 'customer', 3 => 'merchant'])

                                <tr>
                                    <td>{{$transactions->firstitem()+$key}}</td>
                                    <td>{{ $transaction->transaction_id??'' }}</td>
                                    <td>
                                        @php($sender_info = Helpers::get_user_info($transaction['from_user_id']))
                                        @if($sender_info != null)
                                            <a href="{{route('admin.'. $route[$sender_info->type] .'.view',[$transaction['from_user_id']])}}">
                                                {{ $sender_info->f_name ?? '' }} {{ $sender_info->phone ?? ''}}
                                        @else
                                            <span class="text-muted badge badge-danger text-dark">{{ translate('User unavailable') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php($receiver_info = Helpers::get_user_info($transaction['to_user_id']))
                                        @if($receiver_info != null)
                                            <a href="{{route('admin.'. $route[$receiver_info->type] .'.view',[$transaction['to_user_id']])}}">
                                                {{ $receiver_info->f_name ?? '' }} {{ $receiver_info->phone ?? '' }}
                                            </a>
                                        @else
                                            <span class="text-muted badge badge-danger text-dark">{{ translate('User unavailable') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span>
                                            {{ Helpers::set_symbol($transaction['debit']) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            {{ Helpers::set_symbol($transaction['credit']) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            {{ Helpers::set_symbol($transaction['charge']) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-uppercase text-muted badge badge-light">{{ translate($transaction['transaction_type']) }}</span>
                                    </td>
                                    <td>
                                        <span>{{ Helpers::set_symbol($transaction['balance']) }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted badge badge-light">{{ $transaction->created_at->diffForHumans() }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center"><td colspan="9">{{translate('No data available')}}</td></tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mt-4 px-3">
                        <div class="d-flex justify-content-end">
                            {!! $transactions->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script_2')

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<script>
    $(document).ready(function () {
        let clickInsideDatepicker = false;

        // Handle dropdown toggle
        $('.filter_btn[data-toggle="dropdown"]').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            let $dropdown = $(this).closest('.filter-dropdown-wrapper').find('.filter-dropdown');
            $('.filter-dropdown').not($dropdown).removeClass('show');
            $dropdown.toggleClass('show');
        });

        $(document).on('click', '.filter-dropdown', function (e) {
            e.stopPropagation();
        });

        $(document).on('mousedown', '.daterangepicker, .daterangepicker *', function () {
            clickInsideDatepicker = true;
        });

        $(document).on('click', function () {
            if (!clickInsideDatepicker) {
                $('.filter-dropdown').removeClass('show');
            }
            clickInsideDatepicker = false;
        });

        $(document).on('click', '.filter_close_btn, .filter_submit', function () {
            $(this).closest('.filter-dropdown').removeClass('show');
        });

        // Initialize daterangepicker
        $('.js-daterangepicker').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'YYYY-MM-DD',
                cancelLabel: 'Clear',
                applyLabel: 'Apply'
            }
        });

        // Apply event
        $('.js-daterangepicker').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
            $('#start_date').val(picker.startDate.format('YYYY-MM-DD'));
            $('#end_date').val(picker.endDate.format('YYYY-MM-DD'));
        });

        // Cancel event
        $('.js-daterangepicker').on('cancel.daterangepicker', function () {
            $(this).val('');
            $('#start_date').val('');
            $('#end_date').val('');
        });

        // Show/hide custom date range
        $('#date_range_selector').on('change', function () {
            if ($(this).val() === 'custom') {
                $('.custom-date-range').show();
            } else {
                $('.custom-date-range').hide();
                let end = moment();
                let start = moment().subtract(29, 'days');
                $('#start_date').val(start.format('YYYY-MM-DD'));
                $('#end_date').val(end.format('YYYY-MM-DD'));
                $('#date_range_input').val('');
            }
        });

        $('.tio-calendar').on('click', function () {
            $('#date_range_input').focus(); // or trigger the date picker programmatically
        });

        // Trigger correct state on page load
        if ($('#date_range_selector').val() === 'custom') {
            $('.custom-date-range').show();
        }
    });
</script>

@endpush



