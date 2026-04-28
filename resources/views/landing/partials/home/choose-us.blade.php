@if ($data['why_choose_us_section']['status'] == '1')
    <section class="mt-4 pt-lg-3">
        <div class="container">
            <div class="section-title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                <h2 class="text-center">{!! change_text_color_or_bg($data['why_choose_us_section']['header_title']['value']) !!}</h2>
            </div>

            <div class="row g-3 g-lg-0 secure-payment-cards">
                @foreach ($data['why_choose_us_section']['data'] ?? [] as $key => $item)
                    <div class="col-lg-4 col-6">
                        <div class="secure-payment-card active py-2 rounded h-100" data-aos="zoom-in" data-aos-duration="1000"
                             data-aos-delay="300">
                            <div class="p-2 px-sm-4 py-sm-5 mb-3 text-center">
                                <img width="84" class="mb-4"
                                     src="{{dynamicStorage(path: 'storage/app/public/landing-page/why-choose-us/'. $item['image'])}}"
                                     alt="">
                                <h3 class="mb-3">{!! $item['title'] !!}</h3>
                                <p class="__sub-title" data-bs-toggle="tooltip"
                                   title="{!! $item['sub_title'] !!}">{!! $item['sub_title'] !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
