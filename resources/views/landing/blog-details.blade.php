@extends('layouts.landing.app')

@section('title', translate('Blog Details'))

@section('content')

    <div class="container">
        <div class="row">
            @if(count($articleLinks) > 0)
                <div class="col-lg-3">
                    <div class="article-menu-wrap bg-white sticky-top mt-5 pt-4 pt-lg-5">
                        <div class="article-menu-button bg-white btn-circle scroll-arrow-btn shadow d-lg-none position-relative z-999" style="--size: 36px">
                            <i class="tio-back-ui"></i>
                            <i class="tio-menu-hamburger"></i>
                        </div>
                        <div class="in-this-article bg-white">
                            <h2 class="mb-3 fs-20 ps-5 ps-lg-0">{{ translate('In this article:') }}</h2>
                            <div class="d-flex flex-column gap-2 scrollspy-blog-details-menu">
                                @foreach ($articleLinks as $link)
                                    <a href="#{{ $link['id'] }}" class="rounded">{{ $link['text'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="{{ count($articleLinks) > 0 ? 'col-lg-6' : 'col-lg-9' }}">
                <div class="mt-5 pt-5"></div>
                <div data-bs-spy="scroll" data-bs-target="#simple-list-example" data-bs-offset="0" data-bs-smooth-scroll="true" class="scrollspy-blog-details" tabindex="0">
                    <div class="d-flex flex-column gap-3 align-items-center text-center mb-5">
                        <div class="bg-primary-subtle rounded-pill fs-14 px-2">{{ $blog->blogCategory ? $blog->blogCategory->name : '' }}</div>
                        <h1 class="fs-24 mb-0">{{ $blog->title }}</h1>
                        <div class="d-flex align-items-center justify-content-center gap-3 flex-wrap">
                            @if($blog->writer)
                                <div>{{ translate('by') }} <span>{{ $blog->writer }}</span></div>
                            @endif
                            <div class="border-end h-10"></div>
                            @if($blog->click_count > 0)
                                <div>{{ $blog->click_count }} {{ translate('views') }}</div>
                            @endif

                            <div class="border-end h-10"> </div>
                            <div>
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
                    <div>
                        <img class="rounded w-100" src="{{ $blog->imageFullPath }}" alt="">
                    </div>
                    <div>
                        {!! $updatedDescription !!}
                    </div>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="position-sticky sticky-top">
                    <div class="mt-5 pt-4 pt-lg-5"></div>

                    <div class="border-bottom pb-3 mb-4 d-none d-lg-block">
                        <h5 class="text-primary mb-3 text-center">{{ translate('Share Now') }}</h5>

                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            <!-- Facebook -->
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.details', $blog->slug)) }}">
                                <img width="30" src="{{ dynamicAsset(path: 'public/assets/landing/img/media/facebook.svg') }}" alt="Facebook">
                            </a>

                            <!-- Twitter -->
                            <a target="_blank" href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(route('blog.details', $blog->slug)) }}">
                                <img width="30" src="{{ dynamicAsset(path: 'public/assets/landing/img/media/twitter.svg') }}" alt="Twitter">
                            </a>
                            <!-- LinkedIn -->
                            <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.details', $blog->slug)) }}&title={{ urlencode($blog->title) }}&summary={{ urlencode($blog->description) }}">
                                <img width="30" src="{{ dynamicAsset(path: 'public/assets/landing/img/media/linkedin.svg') }}" alt="LinkedIn">
                            </a>
                            <!-- WhatsApp -->
                            <a target="_blank" href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' ' . route('blog.details', $blog->slug)) }}">
                                <img width="30" src="{{ dynamicAsset(path: 'public/assets/landing/img/media/whatsapp.svg') }}" alt="WhatsApp">
                            </a>
                        </div>
                    </div>

                    @if($data['download_section']['status'] == 1 && $data['blog_download_app_button_status'] == 1)
                        @if(($data['download_section']['data']['play_store_link'] != "" && $data['play_store_status'])  || ($data['download_section']['data']['app_store_link'] != "" && $data['app_store_status']))
                            <div class="download-apps position-relative p-4 pb-5 z-1 rounded ov-hidden text-center" data-bg-img="{{ $data['background_image'] ? dynamicStorage(path: 'storage/app/public/business/' . $data['background_image']) : dynamicAsset(path: 'public/assets/landing/img/blog/blog-img.png') }}">
                                <img width="60" class="mb-3 mt-1" src="{{$data['icon_image'] ? dynamicStorage(path: 'storage/app/public/business/' . $data['icon_image']) : dynamicStorage(path: 'storage/app/public/business') . '/' . \App\Models\BusinessSetting::where(['key' => 'landing_page_logo'])->first()->value}}" alt="">
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
            <div class="col-12">
                <div class="social-shares position-relative z-1 py-3 mt-5">
                    <div class="bg-white mx-auto max-content px-sm-5 px-4">
                        <h5 class="mb-3 text-center">{{ translate('Share this article') }}</h5>

                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            <!-- Facebook -->
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.details', $blog->slug)) }}">
                                <img width="30" src="{{ dynamicAsset(path: 'public/assets/landing/img/media/facebook.svg') }}" alt="Facebook">
                            </a>

                            <!-- Twitter -->
                            <a target="_blank" href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(route('blog.details', $blog->slug)) }}">
                                <img width="30" src="{{ dynamicAsset(path: 'public/assets/landing/img/media/twitter.svg') }}" alt="Twitter">
                            </a>
                            <!-- LinkedIn -->
                            <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.details', $blog->slug)) }}&title={{ urlencode($blog->title) }}&summary={{ urlencode($blog->description) }}">
                                <img width="30" src="{{ dynamicAsset(path: 'public/assets/landing/img/media/linkedin.svg') }}" alt="LinkedIn">
                            </a>
                            <!-- WhatsApp -->
                            <a target="_blank" href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' ' . route('blog.details', $blog->slug)) }}">
                                <img width="30" src="{{ dynamicAsset(path: 'public/assets/landing/img/media/whatsapp.svg') }}" alt="WhatsApp">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if(count($popularBlogs) > 0)
                <div class="col-12">
                    <div class="mt-5">
                        <div class="d-flex justify-content-between gap-3 mb-4">
                            <h2 class="fs-24">{{ translate('Popular articles') }}!</h2>
                            <a href="{{ route('popular-blog') }}" class="btn btn-link">{{ translate('See More') }}
                                <i class="tio-arrow-forward"></i>
                            </a>
                        </div>

                        <div class="row g-4">
                            @foreach($popularBlogs as $popularBlog)
                                <div class="col-lg-4 col-sm-6">
                                    <div class="card border-0 shadow-custom overflow-hidden h-100">
                                        <div class="d-flex flex-column gap-2 h-100">
                                            <img width="348" class="w-100 object-fit-cover ratio-2" src="{{ $popularBlog->imageFullPath }}" alt="{{ $popularBlog->title }}">
                                            <div class="media-body card-body d-flex flex-column gap-3 justify-content-between">
                                                <a class="line-clamp clamp-2 fw-semibold fs-18 lh-sm" href="{{ route('blog.details', $popularBlog->slug) }}">{{ $popularBlog->title }}</a>
                                                <div class="d-flex gap-3">
                                                    <div class="bg-white rounded-pill fs-14 px-2 {{ $popularBlog->blogCategory ? 'border border-dark-subtle' : ''  }}">{{ $popularBlog->blogCategory ? $popularBlog->blogCategory->name : ' '  }}</div>
                                                </div>
                                                <div class="d-flex justify-content-between gap-2">
                                                    <div class="d-flex gap-1 fs-14">
                                                        @if($popularBlog->writer)
                                                            <span class="">{{ translate('by') }}</span>
                                                            <span class="line-clamp fw-medium max-w-20ch">{{ $popularBlog->writer }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="fs-14 whitespace-nowrap">
                                                        @php
                                                            $publishDate = \Carbon\Carbon::parse($popularBlog->publish_date);
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
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection

@push('script_2')
    <script>
        function shareBlog(title, description, url) {
            if (navigator.share) {
                navigator.share({
                    title: title,
                    text: description,
                    url: url
                }).catch((error) => console.error('Error sharing:', error));
            } else {
                alert('Sharing is not supported in your browser.');
            }
        }
    </script>
@endpush
