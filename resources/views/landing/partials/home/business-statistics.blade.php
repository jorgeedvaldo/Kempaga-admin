@if ($data['business_statistics_section']['status'] == '1')
    <section class="mt-3 overflow-hidden position-relative">
        <div class="container">
            <div class="row align-items-center gy-5 gx-5 pb-150">
                <div class="col-lg-6">
                    <h2 class="mb-2 mb-sm-4">{!! change_text_color_or_bg($data['business_statistics_section']['download_data']['title']) !!}</h2>
                    <p>{!! $data['business_statistics_section']['download_data']['sub_title'] !!}</p>
                    <div class="d-flex gap-3 gap-xl-4 mt-4">
                        <div class="d-flex flex-column gap-3">
                            <img width="65"
                                 src="{{dynamicStorage(path: 'storage/app/public/landing-page/business-statistics/'.$data['business_statistics_section']['download_data']['download_icon'])}}"
                                 alt="">
                            <h2 id="download-count" class="text-primary">{{ format_number((int)$data['business_statistics_section']['download_data']['download_count']) }}</h2>
                            <p>{!! $data['business_statistics_section']['download_data']['download_sort_description'] !!}</p>
                        </div>
                        <div class="border-start d-none d-sm-block"></div>
                        <div class="d-flex flex-column gap-3">
                            <img width="65"
                                 src="{{dynamicStorage(path: 'storage/app/public/landing-page/business-statistics/'.$data['business_statistics_section']['download_data']['review_icon'])}}"
                                 alt="">
                            <h2 id="review-count" class="text-primary">{{ $data['business_statistics_section']['download_data']['review_count'] }}/5</h2>
                            <p>{!! $data['business_statistics_section']['download_data']['review_sort_description'] !!}</p>
                        </div>
                        <div class="border-start d-none d-sm-block"></div>
                        <div class="d-flex flex-column gap-3">
                            <img width="65"
                                 src="{{dynamicStorage(path: 'storage/app/public/landing-page/business-statistics/'.$data['business_statistics_section']['download_data']['country_icon'])}}"
                                 alt="">
                            <h2 id="country-count" class="text-primary">{{ format_number((int)$data['business_statistics_section']['download_data']['country_count']) }}</h2>
                            <p>{!! $data['business_statistics_section']['download_data']['country_sort_description'] !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="d-none d-lg-flex gap-3 flex-column position-relative testimonial-card_wrapper" data-aos="fade-left"
                         data-aos-duration="1000" data-aos-delay="300">
                        @foreach ($data['business_statistics_section']['testimonial_data'] ?? [] as $review)
                            <div class="testimonial-card bg-white rounded-10 testimonial-content">
                                <div class="p-4">
                                    <div class="media gap-3">
                                        <img width="90"
                                             src="{{dynamicStorage(path: 'storage/app/public/landing-page/testimonial')}}/{{$review['image']}}"
                                             class="rounded-circle" alt="">
                                        <div class="media-body">
                                            <div class="star-rating text-warning fs-12 mb-3">
                                                @php
                                                    $rating = $review['rating'];
                                                    $fullStars = floor($rating);
                                                    $halfStar = $rating - $fullStars;
                                                @endphp

                                                @for ($i = 0; $i < $fullStars; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor

                                                @if ($halfStar > 0)
                                                    <i class="bi bi-star-half"></i>
                                                @endif

                                                @for ($i = 0; $i < (5 - ceil($rating)); $i++)
                                                    <i class="bi bi-star"></i>
                                                @endfor
                                            </div>

                                            <h6 class="mb-2">{!! $review['opinion'] !!}</h6>
                                            <p class="fs-12"><span class="text-uppercase">{{ $review['name'] }}</span>
                                                <span class="text-muted">/ {{$review['user_type']}}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-lg-none" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="300">
                        <!-- Swiper -->
                        <div class="swiper" data-swiper-loop="true" data-swiper-margin="16">
                            <div class="swiper-wrapper">
                                @foreach ($data['business_statistics_section']['testimonial_data'] ?? [] as $review)
                                    <div class="swiper-slide">
                                        <div class="bg-white shadow-sm rounded-10 me-sm-5">
                                            <div class="p-4">
                                                <div class="media gap-3">
                                                    <img width="90"
                                                         src="{{dynamicStorage(path: 'storage/app/public/landing-page/testimonial')}}/{{$review['image']}}"
                                                         class="rounded-circle" alt="">
                                                    <div class="media-body">
                                                        <div class="star-rating text-warning fs-12 mb-3">
                                                            @php
                                                                $rating = $review['rating']; // Assuming you have a 'rating' column in your database.
                                                                $fullStars = floor($rating);
                                                                $halfStar = $rating - $fullStars;
                                                            @endphp

                                                            @for ($i = 0; $i < $fullStars; $i++)
                                                                <i class="bi bi-star-fill"></i>
                                                            @endfor

                                                            @if ($halfStar > 0)
                                                                <i class="bi bi-star-half"></i>
                                                            @endif

                                                            @for ($i = 0; $i < (5 - ceil($rating)); $i++)
                                                                <i class="bi bi-star"></i>
                                                            @endfor
                                                        </div>

                                                        <h6 class="mb-2">{!! $review['opinion'] !!}</h6>
                                                        <p class="fs-12"><span
                                                                class="text-uppercase">{{ $review['name'] }}</span>
                                                            <span class="text-muted">/ {{translate('Agents')}}</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination position-relative mt-3"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{-- <img src="{{dynamicAsset(path: 'public/assets/landing/img/media/testimonial-bottom.svg')}}" class="svg testimonial-bottom-svg w-100" alt="{{translate('image')}}"> --}}
        <div class="ocean">
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
        </div>
    </section>
@endif


@push('script_2')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        function formatNumber(value) {
            if (value >= 1000000) {
                return (value / 1000000).toFixed(1) + ' M';
            } else if (value >= 10000) {
                return (value / 100000).toFixed(1) + ' L';
            } else if (value >= 1000) {
                return (value / 1000).toFixed(1) + ' K';
            } else {
                return value.toLocaleString();
            }
        }

        function animateCounter(element, targetValue, duration, isReview = false) {
            let startValue = 0;
            const increment = Math.ceil(targetValue / (duration / 50));
            const interval = setInterval(() => {
                startValue += increment;
                if (startValue >= targetValue) {
                    startValue = targetValue;
                    clearInterval(interval);
                }
                if (isReview) {
                    element.textContent = `${startValue} / 5`;
                } else {
                    element.textContent = formatNumber(startValue);
                }
            }, 50);
        }

        const downloadCount = parseInt("{{ $data['business_statistics_section']['download_data']['download_count'] }}");
        const reviewCount = parseInt("{{ $data['business_statistics_section']['download_data']['review_count'] }}");
        const countryCount = parseInt("{{ $data['business_statistics_section']['download_data']['country_count'] }}");

        animateCounter(document.getElementById('download-count'), downloadCount, 1000);
        animateCounter(document.getElementById('review-count'), reviewCount, 1000, true);
        animateCounter(document.getElementById('country-count'), countryCount, 1000);
    });
</script>
@endpush
