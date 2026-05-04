@extends('layouts.landing.app')

@section('title', translate('Blog & Novidades'))

@section('content')
    <!-- Header -->
    <div class="max-w-[1400px] mx-auto px-6 lg:px-12 py-20 relative overflow-hidden text-center">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-brandBlue/5 rounded-full blur-[120px] pointer-events-none"></div>
        <h1 class="text-[3.5rem] lg:text-[4.5rem] font-bold mb-6 gradient-text">
            {{translate('Blog Kempaga')}}
        </h1>
        <p class="text-slate-700 dark:text-gray-300 text-[1.2rem] max-w-2xl mx-auto font-medium mb-10">
            {!! change_text_color_or_bg($data['blog_intro_subtitle']) !!}
        </p>

        <!-- Search Bar (Mobile & Desktop) -->
        <div class="max-w-2xl mx-auto relative z-10 mb-12">
            <form action="{{ url()->current() }}" method="GET" class="relative group">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input type="search" name="search" id="search" value="{{ request('search') }}"
                       class="w-full pl-14 pr-6 py-5 bg-white dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-2xl shadow-xl focus:ring-2 focus:ring-brandBlue/50 focus:border-brandBlue outline-none transition-all text-lg"
                       placeholder="{{ translate('Pesquisar artigos...') }}">
                <div class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-brandBlue transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </form>
        </div>

        <!-- Categories Slider -->
        @if(count($categories) > 0)
            <div class="flex flex-wrap justify-center gap-3 relative z-10">
                <a class="px-6 py-2.5 rounded-full transition-all font-semibold {{ request('category') ? 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-gray-400 hover:bg-slate-200' : 'bg-brandBlue text-white shadow-lg shadow-brandBlue/20' }}"
                   href="{{ url()->current() }}{{request('search')? ('?search='. request('search')) : '' }}">
                    {{ translate('Todos') }}
                </a>
                @foreach($categories as $category)
                    <a class="px-6 py-2.5 rounded-full transition-all font-semibold {{ request('category') == $category->slug ? 'bg-brandBlue text-white shadow-lg shadow-brandBlue/20' : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-gray-400 hover:bg-slate-200' }} change-category"
                       data-id="{{ $category->id }}"
                       href="{{ url()->current() }}?category={{ $category->slug }}{{request('search')? ('&&search='. request('search')) : '' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Blog Posts Grid -->
    <section class="max-w-[1400px] mx-auto px-6 lg:px-12 py-10 pb-24">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($blogs as $key => $blog)
                <div class="group bg-white dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-[2.5rem] overflow-hidden hover:-translate-y-2 transition-all duration-300 shadow-sm hover:shadow-xl hover:shadow-brandBlue/5 flex flex-col">
                    <!-- Image -->
                    <div class="relative aspect-video overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                             src="{{ $blog->imageFullPath }}" alt="{{ $blog->title }}">
                        @if($blog->blogCategory)
                            <div class="absolute top-4 left-4">
                                <span class="bg-white/90 dark:bg-black/80 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest text-brandBlue">
                                    {{ $blog->blogCategory->name }}
                                </span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Content -->
                    <div class="p-8 flex flex-col flex-1">
                        <div class="flex items-center gap-4 text-xs font-semibold text-gray-400 mb-4 uppercase tracking-widest">
                            <span>{{ \Carbon\Carbon::parse($blog->publish_date)->format('d M, Y') }}</span>
                            @if($blog->writer)
                                <div class="w-1 h-1 rounded-full bg-gray-300"></div>
                                <span>{{ $blog->writer }}</span>
                            @endif
                        </div>
                        
                        <h3 class="text-xl lg:text-2xl font-bold mb-4 line-clamp-2 leading-tight group-hover:text-brandBlue transition-colors">
                            <a href="{{ route('blog.details', $blog->slug) }}">{{ $blog->title }}</a>
                        </h3>
                        
                        <div class="mt-auto pt-6 border-t border-gray-100 dark:border-gray-900 flex items-center justify-between">
                            <a href="{{ route('blog.details', $blog->slug) }}" class="text-brandBlue font-bold flex items-center gap-2 group/link">
                                {{ translate('Ler Mais') }}
                                <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-white dark:bg-darkCard border border-gray-200 dark:border-gray-800 rounded-[2.5rem]">
                    <div class="w-20 h-20 bg-slate-50 dark:bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                         <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">{{ translate('Ainda não temos artigos') }}</h3>
                    <p class="text-slate-500">{{ translate('Estamos preparando conteúdos incríveis para você. Volte em breve!') }}</p>
                </div>
            @endforelse
        </div>

        <div class="mt-16 flex justify-center">
            {!! $blogs->links() !!}
        </div>
    </section>

    <!-- Sidebar (Optional Recent Posts / Download Box) if needed could be added here or as a separate section -->
@endsection

@push('script_2')
    <script>
        // category click count increment
        $(document).on('click', '.change-category', function () {
            let categoryId = $(this).data('id');
            $.ajax({
                url: '/admin/blog/category/count-increment/' + categoryId,
                method: 'GET'
            });
        });

        const mySearchBar = document.getElementById('search');
        mySearchBar?.addEventListener('input', (e) => {
            if (!e.currentTarget.value)
                window.location.href = "{{ route('blog') }}";
        });
    </script>
@endpush
