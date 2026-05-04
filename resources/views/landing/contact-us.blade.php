@extends('layouts.landing.app')

@section('title', translate('Contactos'))

@section('content')
    <!-- Header -->
    <div class="max-w-[1400px] mx-auto px-6 lg:px-12 py-20 relative overflow-hidden text-center">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-brandBlue/5 rounded-full blur-[120px] pointer-events-none"></div>
        <h1 class="text-[3.5rem] lg:text-[4.5rem] font-bold mb-6 gradient-text">
            {{translate('Fale Connosco')}}
        </h1>
        <p class="text-slate-700 dark:text-gray-300 text-[1.2rem] max-w-2xl mx-auto font-medium">
            {!! change_text_color_or_bg($data['contact_us_section']['data']['sub_title']) !!}
        </p>
    </div>

    <!-- Contact Form Section -->
    <section class="max-w-[1400px] mx-auto px-6 lg:px-12 py-10 pb-24">
        <div class="bg-white dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-[2.5rem] overflow-hidden shadow-2xl flex flex-col lg:flex-row">
            
            <!-- Info Sidebar -->
            <div class="lg:w-[40%] bg-gradient-to-br from-brandBlue to-brandBlueHover p-10 lg:p-14 text-white relative overflow-hidden">
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 24px 24px;"></div>
                
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold mb-8">{{translate('Informações de Contacto')}}</h3>
                    
                    <div class="space-y-10 mt-12">
                        <div class="flex items-start gap-5">
                            <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <p class="font-bold opacity-70 uppercase tracking-wider text-xs mb-1">{{translate('Endereço')}}</p>
                                <p class="text-lg">{{Helpers::get_business_settings('address')}}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-5">
                            <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="font-bold opacity-70 uppercase tracking-wider text-xs mb-1">{{translate('E-mail')}}</p>
                                <a href="mailto:{{Helpers::get_business_settings('email')}}" class="text-lg hover:underline">{{Helpers::get_business_settings('email')}}</a>
                            </div>
                        </div>

                        <div class="flex items-start gap-5">
                            <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <p class="font-bold opacity-70 uppercase tracking-wider text-xs mb-1">{{translate('Telefone')}}</p>
                                <a href="tel:{{Helpers::get_business_settings('phone')}}" class="text-lg hover:underline">{{Helpers::get_business_settings('phone')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="flex-1 p-10 lg:p-14">
                <form action="{{route('send-message')}}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-semibold">{{translate('Nome')}}</label>
                            <input type="text" name="name" id="name" required class="w-full px-4 py-3 bg-slate-50 dark:bg-black/20 border border-gray-200 dark:border-gray-800 rounded-xl focus:ring-2 focus:ring-brandBlue/50 focus:border-brandBlue outline-none transition-all" placeholder="{{translate('Ex: João Manuel')}}">
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-semibold">{{translate('Email')}}</label>
                            <input type="email" name="email" id="email" required class="w-full px-4 py-3 bg-slate-50 dark:bg-black/20 border border-gray-200 dark:border-gray-800 rounded-xl focus:ring-2 focus:ring-brandBlue/50 focus:border-brandBlue outline-none transition-all" placeholder="exemplo@gmail.com">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="subject" class="block text-sm font-semibold">{{translate('Assunto')}}</label>
                        <input type="text" name="subject" id="subject" required class="w-full px-4 py-3 bg-slate-50 dark:bg-black/20 border border-gray-200 dark:border-gray-800 rounded-xl focus:ring-2 focus:ring-brandBlue/50 focus:border-brandBlue outline-none transition-all" placeholder="{{translate('Em que podemos ajudar?')}}">
                    </div>

                    <div class="space-y-2">
                        <label for="message" class="block text-sm font-semibold">{{translate('Mensagem')}}</label>
                        <textarea name="message" id="message" required rows="5" class="w-full px-4 py-3 bg-slate-50 dark:bg-black/20 border border-gray-200 dark:border-gray-800 rounded-xl focus:ring-2 focus:ring-brandBlue/50 focus:border-brandBlue outline-none transition-all" placeholder="{{translate('Escreva aqui a sua mensagem...')}}"></textarea>
                    </div>

                    <button type="submit" class="bg-brandBlue hover:bg-brandBlueHover text-white font-bold py-4 px-10 rounded-xl transition-all duration-300 w-full lg:w-auto shadow-lg shadow-brandBlue/20">
                        {{translate('Enviar Mensagem')}}
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
