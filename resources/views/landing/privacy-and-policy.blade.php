@extends('layouts.landing.app')

@section('title', translate('Política de Privacidade'))

@section('content')
    <!-- Header -->
    <div class="max-w-[1400px] mx-auto px-6 lg:px-12 py-20 relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-brandGreen/5 rounded-full blur-[120px] pointer-events-none"></div>
        
        <div class="text-center relative z-10">
            <h1 class="text-[3.5rem] lg:text-[4.5rem] font-bold mb-6 gradient-text">
                {{translate('Privacidade')}}
            </h1>
            <p class="text-slate-700 dark:text-gray-300 text-[1.2rem] max-w-3xl mx-auto font-medium">
                {!! $data['privacy_policy_section']['sub_title'] !!}
            </p>
        </div>
    </div>

    <!-- Content -->
    <section class="max-w-[1000px] mx-auto px-6 lg:px-12 py-10 pb-24">
        <div class="bg-white dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-[2.5rem] p-8 lg:p-12 shadow-xl shadow-brandBlue/5 relative">
            <div class="prose prose-lg dark:prose-invert max-w-none text-slate-800 dark:text-gray-300">
                {!! change_text_color_or_bg(Helpers::get_business_settings('privacy_policy') ?? '') !!}
            </div>
        </div>
    </section>
@endsection
