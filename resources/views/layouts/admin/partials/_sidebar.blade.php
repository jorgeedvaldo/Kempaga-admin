
<div id="sidebarMain" class="d-none">
    <aside
        class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container">
            <div class="navbar-brand-wrapper justify-content-between">
                @php($restaurantLogo=\App\CentralLogics\helpers::get_business_settings('logo'))
                <a class="navbar-brand" href="{{route('admin.dashboard')}}" aria-label="Front">
                    <img class="w-100 side-logo"
                         src="{{Helpers::onErrorImage($restaurantLogo, dynamicStorage(path: 'storage/app/public/business') . '/' . $restaurantLogo, dynamicAsset(path: 'public/assets/admin/img/1920x400/img2.jpg'), 'business/')}}"
                         alt="{{ translate('Logo') }}">
                </a>
                <div class="navbar-nav-wrap-content-left">
                    <button type="button" class="js-navbar-vertical-aside-toggle-invoker close mr-">
                        <i class="tio-first-page navbar-vertical-aside-toggle-short-align"></i>
                        <i class="tio-last-page navbar-vertical-aside-toggle-full-align"></i>
                    </button>
                </div>
            </div>

            <div class="navbar-vertical-content">
                <form class="sidebar--search-form">
                    <div class="search--form-group">
                        <button type="button" class="btn"><i class="tio-search"></i></button>
                        <input type="text" class="form-control form--control" placeholder="Search Menu..." id="search-sidebar-menu">
                    </div>
                </form>

                <ul class="navbar-nav navbar-nav-lg nav-tabs">
                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link"
                           href="{{route('admin.dashboard')}}" title="{{translate('dashboard')}}">
                            <i class="tio-home-vs-1-outlined nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('dashboard')}}
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <small class="nav-subtitle"
                               title="{{translate('account')}} {{translate('section')}}">{{translate('account')}} {{translate('management')}}</small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>
                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/emoney*')?'active':''}}">
                        <a class="nav-link " href="{{route('admin.emoney.index')}}"
                           title="{{translate('EMoney')}}">
                            <i class="tio-money nav-icon"></i>
                            <span class="text-truncate">{{translate('E-Money')}}</span>
                        </a>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/transfer*')?'active':''}}">
                        <a class="nav-link " href="{{route('admin.transfer.index')}}"
                           title="{{translate('transfer')}}">
                            <i class="tio-users-switch nav-icon"></i>
                            <span class="text-truncate">{{translate('Transfer')}}</span>
                        </a>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/transaction/index')?'active':''}}">
                        <a class="nav-link " href="{{route('admin.transaction.index', ['trx_type'=>'all'])}}"
                           title="{{translate('transaction')}}">
                            <i class="tio-money-vs nav-icon"></i>
                            <span class="text-truncate">{{translate('Transactions')}}</span>
                        </a>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/expense/index')?'active':''}}">
                        <a class="nav-link " href="{{route('admin.expense.index')}}"
                           title="{{translate('Expense Transactions')}}">
                            <i class="tio-receipt-outlined nav-icon"></i>
                            <span class="text-truncate">{{translate('Expense Transactions')}}</span>
                        </a>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/transaction/request-money')?'active':''}}">
                        <a class="nav-link " href="{{route('admin.transaction.request_money')}}"
                           title="{{translate('Agent Request Money')}}">
                            <i class="tio-pound nav-icon"></i>
                            <span class="text-truncate">{{translate('Agent Request Money')}}</span>
                        </a>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/withdraw/requests')?'active':''}}">
                        <a class="nav-link " href="{{route('admin.withdraw.requests', ['request_status'=>'all'])}}"
                           title="{{translate('Agent Request Money')}}">
                            <i class="tio-pound-outlined nav-icon"></i>
                            <span class="text-truncate">{{translate('Withdraw_Requests')}}</span>
                        </a>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/withdrawal-methods*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link"
                           href="{{route('admin.withdrawal_methods.add')}}">
                            <i class="tio-sim-card nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('Add Withdrawal Methods')}}
                            </span>
                        </a>
                    </li>
                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/disputes*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link"
                           href="{{route('admin.disputes.index', ['trx_type'=>'pending'])}}">
                            <i class="tio-report nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{translate('Report Disputes')}}
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <small class="nav-subtitle"
                               title="{{translate('user')}} {{translate('section')}}">{{translate('user')}} {{translate('management')}}</small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/agent*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                        >
                            <i class="tio-user-big-outlined nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{translate('agent')}}</span>
                        </a>
                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{Request::is('admin/agent*')?'block':'none'}}">
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/agent/add')?'active':''}}">
                                <a class="nav-link " href="{{route('admin.agent.add')}}"
                                   title="{{translate('add')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">{{translate('register')}}</span>
                                </a>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/agent/list')?'active':''}}">
                                <a class="nav-link " href="{{route('admin.agent.list')}}"
                                   title="{{translate('list')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">{{translate('list')}}</span>
                                </a>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/agent/kyc-requests')?'active':''}}">
                                <a class="nav-link " href="{{route('admin.agent.kyc_requests')}}"
                                   title="{{translate('Verification Requests')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">{{translate('Verification Requests')}}</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/merchant/add') || Request::is('admin/merchant/list') || Request::is('admin/merchant/view*') || Request::is('admin/merchant/edit*') || Request::is('admin/merchant/transaction*')  ?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                        >
                            <i class="tio-user-big nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{translate('merchant')}}</span>
                        </a>
                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{Request::is('admin/merchant/add') || Request::is('admin/merchant/list') || Request::is('admin/merchant/view*') || Request::is('admin/merchant/edit*') || Request::is('admin/merchant/transaction*') ?'block':'none'}}">
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/merchant/add')?'active':''}}">
                                <a class="nav-link " href="{{route('admin.merchant.add')}}"
                                   title="{{translate('add')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">{{translate('register')}}</span>
                                </a>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/merchant/list')?'active':''}}">
                                <a class="nav-link " href="{{route('admin.merchant.list')}}"
                                   title="{{translate('list')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">{{translate('list')}}</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/customer*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                        >
                            <i class="tio-group-senior nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{translate('customer')}}</span>
                        </a>
                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{Request::is('admin/customer*')?'block':'none'}}">
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/customer/add')?'active':''}}">
                                <a class="nav-link " href="{{route('admin.customer.add')}}"
                                   title="{{translate('add')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">{{translate('register')}}</span>
                                </a>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/customer/list')?'active':''}}">
                                <a class="nav-link " href="{{route('admin.customer.list')}}"
                                   title="{{translate('list')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">{{translate('list')}}</span>
                                </a>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/customer/kyc-requests')?'active':''}}">
                                <a class="nav-link " href="{{route('admin.customer.kyc_requests')}}"
                                   title="{{translate('Verification Requests')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">{{translate('Verification Requests')}}</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item {{Request::is('admin/user/log')?'active':''}}">
                        <a class="nav-link" href="{{route('admin.user.log')}}">
                            <span class="tio-user-big nav-icon"></span>
                            <span class="text-truncate">{{translate('Users Log')}}</span>
                        </a>
                    </li>
                    <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/subscribed-emails') ? 'active' : '' }}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link"
                           href="{{ route('admin.subscribed-emails') }}"
                           title="{{ translate('Contact Messages') }}">
                            <i class="tio-email-outlined nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{ translate('Subscribed Emails') }}
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <small class="nav-subtitle"
                               title="{{translate('Business')}} {{translate('section')}}">{{translate('business')}} {{translate('management')}}</small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>

                    <li class="nav-item {{Request::is('admin/banner*')?'active':''}}">
                        <a class="nav-link "
                           href="{{route('admin.banner.index')}}">
                            <span class="tio-image nav-icon"></span>
                            <span class="text-truncate">{{translate('Banner')}}</span>
                        </a>
                    </li>

                    <li class="nav-item {{Request::is('admin/blog*')?'active':''}}">
                        <a class="nav-link" href="{{route('admin.blog.index')}}">
                            <span class="tio-book-outlined nav-icon"></span>
                            <span class="text-truncate">{{translate('Blog')}}</span>
                        </a>
                    </li>

                    <li class="nav-item {{Request::is('admin/faq*')?'active':''}}">
                        <a class="nav-link" href="{{route('admin.faq.index')}}">
                            <span class="tio-bookmark-outlined nav-icon"></span>
                            <span class="text-truncate">{{translate('FAQ')}}</span>
                        </a>
                    </li>

