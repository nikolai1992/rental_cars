<header class="header">
    <div class="header-desktop">
        <div class="header-desktop__top">
            <div class="container header-desktop__container"><a class="logo" href="{{route('main.page')}}"><img src="{{asset('img/logo.png')}}" alt=""></a>
                <div class="header-desktop__bar">
                    <div class="header__button header__button--dropdown header__button--lang"><a href="#" data-toggle-dropdown>{{$sel_lang->name}}</a>
                        <div class="header__dropdown" data-dropdown>
                            <ul>
                                @foreach($langs as $lang)
                                    @if($lang->code!=app()->getLocale())
                                        <li><a href="{{route('setlocale', $lang->code)}}">{{$lang->name}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="header__button header__button--dropdown header__button--currency"><a href="#" data-toggle-dropdown>{{$car_currency->name}}</a>
                        <div class="header__dropdown" data-dropdown>
                            <ul>
                                @foreach($curs as $cur)
                                    @if($car_currency->id!=$cur->id)
                                        <li><a href="{{route('change_cur', $cur->id)}}">{{$cur->name}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="header__button header__button--login">
                        @if(auth()->user()==null)
                            <a class="modal-open" href="#login">{{App\Models\Translation::getTranslWord($words, $sel_lang, "log_in")}}</a>
                        @else
                            <a href="#" data-toggle-dropdown>{{$words->where('name', "personal_cabinet")->first()->translations->where("language_id", $sel_lang->id)->first()->value}}</a>
                            <div class="header__dropdown" data-dropdown>
                                <ul>
                                    <li>
                                        @if(auth()->user())
                                            @if(auth()->user()->role->alias=="partner")
                                                <a href="{{route('partner.index')}}">{{$words->where('name', "account")->first()->translations->where("language_id", $sel_lang->id)->first()->value}}</a>
                                            @elseif(auth()->user()->role->alias=="admin")
                                                <a href="{{route('admin')}}">{{$words->where('name', "account")->first()->translations->where("language_id", $sel_lang->id)->first()->value}}</a>
                                            @elseif(auth()->user()->role->alias=="client")
                                                <a href="{{route('client.index')}}">{{$words->where('name', "account")->first()->translations->where("language_id", $sel_lang->id)->first()->value}}</a>
                                            @endif
                                        @endif

                                    </li>


                                    
                                    <li>
                                    <form id="frm-logout" style="display: none" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="nav-link" id="logout"></button>
                                    </form>
                                    <a href="#" class="logout-link">{{$words->where('name', "exit")->first()->translations->where("language_id", $sel_lang->id)->first()->value}}</a></li>
                                        {{--<a href="#">Выйти</a></li>--}}
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="header-desktop__bottom">
            <div class="container">
                <ul class="header-desktop__menu">
                    <li style="{{!$pages->where('alias', 'cars')->first()->header ? "display:none" : ''}}"><a href="{{route('cars.page')}}">{{$pages->where('alias', 'cars')->first()->getTranslation('name')}}</a></li>
                    <li style="{{!$pages->where('alias', 'faq')->first()->header ? "display:none" : ''}}"><a href="{{route('faq')}}">{{$pages->where('alias', 'faq')->first()->getTranslation('name')}}</a></li>
                    <li style="{{!$pages->where('alias', 'brands')->first()->header ? "display:none" : ''}}"><a class="header-desktop__submenu-link" href="#" data-toggle-dropdown><span>{{$pages->where('alias', 'brands')->first()->getTranslation('name')}}</span></a>
                        <div class="header-desktop__submenu" data-dropdown>
                            <div class="header-desktop__menu-search">
                                <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "find_car_text")}}</label>
                                <div>
                                    <input id="menu-search" type="text" placeholder="{{App\Models\Translation::getTranslWord($words, $sel_lang, "search_by_brand_name")}}" autocomplete="off">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.999 511.999">
                                        <path fill="currentColor" d="M508.874 478.708L360.142 329.976c28.21-34.827 45.191-79.103 45.191-127.309C405.333 90.917 314.416 0 202.666 0S0 90.917 0 202.667s90.917 202.667 202.667 202.667c48.206 0 92.482-16.982 127.309-45.191l148.732 148.732c4.167 4.165 10.919 4.165 15.086 0l15.081-15.082c4.165-4.166 4.165-10.92-.001-15.085zM202.667 362.667c-88.229 0-160-71.771-160-160s71.771-160 160-160 160 71.771 160 160-71.771 160-160 160z"></path>
                                    </svg>
                                </div>
                            </div>
                            <ul id="menu-search-list">
                                @foreach($brands as $brand)
                                <li><a href="{{route('sort_cars_by_brand', $brand->alias)}}"><span><img src="{{asset($brand->icon)}}" style="width: 47px;" alt=""></span><span><span>{{$brand->name}}</span><span>{{count($brand->getCountCarsWithSimpleRent())}} {{App\Models\Translation::getTranslWord($words, $sel_lang, "auto")}}</span></span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li style="{{!$pages->where('alias', 'rent-of-cars-with-driver')->first()->header ? "display:none" : ''}}"><a href="{{route('cars_rent_with_driver.page')}}">{{$pages->where('alias', 'rent-of-cars-with-driver')->first()->getTranslation('name')}}</a></li>
                    <li style="{{!$pages->where('alias', 'contacts')->first()->header ? "display:none" : ''}}"><a href="{{route('contacts.page')}}">{{$pages->where('alias', 'contacts')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'about_us')->first()->header ? '' : "display:none"}}"><a href="{{route('dynamical.page', 'about_us')}}">{{$pages->where('alias', 'about_us')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'news')->first()->header ? '' : "display:none"}}"><a href="{{route('news.page')}}">{{$pages->where('alias', 'news')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'reviews')->first()->header ? '' : "display:none"}}"><a href="{{route('reviews.page')}}">{{$pages->where('alias', 'reviews')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'why_we')->first()->header ? '' : "display:none"}}"><a href="{{route('dynamical.page', 'why_we')}}">{{$pages->where('alias', 'why_we')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'features-of-renting')->first()->header ? '' : "display:none"}}"><a href="{{route('dynamical.page', 'features-of-renting')}}">{{$pages->where('alias', 'features-of-renting')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'terms-of-cooperation')->first()->header ? '' : "display:none"}}"><a href="{{route('dynamical.page', 'terms-of-cooperation')}}">{{$pages->where('alias', 'terms-of-cooperation')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'advertising-placement')->first()->header ? '' : "display:none"}}"><a href="{{route('dynamical.page', 'advertising-placement')}}">{{$pages->where('alias', 'advertising-placement')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'assistance')->first()->header ? '' : "display:none"}}"><a href="{{route('dynamical.page', 'assistance')}}">{{$pages->where('alias', 'assistance')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'rent_condition')->first()->header ? '' : "display:none"}}"><a href="{{route('rent_condition')}}">{{$pages->where('alias', 'rent_condition')->first()->getTranslation('name')}}</a></li>
                    @foreach($pages->where('basic', false) as $p)

                        @if($p->header)
                            <li style="{{$p->header ? '' : "display:none"}}"><a href="{{route('dynamical.page', $p->alias)}}">{{$p->getTranslation('name')}}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="header-mobile">
        <div class="header-mobile__top"><a class="logo header-mobile__logo" href="{{asset('')}}"><img src="{{asset('img/logo.png')}}" alt=""></a>
            <div class="header-mobile__bar">
                <button class="header-mobile__menu-btn"><span></span><span></span><span></span></button>
            </div>
        </div>
        <div class="header-mobile__menu">
            <div class="header-mobile__menu-inner">
                <div class="header-mobile__menu-btns">
                    <div>
                        <div class="header__button header__button--login">
                            <!--<a class="modal-open" href="#login"><span>Войти</span></a>-->
                            @if(auth()->user())
                                <a href="#" data-toggle-dropdown><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "personal_cabinet")}}</span></a>
                            <div class="header__dropdown" data-dropdown>
                                <ul>
                                    <li>
                                        @if(auth()->user())
                                            @if(auth()->user()->role->alias=="partner")
                                                <a href="{{route('partner.index')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "account")}}</a>
                                            @elseif(auth()->user()->role->alias=="admin")
                                                <a href="{{route('admin')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "account")}}</a>
                                            @elseif(auth()->user()->role->alias=="client")
                                                <a href="{{route('client.index')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "account")}}</a>
                                            @endif
                                                <form id="frm-logout" action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button class="nav-link" id="logout" style="opacity: 0"></button>
                                                </form>
                                    <li><a href="#"><label class="logout-label" for="logout">{{App\Models\Translation::getTranslWord($words, $sel_lang, "exit")}}</label></a></li>

                                        @endif
                                    </li>

                                </ul>
                            </div>
                            @else
                                <a class="modal-open" href="#login"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "log_in")}}</span></a>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="header__button header__button--dropdown header__button--currency"><a href="#" data-toggle-dropdown><span>{{$car_currency->name}}</span></a>
                            <div class="header__dropdown" data-dropdown>
                                <ul>
                                    @foreach($curs as $cur)
                                        @if($car_currency->id!=$cur->id)
                                            <li><a href="{{route('change_cur', $cur->id)}}">{{$cur->name}}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="header__button header__button--dropdown header__button--lang header__button--text-overflow"><a href="#" data-toggle-dropdown><span>{{$sel_lang->name}}</span></a>
                            <div class="header__dropdown" data-dropdown>
                                <ul>
                                    @foreach($langs as $lang)
                                        @if($lang->code!=app()->getLocale())
                                            <li><a href="{{route('setlocale', $lang->code)}}">{{$lang->name}}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <ul>
                    <li style="{{$pages->where('alias', 'cars')->first()->mob_menu ? '' : "display:none"}}"><a href="{{route('cars.page')}}">{{$pages->where('alias', 'cars')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'faq')->first()->mob_menu ? '' : "display:none"}}"><a href="{{route('faq')}}">{{$pages->where('alias', 'faq')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'brands')->first()->mob_menu ? '' : "display:none"}}"><a class="header-mobile__menu-submenu-link" href="{{route('brands.page')}}">{{$pages->where('alias', 'brands')->first()->getTranslation('name')}}</a>
                        <ul class="header-mobile__menu-submenu">
                            @foreach($brands as $brand)
                                <li><a href="{{route('sort_cars_by_brand', $brand->alias)}}"><span><img src="{{asset($brand->icon)}}" alt=""></span><span><span>{{$brand->name}}</span><span>{{count($brand->getCountCarsWithSimpleRent())}} авто</span></span></a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li style="{{$pages->where('alias', 'rent-of-cars-with-driver')->first()->mob_menu ? '' : "display:none"}}"><a href="{{route('cars_rent_with_driver.page')}}">{{$pages->where('alias', 'rent-of-cars-with-driver')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'contacts')->first()->mob_menu ? '' : "display:none"}}"><a href="{{route('contacts.page')}}">{{$pages->where('alias', 'contacts')->first()->getTranslation('name')}}</a></li>

                    <li style="{{$pages->where('alias', 'about_us')->first()->mob_menu ? '' : "display:none"}}"><a href="{{route('dynamical.page', 'about_us')}}">{{$pages->where('alias', 'about_us')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'news')->first()->mob_menu ? '' : "display:none"}}"><a href="{{route('news.page')}}">{{$pages->where('alias', 'news')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'reviews')->first()->mob_menu ? '' : "display:none"}}"><a href="{{route('reviews.page')}}">{{$pages->where('alias', 'reviews')->first()->getTranslation('name')}}</a></li>
                    <li style="{{$pages->where('alias', 'why_we')->first()->mob_menu ? '' : "display:none"}}"><a href="{{route('dynamical.page', 'why_we')}}">{{$pages->where('alias', 'why_we')->first()->getTranslation('name')}}</a></li>
                    @foreach($pages->where('basic', false) as $p)

                        @if($p->mob_menu)
                            <li><a href="{{route('dynamical.page', $p->alias)}}">{{$p->getTranslation('name')}}</a></li>
                        @endif
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</header>