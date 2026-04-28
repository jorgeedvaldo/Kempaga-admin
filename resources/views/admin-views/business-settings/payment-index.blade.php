@extends('layouts.admin.app')

@section('title', translate('Payment Setup'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex align-items-center gap-3 pb-2">
            <img width="24" src="{{dynamicAsset(path: 'public/assets/admin/img/media/business-setup.png')}}" alt="{{ translate('business_setup') }}">
            <h2 class="page-header-title">{{translate('Business Setup')}}</h2>
        </div>

        <div class="inline-page-menu my-4">
            @include('admin-views.business-settings.partial._business-setup-tabs')
        </div>

        @if($publishedStatus)
        <div class="row">
            <div class="col-md-12 mb-5">
                <div class="card">
                    <div class="card-body d-flex justify-content-around">
                        <h4 class="w-50 flex-grow-1 text-danger">
                            <i class="tio-info-outined"></i>
                            {{ translate('Your_current_payment_settings_are_disabled,_because_you_have_enabled_payment_gateway_addon._To_visit_your_currently_active_payment_gateway_settings_please_follow_the_link.') }}</h4>
                           <div>
                                <a href="{{!empty($paymentUrl) ? $paymentUrl : ''}}" class="btn btn-outline-primary"> <i class="tio-settings"></i> {{translate('Settings')}}</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @php($isPublished = $publishedStatus == 1 ? 'disabled' : '')

        <div class="row digital_payment_methods payment_method mt-3 g-3">
            @foreach($dataValues as $payment)
                <div class="col-md-6 mb-5">
                    <div class="card h-100">
                        <form  action="{{env('APP_MODE')!='demo'?route('admin.business-settings.payment-method-update'):'javascript:'}}" method="POST"
                              id="{{$payment->key_name}}-form" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header d-flex flex-wrap align-content-around align-items-center">
                                <h5 class="pm-title m-0">
                                    <span class="text-uppercase">{{str_replace('_',' ',$payment->key_name)}}</span>
                                </h5>
                                <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex {{ $payment['is_active'] == 1 ? 'checked' : '' }}">
                                    <input type="checkbox" name="status" value="1"
                                           class="toggle-switch-input"
                                           {{ $payment['is_active'] == 1 ? 'checked' : '' }} {{$isPublished}}>

                                    <span class="toggle-switch-label text">
                                        <span class="toggle-switch-indicator d-flex align-items-center justify-content-center">
                                            <span>{{ $payment['is_active'] == 1 ? 'On' : 'Off' }}</span>
                                        </span>
                                    </span>
                                </label>
                            </div>

                            @php($additionalData = $payment['additional_data'] != null ? json_decode($payment['additional_data']) : [])
                            <div class="card-body">
                                <div class="payment--gateway-img d-flex justify-content-center mb-2">
                                    <img id="{{$payment->key_name}}-image-preview" class="h-60"
                                    src="{{Helpers::onErrorImage($additionalData != null ? $additionalData->gateway_image : '',
                                            dynamicStorage(path: 'storage/app/public/payment_modules/gateway_image').'/' . ($additionalData != null ? $additionalData->gateway_image : ''),
                                            dynamicAsset(path: 'public/assets/admin/img/placeholder.png') ,
                                            'payment_modules/gateway_image/')}}"
                                         alt="{{ translate('gateway_image') }}">
                                </div>

                                <input name="gateway" value="{{$payment->key_name}}" class="d-none">

                               <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-floating mb-3">
                                            <label for="exampleFormControlInput1"
                                                class="form-label pm-label">{{translate('payment_gateway_title')}}</label>
                                            <input type="text" class="form-control"
                                                name="gateway_title"
                                                placeholder="{{translate('enter_title')}}"
                                                value="{{$additionalData != null ? $additionalData->gateway_title : ''}}" {{$isPublished}}>
                                        </div>
                                    </div>

                                    @php($mode=$dataValues->where('key_name',$payment->key_name)->first()->live_values['mode'])
                                    <div class="col-sm-6">
                                        <div class="form-floating mb-3">
                                            <label for="mode"
                                                class="form-label pm-label">{{translate('select_mode')}}</label>
                                            <select class="js-select form-control theme-input-style w-100" name="mode" {{$isPublished}}>
                                                <option value="live" {{$mode=='live'?'selected':''}}>{{ translate('Live_Mode') }}</option>
                                                <option value="test" {{$mode=='test'?'selected':''}}>{{ translate('Test_Mode') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    @php($skip=['gateway','mode','status'])
                                    @foreach($dataValues->where('key_name',$payment->key_name)->first()->live_values as $key=>$value)
                                        @if(!in_array($key,$skip))
                                            <div class="col-sm-6">
                                                <div class="form-floating mb-3">
                                                    <label for="exampleFormControlInput1"
                                                        class="form-label pm-label">{{ucwords(str_replace('_',' ',$key))}}
                                                        *</label>
                                                    <input type="text" class="form-control"
                                                        name="{{$key}}"
                                                        placeholder="{{ucwords(str_replace('_',' ',$key))}} *"
                                                        value="{{env('APP_ENV')=='demo'?'':$value}}" {{$isPublished}}>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach


                                    <div class="col-sm-12">
                                        <div class="form-floating mb-3">
                                            <label for="exampleFormControlInput1"
                                                class="form-label pm-label">{{translate('Choose_Logo')}}</label>
                                            <input type="file" class="form-control" name="gateway_image" id="{{$payment->key_name}}-image"
                                                   accept=".{{ implode(',.', array_column(IMAGE_EXTENSIONS, 'key')) }}"
                                                   data-maxFileSize="{{ readableUploadMaxFileSize('image') }}"
                                                {{$isPublished}}>
                                        </div>
                                    </div>
                               </div>

                                <div class="text-right mt-4">
                                    <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}"
                                            class="btn btn-primary px-7 demo-form-submit" {{$isPublished}}>{{translate('submit')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('script_2')
    <script>
        "use strict";

        $(document).on('change', 'input[name="gateway_image"]', function () {
            let $input = $(this);
            let $form = $input.closest('form');
            let gatewayName = $form.attr('id');

            if (this.files && this.files[0]) {
                let reader = new FileReader();
                let $imagePreview = $form.find('.payment--gateway-img img');

                reader.onload = function (e) {
                    $imagePreview.attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // toggle switch
        document.addEventListener('DOMContentLoaded', function () {
            const toggleSwitches = document.querySelectorAll('.toggle-switch-input');

            toggleSwitches.forEach(function(toggleSwitch) {
                const indicator = toggleSwitch.closest('label').querySelector('.toggle-switch-indicator span');

                function updateIndicator() {
                    indicator.textContent = toggleSwitch.checked ? 'On' : 'Off';
                }

                updateIndicator();

                toggleSwitch.addEventListener('change', updateIndicator);
            });
        });
    </script>
@endpush