{{--                    <li class="nav-item {{Request::is('admin/helpTopic/list')?'active':''}}">--}}
{{--                        <a class="nav-link" href="{{route('admin.helpTopic.list')}}">--}}
{{--                            <span class="tio-bookmark-outlined nav-icon"></span>--}}
{{--                            <span class="text-truncate">{{translate('faq')}}</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                    <li class="nav-item {{Request::is('admin/purpose*')?'active':''}}">
                        <a class="nav-link "
                           href="{{route('admin.purpose.index')}}">
                            <span class="tio-add-square-outlined nav-icon"></span>
                            <span class="text-truncate">{{translate('Purpose')}}</span>
                        </a>
                    </li>

                    <li class="nav-item {{Request::is('admin/linked-website*')?'active':''}}">
                        <a class="nav-link "
                           href="{{route('admin.linked-website')}}">
                            <span class="tio-website nav-icon"></span>
                            <span class="text-truncate">{{translate('Linked Website')}}</span>
                        </a>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/notification*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link"
                           href="{{route('admin.notification.add-new')}}"
                        >
                            <i class="tio-notifications nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{translate('send')}} {{translate('notification')}}
                                </span>
                        </a>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/bonus*')?'active':''}}">
                        <a class="nav-link " href="{{route('admin.bonus.index')}}" title="{{translate('Bonus')}}">
                            <span class="tio-money nav-icon"></span>
                            <span class="text-truncate">{{translate('Add Money Bonus')}}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <small class="nav-subtitle"
                               title="{{translate('system')}} {{translate('section')}}">{{translate('system')}} {{translate('management')}}</small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/business-settings/*')?'active':''}}">
                        <a class="nav-link " href="{{route('admin.business-settings.business-setup')}}"
                            title="{{translate('business')}} {{translate('setup')}}">
                            <span class="tio-settings nav-icon"></span>
                            <span class="text-truncate">{{translate('business setup')}}</span>
                        </a>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/landing-settings/get-landing-information*')?'active':''}}">
                        <a class="nav-link " href="{{route('admin.landing-settings.get-landing-information', ['web_page' => 'intro_section'])}}"
                            title="{{translate('landing')}} {{translate('setup')}}">
                            <span class="tio-settings-vs-outlined nav-icon"></span>
                            <span class="text-truncate">{{translate('Landing_Page_Settings')}}</span>
                        </a>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/pages*')?'active':''}}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                            <i class="tio-pages-outlined nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{translate('Pages & Media')}}</span>
                        </a>
                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{Request::is('admin/pages*')?'block':'none'}}">
                            <li class="nav-item {{Request::is('admin/pages/terms-and-conditions')?'active':''}}">
                                <a class="nav-link "
                                   href="{{route('admin.pages.terms-and-conditions')}}"
                                >
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">{{translate('terms & Condition')}}</span>
                                </a>
                            </li>

                            <li class="nav-item {{Request::is('admin/pages/privacy-policy')?'active':''}}">
                                <a class="nav-link " href="{{route('admin.pages.privacy-policy')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">{{translate('privacy Policy')}}</span>
                                </a>
                            </li>

                            <li class="nav-item {{Request::is('admin/pages/about-us')?'active':''}}">
                                <a class="nav-link "
                                   href="{{route('admin.pages.about-us')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">{{translate('about Us')}}</span>
                                </a>
                            </li>

                            <li class="nav-item {{Request::is('admin/pages/social-media')?'active':''}}">
                                <a class="nav-link "
                                   href="{{route('admin.pages.social-media.index')}}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">{{translate('Social Media Links')}}</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/merchant-config*')?'active':''}}">
                        <a class="nav-link " href="{{route('admin.merchant-config.index')}}"
                           title="{{translate('landing')}} {{translate('setup')}}">
                            <i class="tio-settings-outlined nav-icon"></i>
                            <span class="text-truncate">{{translate('Merchant Config')}}</span>
                        </a>
                    </li>




                    <li class="nav-item">
                        <small class="nav-subtitle">{{ translate('Help_&_Support') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/contact/*') ? 'active' : '' }}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link"
                            href="{{ route('admin.contact.list') }}"
                            title="{{ translate('Contact_messages') }}">
                            <i class="tio-messages nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{ translate('Contact_messages') }}
                            </span>
                        </a>
                    </li>

                      <li class="nav-item">
                        <small class="nav-subtitle">{{translate('system')}} {{translate('addon')}}</small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>

                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/addon')?'active':''}}">
                    <a class="nav-link " href="{{route('admin.addon.index')}}" title="{{translate('system_Addon')}}">
                        <span class="tio-add-circle-outlined nav-icon"></span>
                        <span class="text-truncate">{{translate('System Addon')}}</span>
                    </a>
                </li>

                    @if(count(config('addon_admin_routes'))>0)
                    <li class="navbar-vertical-aside-has-menu {{Request::is('admin/payment/configuration/*') || Request::is('admin/sms/configuration/*')?'active':''}} mb-5">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:" >
                            <i class="tio-puzzle nav-icon"></i>
                            <span  class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{translate('Addon Menus')}}</span>
                        </a>
                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{Request::is('admin/payment/configuration/*') || Request::is('admin/sms/configuration/*')?'block':'none'}}">
                            @foreach(config('addon_admin_routes') as $routes)
                                @foreach($routes as $route)
                                    <li class="navbar-vertical-aside-has-menu {{Request::is($route['path'])  ? 'active' :''}}">
                                        <a class="js-navbar-vertical-aside-menu-link nav-link "
                                        href="{{ $route['url'] }}" title="{{ translate($route['name']) }}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{ translate($route['name']) }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            @endforeach
                        </ul>
                    </li>
                @endif

                </ul>
            </div>
        </div>
    </aside>
</div>

<div id="sidebarCompact" class="d-none">

</div>

@push('script_2')
<script>
    $(window).on('load' , function() {
        if($(".navbar-vertical-content li.active").length) {
            $('.navbar-vertical-content').animate({
                scrollTop: $(".navbar-vertical-content li.active").offset().top - 150
            }, 10);
        }
    });

    var $rows = $('.navbar-vertical-content  .navbar-nav > li');
    $('#search-sidebar-menu').keyup(function() {
        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

        $rows.show().filter(function() {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
        }).hide();
    });
</script>
@endpush
