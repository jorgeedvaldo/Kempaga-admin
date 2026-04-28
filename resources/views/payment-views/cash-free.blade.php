@extends('payment-views.layouts.master')

@push('script')
    <script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
@endpush

@section('content')

    <center><h1>Please do not refresh this page...</h1></center>

    <script type="text/javascript">
        var session_id = "{{$session_id}}";
        var paymentId = "{{ $data['id'] }}";
        var orderId = "{{ $order_id }}";
        var productionStatus = "{{$production_status}}";
        var callbackUrl = "{{ url('/payment/cashfree/callback') }}" + '?payment_id=' + paymentId + '&order_id=' + orderId;
        document.addEventListener("DOMContentLoaded", function () {
            const cashfree = Cashfree({
                mode: productionStatus
            });
            let checkoutOptions = {
                paymentSessionId: session_id,
                returnUrl: callbackUrl,
            }
            cashfree.checkout(checkoutOptions).then(function(result){
                if(result.error){
                    alert(result.error.message)
                }
                if(result.redirect){
                    console.log("Redirection")
                }
            });
        });
    </script>
@endsection
