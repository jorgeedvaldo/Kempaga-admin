@extends('payment.main')
@section('title', translate('Código de Verificação') . ' — Kempaga Pay')

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
                <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-primary text-sm font-bold shadow">2</div>
                <span class="text-[10px] mt-1 text-white font-medium">OTP</span>
            </div>
            <div class="flex-1 h-0.5 bg-white/30 mx-2 mb-4"></div>
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full bg-white/25 flex items-center justify-center text-white/70 text-sm font-bold">3</div>
                <span class="text-[10px] mt-1 text-white/50">PIN</span>
            </div>
        </div>
    </div>

    <div class="px-6 pt-5 pb-6">
        <div class="text-center mb-6">
            <div class="inline-flex w-14 h-14 rounded-2xl bg-primary/10 dark:bg-primary/20 items-center justify-center mb-3">
                <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
            </div>
            <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-1">{{ translate('Código de Verificação') }}</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ translate('Introduza o código enviado para o seu número') }}</p>
        </div>

        <form action="{{ route('verify-otp') }}" method="POST" id="otp-form">
            @csrf
            <input type="hidden" name="payment_id" value="{{ $paymentId }}">
            <input type="hidden" name="otp" id="otp-value">

            <div class="flex gap-3 justify-center mb-6">
                @for($i = 0; $i < 4; $i++)
                <input type="text" inputmode="numeric" pattern="[0-9]" maxlength="1"
                    autocomplete="{{ $i === 0 ? 'one-time-code' : 'off' }}"
                    class="otp-box w-16 h-[64px] text-center text-2xl font-bold bg-gray-50 dark:bg-surface border-2 border-gray-200 dark:border-gray-700 rounded-2xl text-gray-900 dark:text-white focus:border-primary focus:ring-4 focus:ring-primary/20 outline-none transition-all caret-transparent">
                @endfor
            </div>

            <div class="flex gap-3 mb-4">
                <button type="button" id="cancel-otp"
                    class="w-[100px] shrink-0 py-3.5 rounded-xl border-2 border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 font-semibold hover:bg-gray-50 dark:hover:bg-surface transition-all">
                    {{ translate('Cancelar') }}
                </button>
                <button type="submit"
                    class="flex-1 py-3.5 rounded-xl bg-primary hover:bg-primaryHover text-white font-semibold shadow-lg shadow-primary/25 transition-all flex items-center justify-center gap-2">
                    {{ translate('Verificar') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </form>

        <div class="text-center">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ translate('Não recebeu o código?') }}
                <button type="button" id="resend-otp" class="text-primary hover:underline font-semibold ml-1">
                    {{ translate('Reenviar') }}
                </button>
            </p>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
(function () {
    var boxes = document.querySelectorAll('.otp-box');
    var hidden = document.getElementById('otp-value');

    function sync() {
        hidden.value = Array.from(boxes).map(function (b) { return b.value; }).join('');
    }

    boxes.forEach(function (box, i) {
        box.addEventListener('input', function () {
            box.value = box.value.replace(/\D/g, '').slice(-1);
            box.classList.add('pop');
            setTimeout(function () { box.classList.remove('pop'); }, 180);
            sync();
            if (box.value && i < boxes.length - 1) boxes[i + 1].focus();
        });
        box.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace') {
                if (!box.value && i > 0) { boxes[i - 1].focus(); boxes[i - 1].value = ''; sync(); }
                else { box.value = ''; sync(); }
            }
        });
        box.addEventListener('paste', function (e) {
            e.preventDefault();
            var paste = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '').slice(0, 4);
            paste.split('').forEach(function (ch, j) { if (boxes[j]) boxes[j].value = ch; });
            sync();
            boxes[Math.min(paste.length, boxes.length - 1)].focus();
        });
        box.addEventListener('focus', function () { box.select(); });
    });

    document.getElementById('otp-form').addEventListener('submit', function (e) {
        sync();
        if (hidden.value.length < 4) {
            e.preventDefault();
            toastr.error('{{ translate("Por favor, introduza o código completo.") }}', '', { CloseButton: true, ProgressBar: true });
            boxes[0].focus();
        }
    });

    document.getElementById('cancel-otp').addEventListener('click', function () {
        cancelPayment('{{ $frontendCallback }}');
    });

    document.getElementById('resend-otp').addEventListener('click', function () {
        Swal.fire({
            title: '{{ translate("Reenviar código?") }}',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0078D7',
            cancelButtonColor: '#6B7280',
            confirmButtonText: '{{ translate("Sim, reenviar") }}',
            cancelButtonText: '{{ translate("Não") }}',
            reverseButtons: true
        }).then(function (r) {
            if (r.value) {
                $.ajax({
                    url: '{{ route("resend-otp") }}',
                    type: 'GET',
                    success: function (data) {
                        toastr.success(data.message, '', { CloseButton: true, ProgressBar: true });
                        boxes.forEach(function(b){ b.value=''; });
                        sync();
                        boxes[0].focus();
                    }
                });
            }
        });
    });

    // Auto-focus first box
    boxes[0] && boxes[0].focus();
})();
</script>
@endpush
