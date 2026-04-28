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
                        <h1 class="fs-24 mb-0">{{ $blog->draft_data['title'] }}</h1>
                        <div class="d-flex align-items-center justify-content-center gap-3 flex-wrap">
                            @if($blog->writer)
                                <div>{{ translate('by') }} <span>{{ $blog->writer }}</span></div>
                            @endif
                            <div class="border-end h-10"></div>
                            @if($blog->click_count > 0)
                                <div>{{ $blog->click_count }} {{ translate('views') }}</div>
                            @endif

                            <div class="border-end h-10"> </div>
                            <div>{{ \Carbon\Carbon::parse($blog->draft_data['publish_date'])->format('d M, Y') }}</div>
                        </div>
                    </div>

                    <div>
                        <img class="rounded w-100" src="{{ $blog->draftimageFullPath }}" alt="">
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

                    @if($data['blog_download_app_button_status'] == 1)
                        <div class="download-apps position-relative p-4 pb-5 z-1 rounded ov-hidden text-center" data-bg-img="{{ $data['background_image'] ? dynamicStorage(path: 'storage/app/public/business/' . $data['background_image']) : dynamicAsset(path: 'public/assets/landing/img/blog/blog-img.png') }}">
                            <img width="60" class="mb-3 mt-1" src="{{$data['icon_image'] ? dynamicStorage(path: 'storage/app/public/business/' . $data['icon_image']) : dynamicStorage(path: 'storage/app/public/business') . '/' . \App\Models\BusinessSetting::where(['key' => 'landing_page_logo'])->first()->value}}" alt="">
                            <h3 class="fs-20 mb-3">{{ $data['blog_download_app_button_title'] }}</h3>
                            <p>{{ $data['blog_download_app_button_subtitle'] }}</p>

                            <div class="d-flex gap-3 justify-content-center flex-wrap">
                                @if($data['play_store_status'])
                                    @if ($data['download_section']['status'] == 1 && $data['download_section']['data']['play_store_link'] != "")
                                        <a href="{{$data['download_section']['data']['play_store_link']}}" class="btn btn-light btn-block px-3">
                                            <img width="18" src="{{dynamicAsset(path: 'public/assets/admin/img/android.png')}}" alt="">
                                            {{ translate('Google Play') }}
                                        </a>
                                    @endif
                                @endif
                                @if($data['app_store_status'])
                                    @if ($data['download_section']['status'] == 1 && $data['download_section']['data']['app_store_link'] != "")
                                        <a href="{{$data['download_section']['data']['app_store_link']}}" class="btn btn-light btn-block px-3">
                                            <img width="18" src="{{dynamicAsset(path: 'public/assets/admin/img/apple.png')}}" alt="">
                                            {{ translate('App Store') }}
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
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
