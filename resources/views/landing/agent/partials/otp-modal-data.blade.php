<div class="modal-header border-0 pb-0">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body p-8 lg:p-12 otp-modal min-h-[500px]">
    <div class="text-center">
        <!-- Icon -->
        <div class="w-20 h-20 bg-brandBlue/10 rounded-full flex items-center justify-center mx-auto mb-8">
            <svg class="w-10 h-10 text-brandBlue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
        </div>
        
        <h3 class="text-2xl font-bold mb-4">{{ translate('Verificação OTP') }}</h3>
        <p class="text-slate-600 dark:text-gray-400 mb-8 leading-relaxed">
            {{translate('Enviamos um código de verificação para o seu telemóvel.')}}<br>
            {{translate('Por favor, insira o código abaixo para validar o seu registo.')}}
        </p>

        @php
            $otpResendTime = \App\Models\BusinessSetting::where(['key' => 'otp_resend_time'])->first()?->value ?? 30;
        @endphp

        <form class="otp-form space-y-8" id="agent_otp_verify" method="POST" action="{{route('agent.verify-otp')}}">
            @csrf
            
            <div class="flex gap-4 justify-center">
                <input class="otp-field w-14 h-16 text-center text-2xl font-bold bg-slate-50 dark:bg-white/5 border border-gray-100 dark:border-gray-900 rounded-2xl focus:ring-2 focus:ring-brandBlue/50 outline-none transition-all" type="text" name="otp_field[]" maxlength="1" autocomplete="off" required>
                <input class="otp-field w-14 h-16 text-center text-2xl font-bold bg-slate-50 dark:bg-white/5 border border-gray-100 dark:border-gray-900 rounded-2xl focus:ring-2 focus:ring-brandBlue/50 outline-none transition-all" type="text" name="otp_field[]" maxlength="1" autocomplete="off" required>
                <input class="otp-field w-14 h-16 text-center text-2xl font-bold bg-slate-50 dark:bg-white/5 border border-gray-100 dark:border-gray-900 rounded-2xl focus:ring-2 focus:ring-brandBlue/50 outline-none transition-all" type="text" name="otp_field[]" maxlength="1" autocomplete="off" required>
                <input class="otp-field w-14 h-16 text-center text-2xl font-bold bg-slate-50 dark:bg-white/5 border border-gray-100 dark:border-gray-900 rounded-2xl focus:ring-2 focus:ring-brandBlue/50 outline-none transition-all" type="text" name="otp_field[]" maxlength="1" autocomplete="off" required>
            </div>

            <div class="resend_otp_custom text-sm font-medium text-brandBlue flex justify-center items-center gap-2">
                <span>{{ translate('Reenviar código em') }}</span>
                <span class="verifyCounter font-bold" data-second="{{$otpResendTime}}"></span>
            </div>

            <input type="hidden" name="data" value="{{ json_encode($data) }}">
            <input type="hidden" id="phone_number" name="phone_number" value="{{ $phone }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input class="otp_value" type="hidden" name="otp">
            <input class="identity" type="hidden" name="identity" value="{{ request('identity') }}">

            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                <button class="flex-1 px-8 py-4 bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-gray-400 font-bold rounded-2xl hover:bg-slate-200 transition-all uppercase tracking-widest resend-otp-button" type="button" id="resend_otp">
                    {{ translate('Reenviar') }}
                </button>
                <button class="flex-[2] px-8 py-4 bg-brandBlue hover:bg-brandBlueHover text-white font-bold rounded-2xl transition-all shadow-lg shadow-brandBlue/20 uppercase tracking-widest" type="submit">
                    {{ translate('Verificar') }}
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Loader -->
<div class="modal-body flex items-center justify-center d-none min-h-[500px]" id="loader_otp">
    <div class="animate-spin rounded-full h-16 w-16 border-4 border-brandBlue border-t-transparent"></div>
</div>

<!-- Success State in Modal -->
<div class="modal-body p-8 lg:p-12 reg-success d-none min-h-[500px] text-center">
    <div class="w-20 h-20 bg-brandGreen/10 rounded-full flex items-center justify-center mx-auto mb-8">
        <svg class="w-10 h-10 text-brandGreen" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
    </div>
    <h3 class="text-2xl font-bold mb-4">{{ translate('Registo Concluído!') }}</h3>
    <p class="text-slate-600 dark:text-gray-400 mb-8 leading-relaxed">
        {{translate('A sua conta foi criada com sucesso. Por favor, descarregue a aplicação de Agente para concluir a verificação e começar a usar.')}}
    </p>
    <button onclick="window.location.href='{{route('landing-page-home')}}'" class="w-full bg-brandBlue hover:bg-brandBlueHover text-white font-bold py-4 rounded-2xl shadow-lg transition-all">
        {{translate('Ir para Home')}}
    </button>
</div>
