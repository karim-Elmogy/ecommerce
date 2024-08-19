<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.home') }}" class="app-brand-link">
            <span class="app-brand-logo demo ps-2">
                @if(setting('logo'))
                <img src="{{ setting('logo') }}" style="max-width:40px;" alt="">
                @else
                <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <path
                            d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                            id="path-1"></path>
                        <path
                            d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                            id="path-3"></path>
                        <path
                            d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                            id="path-4"></path>
                        <path
                            d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                            id="path-5"></path>
                    </defs>
                    <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                            <g id="Icon" transform="translate(27.000000, 15.000000)">
                                <g id="Mask" transform="translate(0.000000, 8.000000)">
                                    <mask id="mask-2" fill="white">
                                        <use xlink:href="#path-1"></use>
                                    </mask>
                                    <use fill="#9F85F3" xlink:href="#path-1"></use>
                                    <g id="Path-3" mask="url(#mask-2)">
                                        <use fill="#9F85F3" xlink:href="#path-3"></use>
                                        <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                                    </g>
                                    <g id="Path-4" mask="url(#mask-2)">
                                        <use fill="#9F85F3" xlink:href="#path-4"></use>
                                        <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                                    </g>
                                </g>
                                <g id="Triangle"
                                    transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                                    <use fill="#9F85F3" xlink:href="#path-5"></use>
                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
                @endif

            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2" style="font-size: 20px;font-weight: bold">
                {{ app()->getLocale() == 'ar' ? setting('project_name_ar') :  setting('project_name_en') }}
            </span>
        </a>

        <a href="javascript:void(0);" id="menu-toggle-btn"
            class="layout-menu-toggle menu-link text-large ms-auto d-block ">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item  {{ strpos(Route::currentRouteName(), 'home') !== false ? 'active open' : '' }}">
            <a href="{{ route('admin.home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">{{__('dashboard.sidebar.dashboard')}}</div>
            </a>
        </li>



        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{__('dashboard.sidebar.app')}}</span>
        </li>



        @if (auth('admin')->user()->hasPermissions('client'))
            <li class="menu-item {{ strpos(Route::currentRouteName(), 'client') !== false ? 'active open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons  bx bxs-user"></i>
                    <div data-i18n="User interface">{{__('dashboard.client.clients')}}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Route::currentRouteName() == 'admin.client.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.client.index') }}" class="menu-link">
                            <div data-i18n="Accordion">{{__('dashboard.client.clients')}}</div>
                        </a>
                    </li>
                    @if (auth('admin')->user()->hasPermissions('client','store'))
                        <li class="menu-item {{ Route::currentRouteName() == 'admin.client.create' ? 'active' : '' }}">
                            <a href="{{ route('admin.client.create') }}" class="menu-link">
                                <div data-i18n="Accordion">{{__('dashboard.crud.add')}} {{__('dashboard.client.clients')}}</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth('admin')->user()->hasPermissions('partner'))
            <li class="menu-item {{ strpos(Route::currentRouteName(), 'partner') !== false ? 'active open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons  bx bxs-user-pin"></i>
                    <div data-i18n="User interface">{{__('dashboard.partner.partners')}}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Route::currentRouteName() == 'admin.partner.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.partner.index') }}" class="menu-link">
                            <div data-i18n="Accordion">{{__('dashboard.partner.partners')}}</div>
                        </a>
                    </li>
                    @if (auth('admin')->user()->hasPermissions('partner','store'))
                        <li class="menu-item {{ Route::currentRouteName() == 'admin.partner.create' ? 'active' : '' }}">
                            <a href="{{ route('admin.partner.create') }}" class="menu-link">
                                <div data-i18n="Accordion">{{__('dashboard.crud.add')}} {{__('dashboard.partner.partners')}}</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth('admin')->user()->hasPermissions('specialization'))
            <li class="menu-item {{ strpos(Route::currentRouteName(), 'specialization') !== false ? 'active open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons  bx bxs-book"></i>
                    <div data-i18n="User interface">{{__('dashboard.specialization.specializations')}}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Route::currentRouteName() == 'admin.specialization.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.specialization.index') }}" class="menu-link">
                            <div data-i18n="Accordion">{{__('dashboard.specialization.specializations')}}</div>
                        </a>
                    </li>
                    @if (auth('admin')->user()->hasPermissions('partner','store'))
                        <li class="menu-item {{ Route::currentRouteName() == 'admin.specialization.create' ? 'active' : '' }}">
                            <a href="{{ route('admin.specialization.create') }}" class="menu-link">
                                <div data-i18n="Accordion">{{__('dashboard.crud.add')}} {{__('dashboard.specialization.specializations')}}</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

    @if (auth('admin')->user()->hasPermissions('slider'))
            <li class="menu-item {{ strpos(Route::currentRouteName(), 'slider') !== false ? 'active open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons  bx bxs-image"></i>
                    <div data-i18n="User interface">{{__('dashboard.slider.sliders')}}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Route::currentRouteName() == 'admin.slider.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.slider.index') }}" class="menu-link">
                            <div data-i18n="Accordion">{{__('dashboard.slider.sliders')}}</div>
                        </a>
                    </li>
                    @if (auth('admin')->user()->hasPermissions('slider','store'))
                        <li class="menu-item {{ Route::currentRouteName() == 'admin.slider.create' ? 'active' : '' }}">
                            <a href="{{ route('admin.slider.create') }}" class="menu-link">
                                <div data-i18n="Accordion">{{__('dashboard.crud.add')}} {{__('dashboard.slider.slider')}}</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif


    @if (auth('admin')->user()->hasPermissions('offer'))
        <li class="menu-item {{ strpos(Route::currentRouteName(), 'offer') !== false ? 'active open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons  bx bxs-offer"></i>
                <div data-i18n="User interface">{{__('dashboard.offer.offers')}}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Route::currentRouteName() == 'admin.offer.index' ? 'active' : '' }}">
                    <a href="{{ route('admin.offer.index') }}" class="menu-link">
                        <div data-i18n="Accordion">{{__('dashboard.offer.offers')}}</div>
                    </a>
                </li>
{{--                @if (auth('admin')->user()->hasPermissions('offer','store'))--}}
{{--                <li class="menu-item {{ Route::currentRouteName() == 'admin.offer.create' ? 'active' : '' }}">--}}
{{--                    <a href="{{ route('admin.offer.create') }}" class="menu-link">--}}
{{--                        <div data-i18n="Accordion">{{__('dashboard.crud.add')}} {{__('dashboard.offer.offer')}}</div>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @endif--}}
            </ul>
        </li>
        @endif


        @if (auth('admin')->user()->hasPermissions('book'))
            <li class="menu-item {{ strpos(Route::currentRouteName(), 'book') !== false ? 'active open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons  bx bxs-book"></i>
                    <div data-i18n="User interface">{{__('dashboard.book.books')}}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Route::currentRouteName() == 'admin.book.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.book.index') }}" class="menu-link">
                            <div data-i18n="Accordion">{{__('dashboard.book.books')}}</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        @if (auth('admin')->user()->hasPermissions('county'))
            <li class="menu-item
         {{ strpos(Route::currentRouteName(), 'county') !== false ? 'active open' : '' }}
        ">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-flag"></i>
                    <div data-i18n="User interface">{{__('dashboard.county.counties')}}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Route::currentRouteName() == 'admin.county.index' ? 'active' : '' }}">
                        <a href="{{route('admin.county.index')}}" class="menu-link">
                            <div data-i18n="Accordion">{{__('dashboard.county.counties')}}</div>
                        </a>
                    </li>
                    @if (auth('admin')->user()->hasPermissions('county','store'))
                        <li class="menu-item {{ Route::currentRouteName() == 'admin.county.create' ? 'active' : '' }}">
                            <a href="{{ route('admin.county.create') }}" class="menu-link">
                                <div data-i18n="Accordion">{{__('dashboard.crud.add')}} {{__('dashboard.county.county')}}</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth('admin')->user()->hasPermissions('city'))
            <li class="menu-item
         {{ strpos(Route::currentRouteName(), 'city') !== false ? 'active open' : '' }}
        ">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-map"></i>
                    <div data-i18n="User interface">{{__('dashboard.city.cities')}}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Route::currentRouteName() == 'admin.city.index' ? 'active' : '' }}">
                        <a href="{{route('admin.city.index')}}" class="menu-link">
                            <div data-i18n="Accordion">{{__('dashboard.city.cities')}}</div>
                        </a>
                    </li>
                    @if (auth('admin')->user()->hasPermissions('city','store'))
                        <li class="menu-item {{ Route::currentRouteName() == 'admin.city.create' ? 'active' : '' }}">
                            <a href="{{ route('admin.city.create') }}" class="menu-link">
                                <div data-i18n="Accordion">{{__('dashboard.crud.add')}} {{__('dashboard.city.city')}}</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth('admin')->user()->hasPermissions('nationality'))
            <li class="menu-item
         {{ strpos(Route::currentRouteName(), 'nationality') !== false ? 'active open' : '' }}
        ">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-flag"></i>
                    <div data-i18n="User interface">{{__('dashboard.nationality.nationalities')}}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Route::currentRouteName() == 'admin.nationality.index' ? 'active' : '' }}">
                        <a href="{{route('admin.nationality.index')}}" class="menu-link">
                            <div data-i18n="Accordion">{{__('dashboard.nationality.nationalities')}}</div>
                        </a>
                    </li>
                    @if (auth('admin')->user()->hasPermissions('nationality','store'))
                        <li class="menu-item {{ Route::currentRouteName() == 'admin.nationality.create' ? 'active' : '' }}">
                            <a href="{{ route('admin.nationality.create') }}" class="menu-link">
                                <div data-i18n="Accordion">{{__('dashboard.crud.add')}} {{__('dashboard.nationality.nationality')}}</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth('admin')->user()->hasPermissions('category'))

            <li class="menu-item
         {{ strpos(Route::currentRouteName(), 'category') !== false ? 'active open' : '' }}
        ">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-category"></i>
                    <div data-i18n="User interface">{{__('dashboard.category.categories')}}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Route::currentRouteName() == 'admin.category.index' ? 'active' : '' }}">
                        <a href="{{route('admin.category.index')}}" class="menu-link">
                            <div data-i18n="Accordion">{{__('dashboard.category.categories')}}</div>
                        </a>
                    </li>
{{--                    @if (auth('admin')->user()->hasPermissions('category','store'))--}}
{{--                        <li class="menu-item {{ Route::currentRouteName() == 'admin.category.create' ? 'active' : '' }}">--}}
{{--                            <a href="{{ route('admin.category.create') }}" class="menu-link">--}}
{{--                                <div data-i18n="Accordion">{{__('dashboard.crud.add')}} {{__('dashboard.category.category')}}--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
                </ul>
            </li>
        @endif



        @if (auth('admin')->user()->hasPermissions('package'))
            <li class="menu-item
         {{ strpos(Route::currentRouteName(), 'package') !== false ? 'active open' : '' }}
        ">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-package"></i>
                    <div data-i18n="User interface">{{__('dashboard.package.packages')}}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Route::currentRouteName() == 'admin.package.index' ? 'active' : '' }}">
                        <a href="{{route('admin.package.index')}}" class="menu-link">
                            <div data-i18n="Accordion">{{__('dashboard.package.packages')}}</div>
                        </a>
                    </li>
                    @if (auth('admin')->user()->hasPermissions('package','store'))
                        <li class="menu-item {{ Route::currentRouteName() == 'admin.package.create' ? 'active' : '' }}">
                            <a href="{{ route('admin.package.create') }}" class="menu-link">
                                <div data-i18n="Accordion">{{__('dashboard.crud.add')}} {{__('dashboard.package.packages')}}</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif









        @if (auth('admin')->user()->hasPermissions('story'))
            <li class="menu-item {{ strpos(Route::currentRouteName(), 'story') !== false ? 'active open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class='menu-icon bx bx-stats'></i>
                    <div data-i18n="User interface">{{__('dashboard.story.stories')}}</div>
                </a>
                <ul class="menu-sub">
                    @if (auth('admin')->user()->hasPermissions('story','index'))
                        <li class="menu-item  {{ Route::currentRouteName() ==  'admin.story.index'  ? 'active' : '' }}">
                            <a href="{{route('admin.story.index')}}" class="menu-link">
                                <div data-i18n="Text Divider">{{__('dashboard.story.stories')}}</div>
                            </a>
                        </li>
                        @if (auth('admin')->user()->hasPermissions('story','store'))
                            <li class="menu-item {{ Route::currentRouteName() == 'admin.story.create' ? 'active' : '' }}">
                                <a href="{{ route('admin.story.create') }}" class="menu-link">
                                    <div data-i18n="Accordion">{{__('dashboard.crud.add')}} {{__('dashboard.story.stories')}}
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
            </li>
        @endif



