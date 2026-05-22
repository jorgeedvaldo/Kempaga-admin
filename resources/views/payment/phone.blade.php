@extends('payment.main')
@section('title', translate('Kempaga Pay'))

@section('content')
<div class="bg-white dark:bg-card rounded-3xl shadow-2xl shadow-black/20 overflow-hidden">

    {{-- Header azul com stepper --}}
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
                <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-primary text-sm font-bold shadow">1</div>
                <span class="text-[10px] mt-1 text-white font-medium">{{ translate('Número') }}</span>
            </div>
            <div class="flex-1 h-0.5 bg-white/30 mx-2 mb-4"></div>
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full bg-white/25 flex items-center justify-center text-white/70 text-sm font-bold">2</div>
                <span class="text-[10px] mt-1 text-white/50">OTP</span>
            </div>
            <div class="flex-1 h-0.5 bg-white/30 mx-2 mb-4"></div>
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full bg-white/25 flex items-center justify-center text-white/70 text-sm font-bold">3</div>
                <span class="text-[10px] mt-1 text-white/50">PIN</span>
            </div>
        </div>
    </div>

    <div class="px-6 pt-5 pb-6">

        {{-- Cartão do merchant --}}
        <div class="flex items-center gap-3 p-4 rounded-2xl bg-gray-50 dark:bg-surface border border-gray-100 dark:border-gray-700/50 mb-5">
            <img src="{{ dynamicStorage(path: 'storage/app/public/merchant') }}/{{ $merchantUser->merchant->logo }}"
                 alt="{{ $merchantUser->merchant->store_name }}"
                 class="w-12 h-12 rounded-xl object-cover border border-gray-200 dark:border-gray-700 shrink-0">
            <div class="min-w-0 flex-1">
                <p class="font-semibold text-gray-900 dark:text-white truncate">{{ $merchantUser->merchant->store_name }}</p>
                <p class="text-xs text-gray-400 truncate">{{ $merchantUser->phone }}</p>
            </div>
            <div class="text-right shrink-0">
                <p class="text-[10px] font-medium text-gray-400 uppercase tracking-wide">{{ translate('A pagar') }}</p>
                <p class="text-lg font-bold text-primary leading-tight">{{ Helpers::set_symbol($paymentRecord->amount) }}</p>
            </div>
        </div>

        {{-- Formulário --}}
        <form action="{{ route('send-otp') }}" method="POST">
            @csrf
            <input type="hidden" name="payment_id" value="{{ $paymentId }}">

            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ translate('Número de conta Kempaga') }}
            </label>

            <div class="flex gap-2 mb-4">
                <div class="relative w-[120px] shrink-0">
                    <select name="dial_country_code" id="dial_country_code" required
                        class="w-full h-[52px] appearance-none pl-3 pr-7 bg-gray-50 dark:bg-surface border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary transition-all cursor-pointer">
                        <option value="">{{ translate('País') }}</option>
                        @foreach(PHONE_CODE as $country_code)
                            <option value="{{ $country_code['code'] }}"
                                {{ strpos($country_code['name'], $currentUserInfo->countryName) !== false ? 'selected' : '' }}>
                                {{ $country_code['code'] }} {{ $country_code['name'] }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
                <input type="number" name="phone" value="{{ old('phone') }}" required
                    class="flex-1 min-w-0 px-4 h-[52px] bg-gray-50 dark:bg-surface border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary transition-all"
                    placeholder="{{ translate('923 000 000') }}">
            </div>

            <label class="flex items-start gap-2.5 mb-5 cursor-pointer select-none">
                <input type="checkbox" name="terms_and_condition" required
                    class="mt-0.5 w-4 h-4 rounded accent-primary shrink-0">
                <span class="text-sm text-gray-600 dark:text-gray-400 leading-snug">
                    {{ translate('Concordo com os') }}
                    <a href="{{ route('pages.terms-conditions') }}" target="_blank"
                       class="text-primary hover:underline font-medium">{{ translate('Termos e Condições') }}</a>
                </span>
            </label>

            <div class="flex gap-3">
                <button type="button" id="cancel-btn"
                    class="w-[100px] shrink-0 py-3.5 rounded-xl border-2 border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 font-semibold hover:bg-gray-50 dark:hover:bg-surface transition-all">
                    {{ translate('Cancelar') }}
                </button>
                <button type="submit"
                    class="flex-1 py-3.5 rounded-xl bg-primary hover:bg-primaryHover text-white font-semibold shadow-lg shadow-primary/25 transition-all flex items-center justify-center gap-2">
                    {{ translate('Continuar') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </form>
    </div>

    {{-- Hotline --}}
    @php($hotline = \App\Models\BusinessSetting::where('key', 'hotline_number')->first())
    @if($hotline && $hotline->value)
    <div class="border-t border-gray-100 dark:border-gray-800 px-6 py-3.5">
        <a href="tel:{{ $hotline->value }}"
           class="flex items-center justify-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-primary transition-colors">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            {{ translate('Linha de Apoio') }}: <strong class="text-gray-700 dark:text-gray-200">{{ $hotline->value }}</strong>
        </a>
    </div>
    @endif
</div>
@endsection

@push('script')
<script>
    document.getElementById('cancel-btn').addEventListener('click', function () {
        cancelPayment('{{ $paymentRecord->callback }}');
    });
</script>
@endpush
