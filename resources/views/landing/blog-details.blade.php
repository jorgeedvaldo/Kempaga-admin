@extends('layouts.landing.app')

@section('title', $blog->title)

@section('content')
    <!-- Article Header -->
    <div class="max-w-[1400px] mx-auto px-6 lg:px-12 py-20 relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-brandBlue/5 rounded-full blur-[120px] pointer-events-none"></div>
        
        <div class="max-w-4xl mx-auto text-center relative z-10">
            @if($blog->blogCategory)
                <span class="inline-block bg-brandBlue/10 text-brandBlue px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-6">
                    {{ $blog->blogCategory->name }}
                </span>
            @endif
            
            <h1 class="text-[2.5rem] lg:text-[4rem] font-bold mb-8 leading-[1.1] tracking-tight">
                {{ $blog->title }}
            </h1>

            <div class="flex flex-wrap items-center justify-center gap-6 text-sm font-semibold text-gray-500 uppercase tracking-wider">
                @if($blog->writer)
                    <div class="flex items-center gap-2">
                        <span class="opacity-60">{{ translate('Escrito por') }}</span>
                        <span class="text-slate-900 dark:text-white">{{ $blog->writer }}</span>
                    </div>
                @endif
                <div class="w-1.5 h-1.5 rounded-full bg-gray-300"></div>
                <div>
                    {{ \Carbon\Carbon::parse($blog->publish_date)->format('d M, Y') }}
                </div>
                @if($blog->click_count > 0)
                    <div class="w-1.5 h-1.5 rounded-full bg-gray-300"></div>
                    <div>{{ $blog->click_count }} {{ translate('visualizações') }}</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="max-w-[1400px] mx-auto px-6 lg:px-12 pb-24">
        <div class="flex flex-col lg:flex-row gap-16">
            
            <!-- Sidebar: Article Navigation -->
            @if(count($articleLinks) > 0)
                <aside class="hidden lg:block w-1/4">
                    <div class="sticky top-24">
                        <h4 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-6">{{ translate('Neste artigo') }}</h4>
                        <nav class="flex flex-col gap-3">
                            @foreach ($articleLinks as $link)
                                <a href="#{{ $link['id'] }}" class="text-slate-600 dark:text-gray-400 hover:text-brandBlue font-medium transition-colors py-1">
                                    {{ $link['text'] }}
                                </a>
                            @endforeach
                        </nav>
                        
                        <!-- Share Box -->
                        <div class="mt-12 pt-12 border-t border-gray-100 dark:border-gray-900">
                             <h4 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-6">{{ translate('Partilhar') }}</h4>
                             <div class="flex gap-4">
                                 <!-- Facebook -->
                                 <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.details', $blog->slug)) }}" class="w-10 h-10 rounded-full bg-slate-50 dark:bg-white/5 flex items-center justify-center hover:bg-brandBlue hover:text-white transition-all text-slate-400">
                                     <i class="bi bi-facebook"></i>
                                 </a>
                                 <!-- Twitter -->
                                 <a target="_blank" href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(route('blog.details', $blog->slug)) }}" class="w-10 h-10 rounded-full bg-slate-50 dark:bg-white/5 flex items-center justify-center hover:bg-brandBlue hover:text-white transition-all text-slate-400">
                                     <i class="bi bi-twitter-x"></i>
                                 </a>
                                 <!-- LinkedIn -->
                                 <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.details', $blog->slug)) }}" class="w-10 h-10 rounded-full bg-slate-50 dark:bg-white/5 flex items-center justify-center hover:bg-brandBlue hover:text-white transition-all text-slate-400">
                                     <i class="bi bi-linkedin"></i>
                                 </a>
                             </div>
                        </div>
                    </div>
                </aside>
            @endif

            <!-- Article Body -->
            <div class="flex-1 max-w-3xl mx-auto lg:mx-0">
                <div class="mb-12 rounded-[2.5rem] overflow-hidden shadow-2xl">
                    <img class="w-full h-auto" src="{{ $blog->imageFullPath }}" alt="{{ $blog->title }}">
                </div>
                
                <div class="prose prose-lg lg:prose-xl dark:prose-invert max-w-none text-slate-800 dark:text-gray-300 leading-relaxed article-content">
                    {!! $updatedDescription !!}
                </div>
                
                <!-- Mobile Share -->
                <div class="lg:hidden mt-16 pt-8 border-t border-gray-100 dark:border-gray-900">
                    <h4 class="text-center font-bold mb-6">{{ translate('Partilhar este artigo') }}</h4>
                    <div class="flex justify-center gap-6">
                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.details', $blog->slug)) }}" class="text-2xl text-slate-400 hover:text-brandBlue"><i class="bi bi-facebook"></i></a>
                        <a target="_blank" href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.details', $blog->slug)) }}" class="text-2xl text-slate-400 hover:text-brandBlue"><i class="bi bi-twitter-x"></i></a>
                        <a target="_blank" href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' ' . route('blog.details', $blog->slug)) }}" class="text-2xl text-slate-400 hover:text-brandBlue"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Articles -->
    @if(count($popularBlogs) > 0)
        <section class="bg-slate-50 dark:bg-white/5 py-24">
            <div class="max-w-[1400px] mx-auto px-6 lg:px-12">
                <div class="flex items-center justify-between mb-12">
                    <h2 class="text-3xl font-bold">{{ translate('Artigos Populares') }}</h2>
                    <a href="{{ route('blog') }}" class="text-brandBlue font-bold flex items-center gap-2 group">
                        {{ translate('Ver Todos') }}
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($popularBlogs as $popularBlog)
                        <div class="bg-white dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-3xl overflow-hidden hover:-translate-y-2 transition-all duration-300 shadow-sm flex flex-col">
                            <div class="aspect-video overflow-hidden">
                                <img class="w-full h-full object-cover" src="{{ $popularBlog->imageFullPath }}" alt="{{ $popularBlog->title }}">
                            </div>
                            <div class="p-6 flex flex-col flex-1">
                                <h3 class="font-bold mb-4 line-clamp-2 leading-tight">
                                    <a href="{{ route('blog.details', $popularBlog->slug) }}" class="hover:text-brandBlue transition-colors">{{ $popularBlog->title }}</a>
                                </h3>
                                <div class="mt-auto text-xs font-semibold text-gray-400 uppercase tracking-widest">
                                    {{ \Carbon\Carbon::parse($popularBlog->publish_date)->format('d M, Y') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
