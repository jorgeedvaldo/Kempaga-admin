@extends('layouts.landing.app')

@section('title', translate('Perguntas Frequentes (FAQ)'))

@section('content')
    <!-- Header -->
    <div class="max-w-[1400px] mx-auto px-6 lg:px-12 py-20 relative overflow-hidden text-center">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-brandGreen/5 rounded-full blur-[120px] pointer-events-none"></div>
        <h1 class="text-[3.5rem] lg:text-[4.5rem] font-bold mb-6 gradient-text">
            {{translate('Como podemos ajudar?')}}
        </h1>
        <p class="text-slate-700 dark:text-gray-300 text-[1.2rem] max-w-2xl mx-auto font-medium mb-10">
            {!! change_text_color_or_bg($data['faq_intro_subtitle']) !!}
        </p>

        <!-- Search Bar -->
        <div class="max-w-2xl mx-auto relative z-10">
            <form action="{{ url()->current() }}" method="GET" class="relative group">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input type="search" name="search" id="search" value="{{ request('search') }}"
                       class="w-full pl-14 pr-6 py-5 bg-white dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-2xl shadow-xl focus:ring-2 focus:ring-brandBlue/50 focus:border-brandBlue outline-none transition-all text-lg"
                       placeholder="{{ translate('Pesquise por uma dúvida ou palavra-chave...') }}">
                <div class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-brandBlue transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </form>
        </div>
    </div>

    <!-- Main FAQ Content -->
    <section class="max-w-[1400px] mx-auto px-6 lg:px-12 py-10 pb-24 flex flex-col lg:flex-row gap-12">
        
        <!-- Sidebar: Categories -->
        <aside class="w-full lg:w-1/3">
            <div class="sticky top-24 space-y-8">
                @if(count($categories) > 0)
                    <div class="bg-white dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-3xl p-6 shadow-sm">
                        <h3 class="text-xl font-bold mb-6 px-2">{{translate('Categorias')}}</h3>
                        <div class="flex flex-col gap-2">
                            <a href="{{ url()->current() }}{{request('search')? ('?search='. request('search')) : '' }}"
                               class="px-4 py-3 rounded-xl transition-all font-medium {{ request('category') ? 'text-slate-600 dark:text-gray-400 hover:bg-slate-50 dark:hover:bg-white/5' : 'bg-brandBlue text-white shadow-lg shadow-brandBlue/20' }}">
                                {{ translate('Todas as Dúvidas') }}
                            </a>
                            @foreach($categories as $category)
                                <a href="{{ url()->current() }}?category={{ $category->name }}{{request('search')? ('&&search='. request('search')) : '' }}"
                                   class="px-4 py-3 rounded-xl transition-all font-medium {{ request('category') == $category->name ? 'bg-brandBlue text-white shadow-lg shadow-brandBlue/20' : 'text-slate-600 dark:text-gray-400 hover:bg-slate-50 dark:hover:bg-white/5' }} change-category"
                                   data-id="{{ $category->id }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Download App Box -->
                @if($data['download_section']['status'] == 1 && $data['faq_download_app_button_status'] == 1)
                    <div class="bg-gradient-to-br from-brandBlue to-brandBlueHover rounded-3xl p-8 text-white shadow-xl relative overflow-hidden group">
                        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 16px 16px;"></div>
                        <div class="relative z-10 text-center">
                            <h4 class="text-xl font-bold mb-3">{{ $data['faq_download_app_button_title'] }}</h4>
                            <p class="text-white/80 text-sm mb-6">{{ $data['faq_download_app_button_subtitle'] }}</p>
                            <div class="flex flex-col gap-3">
                                @if ($data['play_store_status'] && $data['download_section']['data']['play_store_link'] != "")
                                    <a href="{{$data['download_section']['data']['play_store_link']}}" class="bg-white text-slate-900 py-3 rounded-xl font-bold text-sm hover:scale-105 transition-transform flex items-center justify-center gap-2">
                                        {{ translate('Google Play') }}
                                    </a>
                                @endif
                                @if ($data['app_store_status'] && $data['download_section']['data']['app_store_link'] != "")
                                    <a href="{{$data['download_section']['data']['app_store_link']}}" class="bg-white text-slate-900 py-3 rounded-xl font-bold text-sm hover:scale-105 transition-transform flex items-center justify-center gap-2">
                                        {{ translate('App Store') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </aside>

        <!-- FAQ Accordion -->
        <div class="flex-1">
            <div class="space-y-4">
                @forelse($faqs as $key => $faq)
                    <div class="faq-item group">
                        <button class="faq-trigger w-full flex items-center justify-between p-6 bg-white dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-2xl transition-all hover:border-brandBlue/50 text-left">
                            <span class="text-lg font-bold pr-4">{{ $faq->question }}</span>
                            <div class="w-8 h-8 rounded-full bg-slate-50 dark:bg-white/5 flex items-center justify-center shrink-0 group-hover:bg-brandBlue/10 transition-colors">
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-brandBlue transition-all icon-plus" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                        </button>
                        <div class="faq-content overflow-hidden max-h-0 transition-all duration-300">
                            <div class="p-8 text-slate-600 dark:text-gray-400 leading-relaxed border-x border-b border-gray-100 dark:border-gray-900 rounded-b-2xl -mt-2 bg-white dark:bg-darkCard/50">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-white dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-[2.5rem]">
                        <div class="w-20 h-20 bg-slate-50 dark:bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                             <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">{{ translate('Nenhum resultado encontrado') }}</h3>
                        <p class="text-slate-500">{{ translate('Tente pesquisar por outros termos ou explore as categorias.') }}</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12 flex justify-center">
                {!! $faqs->links() !!}
            </div>
        </div>
    </section>
@endsection

@push('script_2')
    <script>
        // Simple Accordion Logic
        document.querySelectorAll('.faq-trigger').forEach(trigger => {
            trigger.addEventListener('click', () => {
                const item = trigger.closest('.faq-item');
                const content = item.querySelector('.faq-content');
                const icon = item.querySelector('.icon-plus');
                
                // Toggle current
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                    icon.style.transform = 'rotate(0deg)';
                } else {
                    // Close others
                    document.querySelectorAll('.faq-content').forEach(c => c.style.maxHeight = null);
                    document.querySelectorAll('.icon-plus').forEach(i => i.style.transform = 'rotate(0deg)');
                    
                    content.style.maxHeight = content.scrollHeight + "px";
                    icon.style.transform = 'rotate(45deg)';
                }
            });
        });

        // Search logic
        const mySearchBar = document.getElementById('search');
        mySearchBar?.addEventListener('input', (e) => {
            if (!e.currentTarget.value)
                window.location.href = "{{ route('faq') }}";
        });
    </script>
@endpush
