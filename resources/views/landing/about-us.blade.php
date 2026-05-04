@extends('layouts.landing.app')

@section('title', translate('Sobre Nós'))

@section('content')
    <!-- Header -->
    <div class="max-w-[1400px] mx-auto px-6 lg:px-12 py-20 relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-brandBlue/5 rounded-full blur-[120px] pointer-events-none"></div>
        
        <div class="text-center relative z-10">
            <h1 class="text-[3.5rem] lg:text-[4.5rem] font-bold mb-6 gradient-text">
                {{translate('Sobre a Kempaga')}}
            </h1>
            <p class="text-slate-700 dark:text-gray-300 text-[1.2rem] max-w-3xl mx-auto font-medium">
                {!! $data['about_us_section']['sub_title'] !!}
            </p>
        </div>
    </div>

    <!-- Content Section -->
    <section class="max-w-[1400px] mx-auto px-6 lg:px-12 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="relative">
                <div class="absolute -inset-4 bg-brandBlue/10 rounded-[2.5rem] blur-2xl"></div>
                <div class="relative bg-white dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-[2.5rem] p-4 shadow-2xl">
                    <div class="rounded-[2rem] overflow-hidden">
                        <img class="w-full h-auto object-cover"
                             src="{{dynamicStorage(path: 'storage/app/public/about-us/'.$data['about_us_section']['image'])}}" 
                             alt="{{translate('Sobre Nós')}}">
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col gap-6">
                <div class="prose prose-lg dark:prose-invert max-w-none text-slate-800 dark:text-gray-300">
                    {!! change_text_color_or_bg(Helpers::get_business_settings('about_us') ?? '') !!}
                </div>
            </div>
        </div>
    </section>

    <!-- Stats / Registration from Home Style -->
    <section class="w-full bg-white dark:bg-[#050505] py-24 border-y border-gray-100 dark:border-gray-900 transition-colors">
        <div class="max-w-[1400px] mx-auto px-6 lg:px-12 text-center">
             <h2 class="text-3xl lg:text-4xl font-bold mb-12">{{translate('Nossa Presença em Números')}}</h2>
             <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                 @foreach($data['business_statistics_section']['download_data'] as $stat)
                    <div class="bg-lightBg dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-3xl p-8 hover:-translate-y-2 transition-all duration-300 shadow-sm hover:shadow-brandBlue/10 hover:shadow-xl">
                        <div class="text-4xl font-bold text-brandBlue mb-2">{{ $stat['count'] }}+</div>
                        <div class="text-textMutedLight dark:text-textMutedDark font-semibold uppercase tracking-wider text-sm">{{ $stat['title'] }}</div>
                    </div>
                 @endforeach
             </div>
        </div>
    </section>

    <!-- CTA Area -->
    <section class="max-w-[1200px] mx-auto px-6 lg:px-12 py-16">
        <div class="w-full bg-gradient-to-br from-brandBlue to-brandGreen rounded-3xl p-10 lg:p-16 text-center shadow-2xl shadow-brandBlue/20 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 24px 24px;"></div>
            <div class="relative z-10">
                <h2 class="text-3xl lg:text-5xl font-bold text-white mb-6">{{translate('Faça parte da revolução')}}</h2>
                <a href="{{route('agent.agent-self-registration')}}" class="bg-white text-slate-900 font-bold py-4 px-10 rounded-full hover:bg-gray-100 transition-colors text-lg shadow-lg">
                    {{translate('Torne-se um Agente')}}
                </a>
            </div>
        </div>
    </section>
@endsection
