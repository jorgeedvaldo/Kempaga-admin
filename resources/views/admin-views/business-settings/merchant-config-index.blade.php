@extends('layouts.admin.app')

@section('title', translate('Merchant Configuration'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex align-items-center gap-3 mb-3">
            <img width="24" src="{{dynamicAsset(path: 'public/assets/admin/img/media/merchant-config.png')}}" alt="{{ translate('image') }}">
            <h1 class="page-header-title">{{translate('Merchant Config')}} </h1>
            <i class="tio-info text-primary cursor-pointer" data-toggle="tooltip" data-placement="top"
               title="{{translate('Settings to manage merchant payment security and admin commission for third-party transactions.')}}">
            </i>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-20">
                            <h4 class="mb-1">{{translate('Payment OTP Verification')}}</h4>
                            <p class="mb-1 fs-12">{{translate('Enable this option to require users to verify payments using a One-Time Password (OTP) when using a third-party payment gateway.')}}</p>
                        </div>

                        @php($otpStatus=\App\CentralLogics\Helpers::get_business_settings('payment_otp_verification'))
                        <form action="{{route('admin.merchant-config.merchant-payment-otp-verification-update')}}" method="post">
                            @csrf
                            <div class="bg-fafafa rounded p-xxl-4 p-3">
                                <div class="bg-white p-3 gap-3 d-flex align-items-center flex-wrap payment-active-opp">
                                    <div class="mb-0 d-flex align-items-start gap-2 w-350">
                                        <input type="radio" name="payment_otp_verification" class="mt-1"
                                                value="1" {{isset($otpStatus) && $otpStatus==1?'checked':''}}>
                                        <div>
                                            <label class="mb-0">{{translate('active')}}</label>
                                            <p class="fs-12 m-0">{{translate("Users must verify payments using an OTP.")}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-start gap-2 mb-0">
                                        <input type="radio" name="payment_otp_verification" class="mt-1"
                                                value="0" {{isset($otpStatus) && $otpStatus==0?'checked':''}}>
                                        <div>
                                            <label class="mb-0">{{translate('inactive')}} </label>
                                            <p class="fs-12 m-0">{{translate("OTP verification is not required for user payments.")}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-4 gap-3">
                                <button type="reset" class="btn btn-secondary min-w-120">{{translate('Reset')}}</button>
                                <button type="submit" class="btn btn-primary min-w-120">{{translate('save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="mb-20">
                            <h4 class="mb-1">{{translate('Commission Setup')}}</h4>
                            <p class="mb-1 fs-12">{{translate('The admin will earn a commission from the merchant for every customer payment made via a third-party payment gateway.')}}</p>
                        </div>
                        <div class="">
                            <form action="{{route('admin.merchant-config.settings-update')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="bg-fafafa rounded p-xxl-4 p-3">
                                            @php($merchantCommissionPercent=\App\CentralLogics\helpers::get_business_settings('merchant_commission_percent'))
                                            <div class="form-group mb-0">
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <label class="text-dark mb-0">{{translate('Transaction Commission')}}</label>
                                                    <small class="text-danger"> *( {{translate('percent (%)')}} )</small>
                                                </div>
                                                <input type="number" name="merchant_commission_percent" class="form-control" id="merchant_commission_percent"
                                                       value="{{$merchantCommissionPercent??''}}" min="0" step=".02" max="100" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-4 gap-3">
                                    <button type="reset" class="btn btn-secondary min-w-120">{{translate('Reset')}}</button>
                                    <button type="submit" class="btn btn-primary min-w-120">{{translate('save')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
