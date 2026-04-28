@extends('layouts.landing.app')

@section('title', translate('Blog'))

@section('content')
    <div class="overflow-hidden" data-bg-img="{{dynamicAsset(path: 'public/assets/landing/img/media/page-header-bg.png')}}">
        <div class="container">
            <div class="page-header text-center">
                <h2 class="text-white mb-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                    {!! change_text_color_or_bg($data['blog_intro_title']) !!}
                </h2>
                <p class="mx-w-480 mx-auto text-white fs-18" data-aos="fade-up" data-aos-duration="1000"
                   data-aos-delay="500">
                    {!! change_text_color_or_bg($data['blog_intro_subtitle']) !!}
                </p>
            </div>
        </div>
    </div>

    <div class="py-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">

                    <div class="position-sticky bg-blur p-2 sticky-top">
                        <form action="{{ url()->current() }}" method="GET"
                              class="newsletter-form flex-grow-1 mb-3 d-lg-none">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <div class="d-flex form-control px-1">
                                <input type="search" name="search" class="border-0 px-2 text-dark bg-transparent w-100" id="mobile-search"
                                       value="{{ request('search') }}" placeholder="{{ translate('Search blog') }}">
                                <button type="button" class="bg-transparent border-0"><i class="tio-search"></i>
                                </button>
                            </div>
                        </form>
                        @if(count($categories) > 0)

                            <div class="d-flex align-items-center position-relative category-tab px-5">
                                <button
                                    class="btn btn-primary btn-circle scroll-arrow-btn prev position-absolute start-0">
                                    <i class="tio-chevron-left"></i>
                                </button>

                                <div class="category-filter-list d-flex text-nowrap gap-2 align-items-center overflow-x-auto scrollbar-none">
                                    <a class="btn btn-outline-primary px-4 lh-1 {{ request('category') ? '' : 'active' }}"
                                       href="{{ url()->current() }}{{request('search')? ('?search='. request('search')) : '' }}">
                                        {{ translate('All') }}
                                    </a>
                                    @foreach($categories as $category)
                                        <a class="btn btn-outline-primary px-4 lh-1 {{ request('category') == $category->slug ? 'active' : '' }} change-category"
                                           data-id="{{ $category->id }}"
                                           href="{{ url()->current() }}?category={{ $category->slug }}{{request('search')? ('&&search='. request('search')) : '' }}">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>

                                <button class="btn btn-primary btn-circle scroll-arrow-btn next position-absolute end-0">
                                    <i class="tio-chevron-right"></i>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="row g-4 pt-3">
                        @forelse($blogs as $key => $blog)
                            <div class="col-md-6">
                                <div class="card border-0 shadow-custom overflow-hidden h-100">
                                    <div class="d-flex flex-column gap-2 h-100">
                                        <img width="348" class="w-100 object-fit-cover ratio-2"
                                             src="{{ $blog->imageFullPath }}" alt="{{ $blog->title }}">
                                        <div
                                            class="media-body card-body d-flex flex-column gap-3 justify-content-between">
                                            <a class="line-clamp clamp-2 fw-semibold fs-18 lh-sm"
                                               href="{{ route('blog.details', $blog->slug) }}">{{ $blog->title }}</a>
                                            <div class="d-flex gap-3">
                                                <div
                                                    class="bg-white rounded-pill fs-14 px-2 {{ $blog->blogCategory ? 'border border-dark-subtle' : ''  }}">{{ $blog->blogCategory ? $blog->blogCategory->name : ' '  }}</div>
                                            </div>
                                            <div class="d-flex justify-content-between gap-2">
                                                <div class="d-flex gap-1 fs-14">
                                                    @if($blog->writer)
                                                        <span class="">{{ translate('by') }}</span>
                                                        <span class="line-clamp fw-medium max-w-20ch">{{ $blog->writer }}</span>
                                                    @endif
                                                </div>
                                                <div class="fs-14 whitespace-nowrap">
                                                    @php
                                                        $publishDate = \Carbon\Carbon::parse($blog->publish_date);
                                                    @endphp

                                                    @if ($publishDate->isToday())
                                                        {{ ('Today') }}
                                                    @elseif ($publishDate->diffInDays(now()) <= 7)
                                                        {{ $publishDate->diffForHumans() }}
                                                    @else
                                                        {{ $publishDate->format('d M, Y') }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card shadow-custom border-0 mt-4">
                                <div class="card-body py-5 my-5">
                                    <div
                                        class="d-flex flex-column gap-2 align-items-center text-center max-w-410 mx-auto">
                                        <img width="54" class="mb-3"
                                             src="{{dynamicAsset(path: 'public/assets/landing/img/media/empty-blog.png')}}" alt="">
                                        <h3 class="fs-22">{{ translate('Sorry! Our Blog is not yet available.') }}</h3>
                                        <p class="fs-18">{{ translate('We are getting ready to publish the blogs. Come back soon for updates') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="d-flex justify-content-end my-3">
                        {!! $blogs->links() !!}
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="position-sticky bg-blur p-2 sticky-top d-none d-lg-block">
                        <form action="{{ url()->current() }}" method="GET">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <div class="d-flex form-control px-1">
                                <input type="search" name="search" id="search"
                                       class="border-0 px-2 text-dark bg-transparent w-100"
                                       value="{{ request('search') }}" placeholder="{{ translate('Search blog') }}">
                                <button type="button" class="bg-transparent border-0"><i class="tio-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    @if(count($recentBlogs) > 0)
                        <div class="card border-0 shadow-custom my-3">
                            <div class="card-body">
                                <h2 class="mb-4 fs-20">{{ translate('Recent Posts') }}</h2>
                                <div class="d-flex flex-column gap-3">
                                    @foreach($recentBlogs as $recentBlog)
                                        <div class="media gap-3">
                                            <img width="80" class="rounded ratio-1 object-fit-cover"
                                                 src="{{ $recentBlog->imageFullPath }}" alt="">
                                            <div
                                                class="media-body min-h80 d-flex flex-column gap-2 justify-content-between">
                                                <a class="line-clamp clamp-2 fs-14 fw-semibold"
                                                   href="{{ route('blog.details', $recentBlog->slug) }}">
                                                    {{ $recentBlog->title }}
                                                </a>
                                                <div class="text-muted fs-14">
                                                    @php
                                                        $publishDate = \Carbon\Carbon::parse($recentBlog->publish_date);
                                                    @endphp

                                                    @if ($publishDate->isToday())
                                                        {{ ('Today') }}
                                                    @elseif ($publishDate->diffInDays(now()) <= 7)
                                                        {{ $publishDate->diffForHumans() }}
                                                    @else
                                                        {{ $publishDate->format('d M, Y') }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($data['download_section']['status'] == 1 && $data['blog_download_app_button_status'] == 1)
                        @if(($data['download_section']['data']['play_store_link'] != "" && $data['play_store_status'])  || ($data['download_section']['data']['app_store_link'] != "" && $data['app_store_status']))
                            <div class="download-apps position-relative p-3 pb-5 z-1 rounded ov-hidden text-center"
                                 data-bg-img="{{ $data['background_image'] ? dynamicStorage(path: 'storage/app/public/business/' . $data['background_image']) : dynamicAsset(path: 'public/assets/landing/img/blog/blog-img.png') }}">
                                <img width="100" class="mb-3 mt-2"
                                     src="{{$data['icon_image'] ? dynamicStorage(path: 'storage/app/public/business/' . $data['icon_image']) : dynamicStorage(path: 'storage/app/public/business') . '/' . \App\Models\BusinessSetting::where(['key' => 'landing_page_logo'])->first()->value}}"
                                     alt="">
                                <h3 class="fs-20 mb-3">{{ $data['blog_download_app_button_title'] }}</h3>
                                <p>{{ $data['blog_download_app_button_subtitle'] }}</p>

                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    @if ($data['play_store_status'] && $data['download_section']['data']['play_store_link'] != "")
                                        <a href="{{$data['download_section']['data']['play_store_link']}}"
                                           class="btn btn-light px-3">
                                            <img width="18" src="{{dynamicAsset(path: 'public/assets/admin/img/android.png')}}"
                                                 alt="">
                                            {{ translate('Google Play') }}
                                        </a>
                                    @endif
                                    @if ($data['app_store_status']  && $data['download_section']['data']['app_store_link'] != "")
                                        <a href="{{$data['download_section']['data']['app_store_link']}}"
                                           class="btn btn-light px-3">
                                            <img width="18" src="{{dynamicAsset(path: 'public/assets/admin/img/apple.png')}}" alt="">
                                            {{ translate('App Store') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script>
        // category click count increment
        $(document).on('click', '.change-category', function () {
            let categoryId = $(this).data('id');

            $.ajax({
                url: '/admin/blog/category/count-increment/' + categoryId,
                method: 'GET',
                success: function (response) {

                },
                error: function (xhr) {

                }
            });
        });

        mySearchBar = document.getElementById('search');
        mySearchBar.addEventListener('input', (e) => {
            if (!e.currentTarget.value)
                window.location.href = "{{ route('blog') }}";

        })

        mySearchBar = document.getElementById('mobile-search');
        mySearchBar.addEventListener('input', (e) => {
            if (!e.currentTarget.value)
                window.location.href = "{{ route('blog') }}";

        })
    </script>
@endpush
