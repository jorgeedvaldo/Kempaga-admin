@extends('layouts.landing.app')

@section('title', translate('FAQ'))

@section('content')
    <div class="overflow-hidden" data-bg-img="{{dynamicAsset(path: 'public/assets/landing/img/media/page-header-bg.png')}}">
        <div class="container">
            <div class="page-header text-center">
                <h2 class="text-white mb-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                    {!! change_text_color_or_bg($data['faq_intro_title']) !!}
                </h2>
                <p class="mx-w-480 mx-auto text-white fs-18" data-aos="fade-up" data-aos-duration="1000"
                   data-aos-delay="500">
                    {!! change_text_color_or_bg($data['faq_intro_subtitle']) !!}
                </p>

                <div class="mx-w-480 mx-auto" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="1000">
                    <form class="px-md-0 px-5" action="{{ url()->current() }}" method="GET">
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <div class="d-flex form-control px-1">
                            <input type="search" name="search" id="search"
                                   class="border-0 px-2 text-dark bg-transparent w-100" value="{{ request('search') }}"
                                   placeholder="{{ translate('Search question or answer') }}" autocomplete="off">
                            <button type="submit" class="bg-transparent border-0"><i class="tio-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="mt-4 mt-lg-5">
        <div class="container">
            <div class="row g-4">
                @if(count($categories) > 0 || $data['faq_download_app_button_status'] == 1)
                    <div class="col-lg-4">
                        <div class="position-sticky top-80">
                            @if(count($categories) > 0)
                                <div class="mb-lg-4">
                                    <div
                                        class="faq-tab landing-faq-tab d-flex flex-lg-column gap-3 overflow-y-auto scrollbar-thin pb-1 pb-lg-0"
                                        id="faq-tab" role="tablist" aria-orientation="vertical">
                                        <a href="{{ url()->current() }}{{request('search')? ('?search='. request('search')) : '' }}"
                                           class="nav-link {{ request('category') ? '' : 'active' }}">
                                            {{ translate('all') }}
                                        </a>
                                        @foreach($categories as $category)
                                            <a href="{{ url()->current() }}?category={{ $category->name }}{{request('search')? ('&&search='. request('search')) : '' }}"
                                               class="nav-link {{ request('category') == $category->name ? 'active' : '' }} change-category"
                                               data-id="{{ $category->id }}">
                                                {{ $category->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if($data['download_section']['status'] == 1 && $data['faq_download_app_button_status'] == 1)
                                @if(($data['download_section']['data']['play_store_link'] != "" && $data['play_store_status'])  || ($data['download_section']['data']['app_store_link'] != "" && $data['app_store_status']))
                                    <div
                                        class="download-apps position-relative p-3 pb-5 z-1 rounded ov-hidden text-center d-none d-lg-block"
                                        data-bg-img="{{ $data['background_image'] ? dynamicStorage(path: 'storage/app/public/business/' . $data['background_image']) : dynamicAsset(path: 'public/assets/landing/img/blog/blog-img.png') }}">
                                        <img width="100" class="mb-3 mt-2"
                                             src="{{$data['icon_image'] ? dynamicStorage(path: 'storage/app/public/business/' . $data['icon_image']) : dynamicStorage(path: 'storage/app/public/business') . '/' . \App\Models\BusinessSetting::where(['key' => 'landing_page_logo'])->first()->value}}"
                                             alt="">
                                        <h3 class="fs-20 mb-3">{{ $data['faq_download_app_button_title'] }}</h3>
                                        <p>{{ $data['faq_download_app_button_subtitle'] }}</p>

                                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                                            @if ($data['play_store_status'] && $data['download_section']['data']['play_store_link'] != "")
                                                <a href="{{$data['download_section']['data']['play_store_link']}}"
                                                   class="btn btn-light px-3">
                                                    <img width="18"
                                                         src="{{dynamicAsset(path: 'public/assets/admin/img/android.png')}}" alt="">
                                                    {{ translate('Google Play') }}
                                                </a>
                                            @endif

                                            @if ($data['app_store_status'] && $data['download_section']['data']['app_store_link'] != "")
                                                <a href="{{$data['download_section']['data']['app_store_link']}}"
                                                   class="btn btn-light px-3">
                                                    <img width="18" src="{{dynamicAsset(path: 'public/assets/admin/img/apple.png')}}"
                                                         alt="">
                                                    {{ translate('App Store') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif

                        </div>
                    </div>
                @endif

                <div
                    class="{{ count($categories) > 0 || $data['faq_download_app_button_status'] == 1 ? 'col-lg-8' : 'col-lg-12' }}">
                    <div class="tab-content" id="faq-tabContent">
                        <div class="tab-pane fade show active" id="all-faq" role="tabpanel"
                             aria-labelledby="all-faq-tab">
                            <div class="faq-accordion accordion accordion-flush d-flex flex-column gap-3"
                                 id="accordionFlushExample">
                                @forelse($faqs as $key => $faq)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading-{{$faq->id}}">
                                            <button class="accordion-button h3 collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#flush-collapse-{{$faq->id}}" aria-expanded="false"
                                                    aria-controls="flush-collapse-{{$faq->id}}">
                                                {{ $faqs->firstitem()+$key }}. {{ $faq->question }}
                                            </button>
                                        </h2>
                                        <div id="flush-collapse-{{$faq->id}}" class="accordion-collapse collapse"
                                             aria-labelledby="flush-heading-{{$faq->id}}"
                                             data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                {{ $faq->answer }}
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    @if(request('search'))
                                        <div class="card shadow-custom border-0 mt-4">
                                            <div class="card-body py-5">
                                                <div
                                                    class="d-flex flex-column gap-2 align-items-center text-center max-w-410 mx-auto">
                                                    <img width="60" class="mb-3"
                                                         src="{{dynamicAsset(path: 'public/assets/landing/img/media/no-result.png')}}"
                                                         alt="">
                                                    <h3 class="fs-22">{{ translate('No Result Found') }}.</h3>
                                                    <p class="fs-18">{{ translate('We couldn’t find what you’re looking for. Try a different approach or keyword.') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="card shadow-custom border-0">
                                            <div class="card-body py-5 my-5">
                                                <div
                                                    class="d-flex flex-column gap-2 align-items-center text-center max-w-410 mx-auto">
                                                    <img width="60" class="mb-3"
                                                         src="{{dynamicAsset(path: 'public/assets/landing/img/media/faq.png')}}"
                                                         alt="">
                                                    <h3 class="fs-22">{{ translate('Sorry! Our FAQ is not yet available') }}
                                                        .</h3>
                                                    <p class="fs-18">{{ translate('We are getting ready to answer all your questions. Come back soon for updates') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforelse
                            </div>
                            <div class="d-flex justify-content-end my-3">
                                {!! $faqs->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
                @if($data['download_section']['status'] == 1 && $data['faq_download_app_button_status'] == 1)
                    @if(($data['download_section']['data']['play_store_link'] != "" && $data['play_store_status'])  || ($data['download_section']['data']['app_store_link'] != "" && $data['app_store_status']))
                        <div class="col-12 d-lg-none">
                            <div class="download-apps position-relative p-3 pb-5 z-1 rounded ov-hidden text-center"
                                 data-bg-img="{{ $data['background_image'] ? dynamicStorage(path: 'storage/app/public/business/' . $data['background_image']) : dynamicAsset(path: 'public/assets/landing/img/blog/blog-img.png') }}">
                                <img width="100" class="mb-3 mt-2"
                                     src="{{$data['icon_image'] ? dynamicStorage(path: 'storage/app/public/business/' . $data['icon_image']) : dynamicStorage(path: 'storage/app/public/business') . '/' . \App\Models\BusinessSetting::where(['key' => 'landing_page_logo'])->first()->value}}"
                                     alt="">
                                <h3 class="fs-20 mb-3">{{ $data['faq_download_app_button_title'] }}</h3>
                                <p>{{ $data['faq_download_app_button_subtitle'] }}</p>

                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    @if ($data['play_store_status'] && $data['download_section']['data']['play_store_link'] != "")
                                        <a href="{{$data['download_section']['data']['play_store_link']}}"
                                           class="btn btn-light px-3">
                                            <img width="18" src="{{dynamicAsset(path: 'public/assets/admin/img/android.png')}}"
                                                 alt="">{{ translate('Google Play') }}
                                        </a>
                                    @endif

                                    @if ($data['app_store_status'] && $data['download_section']['data']['app_store_link'] != "")
                                        <a href="{{$data['download_section']['data']['app_store_link']}}"
                                           class="btn btn-light px-3">
                                            <img width="18" src="{{dynamicAsset(path: 'public/assets/admin/img/apple.png')}}"
                                                 alt="">{{ translate('App Store') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
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
                window.location.href = "{{ route('faq') }}";

        })
    </script>
@endpush
