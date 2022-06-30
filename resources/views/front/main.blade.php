
@extends('layouts.app')
@section('content')
<!--Main content-->
<main class="main">
    <div class="hero">
        <div class="hero__slider">
            <div class="owl-carousel"><img src="{{asset('img/hero/slide-1.jpg')}}" alt=""><img src="{{asset('img/hero/slide-2.jpg')}}" alt=""><img src="{{asset('img/hero/slide-3.jpg')}}" alt=""></div>
        </div>
        <div class="hero__search">
            <div class="hero-tabs">
                <div class="hero-tabs__btns">
                    <button class="active">{{App\Models\Translation::getTranslWord($words, $sel_lang, "car_rent")}}</button>
                    <button>{{App\Models\Translation::getTranslWord($words, $sel_lang, "rent_with_driver")}}</button>
                </div>
                <div class="hero-tabs__content">
                    <div class="active">
                        <form action="{{route('cars.page')}}" method="get">
                            <div>
                                <div>
                                    <div>
                                        <div class="custom-select-multiple-wrapper">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "brand")}}</label>
                                            <select class="custom-select-multiple" name="brands[]" multiple="multiple" data-placeholder="{{App\Models\Translation::getTranslWord($words, $sel_lang, "find_car")}}" data-dropdown-css-class="custom-select-dropdown custom-select-dropdown--bold custom-select-dropdown--uppercase">
                                                @foreach($brandsSimpleRent as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" value="1" name="filter">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "city")}}</label>
                                            <div class="custom-select-wrapper">
                                                <select class="custom-select custom-select--bold custom-select--uppercase" name="city" data-dropdown-css-class="custom-select-dropdown custom-select-dropdown--bold custom-select-dropdown--uppercase" required>
                                                    <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                                    <option value="1">{{App\Models\Translation::getTranslWord($words, $sel_lang, "dubai")}}</option>
                                                    <option value="2">{{App\Models\Translation::getTranslWord($words, $sel_lang, "abu_dhabi")}}</option>
                                                    <option value="3">{{App\Models\Translation::getTranslWord($words, $sel_lang, "sharjah")}}</option>
                                                    <option value="4">{{App\Models\Translation::getTranslWord($words, $sel_lang, "ras-al-Khaim")}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <div class="input-group input-group--with-label input-group--with-icon input-group--input-bold input-group--input-fz-sm mb-0 hidden-desktop">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_from")}}</label>
                                            <input type="date" data-datepicker-mob-from name="from_date" required>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356" width="25" height="25">
                                                <path fill="#828C98" d="M320.525 36.508V10h-45.706v26.508h-98.638V10h-45.706v26.508H95V271h261V36.508h-35.475zm-30.413-11.215h15.12v31.605h-15.12V25.293zm-144.344 0h15.12v31.605h-15.12V25.293zm194.939 230.414H110.293v-151.91h230.414v151.91zm0-167.203H110.293V51.8h20.182v20.39h45.706v-20.39h98.638v20.39h45.706v-20.39h20.182v36.703z"></path>
                                                <path fill="#828C98" d="M238.134 123.678h-25.266v15.293h25.266v-15.293zM281.179 123.678h-25.266v15.293h25.266v-15.293zM324.223 123.678h-25.266v15.293h25.266v-15.293zM152.04 156.812h-25.266v15.293h25.266v-15.293zM195.089 156.812h-25.266v15.293h25.266v-15.293zM238.134 156.812h-25.266v15.293h25.266v-15.293zM281.179 156.812h-25.266v15.293h25.266v-15.293zM324.223 156.812h-25.266v15.293h25.266v-15.293zM152.04 189.947h-25.266v15.293h25.266v-15.293zM195.089 189.947h-25.266v15.293h25.266v-15.293zM238.134 189.947h-25.266v15.293h25.266v-15.293zM281.179 189.947h-25.266v15.293h25.266v-15.293zM324.223 189.947h-25.266v15.293h25.266v-15.293zM152.04 223.082h-25.266v15.293h25.266v-15.293zM195.089 223.082h-25.266v15.293h25.266v-15.293zM238.134 223.082h-25.266v15.293h25.266v-15.293zM281.179 223.082h-25.266v15.293h25.266v-15.293z"></path>
                                                <path fill="#828C98" d="M193.957 256.341l-71.182-71.193a10.704 10.704 0 00-7.628-3.148 10.708 10.708 0 00-7.629 3.148l-6.463 6.465a10.708 10.708 0 00-3.15 7.629c0 2.888 1.12 5.689 3.15 7.718l41.527 41.624H10.649C4.7 248.584 0 253.241 0 259.192v9.14c0 5.951 4.7 11.078 10.649 11.078h132.404l-41.997 41.856c-2.03 2.032-3.149 4.668-3.149 7.558 0 2.886 1.119 5.561 3.149 7.592l6.463 6.444c2.032 2.033 4.739 3.14 7.63 3.14 2.887 0 5.595-1.122 7.627-3.154l71.183-71.192a10.714 10.714 0 003.149-7.652c.006-2.903-1.112-5.626-3.151-7.661z"></path>
                                            </svg>
                                        </div>
                                        <div class="input-group input-group--with-label input-group--with-icon input-group--input-bold input-group--input-fz-sm mb-0 hidden-mobile">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_from")}}</label>
                                            <input type="text" data-datepicker-from name="from_date" data-date-from-to-id="date-from-to" required>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356" width="25" height="25">
                                                <path fill="#828C98" d="M320.525 36.508V10h-45.706v26.508h-98.638V10h-45.706v26.508H95V271h261V36.508h-35.475zm-30.413-11.215h15.12v31.605h-15.12V25.293zm-144.344 0h15.12v31.605h-15.12V25.293zm194.939 230.414H110.293v-151.91h230.414v151.91zm0-167.203H110.293V51.8h20.182v20.39h45.706v-20.39h98.638v20.39h45.706v-20.39h20.182v36.703z"></path>
                                                <path fill="#828C98" d="M238.134 123.678h-25.266v15.293h25.266v-15.293zM281.179 123.678h-25.266v15.293h25.266v-15.293zM324.223 123.678h-25.266v15.293h25.266v-15.293zM152.04 156.812h-25.266v15.293h25.266v-15.293zM195.089 156.812h-25.266v15.293h25.266v-15.293zM238.134 156.812h-25.266v15.293h25.266v-15.293zM281.179 156.812h-25.266v15.293h25.266v-15.293zM324.223 156.812h-25.266v15.293h25.266v-15.293zM152.04 189.947h-25.266v15.293h25.266v-15.293zM195.089 189.947h-25.266v15.293h25.266v-15.293zM238.134 189.947h-25.266v15.293h25.266v-15.293zM281.179 189.947h-25.266v15.293h25.266v-15.293zM324.223 189.947h-25.266v15.293h25.266v-15.293zM152.04 223.082h-25.266v15.293h25.266v-15.293zM195.089 223.082h-25.266v15.293h25.266v-15.293zM238.134 223.082h-25.266v15.293h25.266v-15.293zM281.179 223.082h-25.266v15.293h25.266v-15.293z"></path>
                                                <path fill="#828C98" d="M193.957 256.341l-71.182-71.193a10.704 10.704 0 00-7.628-3.148 10.708 10.708 0 00-7.629 3.148l-6.463 6.465a10.708 10.708 0 00-3.15 7.629c0 2.888 1.12 5.689 3.15 7.718l41.527 41.624H10.649C4.7 248.584 0 253.241 0 259.192v9.14c0 5.951 4.7 11.078 10.649 11.078h132.404l-41.997 41.856c-2.03 2.032-3.149 4.668-3.149 7.558 0 2.886 1.119 5.561 3.149 7.592l6.463 6.444c2.032 2.033 4.739 3.14 7.63 3.14 2.887 0 5.595-1.122 7.627-3.154l71.183-71.192a10.714 10.714 0 003.149-7.652c.006-2.903-1.112-5.626-3.151-7.661z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="input-group input-group--with-label input-group--with-icon input-group--input-bold input-group--input-fz-sm mb-0 hidden-desktop">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_to")}}</label>
                                            <input type="date" data-datepicker-mob-to name="to_date" required>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356" width="25" height="25">
                                                <path fill="#828C98" d="M35.475 36.508V10h45.706v26.508h98.638V10h45.706v26.508H261V271H0V36.508h35.475zm30.413-11.215h-15.12v31.605h15.12V25.293zm144.344 0h-15.12v31.605h15.12V25.293zM15.293 255.707h230.414v-151.91H15.293v151.91zm0-167.203h230.414V51.8h-20.182v20.39h-45.706v-20.39H81.181v20.39H35.475v-20.39H15.293v36.703z"></path>
                                                <path fill="#828C98" d="M117.866 123.678h25.266v15.293h-25.266v-15.293zM74.821 123.678h25.266v15.293H74.821v-15.293zM31.777 123.678h25.266v15.293H31.777v-15.293zM203.96 156.812h25.266v15.293H203.96v-15.293zM160.911 156.812h25.266v15.293h-25.266v-15.293zM117.866 156.812h25.266v15.293h-25.266v-15.293zM74.821 156.812h25.266v15.293H74.821v-15.293zM31.777 156.812h25.266v15.293H31.777v-15.293zM203.96 189.947h25.266v15.293H203.96v-15.293zM160.911 189.947h25.266v15.293h-25.266v-15.293zM117.866 189.947h25.266v15.293h-25.266v-15.293zM74.821 189.947h25.266v15.293H74.821v-15.293zM31.777 189.947h25.266v15.293H31.777v-15.293zM203.96 223.082h25.266v15.293H203.96v-15.293zM160.911 223.082h25.266v15.293h-25.266v-15.293zM117.866 223.082h25.266v15.293h-25.266v-15.293zM74.821 223.082h25.266v15.293H74.821v-15.293z"></path>
                                                <path fill="#828C98" d="M162.043 256.341l71.182-71.193a10.704 10.704 0 017.628-3.148c2.891 0 5.598 1.117 7.629 3.148l6.463 6.465a10.707 10.707 0 013.149 7.629c0 2.888-1.118 5.689-3.149 7.718l-41.527 41.624h131.933c5.949 0 10.649 4.657 10.649 10.608v9.14c0 5.951-4.7 11.078-10.649 11.078H212.947l41.997 41.856c2.03 2.032 3.149 4.668 3.149 7.558 0 2.886-1.119 5.561-3.149 7.592l-6.463 6.444c-2.032 2.033-4.739 3.14-7.63 3.14a10.713 10.713 0 01-7.627-3.154l-71.183-71.192a10.714 10.714 0 01-3.149-7.652c-.006-2.903 1.112-5.626 3.151-7.661z"></path>
                                            </svg>
                                        </div>
                                        <div class="input-group input-group--with-label input-group--with-icon input-group--input-bold input-group--input-fz-sm mb-0 hidden-mobile">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_to")}}</label>
                                            <input type="text" data-datepicker-to name="to_date" data-date-from-to-id="date-from-to" required>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356" width="25" height="25">
                                                <path fill="#828C98" d="M35.475 36.508V10h45.706v26.508h98.638V10h45.706v26.508H261V271H0V36.508h35.475zm30.413-11.215h-15.12v31.605h15.12V25.293zm144.344 0h-15.12v31.605h15.12V25.293zM15.293 255.707h230.414v-151.91H15.293v151.91zm0-167.203h230.414V51.8h-20.182v20.39h-45.706v-20.39H81.181v20.39H35.475v-20.39H15.293v36.703z"></path>
                                                <path fill="#828C98" d="M117.866 123.678h25.266v15.293h-25.266v-15.293zM74.821 123.678h25.266v15.293H74.821v-15.293zM31.777 123.678h25.266v15.293H31.777v-15.293zM203.96 156.812h25.266v15.293H203.96v-15.293zM160.911 156.812h25.266v15.293h-25.266v-15.293zM117.866 156.812h25.266v15.293h-25.266v-15.293zM74.821 156.812h25.266v15.293H74.821v-15.293zM31.777 156.812h25.266v15.293H31.777v-15.293zM203.96 189.947h25.266v15.293H203.96v-15.293zM160.911 189.947h25.266v15.293h-25.266v-15.293zM117.866 189.947h25.266v15.293h-25.266v-15.293zM74.821 189.947h25.266v15.293H74.821v-15.293zM31.777 189.947h25.266v15.293H31.777v-15.293zM203.96 223.082h25.266v15.293H203.96v-15.293zM160.911 223.082h25.266v15.293h-25.266v-15.293zM117.866 223.082h25.266v15.293h-25.266v-15.293zM74.821 223.082h25.266v15.293H74.821v-15.293z"></path>
                                                <path fill="#828C98" d="M162.043 256.341l71.182-71.193a10.704 10.704 0 017.628-3.148c2.891 0 5.598 1.117 7.629 3.148l6.463 6.465a10.707 10.707 0 013.149 7.629c0 2.888-1.118 5.689-3.149 7.718l-41.527 41.624h131.933c5.949 0 10.649 4.657 10.649 10.608v9.14c0 5.951-4.7 11.078-10.649 11.078H212.947l41.997 41.856c2.03 2.032 3.149 4.668 3.149 7.558 0 2.886-1.119 5.561-3.149 7.592l-6.463 6.444c-2.032 2.033-4.739 3.14-7.63 3.14a10.713 10.713 0 01-7.627-3.154l-71.183-71.192a10.714 10.714 0 01-3.149-7.652c-.006-2.903 1.112-5.626 3.151-7.661z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "auto_class")}}</label>
                                            <div class="custom-select-wrapper">
                                                <select class="custom-select custom-select--bold custom-select--uppercase" name="car_class" data-dropdown-css-class="custom-select-dropdown custom-select-dropdown--bold custom-select-dropdown--uppercase" data-placeholder="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}">
                                                    <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                                    <option value="">Не выбрано</option>
                                                    <option value="vip">{{App\Models\Translation::getTranslWord($words, $sel_lang, "vip_class")}}</option>
                                                    <option value="elites">{{App\Models\Translation::getTranslWord($words, $sel_lang, "elit_class")}}</option>
                                                    <option value="super_car">{{App\Models\Translation::getTranslWord($words, $sel_lang, "supercars")}}</option>
                                                    <option value="sport_class">{{App\Models\Translation::getTranslWord($words, $sel_lang, "sport_class")}}</option>
                                                    <option value="suv">{{App\Models\Translation::getTranslWord($words, $sel_lang, "suvs")}}</option>
                                                    <option value="business">{{App\Models\Translation::getTranslWord($words, $sel_lang, "business_class")}}</option>
                                                    <option value="middle">{{App\Models\Translation::getTranslWord($words, $sel_lang, "middle_class")}}</option>
                                                    <option value="econom">{{App\Models\Translation::getTranslWord($words, $sel_lang, "econom_class")}}</option>
                                                    <option value="microbus">{{App\Models\Translation::getTranslWord($words, $sel_lang, "minibuses")}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="date-from-to" id="date-from-to">
                                        <div class="flatpickr-hero" data-elem-from="[data-datepicker-from]" data-elem-to="[data-datepicker-to]" data-hidden data-lang="ru"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <button class="btn w-full" type="submit"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "search")}}</span></button>
                                </div>
                                <div>
                                    <div class="checkbox-group-2 checkbox-group-2--white">
                                        <input id="hero-search-show-cars" type="checkbox" name="free_cars">
                                        <label for="hero-search-show-cars">{{App\Models\Translation::getTranslWord($words, $sel_lang, "show_available_cars")}}</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div>
                        <form class="filter-catalog-with-driver" method="get" action="{{route('cars_rent_with_driver.page')}}">
                            <div>
                                <div>
                                <div>
                                    <div class="input-group input-group--with-label mb-0">
                                        <input type="hidden" value="1" name="filter">
                                        <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "car_pick_location")}}</label>
                                        <div class="custom-select-wrapper">
                                            <select required="required" class="custom-select custom-select--bold custom-select--uppercase" name="city" data-dropdown-css-class="custom-select-dropdown custom-select-dropdown--bold custom-select-dropdown--uppercase">
                                                <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                                <option value="1">{{App\Models\Translation::getTranslWord($words, $sel_lang, "dubai2")}}</option>
                                                <option value="2">{{App\Models\Translation::getTranslWord($words, $sel_lang, "abu_dhabi")}}</option>
                                                <option value="3">{{App\Models\Translation::getTranslWord($words, $sel_lang, "sharjah")}}</option>
                                                <option value="4">{{App\Models\Translation::getTranslWord($words, $sel_lang, "ras-al-Khaim")}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="input-group input-group--with-label mb-0">
                                        <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "auto_class")}}</label>
                                        <div class="custom-select-wrapper">
                                            <select class="custom-select custom-select--bold custom-select--uppercase" name="car_class" data-dropdown-css-class="custom-select-dropdown custom-select-dropdown--bold custom-select-dropdown--uppercase" data-placeholder="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}">
                                                <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                                <option value="">Не выбрано</option>
                                                <option value="vip">{{App\Models\Translation::getTranslWord($words, $sel_lang, "vip_class")}}</option>
                                                <option value="elites">{{App\Models\Translation::getTranslWord($words, $sel_lang, "elit_class")}}</option>
                                                <option value="super_car">{{App\Models\Translation::getTranslWord($words, $sel_lang, "supercars")}}</option>
                                                <option value="sport_class">{{App\Models\Translation::getTranslWord($words, $sel_lang, "sport_class")}}</option>
                                                <option value="suv">{{App\Models\Translation::getTranslWord($words, $sel_lang, "suvs")}}</option>
                                                <option value="business">{{App\Models\Translation::getTranslWord($words, $sel_lang, "business_class")}}</option>
                                                <option value="middle">{{App\Models\Translation::getTranslWord($words, $sel_lang, "middle_class")}}</option>
                                                <option value="econom">{{App\Models\Translation::getTranslWord($words, $sel_lang, "econom_class")}}</option>
                                                <option value="microbus">{{App\Models\Translation::getTranslWord($words, $sel_lang, "minibuses")}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <div class="input-group input-group--with-label input-group--with-icon input-group--input-bold input-group--input-fz-sm mb-0">
                                        <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date")}}</label>
                                        <input class="flatpickr" type="text" name="date" data-lang="ru" required>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356" width="25" height="25">
                                            <path fill="#828C98" d="M320.525 36.508V10h-45.706v26.508h-98.638V10h-45.706v26.508H95V271h261V36.508h-35.475zm-30.413-11.215h15.12v31.605h-15.12V25.293zm-144.344 0h15.12v31.605h-15.12V25.293zm194.939 230.414H110.293v-151.91h230.414v151.91zm0-167.203H110.293V51.8h20.182v20.39h45.706v-20.39h98.638v20.39h45.706v-20.39h20.182v36.703z"></path>
                                            <path fill="#828C98" d="M238.134 123.678h-25.266v15.293h25.266v-15.293zM281.179 123.678h-25.266v15.293h25.266v-15.293zM324.223 123.678h-25.266v15.293h25.266v-15.293zM152.04 156.812h-25.266v15.293h25.266v-15.293zM195.089 156.812h-25.266v15.293h25.266v-15.293zM238.134 156.812h-25.266v15.293h25.266v-15.293zM281.179 156.812h-25.266v15.293h25.266v-15.293zM324.223 156.812h-25.266v15.293h25.266v-15.293zM152.04 189.947h-25.266v15.293h25.266v-15.293zM195.089 189.947h-25.266v15.293h25.266v-15.293zM238.134 189.947h-25.266v15.293h25.266v-15.293zM281.179 189.947h-25.266v15.293h25.266v-15.293zM324.223 189.947h-25.266v15.293h25.266v-15.293zM152.04 223.082h-25.266v15.293h25.266v-15.293zM195.089 223.082h-25.266v15.293h25.266v-15.293zM238.134 223.082h-25.266v15.293h25.266v-15.293zM281.179 223.082h-25.266v15.293h25.266v-15.293z"></path>
                                            <path fill="#828C98" d="M193.957 256.341l-71.182-71.193a10.704 10.704 0 00-7.628-3.148 10.708 10.708 0 00-7.629 3.148l-6.463 6.465a10.708 10.708 0 00-3.15 7.629c0 2.888 1.12 5.689 3.15 7.718l41.527 41.624H10.649C4.7 248.584 0 253.241 0 259.192v9.14c0 5.951 4.7 11.078 10.649 11.078h132.404l-41.997 41.856c-2.03 2.032-3.149 4.668-3.149 7.558 0 2.886 1.119 5.561 3.149 7.592l6.463 6.444c2.032 2.033 4.739 3.14 7.63 3.14 2.887 0 5.595-1.122 7.627-3.154l71.183-71.192a10.714 10.714 0 003.149-7.652c.006-2.903-1.112-5.626-3.151-7.661z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <div class="input-group input-group--with-label input-group--with-icon mb-0">
                                        <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "time")}}</label>
                                        <div class="custom-select-wrapper">
                                            <select class="custom-select custom-select--bold custom-select--uppercase" name="time" data-dropdown-css-class="custom-select-dropdown custom-select-dropdown--bold custom-select-dropdown--uppercase">
                                                <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                                <option value="1">00:00</option>
                                                <option value="2">01:00</option>
                                                <option value="3">02:00</option>
                                                <option value="4">03:00</option>
                                                <option value="5">04:00</option>
                                                <option value="6">05:00</option>
                                                <option value="7">06:00</option>
                                                <option value="8">07:00</option>
                                                <option value="9">08:00</option>
                                                <option value="10">09:00</option>
                                                <option value="11">10:00</option>
                                                <option value="12">11:00</option>
                                                <option value="13">12:00</option>
                                                <option value="14">13:00</option>
                                                <option value="15">14:00</option>
                                                <option value="16">15:00</option>
                                                <option value="17">16:00</option>
                                                <option value="18">17:00</option>
                                                <option value="19">18:00</option>
                                                <option value="20">19:00</option>
                                                <option value="21">20:00</option>
                                                <option value="22">21:00</option>
                                                <option value="23">22:00</option>
                                                <option value="24">23:00</option>
                                            </select>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356" width="25" height="25">
                                            <path fill="#828C98" d="M35.475 36.508V10h45.706v26.508h98.638V10h45.706v26.508H261V271H0V36.508h35.475zm30.413-11.215h-15.12v31.605h15.12V25.293zm144.344 0h-15.12v31.605h15.12V25.293zM15.293 255.707h230.414v-151.91H15.293v151.91zm0-167.203h230.414V51.8h-20.182v20.39h-45.706v-20.39H81.181v20.39H35.475v-20.39H15.293v36.703z"></path>
                                            <path fill="#828C98" d="M117.866 123.678h25.266v15.293h-25.266v-15.293zM74.821 123.678h25.266v15.293H74.821v-15.293zM31.777 123.678h25.266v15.293H31.777v-15.293zM203.96 156.812h25.266v15.293H203.96v-15.293zM160.911 156.812h25.266v15.293h-25.266v-15.293zM117.866 156.812h25.266v15.293h-25.266v-15.293zM74.821 156.812h25.266v15.293H74.821v-15.293zM31.777 156.812h25.266v15.293H31.777v-15.293zM203.96 189.947h25.266v15.293H203.96v-15.293zM160.911 189.947h25.266v15.293h-25.266v-15.293zM117.866 189.947h25.266v15.293h-25.266v-15.293zM74.821 189.947h25.266v15.293H74.821v-15.293zM31.777 189.947h25.266v15.293H31.777v-15.293zM203.96 223.082h25.266v15.293H203.96v-15.293zM160.911 223.082h25.266v15.293h-25.266v-15.293zM117.866 223.082h25.266v15.293h-25.266v-15.293zM74.821 223.082h25.266v15.293H74.821v-15.293z"></path>
                                            <path fill="#828C98" d="M162.043 256.341l71.182-71.193a10.704 10.704 0 017.628-3.148c2.891 0 5.598 1.117 7.629 3.148l6.463 6.465a10.707 10.707 0 013.149 7.629c0 2.888-1.118 5.689-3.149 7.718l-41.527 41.624h131.933c5.949 0 10.649 4.657 10.649 10.608v9.14c0 5.951-4.7 11.078-10.649 11.078H212.947l41.997 41.856c2.03 2.032 3.149 4.668 3.149 7.558 0 2.886-1.119 5.561-3.149 7.592l-6.463 6.444c-2.032 2.033-4.739 3.14-7.63 3.14a10.713 10.713 0 01-7.627-3.154l-71.183-71.192a10.714 10.714 0 01-3.149-7.652c-.006-2.903 1.112-5.626 3.151-7.661z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div>
                                <button class="btn w-full" type="submit"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "search")}}</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-page-title mt-65 mb-55">
        <div class="container main-page-title__container">
            <div>
                <h1>{{App\Models\Translation::getTranslWord($words, $sel_lang, "service_number_one_in_oae")}}</h1>
            </div>
        </div>
    </div>
    @if(count($cars->where('car_class', 'vip')))
        <div class="container">
            <div class="car-block mb-85 md:mb-50">
                <div class="car-block__top">
                    <h2 class="block-title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "vip_class")}}</h2><a class="arrow-link car-block__link" href="{{route('sort_cars_by_class', 'vip')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "all_cars_vip_class")}}</a>
                </div>
                <div class="car-cards">
                        @foreach($cars->where('car_class', 'vip') as $car)
                        <a class="car-card mb-20" href="{{route('one_car.page', $car->alias)}}">
                        <div class="car-card__img"><img src="{{$car->images->sortBy('order_id')->first()->url}}" alt=""></div>
                        <div class="car-card__content">
                            <div><span>{{$car->carBrand->name}} {{$car->model}}</span><span>{{$car->year_created}}</span></div>
                            @if($car->rent_type=="simple_rent")
                                <div><span>{{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->price_day_30,$car_currency->dollar_rate) : ''}} {{$car_currency->symbol}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_one-day")}}</span></div>
                            @endif
                        </div></a>
                        @endforeach
                </div>
            </div>
        </div>
    @endif
    <div class="banner1">
        <div class="container banner1__container">
            <div class="banner1__content">
                <div class="banner1__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "realy_luxury_cars")}}</div><a class="banner1-btn" href="{{route('sort_cars_by_class', 'vip')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "select")}}</a>
            </div>
        </div>
    </div>
    @if(count($cars->where('car_class', 'elites')))
        <div class="container">
            <div class="car-block mb-85 mt-85 md:mb-50 md:mt-50">
                <div class="car-block__top">
                    <h2 class="block-title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "elit_class")}}</h2><a class="arrow-link car-block__link" href="{{route('sort_cars_by_class', 'elites')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "all_elit_cars")}}</a>
                </div>
                <div class="car-cards">
                    @foreach($cars->where('car_class', 'elites') as $car)
                        <a class="car-card mb-20" href="{{route('one_car.page', $car->alias)}}">
                            <div class="car-card__img"><img src="{{$car->images->sortBy('order_id')->first()->url}}" alt=""></div>
                            <div class="car-card__content">
                                <div><span>{{$car->carBrand->name}} {{$car->model}}</span><span>{{$car->year_created}}</span></div>
                                @if($car->rent_type=="simple_rent")
                                    <div><span>{{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->price_day_30,$car_currency->dollar_rate) : ''}} {{$car_currency->symbol}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_one-day")}}</span></div>
                                @endif
                            </div></a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if(count($cars->where('car_class', 'suv')))
        <div class="container">
            <div class="car-block mb-85 mt-85 md:mb-50 md:mt-50">
                <div class="car-block__top">
                    <h2 class="block-title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "suvs")}}</h2><a class="arrow-link car-block__link" href="{{route('sort_cars_by_class', 'suv')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "all_suvs")}}</a>
                </div>
                <div class="car-cards">
                    @foreach($cars->where('car_class', 'suv') as $car)
                        <a class="car-card mb-20" href="{{route('one_car.page', $car->alias)}}">
                            <div class="car-card__img"><img src="{{$car->images->sortBy('order_id')->first()->url}}" alt=""></div>
                            <div class="car-card__content">
                                <div><span>{{$car->carBrand->name}} {{$car->model}}</span><span>{{$car->year_created}}</span></div>
                                @if($car->rent_type=="simple_rent")
                                    <div><span>{{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->price_day_30,$car_currency->dollar_rate) : '0'}} {{$car_currency->symbol}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_one-day")}}</span></div>
                                @endif
                            </div></a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <div class="car-block mb-55 mt-85 md:mt-50">
        <div class="container">
            <div class="car-block__top mb-0">
                <h2 class="block-title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "browse_brand")}}</h2><a class="arrow-link car-block__link" href="{{route('brands.page')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "all_brands")}}</a>
            </div>
        </div>
        <div class="car-carousel">
            <div class="container">
                <div class="owl-carousel owl-carousel--my">
                    @foreach($brands as $brand)
                    <a class="car-brand" href="{{route('sort_cars_by_brand', $brand->alias)}}">
                        <div class="car-brand__img">
                            <img src="{{$brand->icon}}" alt="">
                        </div>
                        <div class="car-brand__content">
                            <span>{{$brand->name}}</span>
                            <span>{{count($brand->cars()->where('rent_type', 'simple_rent')->where('saved', true)->get())}} {{App\Models\Translation::getTranslWord($words, $sel_lang, "auto")}}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="banner2">
        <div class="container">
            <div class="banner2__content">
                <div class="banner2__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rent_car_on")}} <span>RENTAL СARS.<span>one</span></span></div>
                <div class="banner2__items">
                    <div class="banner2__item"><span><span>{{$setting->companies}}</span> {{App\Models\Translation::getTranslWord($words, $sel_lang, "companies")}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "by_car_rental")}}</span></div>
                    <div class="banner2__item"><span><span>{{$setting->auto}}</span> {{App\Models\Translation::getTranslWord($words, $sel_lang, "auto")}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "for_rent")}}</span></div>
                    <div class="banner2__item"><span><span>{{$setting->clients}}</span> {{App\Models\Translation::getTranslWord($words, $sel_lang, "clients")}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "booked_car")}}</span></div>
                    <div class="banner2__item"><span><span>{{$setting->seconds}}</span> {{App\Models\Translation::getTranslWord($words, $sel_lang, "second")}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "car_booking_time")}}</span></div>
                </div>
            </div>
        </div>
    </div>
    @if(count($cars->where('car_class', 'super_car')))
        <div class="container">
            <div class="car-block mb-85 mt-85 md:mb-50 md:mt-50">
                <div class="car-block__top">
                    <h2 class="block-title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "supercars")}}</h2><a class="arrow-link car-block__link" href="{{route('sort_cars_by_class', 'super_car')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "all_supercars")}}</a>
                </div>
                <div class="car-cards">
                    @foreach($cars->where('car_class', 'super_car') as $car)
                        <a class="car-card mb-20" href="{{route('one_car.page', $car->alias)}}">
                            <div class="car-card__img"><img src="{{$car->images->sortBy('order_id')->first()->url}}" alt=""></div>
                            <div class="car-card__content">
                                <div><span>{{$car->carBrand->name}} {{$car->model}}</span><span>{{$car->year_created}}</span></div>
                                @if($car->rent_type=="simple_rent")
                                    <div><span>{{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->price_day_30,$car_currency->dollar_rate) : ''}} {{$car_currency->symbol}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_one-day")}}</span></div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if(count($cars->where('car_class', 'sport_class')))
        <div class="container">
            <div class="car-block mb-85 mt-85 md:mb-50 md:mt-50">
                <div class="car-block__top">
                        <h2 class="block-title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "sport_class")}}</h2><a class="arrow-link car-block__link" href="{{route('sort_cars_by_class', 'sport_class')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "all_cars_sport_class")}}</a>
                </div>
                <div class="car-cards">
                    @foreach($cars->where('car_class', 'sport_class') as $car)
                        <a class="car-card mb-20" href="{{route('one_car.page', $car->alias)}}">
                            <div class="car-card__img"><img src="{{$car->images->sortBy('order_id')->first()->url}}" alt=""></div>
                            <div class="car-card__content">
                                <div><span>{{$car->carBrand->name}} {{$car->model}}</span><span>{{$car->year_created}}</span></div>
                                @if($car->rent_type=="simple_rent")
                                    <div><span>{{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->price_day_30,$car_currency->dollar_rate) : ''}} {{$car_currency->symbol}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_one-day")}}</span></div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <div class="banner3">
        <div class="container">
            <div class="banner3__content">
                <div class="banner3__title"><span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "feel_sport_car_drive")}}</span></span></div><a class="arrow-link arrow-link--white banner3__link" href="{{route('sort_cars_by_class', 'sport_class')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_sport_car")}}</a>
            </div>
        </div>
    </div>
    @if(count($cars->where('car_class', 'business')))
        <div class="container">
            <div class="car-block mb-85 mt-85 md:mb-50 md:mt-50">
                <div class="car-block__top">
                    <h2 class="block-title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "business_class")}}</h2><a class="arrow-link car-block__link" href="{{route('sort_cars_by_class', 'business')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "all_business_cars2")}}</a>
                </div>
                <div class="car-cards">
                    @foreach($cars->where('car_class', 'business') as $car)
                        <a class="car-card mb-20" href="{{route('one_car.page', $car->alias)}}">
                            <div class="car-card__img"><img src="{{$car->images->sortBy('order_id')->first()->url}}" alt=""></div>
                            <div class="car-card__content">
                                <div><span>{{$car->carBrand->name}} {{$car->model}}</span><span>{{$car->year_created}}</span></div>
                                @if($car->rent_type=="simple_rent")
                                    <div><span>{{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->price_day_30,$car_currency->dollar_rate) : ''}} {{$car_currency->symbol}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_one-day")}}</span></div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <div class="banner4">
        <div class="container">
            <div class="banner4__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "best_solution_for_busines")}}</div><a class="banner4-btn" href="{{route('sort_cars_by_class', 'business')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "all_business_cars")}}</a>
        </div>
    </div>
    @if(count($cars->where('car_class', 'middle')))
        <div class="container">
            <div class="car-block mb-85 mt-85 md:mb-50 md:mt-50">
                <div class="car-block__top">
                    <h2 class="block-title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "middle_class")}}</h2><a class="arrow-link car-block__link" href="{{route('sort_cars_by_class', 'middle')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "all_middle_class_cars")}}</a>
                </div>
                <div class="car-cards">
                    @foreach($cars->where('car_class', 'middle') as $car)
                        <a class="car-card mb-20" href="{{route('one_car.page', $car->alias)}}">
                            <div class="car-card__img"><img src="{{$car->images->sortBy('order_id')->first()->url}}" alt=""></div>
                            <div class="car-card__content">
                                <div><span>{{$car->carBrand->name}} {{$car->model}}</span><span>{{$car->year_created}}</span></div>
                                @if($car->rent_type=="simple_rent")
                                    <div><span>{{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->price_day_30,$car_currency->dollar_rate) : ''}} {{$car_currency->symbol}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_one-day")}}</span></div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if(count($cars->where('car_class', 'econom')))
        <div class="container">
            <div class="car-block mb-85 mt-85 md:mb-50 md:mt-50">
                <div class="car-block__top">
                    <h2 class="block-title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "econom_class")}}</h2><a class="arrow-link car-block__link" href="{{route('sort_cars_by_class', 'econom')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "all_aconomy_class_cars")}}</a>
                </div>
                <div class="car-cards">
                    @foreach($cars->where('car_class', 'econom') as $car)
                        <a class="car-card mb-20" href="{{route('one_car.page', $car->alias)}}">
                            <div class="car-card__img"><img src="{{$car->images->sortBy('order_id')->first()->url}}" alt=""></div>
                            <div class="car-card__content">
                                <div><span>{{$car->carBrand->name}} {{$car->model}}</span><span>{{$car->year_created}}</span></div>
                                @if($car->rent_type=="simple_rent")
                                    <div><span>{{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->price_day_30,$car_currency->dollar_rate) : ''}} {{$car_currency->symbol}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_one-day")}}</span></div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if(count($cars->where('car_class', 'microbus')))
        <div class="container">
            <div class="car-block mb-85 mt-85 md:mb-50 md:mt-50">
                <div class="car-block__top">
                    <h2 class="block-title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "minibuses")}}</h2><a class="arrow-link car-block__link" href="{{route('sort_cars_by_class', 'microbus')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "all_minibuses")}}</a>
                </div>
                <div class="car-cards">
                    @foreach($cars->where('car_class', 'microbus') as $car)
                        <a class="car-card mb-20" href="{{route('one_car.page', $car->alias)}}">
                            <div class="car-card__img"><img src="{{$car->images->sortBy('order_id')->first()->url}}" alt=""></div>
                            <div class="car-card__content">
                                <div><span>{{$car->carBrand->name}} {{$car->model}}</span><span>{{$car->year_created}}</span></div>
                                @if($car->rent_type=="simple_rent")
                                    <div><span>{{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->price_day_30,$car_currency->dollar_rate) : ''}} {{$car_currency->symbol}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_one-day")}}</span></div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <div class="banner5">
        <div class="container">
            <div class="banner5__content">
                <div class="banner5__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "learn_about_benefits")}}</div><a class="btn-outlined btn-outlined--theme-accent2 banner5__btn modal-open" href="#partner">{{App\Models\Translation::getTranslWord($words, $sel_lang, "contact_us")}}</a>
            </div>
        </div>
    </div>
    <div class="info-block">
        <div class="container clearfix">
            <div class="info-block__content">
                <h2 class="info-block__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "leading_car_rental_service")}}</h2>
                <div class="info-block__text">
                    <p>{{App\Models\Translation::getTranslWord($words, $sel_lang, "leading_car_rental_service_text_1")}}</p>
                    <p>{{App\Models\Translation::getTranslWord($words, $sel_lang, "leading_car_rental_service_text_2")}}</p>
                    <p>{{App\Models\Translation::getTranslWord($words, $sel_lang, "leading_car_rental_service_text_3")}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="car-block mb-85 mt-50 md:mb-50 md:mt-0">
            <div class="car-block__top">
                <h2 class="block-title">{{$pages->where('alias', 'faq')->first()->getTranslation('name')}}</h2>
            </div>
            <div class="faq-section faq-section--dual">
                <ol class="faq-list">
                    @foreach($faqs[0] as $faq)
                        <li><a href="#">{{$faq->getTranslation('question')}}<i></i></a><span>{{$faq->getTranslation('answer')}}</span></li>
                    @endforeach
                </ol>
                <ol class="faq-list">
                    @foreach($faqs[1] as $faq)
                        <li><a href="#">{{$faq->getTranslation('question')}}<i></i></a><span>{{$faq->getTranslation('answer')}}</span></li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
    <div class="container">
        @if (count($current_page->banners) > 0)
            @foreach($current_page->banners as $banner)
            <div class="ad-placeholder mt-150 mb-200 md:mt-80 md:mb-100" style="display:block;" >
                @if($banner->type=="image_link")
                    <a href="{{$banner->src}}" target="_blank"><img src="{{$banner->image}}" style="width: 100%;"></a>
                @else
                    {!! $banner->code !!}
                @endif
            </div>
            @endforeach
        @else
            <div class="ad-placeholder mt-150 mb-200 md:mt-80 md:mb-100"></div>
        @endif
    </div>
</main>
@endsection