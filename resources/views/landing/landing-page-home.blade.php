@extends('layouts.landing.app')

@section('title', Helpers::get_business_settings('business_name') . ' | ' . translate('A sua carteira digital em Angola'))

@section('content')
    <!-- ==================== HERO SECTION ==================== -->
    <div class="max-w-[1400px] mx-auto px-6 lg:px-12 relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 mt-10 pb-20 items-center">
        
        <!-- Textos -->
        <div class="flex flex-col z-10">
            <div class="flex flex-wrap gap-3 mb-6">
                <span class="px-3 py-1 rounded-full bg-brandBlue/10 dark:bg-brandBlue/20 text-brandBlue dark:text-[#4da6ff] text-sm font-semibold border border-brandBlue/20">{{translate('Multicaixa Express')}}</span>
                <span class="px-3 py-1 rounded-full bg-brandGreen/10 dark:bg-brandGreen/20 text-brandGreen dark:text-brandGreenBright text-sm font-semibold border border-brandGreen/20">{{translate('Seguro & Rápido')}}</span>
            </div>

            <h1 class="text-[3.2rem] lg:text-[4.5rem] font-bold leading-[1.05] tracking-tight">
                {{translate('A Sua Carteira')}}<br>
                <span class="gradient-text">{{translate('Digital em Angola')}}</span>
            </h1>
            
            <p class="mt-6 text-slate-800 dark:text-gray-300 text-[1.2rem] font-medium">
                {{translate('Kempaga é a carteira digital que simplifica a sua vida.')}}<br>
                <span class="text-textMutedLight dark:text-textMutedDark font-light">{{translate('Pague, envie e receba dinheiro com total liberdade.')}}</span>
            </p>

            <div class="flex flex-wrap items-center gap-4 mt-8">
                <a href="{{route('agent.agent-self-registration')}}" class="bg-gradient-to-r from-brandBlue to-brandBlueHover text-white font-semibold py-4 px-8 rounded-full transition-all duration-300 text-lg shadow-lg shadow-brandBlue/25 hover:scale-105">
                    {{translate('Começar Agora')}}
                </a>
                <a href="{{route('pages.about-us')}}" class="bg-transparent border-2 border-slate-300 text-slate-700 hover:border-brandGreen hover:bg-brandGreen hover:text-white dark:border-gray-700 dark:text-white dark:hover:border-brandGreen dark:hover:bg-brandGreen font-semibold py-4 px-8 rounded-full transition-all duration-300 text-lg">
                    {{translate('Saiba Mais')}}
                </a>
            </div>

            <div class="flex items-center gap-8 mt-10 pt-6 border-t border-gray-200 dark:border-gray-900">
                <div class="flex flex-col">
                    <span class="text-xl font-bold">100%</span>
                    <span class="text-textMutedLight dark:text-textMutedDark text-sm">{{translate('Seguro')}}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-bold">0 AOA</span>
                    <span class="text-textMutedLight dark:text-textMutedDark text-sm">{{translate('Adesão')}}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-bold">24/7</span>
                    <span class="text-textMutedLight dark:text-textMutedDark text-sm">{{translate('Suporte')}}</span>
                </div>
            </div>
        </div>

        <!-- Imagem e Card Flutuante -->
        <div class="relative w-full max-w-[550px] mx-auto lg:ml-auto lg:mr-0 mt-10 lg:mt-0 flex flex-col items-end">
            <div class="relative bg-lightCard dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-[2.5rem] p-4 w-full aspect-[4/4.5] shadow-2xl">
                
                <div class="w-full h-full bg-gray-200 dark:bg-[#08080a] rounded-[2rem] overflow-hidden relative flex items-center justify-center">
                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=800&auto=format&fit=crop" alt="App Kempaga" class="w-full h-full object-cover opacity-80 transition-transform duration-700 hover:scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-tr from-brandBlue/30 via-transparent to-brandGreen/20 mix-blend-overlay"></div>
                </div>

                <!-- Notificação Flutuante -->
                <div class="absolute -left-4 lg:-left-12 bottom-16 backdrop-blur-xl bg-white/90 dark:bg-[#0a0a0c]/90 border border-white/60 dark:border-gray-800 rounded-2xl p-4 flex items-center gap-4 min-w-[280px] shadow-2xl z-20">
                    <div class="h-10 w-10 rounded-full bg-brandGreen/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-brandGreen" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm">{{translate('Pagamento Recebido')}}</p>
                        <p class="text-gray-500 text-xs mt-0.5">{{translate('Multicaixa Express')}}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-brandGreen font-bold text-lg">+ 15.000</p>
                        <p class="text-gray-500 text-xs mt-0.5 font-medium">{{translate('AOA')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== VANTAGENS SECTION ==================== -->
    <section id="features" class="w-full bg-white dark:bg-[#050505] py-24 border-y border-gray-100 dark:border-gray-900 transition-colors">
        <div class="max-w-[1400px] mx-auto px-6 lg:px-12">
            
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold mb-6">{{translate('Tudo o que precisa na sua mão')}}</h2>
                <p class="text-textMutedLight dark:text-textMutedDark text-lg">
                    {{translate('O Kempaga foi criado para facilitar o seu dia-a-dia financeiro com segurança e simplicidade.')}}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Pagamentos -->
                <div class="bg-lightBg dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-3xl p-8 hover:-translate-y-2 transition-all duration-300 shadow-sm hover:shadow-brandBlue/10 hover:shadow-xl group">
                    <div class="w-14 h-14 rounded-2xl bg-brandBlue/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-brandBlue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">{{translate('Pagamentos Instantâneos')}}</h3>
                    <p class="text-textMutedLight dark:text-textMutedDark">
                        {{translate('Pague as suas compras em lojas físicas ou online de forma rápida e segura usando apenas o seu smartphone.')}}
                    </p>
                </div>

                <!-- Transferências -->
                <div class="bg-lightBg dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-3xl p-8 hover:-translate-y-2 transition-all duration-300 shadow-sm hover:shadow-brandGreen/10 hover:shadow-xl group">
                    <div class="w-14 h-14 rounded-2xl bg-brandGreen/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-brandGreen" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">{{translate('Envio de Dinheiro')}}</h3>
                    <p class="text-textMutedLight dark:text-textMutedDark">
                        {{translate('Envie e receba dinheiro de amigos e familiares em segundos, sem complicações e com taxas mínimas.')}}
                    </p>
                </div>

                <!-- Segurança -->
                <div class="bg-lightBg dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-3xl p-8 hover:-translate-y-2 transition-all duration-300 shadow-sm hover:shadow-brandBlue/10 hover:shadow-xl group">
                    <div class="w-14 h-14 rounded-2xl bg-brandBlue/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-brandBlue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">{{translate('Segurança Avançada')}}</h3>
                    <p class="text-textMutedLight dark:text-textMutedDark">
                        {{translate('A sua conta está protegida por biometria e encriptação de nível bancário, garantindo que o seu dinheiro esteja sempre seguro.')}}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== APP SHOWCASE ==================== -->
    <section id="download" class="w-full py-24 relative overflow-hidden">
        <!-- Blur decorativo de fundo -->
        <div class="absolute top-1/2 left-0 w-[500px] h-[500px] bg-brandBlue/20 rounded-full blur-[120px] -translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>

        <div class="max-w-[1400px] mx-auto px-6 lg:px-12 relative z-10 flex flex-col lg:flex-row items-center gap-16">
            
            <div class="w-full lg:w-1/2">
                <h2 class="text-3xl lg:text-5xl font-bold mb-6">{{translate('O controlo total no seu bolso.')}}</h2>
                <p class="text-textMutedLight dark:text-textMutedDark text-lg mb-8 leading-relaxed">
                    {{translate('Baixe o aplicativo Kempaga e simplifique as suas finanças. Faça pagamentos, levante dinheiro e gira o seu saldo com total facilidade e segurança.')}}
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <button class="flex items-center justify-center gap-3 bg-slate-900 dark:bg-white text-white dark:text-black py-3 px-6 rounded-xl hover:scale-105 transition-transform">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.04 2.26-.74 3.58-.8 1.58-.06 2.88.58 3.56 1.5-3.06 1.74-2.52 5.95.38 7.15-.75 1.83-1.68 3.51-2.6 4.32zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/></svg>
                        <div class="text-left">
                            <span class="block text-[10px] uppercase tracking-wider">{{translate('Descarregar na')}}</span>
                            <span class="block font-bold text-lg leading-none">{{translate('App Store')}}</span>
                        </div>
                    </button>
                    <button class="flex items-center justify-center gap-3 bg-slate-900 dark:bg-white text-white dark:text-black py-3 px-6 rounded-xl hover:scale-105 transition-transform">
                        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none"><path d="M2.912 3.122A1.986 1.986 0 002 4.877v14.246c0 .736.402 1.385 1.011 1.73l10.27-10.27L2.912 3.122z" fill="#4285F4"/><path d="M16.91 10.584l-3.729-3.728-10.27 10.27a1.996 1.996 0 001.378.143l12.62-7.185z" fill="#34A853"/><path d="M16.91 13.416l-3.729 3.728 3.729 3.728 5.48-3.118a1.996 1.996 0 000-3.48l-5.48-3.118z" fill="#FBBC04"/><path d="M13.181 13.181l-10.27 10.27a1.996 1.996 0 001.378-.143l12.62-7.185-3.728-3.728z" fill="#EA4335"/></svg>
                        <div class="text-left">
                            <span class="block text-[10px] uppercase tracking-wider text-white dark:text-gray-600">{{translate('Disponível no')}}</span>
                            <span class="block font-bold text-lg leading-none">{{translate('Google Play')}}</span>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Imagem do Celular -->
            <div class="w-full lg:w-1/2 flex justify-center relative">
                <div class="relative w-[280px] h-[580px] bg-black rounded-[3rem] border-[8px] border-gray-800 shadow-2xl overflow-hidden transform rotate-2 hover:rotate-0 transition-transform duration-500">
                    <img src="https://images.unsplash.com/photo-1616077168712-fc6c788db4af?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover opacity-80" alt="Interface do App">
                    <!-- Detalhes do iPhone -->
                    <div class="absolute top-0 w-full h-7 flex justify-center">
                        <div class="w-32 h-6 bg-gray-800 rounded-b-2xl"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== CTA BANNER ==================== -->
    <section class="max-w-[1200px] mx-auto px-6 lg:px-12 py-16">
        <div class="w-full bg-gradient-to-br from-brandBlue to-brandGreen rounded-3xl p-10 lg:p-16 text-center shadow-2xl shadow-brandBlue/20 relative overflow-hidden">
            <!-- Padrão decorativo -->
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 24px 24px;"></div>
            
            <div class="relative z-10">
                <h2 class="text-3xl lg:text-5xl font-bold text-white mb-6">{{translate('Pronto para simplificar a sua vida?')}}</h2>
                <p class="text-white/90 text-lg mb-10 max-w-2xl mx-auto">
                    {{translate('Junte-se a milhares de angolanos que já usam o Kempaga para movimentar dinheiro sem complicações.')}}
                </p>
                <a href="{{route('agent.agent-self-registration')}}" class="bg-white text-slate-900 font-bold py-4 px-10 rounded-full hover:bg-gray-100 transition-colors text-lg shadow-lg">
                    {{translate('Criar Conta Gratuita')}}
                </a>
            </div>
        </div>
    </section>
@endsection