{{--        @if (auth('admin')->user()->hasPermissions('team'))--}}
{{--            <li class="menu-item {{ strpos(Route::currentRouteName(), 'team') !== false ? 'active open' : '' }}">--}}
{{--                <a href="javascript:void(0)" class="menu-link menu-toggle">--}}
{{--                    <i class='menu-icon bx bx-user'></i>--}}
{{--                    <div data-i18n="User interface">{{__('dashboard.team.teams')}}</div>--}}
{{--                </a>--}}
{{--                <ul class="menu-sub">--}}
{{--                    @if (auth('admin')->user()->hasPermissions('team','index'))--}}
{{--                        <li class="menu-item  {{ Route::currentRouteName() ==  'admin.team.index'  ? 'active' : '' }}">--}}
{{--                            <a href="{{route('admin.team.index')}}" class="menu-link">--}}
{{--                                <div data-i18n="Text Divider">{{__('dashboard.team.teams')}}</div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        @if (auth('admin')->user()->hasPermissions('team','store'))--}}
{{--                            <li class="menu-item {{ Route::currentRouteName() == 'admin.team.create' ? 'active' : '' }}">--}}
{{--                                <a href="{{ route('admin.team.create') }}" class="menu-link">--}}
{{--                                    <div data-i18n="Accordion">{{__('dashboard.crud.add')}} {{__('dashboard.team.teams')}}--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                    @endif--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--        @endif--}}

        @if (auth('admin')->user()->hasPermissions('order'))
            <li class="menu-item {{ strpos(Route::currentRouteName(), 'order') !== false ? 'active open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class='menu-icon bx bx-cart'></i>
                    <div data-i18n="User interface">{{__('dashboard.order.orders')}}</div>
                </a>
                <ul class="menu-sub">
                    @if (auth('admin')->user()->hasPermissions('order','index'))
                        <li class="menu-item  {{ Route::currentRouteName() ==  'admin.order.index'  ? 'active' : '' }}">
                            <a href="{{route('admin.order.index')}}" class="menu-link">
                                <div data-i18n="Text Divider">{{__('dashboard.order.orders')}}</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (auth('admin')->user()->hasPermissions('course'))
            <li class="menu-item {{ strpos(Route::currentRouteName(), 'course') !== false ? 'active open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class='menu-icon bx bx-caret-down-circle'></i>
                    <div data-i18n="User interface">{{__('dashboard.course.courses')}}</div>
                </a>
                <ul class="menu-sub">
                    @if (auth('admin')->user()->hasPermissions('course','index'))
                        <li class="menu-item  {{ Route::currentRouteName() ==  'admin.course.index'  ? 'active' : '' }}">
                            <a href="{{route('admin.course.index')}}" class="menu-link">
                                <div data-i18n="Text Divider">{{__('dashboard.course.courses')}}</div>
                            </a>
                        </li>
                        @if (auth('admin')->user()->hasPermissions('course','store'))
                            <li class="menu-item {{ Route::currentRouteName() == 'admin.course.all-course' ? 'active' : '' }}">
                                <a href="{{ route('admin.course.all-course') }}" class="menu-link">
                                    <div data-i18n="Accordion">{{__('dashboard.order.orders')}}</div>
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
            </li>
        @endif






        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{__('dashboard.sidebar.utopia')}}</span>
        </li>
        @if (auth('admin')->user()->hasPermissions('contact-info'))
        <li class="menu-item
               {{ strpos(Route::currentRouteName(), 'why') !== false ? 'active open' : '' }}
               ">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-cylinder"></i>
                <div data-i18n="User interface">{{__('dashboard.sidebar.utopia')}}</div>
            </a>
            <ul class="menu-sub">
                @if (auth('admin')->user()->hasPermissions('why','index'))
                <li class="menu-item  {{ Route::currentRouteName() ==  'admin.why.index'  ? 'active' : '' }}">
                    <a href="{{route('admin.why.index')}}" class="menu-link">
                        <div data-i18n="Text Divider">{{__('dashboard.general.why')}}</div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        <!-- Components -->
        <li class="menu-header small text-uppercase"><span
                class="menu-header-text">{{__('dashboard.sidebar.settings_app')}}</span></li>
        @if (auth('admin')->user()->hasPermissions('users'))
        <li class="menu-item {{ strpos(Route::currentRouteName(), 'users') !== false ? 'active open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="User interface">{{__('dashboard.user.users')}}</div>
            </a>
            <ul class="menu-sub">

                <li class="menu-item  {{ Route::currentRouteName()== 'admin.users.index'  ? 'active' : '' }}">
                    <a href="{{route('admin.users.index')}}" class="menu-link">
                        <div data-i18n="Text Divider">{{__('dashboard.user.users')}}</div>
                    </a>
                </li>
                @if (auth('admin')->user()->hasPermissions('users','store'))
                <li class="menu-item {{ Route::currentRouteName() == 'admin.users.create' ? 'active' : '' }}">
                    <a href="{{ route('admin.users.create') }}" class="menu-link">
                        <div data-i18n="Accordion">{{__('dashboard.crud.add')}} {{__('dashboard.user.user')}}</div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif


        @if (auth('admin')->user()->hasPermissions('role'))
        <li class="menu-item {{ strpos(Route::currentRouteName(), 'role') !== false ? 'active open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-block"></i>
                <div data-i18n="User interface">{{__('dashboard.role.roles')}}</div>
            </a>
            <ul class="menu-sub">
                @if (auth('admin')->user()->hasPermissions('role','index'))
                <li class="menu-item  {{ Route::currentRouteName() ==  'admin.role.index'  ? 'active' : '' }}">
                    <a href="{{route('admin.role.index')}}" class="menu-link">
                        <div data-i18n="Text Divider">{{__('dashboard.role.roles')}}</div>
                    </a>
                </li>
                @if (auth('admin')->user()->hasPermissions('role','store'))
                <li class="menu-item {{ Route::currentRouteName() == 'admin.role.create' ? 'active' : '' }}">
                    <a href="{{ route('admin.role.create') }}" class="menu-link">
                        <div data-i18n="Accordion">{{__('dashboard.crud.add')}} {{__('dashboard.role.role')}}</div>
                    </a>
                </li>
                @endif
                @endif
            </ul>
        </li>
        @endif

        @if (auth('admin')->user()->hasPermissions('bank'))
            <li class="menu-item {{ strpos(Route::currentRouteName(), 'bank') !== false ? 'active open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxs-bank"></i>
                    <div data-i18n="User interface">{{__('dashboard.bank.banks')}}</div>
                </a>
                <ul class="menu-sub">
                    @if (auth('admin')->user()->hasPermissions('bank','index'))
                        <li class="menu-item  {{ Route::currentRouteName() ==  'admin.bank.index'  ? 'active' : '' }}">
                            <a href="{{route('admin.bank.index')}}" class="menu-link">
                                <div data-i18n="Text Divider">{{__('dashboard.bank.banks')}}</div>
                            </a>
                        </li>
                        @if (auth('admin')->user()->hasPermissions('bank','store'))
                            <li class="menu-item {{ Route::currentRouteName() == 'admin.bank.create' ? 'active' : '' }}">
                                <a href="{{ route('admin.bank.create') }}" class="menu-link">
                                    <div data-i18n="Accordion">{{__('dashboard.crud.add')}} {{__('dashboard.bank.bank')}}</div>
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
            </li>
        @endif

        @if (auth('admin')->user()->hasPermissions('coupon'))
        <li class="menu-item {{ strpos(Route::currentRouteName(), 'coupon') !== false ? 'active open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-coupon"></i>
                <div data-i18n="User interface">{{__('dashboard.coupon.coupons')}}</div>
            </a>
            <ul class="menu-sub">
                @if (auth('admin')->user()->hasPermissions('coupon','index'))
                <li class="menu-item  {{ Route::currentRouteName() ==  'admin.coupon.index'  ? 'active' : '' }}">
                    <a href="{{route('admin.coupon.index')}}" class="menu-link">
                        <div data-i18n="Text Divider">{{__('dashboard.coupon.coupons')}}</div>
                    </a>
                </li>
                @if (auth('admin')->user()->hasPermissions('coupon','store'))
                <li class="menu-item {{ Route::currentRouteName() == 'admin.coupon.create' ? 'active' : '' }}">
                    <a href="{{ route('admin.coupon.create') }}" class="menu-link">
                        <div data-i18n="Accordion">{{__('dashboard.crud.add')}} {{__('dashboard.coupon.coupon')}}</div>
                    </a>
                </li>
                @endif
                @endif
            </ul>
        </li>
        @endif




        <!-- User interface -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-bell-ring"></i>
                <div data-i18n="User interface">{{__('dashboard.sidebar.notifications')}}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div data-i18n="Accordion">{{__('dashboard.sidebar.notifications_all')}}</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div data-i18n="Alerts">{{__('dashboard.sidebar.notifications_especially')}}</div>
                    </a>
                </li>

            </ul>
        </li>




        <!-- Extended components -->
        <li class="menu-item {{ strpos(Route::currentRouteName(), 'setting') !== false ? 'active open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Extended UI">{{__('dashboard.sidebar.settings')}}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ strpos(Route::currentRouteName(), '.setting') !== false ? 'active' : '' }}">
                    <a href="{{route('admin.setting.index')}}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">{{__('dashboard.setting.settings')}}</div>
                    </a>
                </li>

            </ul>

        <li class="menu-item">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <a class="menu-link" onclick="event.preventDefault();
            this.closest('form').submit();" style="cursor: pointer;">
                    <i class="menu-icon tf-icons bx bx-log-out-circle"></i>
                    <div data-i18n="Logout">{{__('dashboard.sidebar.logout')}}</div>
                </a>
            </form>
        </li>




        </li>


    </ul>
</aside>
