@extends('layouts.landing.app')

@section('title', translate('Registo de Agente'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endpush

@section('content')
    <!-- Header Decorativo -->
    <div class="max-w-[1400px] mx-auto px-6 lg:px-12 py-16 relative overflow-hidden text-center">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-brandBlue/5 rounded-full blur-[120px] pointer-events-none"></div>
        <h1 class="text-[3rem] lg:text-[4rem] font-bold mb-6 gradient-text">
            {{translate('Torne-se um Agente')}}
        </h1>
        <p class="text-slate-700 dark:text-gray-300 text-lg max-w-2xl mx-auto font-medium">
            {{translate('Abra a sua conta de agente e comece a oferecer soluções financeiras na sua comunidade. Simples, rápido e seguro.')}}
        </p>
    </div>

    <!-- Form Section -->
    <section class="max-w-[1400px] mx-auto px-6 lg:px-12 pb-24">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-[2.5rem] shadow-2xl overflow-hidden p-8 lg:p-12">
                
                <form id="agent-form-store" class="space-y-8">
                    @csrf
                    
                    <!-- Nome Completo -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        <div class="space-y-2">
                            <label for="f_name" class="text-sm font-bold uppercase tracking-widest text-gray-500 ml-1">{{translate('Primeiro Nome')}}*</label>
                            <input type="text" name="f_name" id="f_name" placeholder="Ex: João"
                                   class="w-full px-6 py-4 bg-slate-50 dark:bg-white/5 border border-gray-100 dark:border-gray-900 rounded-2xl focus:ring-2 focus:ring-brandBlue/50 outline-none transition-all font-medium" required>
                        </div>
                        <div class="space-y-2">
                            <label for="l_name" class="text-sm font-bold uppercase tracking-widest text-gray-500 ml-1">{{translate('Último Nome')}}*</label>
                            <input type="text" name="l_name" id="l_name" placeholder="Ex: Silva"
                                   class="w-full px-6 py-4 bg-slate-50 dark:bg-white/5 border border-gray-100 dark:border-gray-900 rounded-2xl focus:ring-2 focus:ring-brandBlue/50 outline-none transition-all font-medium" required>
                        </div>
                    </div>

                    <!-- Contactos -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        <div class="space-y-2">
                            <label for="phone" class="text-sm font-bold uppercase tracking-widest text-gray-500 ml-1">{{translate('Telemóvel')}}*</label>
                            <div class="flex gap-3">
                                <select id="country_code" name="country_code" class="w-32 px-4 py-4 bg-slate-50 dark:bg-white/5 border border-gray-100 dark:border-gray-900 rounded-2xl focus:ring-2 focus:ring-brandBlue/50 outline-none transition-all font-medium cursor-pointer" required>
                                    @foreach(PHONE_CODE as $countryCode)
                                        <option value="{{ $countryCode['code'] }}" {{ $currentUserInfo && strpos($countryCode['name'], $currentUserInfo->countryName) !== false ? 'selected' : '' }}>
                                            {{ $countryCode['code'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="tel" id="phone" name="phone" class="flex-1 px-6 py-4 bg-slate-50 dark:bg-white/5 border border-gray-100 dark:border-gray-900 rounded-2xl focus:ring-2 focus:ring-brandBlue/50 outline-none transition-all font-medium"
                                       oninput="this.value = this.value.replace(/[^+\d]+$/g, '').replace(/(\..*)\./g, '$1');"
                                       placeholder="9XX XXX XXX" required>
                            </div>
                            <div class="text-danger text-xs mt-1 ml-1" id="show-error-message"></div>
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="text-sm font-bold uppercase tracking-widest text-gray-500 ml-1">{{translate('E-mail')}}*</label>
                            <input type="email" name="email" id="email" placeholder="exemplo@email.com"
                                   class="w-full px-6 py-4 bg-slate-50 dark:bg-white/5 border border-gray-100 dark:border-gray-900 rounded-2xl focus:ring-2 focus:ring-brandBlue/50 outline-none transition-all font-medium" required>
                        </div>
                    </div>

                    <!-- Profissão e PIN -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        <div class="space-y-2">
                            <label for="occupation" class="text-sm font-bold uppercase tracking-widest text-gray-500 ml-1">{{translate('Profissão')}}*</label>
                            <input type="text" name="occupation" id="occupation" placeholder="Ex: Comerciante"
                                   class="w-full px-6 py-4 bg-slate-50 dark:bg-white/5 border border-gray-100 dark:border-gray-900 rounded-2xl focus:ring-2 focus:ring-brandBlue/50 outline-none transition-all font-medium" required>
                        </div>
                        <div class="space-y-2">
                            <label for="password" class="text-sm font-bold uppercase tracking-widest text-gray-500 ml-1">{{translate('PIN da Conta (4 dígitos)')}}*</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" maxlength="4" placeholder="••••"
                                       class="w-full px-6 py-4 bg-slate-50 dark:bg-white/5 border border-gray-100 dark:border-gray-900 rounded-2xl focus:ring-2 focus:ring-brandBlue/50 outline-none transition-all font-medium tracking-[0.5em]" required>
                                <button type="button" onclick="togglePinVisibility()" class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-brandBlue">
                                    <svg id="pin-eye-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Género -->
                    <div class="space-y-4">
                        <label class="text-sm font-bold uppercase tracking-widest text-gray-500 ml-1 block">{{translate('Género')}}*</label>
                        <div class="flex flex-wrap gap-4">
                            <label class="relative group cursor-pointer">
                                <input type="radio" name="gender" value="male" class="peer hidden" checked>
                                <div class="px-8 py-3 rounded-xl bg-slate-50 dark:bg-white/5 border border-gray-100 dark:border-gray-900 peer-checked:bg-brandBlue peer-checked:text-white peer-checked:border-brandBlue transition-all font-bold">
                                    {{translate('Masculino')}}
                                </div>
                            </label>
                            <label class="relative group cursor-pointer">
                                <input type="radio" name="gender" value="female" class="peer hidden">
                                <div class="px-8 py-3 rounded-xl bg-slate-50 dark:bg-white/5 border border-gray-100 dark:border-gray-900 peer-checked:bg-brandBlue peer-checked:text-white peer-checked:border-brandBlue transition-all font-bold">
                                    {{translate('Feminino')}}
                                </div>
                            </label>
                            <label class="relative group cursor-pointer">
                                <input type="radio" name="gender" value="other" class="peer hidden">
                                <div class="px-8 py-3 rounded-xl bg-slate-50 dark:bg-white/5 border border-gray-100 dark:border-gray-900 peer-checked:bg-brandBlue peer-checked:text-white peer-checked:border-brandBlue transition-all font-bold">
                                    {{translate('Outro')}}
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="pt-8 flex flex-col sm:flex-row gap-4">
                        <button type="reset" class="flex-1 px-8 py-4 bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-gray-400 font-bold rounded-2xl hover:bg-slate-200 transition-all uppercase tracking-widest">
                            {{translate('Limpar')}}
                        </button>
                        <button type="submit" class="flex-[2] px-8 py-4 bg-brandBlue hover:bg-brandBlueHover text-white font-bold rounded-2xl transition-all shadow-lg shadow-brandBlue/20 uppercase tracking-widest">
                            {{translate('Criar Minha Conta')}}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </section>

    <!-- Success Modal (Standard Tailwind Style) -->
    <div id="success-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-6 backdrop-blur-md bg-black/50">
        <div class="bg-white dark:bg-darkCard rounded-[2.5rem] p-10 max-w-md w-full text-center shadow-2xl scale-90 transition-transform duration-300">
            <div class="w-20 h-20 bg-brandGreen/10 rounded-full flex items-center justify-center mx-auto mb-6">
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
    </div>

    @include('landing.agent.partials.otp-modal')
@endsection

@push('script_2')
    <script>
        "use strict";

        function togglePinVisibility() {
            const input = document.getElementById('password');
            const icon = document.getElementById('pin-eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878l4.242 4.242M3 3l18 18"></path>';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        }

        var timer;
        function checkPhoneNumber() {
            var phone = $('#country_code').val() + $('#phone').val();
            clearTimeout(timer);
            timer = setTimeout(function () {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('agent.phone-number-check') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'phone': phone
                    },
                    success: function (response) {
                        if (response.available) {
                            $('#show-error-message').text('');
                        } else {
                            $('#show-error-message').text('Este número já está a ser utilizado em outra conta');
                        }
                    }
                });
            }, 500);
        }

        $('#phone').on('keyup', checkPhoneNumber);

        function resendOtp(phone) {
            $.ajax({
                type: 'POST',
                url: '{{ route('agent.resend-otp') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'phone': phone
                },
                success: function (data) {
                    if (data.errors) {
                        for (var i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message);
                        }
                    } else {
                        if (data.status === 'success') {
                            toastr.success(data.message);
                            countdown();
                        } else if (data.status === 'error') {
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }

        function countdown() {
            var counter = $(".verifyCounter");
            var seconds = counter.data("second");
            function tick() {
                var m = Math.floor(seconds / 60);
                var s = seconds % 60;
                seconds--;
                counter.html(m + ":" + (s < 10 ? "0" : "") + String(s));
                if (seconds > 0) {
                    setTimeout(tick, 1000);
                    $(".resend-otp-button").attr("disabled", true);
                    $(".resend_otp_custom").slideDown();
                } else {
                    $(".resend-otp-button").removeAttr("disabled");
                    $(".verifyCounter").html("0:00");
                    $(".resend_otp_custom").slideUp();
                }
            }
            tick();
        }

        function otp_verification() {
            $(".otp-form button[type=submit]").attr("disabled", true);
            $(".otp-form *:input[type!=hidden]:first").focus();
            let otp_fields = $(".otp-form .otp-field"),
                otp_value_field = $(".otp-form .otp_value");
            otp_fields
                .on("input", function (e) {
                    $(this).val($(this).val().replace(/[^0-9]/g, ""));
                    let otp_value = "";
                    otp_fields.each(function () {
                        let field_value = $(this).val();
                        if (field_value != "") otp_value += field_value;
                    });
                    otp_value_field.val(otp_value);
                    if (otp_value.length === 4) {
                        $(".otp-form button[type=submit]").attr("disabled", false);
                    } else {
                        $(".otp-form button[type=submit]").attr("disabled", true);
                    }
                })
                .on("keyup", function (e) {
                    let key = e.keyCode || e.charCode;
                    if (key == 8 || key == 46 || key == 37 || key == 40) {
                        $(this).prev().focus();
                    } else if (key == 38 || key == 39 || $(this).val() != "") {
                        $(this).next().focus();
                    }
                })
                .on("paste", function (e) {
                    let paste_data = e.originalEvent.clipboardData.getData("text");
                    let paste_data_splitted = paste_data.split("");
                    $.each(paste_data_splitted, function (index, value) {
                        otp_fields.eq(index).val(value);
                    });
                });
        }

        $('#agent-form-store').on('submit', function (event) {
            event.preventDefault();
            var form = $('#agent-form-store')[0];
            var formData = new FormData(form);
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                url: "{{route('agent.store-registration')}}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (data) {
                    if (data.errors) {
                        for (var i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message);
                        }
                    } else {
                        if (data.flag === 'open_otp') {
                            $('#exampleModal').modal('show');
                            $('#activateData').empty().html(data.view);
                            countdown();
                            otp_verification();
                            document.getElementById('resend_otp').addEventListener('click', function (event) {
                                event.preventDefault();
                                var phone = $('.otp-form #phone_number').val();
                                resendOtp(phone);
                            });
                        } else if (data.flag === 'phone_exists') {
                            toastr.error('{{ translate("Este número de telefone já está registado.") }}');
                        } else if (data.flag === 'failed_otp') {
                            toastr.error('{{ translate("Falha no OTP!") }}');
                        } else {
                            form.reset();
                            $('#show-error-message').text('');
                            $('#success-modal').removeClass('hidden').addClass('flex');
                            setTimeout(() => {
                                $('#success-modal > div').removeClass('scale-90').addClass('scale-100');
                            }, 10);
                        }
                    }
                },
                error: function (jqXHR) {
                    toastr.error(jqXHR.responseJSON.message);
                }
            });
        });

        $(document).on('submit', '#agent_otp_verify', function (event) {
            event.preventDefault();
            var form = $('#agent_otp_verify')[0];
            var formData = new FormData(form);
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            var responseData;
            $.ajax({
                url: "{{route('agent.verify-otp')}}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                beforeSend: function () {
                    $('.otp-modal').addClass('d-none');
                    $('#loader_otp').removeClass('d-none');
                },
                success: function (data) {
                    responseData = data;
                    if (data.errors) {
                        for (var i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message);
                        }
                    } else {
                        if (data.flag === 'failed_otp') {
                            toastr.error('{{ translate("OTP inválido!") }}');
                        } else {
                            $('#exampleModal').modal('hide');
                            $('#success-modal').removeClass('hidden').addClass('flex');
                            setTimeout(() => {
                                $('#success-modal > div').removeClass('scale-90').addClass('scale-100');
                            }, 10);
                        }
                    }
                },
                complete: function (jqXHR, textStatus) {
                    $('#loader_otp').addClass('d-none');
                    if (textStatus !== "success") {
                        toastr.error(jqXHR.responseJSON.message);
                        $('.otp-modal').removeClass('d-none');
                    }
                }
            });
        });
    </script>
@endpush
