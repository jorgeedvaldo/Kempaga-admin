@extends('payment-views.layouts.master')

@push('script')
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'assets/razor-pay/css/razor-pay.css')}}">
@endpush

@section('content')
    <div class="razorpay-container">
        <h1 class="text-center">{{ "Please do not refresh this page..." }}</h1>

        <div class="razorpay-button-container">
            <button type="button" id="rzp-button1">Pay</button>
            <button type="button" class="razorpay-cancel-button" id="razorpay-cancel-button">Cancel</button>
        </div>
    </div>

    <script type="text/javascript">
        "use strict";
        document.getElementById('razorpay-cancel-button').onclick = function () {
            window.location.href = '{{ route('razor-pay.cancel', ['payment_id' => $data->id]) }}';
        };
        setTimeout(function () {
            let payButton = document.getElementById("rzp-button1");
            if (payButton) {
                payButton.click();
            }
        }, 500);
    </script>
@endsection

@push('script_2')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let rzpButton = document.getElementById('rzp-button1');
            if (rzpButton) {
                fetch("{{ route('razor-pay.create-order') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        payment_request_id: "{{ $data->id }}",
                        payment_amount: "{{ $data->payment_amount }}",
                        currency_code: "{{ $data->currency_code }}"
                    })
                })
                    .then(response => response.json())
                    .then(orderData => {
                        var rzp1 = new Razorpay({
                            "key": "{{ config()->get('razor_config.api_key') }}",
                            "amount": orderData.amount,
                            "currency": orderData.currency,
                            "name": "{{ $business_name }}",
                            "description": "{{ $data->payment_amount }}",
                            "image": "{{ $business_logo }}",
                            "order_id": orderData.order_id,
                            "callback_url": "{{ route('razor-pay.callback') }}",
                            "handler": function (response) {
                                console.log("Payment successful!", response);
                                window.location.href = "{{ route('razor-pay.verify-payment') }}?" + new URLSearchParams({
                                    payment_request_id: "{{ $data->id }}",
                                    payment_id: response.razorpay_payment_id,
                                    order_id: response.razorpay_order_id,
                                    signature: response.razorpay_signature
                                }).toString();
                            },
                            "prefill": {
                                "name": "{{ $payer?->name ?? '' }}",
                                "email": "{{ $payer?->email ?? '' }}",
                                "contact": "{{ $payer?->phone ?? '' }}"
                            },
                            "theme": {
                                "color": "#ff7529"
                            },
                            "method": {
                                "netbanking": true,
                                "card": true,
                                "upi": true,
                                "wallet": true
                            },
                        });

                        rzpButton.onclick = function (e) {
                            rzp1.open();
                            e.preventDefault();
                        };
                    })
                    .catch(error => {
                        console.error("Error creating order:", error);
                    });
            } else {
                console.error("Button with ID 'rzp-button1' not found!");
            }
        });
    </script>
@endpush
