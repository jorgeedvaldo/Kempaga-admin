@extends('layouts.admin.app')

@section('title', translate('Charge Setup'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex align-items-center gap-3 pb-2">
            <img width="24" src="{{dynamicAsset(path: 'public/assets/admin/img/media/business-setup.png')}}" alt="{{ translate('business_setup') }}">
            <h2 class="page-header-title">{{translate('Business Setup')}}</h2>
        </div>

        <div class="inline-page-menu my-4">
            @include('admin-views.business-settings.partial._business-setup-tabs')
        </div>

        <form action="{{route('admin.business-settings.charge-setup')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card mb-5">
                <div class="card-header">
                    <h5 class="mb-0 text-capitalize d-flex align-items-center gap-1"><i class="tio-wallet"></i>
                        {{translate('Transaction_Charges')}}
                    </h5>
                </div>
                <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-sm-6 col-xl-3">
                                @php($agentCommissionPercent=\App\CentralLogics\helpers::get_business_settings('agent_commission_percent'))
                                <div class="form-group mb-0">
                                    <label
                                        class="input-label text-capitalize d-flex flex-wrap align-items-center column-gap-2"
                                        for="agent_commission_percent">{{translate('Agent Commission')}}
                                        {{-- <small class="text-danger">( {{translate('percent (%)')}} )</small> --}}

                                        <i class="tio-info cursor-pointer" data-toggle="tooltip" data-placement="top"
                                        title="{{ translate('The agent will get the percentage from cash out charge') }}"></i>
                                    </label>
                                    <input type="number" name="agent_commission_percent" class="form-control"
                                        id="agent_commission_percent" value="{{$agentCommissionPercent??''}}" min="0"
                                        step="any" max="100" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                @php($cashoutChargePercent=\App\CentralLogics\helpers::get_business_settings('cashout_charge_percent'))
                                <div class="form-group mb-0">
                                    <label
                                        class="input-label text-capitalize d-flex flex-wrap align-items-center column-gap-2"
                                        for="cashout_charge_percent">{{translate('cash_out_charge')}}
                                        {{-- <small class="text-danger">( {{translate('percent (%)')}} )</small> --}}

                                        <i class="tio-info cursor-pointer" data-toggle="tooltip" data-placement="top"
                                        title="{{ translate('The customer will be charged the percentage of cash out amount') }}"></i>
                                    </label>
                                    <input type="number" name="cashout_charge_percent" class="form-control"
                                        id="cashout_charge_percent" value="{{$cashoutChargePercent??1}}" min="0"
                                        step="any" max="100" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                @php($withdrawChargePercent = \App\CentralLogics\helpers::get_business_settings('withdraw_charge_percent'))
                                <div class="form-group mb-0">
                                    <label
                                        class="input-label text-capitalize d-flex flex-wrap align-items-center column-gap-2">{{translate('withdraw_charge')}}
                                        {{-- <small class="text-danger">( {{translate('percent (%)')}} )</small> --}}

                                        <i class="tio-info cursor-pointer" data-toggle="tooltip" data-placement="top"
                                        title="{{ translate('The withdraw request sender will be charged the percentage of the withdrawal amount') }}"></i>
                                    </label>
                                    <input type="number" name="withdraw_charge_percent" class="form-control"
                                        value="{{$withdrawChargePercent??1}}" min="0" step="any" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                @php($sendmoneyChargeFlat=\App\CentralLogics\helpers::get_business_settings('sendmoney_charge_flat'))
                                <div class="form-group mb-0">
                                    <label
                                        class="input-label text-capitalize d-flex flex-wrap align-items-center column-gap-2"
                                        for="sendmoney_charge_flat">
                                        {{translate('send_money_charge')}}
                                        {{-- <small class="text-danger">( {{translate('flat')}} )</small> --}}

                                        <i class="tio-info cursor-pointer" data-toggle="tooltip" data-placement="top"
                                        title="{{ translate('The customer will be charged the amount while sending money to others') }}"></i>
                                    </label>
                                    <input type="number" name="sendmoney_charge_flat" class="form-control"
                                        id="sendmoney_charge_flat" value="{{$sendmoneyChargeFlat??0}}" min="0"
                                        step="any" required>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap flex-grow-1 justify-content-between">
                        <h5 class="mb-0 text-capitalize d-flex align-items-center gap-1"><i class="tio-wallet"></i>
                            {{translate('customer_favorite_number_setup')}}
                        </h5>
                        <div>
                            @php($favoriteNumberStatus=\App\CentralLogics\helpers::get_business_settings('favorite_number_status'))
                            <label class="switcher mx-auto">
                                <input type="checkbox" class="switcher_input"  name="favorite_number_status"
                                    {{ isset($favoriteNumberStatus) && $favoriteNumberStatus == 1 ? 'checked': '' }}>
                                <span class="switcher_control"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-sm-6 col-xl-4">
                                @php($favoriteNumberLimit=\App\CentralLogics\helpers::get_business_settings('favorite_number_limit'))
                                <div class="form-group mb-0">
                                    <label class="input-label text-capitalize d-flex flex-wrap align-items-center column-gap-2" for="">{{translate('favorite_number_limit')}}
                                        <i class="tio-info cursor-pointer" data-toggle="tooltip" data-placement="top" title="{{ translate('Define the favorite number limit for the users. The system will notify when a user meets the limit.') }}"></i>
                                    </label>
                                    <input type="number" name="favorite_number_limit" class="form-control" id="favorite_number_limit"
                                           value="{{ $favoriteNumberLimit }}" min="1" placeholder="{{translate('Ex : 5')}}" step="1" max="99999999" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                                @php($favoriteNumberCashOutChargeDiscount=\App\CentralLogics\helpers::get_business_settings('favorite_number_cash_out_charge_discount'))
                                <div class="form-group mb-0">
                                    <label class="input-label text-capitalize d-flex flex-wrap align-items-center column-gap-2" for="">{{translate('cash_out_charge_discount')}} (%)
                                        <i class="tio-info cursor-pointer" data-toggle="tooltip" data-placement="top" title="{{ translate('Apply a reduced percentage fee when customers cash out to favorite numbers.') }}"></i>
                                    </label>
                                    <input type="number" name="favorite_number_cash_out_charge_discount" class="form-control" id="favorite_number_cash_out_charge_discount"
                                           value="{{ $favoriteNumberCashOutChargeDiscount }}" min="0" placeholder="{{translate('Ex : 5')}}" step="0.01" max="100" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                                @php($favoriteNumberSendMoneyChargeDiscount=\App\CentralLogics\helpers::get_business_settings('favorite_number_send_money_charge_discount'))
                                <div class="form-group mb-0">
                                    <label class="input-label text-capitalize d-flex flex-wrap align-items-center column-gap-2" for="">{{translate('send_money_charge_discount')}} (%)
                                        <i class="tio-info cursor-pointer" data-toggle="tooltip" data-placement="top" title="{{ translate('Apply a reduced percentage fee when customers send money to favorite numbers.') }}"></i>
                                    </label>
                                    <input type="number" name="favorite_number_send_money_charge_discount" class="form-control" id="favorite_number_send_money_charge_discount"
                                           value="{{ $favoriteNumberSendMoneyChargeDiscount }}" min="0" placeholder="{{translate('Ex : 5')}}" step="0.01" max="100" required>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-3 mt-8">
                <button type="reset" class="btn btn-secondary">{{translate('reset')}}</button>
                <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}" class="btn btn-primary demo-form-submit">{{translate('submit')}}</button>
            </div>
        </form>
    </div>
@endsection
