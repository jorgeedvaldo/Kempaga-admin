@extends('payment.main')
@section('title', translate('Pagamento Concluído') . ' — Kempaga Pay')

@section('content')
<div class="bg-white dark:bg-card rounded-3xl shadow-2xl shadow-black/20 overflow-hidden text-center">

    {{-- Header verde --}}
    <div class="bg-gradient-to-r from-success to-green-600 px-6 py-5 text-white">
        <div class="flex items-center justify-between mb-5">
            <img src="{{ dynamicAsset(path: 'public/assets/logo-kempaga.png') }}" alt="Kempaga" class="h-8 w-auto brightness-0 invert">
            <span class="flex items-center gap-1.5 text-xs bg-white/25 rounded-full px-3 py-1.5 font-medium">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ translate('Concluído') }}
            </span>
        </div>
        <div class="flex items-center">
            @foreach(['Número', 'OTP', 'PIN'] as $step)
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full bg-white/30 flex items-center justify-center text-white text-sm font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
                <span class="text-[10px] mt-1 text-white/70">{{ translate($step) }}</span>
            </div>
            @if(!$loop->last)
            <div class="flex-1 h-0.5 bg-white/40 mx-2 mb-4"></div>
            @endif
            @endforeach
        </div>
    </div>

    <div class="px-6 py-8">
        {{-- Checkmark animado --}}
        <div class="flex justify-center mb-6">
            <svg class="success-ring w-24 h-24" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="26" cy="26" r="24" fill="#39B54A" fill-opacity=".12"/>
                <circle cx="26" cy="26" r="24" stroke="#39B54A" stroke-width="2"/>
                <path class="check-path" d="M15 27l8 8 14-14" stroke="#39B54A" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ translate('Pagamento Concluído!') }}</h2>
        <p class="text-gray-500 dark:text-gray-400 text-sm mb-8">{{ translate('A sua transação foi processada com sucesso.') }}</p>

        {{-- Barra de redirect --}}
        <div class="bg-gray-50 dark:bg-surface rounded-2xl p-4 text-left">
            <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 mb-2.5">
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 animate-spin text-primary" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/></svg>
                    {{ translate('A redirecionar...') }}
                </span>
                <span id="countdown" class="font-bold text-primary text-base">3</span>
            </div>
            <div class="h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                <div id="progress-bar" class="h-full bg-primary rounded-full" style="width:100%"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    var _redirectUrl = '{{ route("success-callback", ["payment_id" => $paymentId]) }}';
    var _seconds = 3;
    var _bar = document.getElementById('progress-bar');
    var _cd  = document.getElementById('countdown');

    // Start transition after paint
    requestAnimationFrame(function () {
        requestAnimationFrame(function () {
            _bar.style.transition = 'width ' + _seconds + 's linear';
            _bar.style.width = '0%';
        });
    });

    var _timer = setInterval(function () {
        _seconds--;
        _cd.textContent = _seconds;
        if (_seconds <= 0) {
            clearInterval(_timer);
            window.location.href = _redirectUrl;
        }
    }, 1000);
</script>
@endpush
