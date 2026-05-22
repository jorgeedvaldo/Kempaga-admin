@extends('payment.main')
@section('title', translate('PIN de Segurança') . ' — Kempaga Pay')

@section('content')
<div class="bg-white dark:bg-card rounded-3xl shadow-2xl shadow-black/20 overflow-hidden">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-primary to-primaryHover px-6 py-5 text-white">
        <div class="flex items-center justify-between mb-5">
            <img src="{{ $logo }}" alt="Kempaga" class="h-8 w-auto brightness-0 invert">
            <span class="flex items-center gap-1.5 text-xs bg-white/20 backdrop-blur rounded-full px-3 py-1.5 font-medium">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                {{ translate('Seguro') }}
            </span>
        </div>
        <div class="flex items-center">
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full bg-success flex items-center justify-center text-white text-sm font-bold shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
                <span class="text-[10px] mt-1 text-white/70">{{ translate('Número') }}</span>
            </div>
            <div class="flex-1 h-0.5 bg-success/70 mx-2 mb-4"></div>
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full bg-success flex items-center justify-center text-white text-sm font-bold shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
                <span class="text-[10px] mt-1 text-white/70">OTP</span>
            </div>
            <div class="flex-1 h-0.5 bg-white/30 mx-2 mb-4"></div>
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-primary text-sm font-bold shadow">3</div>
                <span class="text-[10px] mt-1 text-white font-medium">PIN</span>
            </div>
        </div>
    </div>

    <div class="px-6 pt-5 pb-6">
        <div class="text-center mb-6">
            <div class="inline-flex w-14 h-14 rounded-2xl bg-primary/10 dark:bg-primary/20 items-center justify-center mb-3">
                <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
            </div>
            <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-1">{{ translate('PIN de Segurança') }}</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ translate('Introduza o seu PIN Kempaga para confirmar') }}</p>
        </div>

        <form action="{{ route('verify-pin') }}" method="POST" id="pin-form">
            @csrf
            <input type="hidden" name="payment_id" value="{{ $paymentId }}">
            <input type="hidden" name="pin" id="pin-value">

            <div class="flex gap-3 justify-center mb-2">
                @for($i = 0; $i < 4; $i++)
                <input type="password" inputmode="numeric" pattern="[0-9]" maxlength="1" autocomplete="off"
                    class="pin-box w-16 h-[64px] text-center text-3xl bg-gray-50 dark:bg-surface border-2 border-gray-200 dark:border-gray-700 rounded-2xl text-gray-900 dark:text-white focus:border-primary focus:ring-4 focus:ring-primary/20 outline-none transition-all caret-transparent">
                @endfor
            </div>

            <p class="text-center text-xs text-gray-400 dark:text-gray-500 mb-6">
                <svg class="inline w-3 h-3 mr-0.5 mb-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                {{ translate('Nunca partilhe o seu PIN com ninguém') }}
            </p>

            <div class="flex gap-3">
                <button type="button" id="cancel-pin"
                    class="w-[100px] shrink-0 py-3.5 rounded-xl border-2 border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 font-semibold hover:bg-gray-50 dark:hover:bg-surface transition-all">
                    {{ translate('Cancelar') }}
                </button>
                <button type="submit"
                    class="flex-1 py-3.5 rounded-xl bg-primary hover:bg-primaryHover text-white font-semibold shadow-lg shadow-primary/25 transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    {{ translate('Confirmar Pagamento') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('script')
<script>
(function () {
    var boxes = document.querySelectorAll('.pin-box');
    var hidden = document.getElementById('pin-value');

    function sync() {
        hidden.value = Array.from(boxes).map(function (b) { return b.value; }).join('');
    }

    boxes.forEach(function (box, i) {
        box.addEventListener('input', function () {
            box.value = box.value.replace(/\D/g, '').slice(-1);
            sync();
            if (box.value && i < boxes.length - 1) boxes[i + 1].focus();
        });
        box.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace') {
                if (!box.value && i > 0) { boxes[i - 1].focus(); boxes[i - 1].value = ''; sync(); }
                else { box.value = ''; sync(); }
            }
        });
        box.addEventListener('focus', function () { box.select(); });
    });

    document.getElementById('pin-form').addEventListener('submit', function (e) {
        sync();
        if (hidden.value.length < 4) {
            e.preventDefault();
            toastr.error('{{ translate("Por favor, introduza o PIN completo (4 dígitos).") }}', '', { CloseButton: true, ProgressBar: true });
            boxes[0].focus();
        }
    });

    document.getElementById('cancel-pin').addEventListener('click', function () {
        cancelPayment('{{ $frontendCallback }}');
    });

    boxes[0] && boxes[0].focus();
})();
</script>
@endpush
