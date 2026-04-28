@extends('layouts.landing.app')

@section('title', translate('Popular Blog'))

@section('content')
    <div class="overflow-hidden" data-bg-img="{{dynamicAsset(path: 'public/assets/landing/img/media/page-header-bg.png')}}">
        <div class="container">
            <div class="page-header popular-page-header text-center">
                <h2 class="text-white mb-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                    {!! change_text_color_or_bg(('##'. translate('Popular') .'##')) !!} {{ translate('Blogs') }}
                </h2>
            </div>
        </div>
    </div>

    <div class="translate-middle-y position-relative">
        <div class="mx-auto max-w-650">
            <form action="{{ url()->current() }}" method="GET">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <div class="d-flex border-primary form-control px-1" style="--bs-border-opacity: .4">
                    <input type="search" name="search" id="search" class="border-0 px-2 text-dark bg-transparent w-100" value="{{ request('search') }}" placeholder="{{ translate('Search blog') }}">
                    <button type="button" class="bg-transparent border-0"><i class="tio-search"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div class="pt-2 pb-4">
        <div class="container">
            @if(count($categories) > 0)
                <div class="col-lg-12">
                    <div class="position-sticky bg-blur p-2 sticky-top">
                        <div class="d-flex align-items-center position-relative category-tab px-5">
                            <button class="btn btn-primary btn-circle scroll-arrow-btn prev position-absolute start-0">
                                <i class="tio-chevron-left"></i>
                            </button>

                            <div class="category-filter-list d-flex text-nowrap gap-2 align-items-center overflow-x-auto scrollbar-none">
                                <a class="btn btn-outline-primary px-4 lh-1 {{ request('category') ? '' : 'active' }}"
                                   href="{{ url()->current() }}{{request('search')? ('?search='. request('search')) : '' }}">
                                    {{ translate('All') }}
                                </a>
                                @foreach($categories as $category)
                                    <a class="btn btn-outline-primary px-4 lh-1 {{ request('category') == $category->slug ? 'active' : '' }} change-category" data-id="{{ $category->id }}"
                                       href="{{ url()->current() }}?category={{ $category->slug }}{{request('search')? ('&&search='. request('search')) : '' }}">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>

                            <button class="btn btn-primary btn-circle scroll-arrow-btn next position-absolute end-0">
                                <i class="tio-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row g-4 pt-3">
                @forelse($popularBlogs as $key => $blog)
                    <div class="col-md-4">

                        <div class="card border-0 shadow-custom overflow-hidden h-100">
                            <div class="d-flex flex-column gap-2 h-100">
                                <img width="348" class="w-100 object-fit-cover ratio-2" src="{{ $blog->imageFullPath }}" alt="{{ $blog->title }}">
                                <div class="media-body card-body d-flex flex-column gap-3 justify-content-between">
                                    <a class="line-clamp clamp-2 fw-semibold fs-18 lh-sm" href="{{ route('blog.details', $blog->slug) }}">{{ $blog->title }}</a>
                                    <div class="d-flex gap-3">
                                        <div class="bg-white rounded-pill fs-14 px-2 {{ $blog->blogCategory ? 'border border-dark-subtle' : ''  }}">{{ $blog->blogCategory ? $blog->blogCategory->name : ' '  }}</div>
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
                                <h3 class="fs-22">{{ translate('Search no result found') }}</h3>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-end my-3">
                {!! $popularBlogs->links() !!}
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
                window.location.href = "{{ route('popular-blog') }}";

        })
    </script>
@endpush
