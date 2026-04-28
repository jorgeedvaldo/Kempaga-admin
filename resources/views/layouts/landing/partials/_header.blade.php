<header class="header fixed-top love-sticky {{ request()->routeIs('blog.details') || request()->routeIs('admin.blog.preview') ? 'blog-details' : '' }}">
    <div class="container position-relative">
        <div
            class="sticky-bg-area d-flex justify-content-between gap-3 align-items-center"
        >
            <div class="logo">
                <a href="{{route('landing-page-home')}}">
                    <img width="120"
                         src="{{dynamicStorage(path: 'storage/app/public/business') . '/' . \App\Models\BusinessSetting::where(['key' => 'landing_page_logo'])->first()->value}}"
                         alt="">
                </a>
            </div>

            <div class="menu-btn text-white d-lg-none">
                <i class="bi bi-list fs-4"></i>
            </div>

            <div class="nav-wrapper d-none d-lg-block">
                <ul class="nav main-menu align-items-center">
                    <li><a class="{{Request::is('/') ? 'active' : ''}}" href="{{route('landing-page-home')}}">{{translate('Home')}}</a></li>
                    <li><a class="{{Request::is('pages/about-us') ? 'active' : ''}}" href="{{route('pages.about-us')}}">{{translate('About Us')}}</a></li>
                    <li><a class="{{Request::is('pages/terms-conditions') ? 'active' : ''}}" href="{{route('pages.terms-conditions')}}">{{translate('Terms & Condition')}}</a></li>
                    <li><a class="{{Request::is('pages/privacy-policy') ? 'active' : ''}}" href="{{route('pages.privacy-policy')}}">{{translate('Privacy Policy')}}</a></li>
                    @if(\App\CentralLogics\helpers::get_business_settings('blog_section_status'))
                        <li><a class="{{Request::is('blog*') || Request::is('popular-blog*') ? 'active' : ''}}" href="{{ route('blog') }}">{{translate('blog')}}</a></li>
                    @endif
                    @if(\App\CentralLogics\helpers::get_business_settings('faq_section_status'))
                        <li><a class="{{Request::is('faq') ? 'active' : ''}}" href="{{ route('faq') }}">{{translate('FAQ')}}</a></li>
                    @endif
                    <li><a href="{{route('contact-us')}}" class="btn btn-outline-light {{Request::is('contact-us') ? 'active' : ''}}">{{translate('Contact Us')}}</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
