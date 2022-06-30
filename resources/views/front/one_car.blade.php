@extends('layouts.app')
@section('content')
    <!--Main content-->
    <main class="main">
        <div class="container">
            <div class="top-navigation">
                <div><a class="arrow-link arrow-link--reverse" href="{{route('cars.page')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "return_to_search")}}</a>
                </div>
                <div>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{route('main.page')}}">{{$pages->where('alias', 'main')->first()->getTranslation('name')}}</a></li>
                            <li><a href="{{route('brands.page')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "car_brands")}}</a></li>
                            <li>
                                <a href="{{route('sort_cars_by_brand', $car->carBrand->name)}}">{{$car->carBrand->name}}</a>
                            </li>
                            <li>{{$car->carBrand->name}} {{$car->model}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="single-hero mb-20">
                <div class="single-hero__top">
                    <div class="single-hero__title"><img src="{{$car->carBrand->icon}}"
                                                         alt="" style="width:30px;">{{$car->carBrand->name}} {{$car->model}}</div>
                    <div class="share">
                        <button class="share__btn share__link share__link--share"></button>
                        <div class="share__links">
                            <?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
                            <a class="share__link share__link--facebook" href="https://www.facebook.com/sharer/sharer.php?u={{$actual_link}}&t={{$car->carBrand->name}} {{$car->model}}" target="_blank" rel="noopener"></a>

                                <a class="share__link share__link--twitter" href="https://twitter.com/share?text={{$actual_link}}"></a>
                            <a class="share__link share__link--whatsapp" href="whatsapp://send?text={{$actual_link}}"></a><a
                                    class="share__link share__link--messenger" href="fb-messenger://share?link={{$actual_link}}"></a><a
                                    class="share__link share__link--viber" href="viber://forward?text={{$actual_link}}"></a><a
                                    class="share__link share__link--wechat" href="#"></a></div>
                    </div>
                </div>
                <div class="single-hero__sides">
                    <div class="single-hero__side-1">
                        <div class="single-carousels">
                            <div class="single-carousels__main single-owl-carousel">
                                <div class="owl-carousel">

                                    @foreach($car->images->sortBy('order_id') as $image)

                                        @if($loop->iteration==1)
                                            <a class="single-carousels__main-item {{$car->video ? "single-carousels__main-item--video" : ''}}"
                                               href="{{$car->video ? $car->video : asset($image->url)}}" data-fancybox="gallery"
                                               data-caption="{{$car->carBrand->name}} {{$car->model}} - {{App\Models\Translation::getTranslWord($words, $sel_lang, "video")}}"><img
                                                        src="{{asset($image->url)}}" alt=""></a>
                                        @else
                                            <a class="single-carousels__main-item" href="{{asset($image->url)}}"
                                               data-fancybox="gallery" data-caption="{{$car->carBrand->name}} {{$car->model}} - Фото 1"><img
                                                        src="{{asset($image->url)}}" alt=""></a>
                                        @endif

                                    @endforeach
                                    {{--<a class="single-carousels__main-item single-carousels__main-item--video" href="https://www.youtube.com/watch?v=o3d_kM4uX0E" data-fancybox="gallery" data-caption="BMW X5 M Sport - Видео"><img src="img/cars/1/0-medium.jpg" alt=""></a><a class="single-carousels__main-item" href="img/cars/1/1-big.jpg" data-fancybox="gallery" data-caption="BMW X5 M Sport - Фото 1"><img src="img/cars/1/1-medium.jpg" alt=""></a><a class="single-carousels__main-item" href="img/cars/1/2-big.jpg" data-fancybox="gallery" data-caption="BMW X5 M Sport - Фото 2"><img src="img/cars/1/2-medium.jpg" alt=""></a><a class="single-carousels__main-item" href="img/cars/1/3-big.jpg" data-fancybox="gallery" data-caption="BMW X5 M Sport - Фото 3"><img src="img/cars/1/3-medium.jpg" alt=""></a>--}}
                                </div>
                                <div class="single-carousels__main-counter"><span>0</span><span>0</span></div>
                            </div>
                            <div class="single-carousels__nav">
                                <div class="single-carousels__nav-inner">
                                    <div class="owl-carousel">
                                        @foreach($car->images->sortBy('order_id') as $image)
                                            <div class="single-carousels__nav-item {{$loop->iteration==1&&$car->video ? 'single-carousels__nav-item--video' : ''}}">
                                                <img src="{{$image->url}}" alt=""></div>
                                        @endforeach
                                        {{--<div class="single-carousels__nav-item single-carousels__nav-item--video"><img src="img/cars/1/0-small.jpg" alt=""></div>--}}
                                        {{--<div class="single-carousels__nav-item"><img src="img/cars/1/1-small.jpg" alt=""></div>--}}
                                        {{--<div class="single-carousels__nav-item"><img src="img/cars/1/2-small.jpg" alt=""></div>--}}
                                        {{--<div class="single-carousels__nav-item"><img src="img/cars/1/3-small.jpg" alt=""></div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="single-hero__side-2"
                          action="{{$car->rent_type=="with_driver" ? route('booking_cars_with_driver', $car->id) : route('booking_cars_simple_rent', $car->id)}}"
                          method="GET">
                        @if($car->rent_type=="simple_rent")
                            <div class="single-hero__price">
                                <span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "price_per_one_day")}}</span><span>{{$car_currency->symbol}} {{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->price_day_30,$car_currency->dollar_rate) : '0'}}</span><span>+ {{$car_currency->symbol}}{{App\Models\Currency::CurrencyConverter($car->getPriceFromPercentVat($car->simpleRent->price_day_30, $setting->vat_tax),$car_currency->dollar_rate)}} VAT Tax</span>
                            </div>
                        @endif
                        @if($car->rent_type=="simple_rent")
                            <div class="check mb-40 xl:mb-30 xxl:mb-20">{{$car->simpleRent ? $car->simpleRent->mileage_limit : '0'}}
                                {{App\Models\Translation::getTranslWord($words, $sel_lang, "km_included_price_day")}}
                            </div>

                            <div class="single-hero__inputs">
                                <div>
                                    <div>
                                        <div class="input-group input-group--with-label input-group--with-icon input-group--input-bold input-group--input-fz-sm mb-0 hidden-desktop">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_from")}}</label>
                                            <input type="date" data-datepicker-mob-from name="date_from" value="{{Session::get('from_date')}}" required>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356"
                                                 width="25" height="25">
                                                <path fill="#828C98"
                                                      d="M320.525 36.508V10h-45.706v26.508h-98.638V10h-45.706v26.508H95V271h261V36.508h-35.475zm-30.413-11.215h15.12v31.605h-15.12V25.293zm-144.344 0h15.12v31.605h-15.12V25.293zm194.939 230.414H110.293v-151.91h230.414v151.91zm0-167.203H110.293V51.8h20.182v20.39h45.706v-20.39h98.638v20.39h45.706v-20.39h20.182v36.703z"></path>
                                                <path fill="#828C98"
                                                      d="M238.134 123.678h-25.266v15.293h25.266v-15.293zM281.179 123.678h-25.266v15.293h25.266v-15.293zM324.223 123.678h-25.266v15.293h25.266v-15.293zM152.04 156.812h-25.266v15.293h25.266v-15.293zM195.089 156.812h-25.266v15.293h25.266v-15.293zM238.134 156.812h-25.266v15.293h25.266v-15.293zM281.179 156.812h-25.266v15.293h25.266v-15.293zM324.223 156.812h-25.266v15.293h25.266v-15.293zM152.04 189.947h-25.266v15.293h25.266v-15.293zM195.089 189.947h-25.266v15.293h25.266v-15.293zM238.134 189.947h-25.266v15.293h25.266v-15.293zM281.179 189.947h-25.266v15.293h25.266v-15.293zM324.223 189.947h-25.266v15.293h25.266v-15.293zM152.04 223.082h-25.266v15.293h25.266v-15.293zM195.089 223.082h-25.266v15.293h25.266v-15.293zM238.134 223.082h-25.266v15.293h25.266v-15.293zM281.179 223.082h-25.266v15.293h25.266v-15.293z"></path>
                                                <path fill="#828C98"
                                                      d="M193.957 256.341l-71.182-71.193a10.704 10.704 0 00-7.628-3.148 10.708 10.708 0 00-7.629 3.148l-6.463 6.465a10.708 10.708 0 00-3.15 7.629c0 2.888 1.12 5.689 3.15 7.718l41.527 41.624H10.649C4.7 248.584 0 253.241 0 259.192v9.14c0 5.951 4.7 11.078 10.649 11.078h132.404l-41.997 41.856c-2.03 2.032-3.149 4.668-3.149 7.558 0 2.886 1.119 5.561 3.149 7.592l6.463 6.444c2.032 2.033 4.739 3.14 7.63 3.14 2.887 0 5.595-1.122 7.627-3.154l71.183-71.192a10.714 10.714 0 003.149-7.652c.006-2.903-1.112-5.626-3.151-7.661z"></path>
                                            </svg>
                                        </div>
                                        <div class="input-group input-group--with-label input-group--with-icon input-group--input-bold input-group--input-fz-sm mb-0 hidden-mobile">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_from")}}</label>
                                            <input type="text" data-datepicker-from name="date_from"
                                                   data-date-from-to-id="date-from-to" value="{{Session::get('from_date')}}" required>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356"
                                                 width="25" height="25">
                                                <path fill="#828C98"
                                                      d="M320.525 36.508V10h-45.706v26.508h-98.638V10h-45.706v26.508H95V271h261V36.508h-35.475zm-30.413-11.215h15.12v31.605h-15.12V25.293zm-144.344 0h15.12v31.605h-15.12V25.293zm194.939 230.414H110.293v-151.91h230.414v151.91zm0-167.203H110.293V51.8h20.182v20.39h45.706v-20.39h98.638v20.39h45.706v-20.39h20.182v36.703z"></path>
                                                <path fill="#828C98"
                                                      d="M238.134 123.678h-25.266v15.293h25.266v-15.293zM281.179 123.678h-25.266v15.293h25.266v-15.293zM324.223 123.678h-25.266v15.293h25.266v-15.293zM152.04 156.812h-25.266v15.293h25.266v-15.293zM195.089 156.812h-25.266v15.293h25.266v-15.293zM238.134 156.812h-25.266v15.293h25.266v-15.293zM281.179 156.812h-25.266v15.293h25.266v-15.293zM324.223 156.812h-25.266v15.293h25.266v-15.293zM152.04 189.947h-25.266v15.293h25.266v-15.293zM195.089 189.947h-25.266v15.293h25.266v-15.293zM238.134 189.947h-25.266v15.293h25.266v-15.293zM281.179 189.947h-25.266v15.293h25.266v-15.293zM324.223 189.947h-25.266v15.293h25.266v-15.293zM152.04 223.082h-25.266v15.293h25.266v-15.293zM195.089 223.082h-25.266v15.293h25.266v-15.293zM238.134 223.082h-25.266v15.293h25.266v-15.293zM281.179 223.082h-25.266v15.293h25.266v-15.293z"></path>
                                                <path fill="#828C98"
                                                      d="M193.957 256.341l-71.182-71.193a10.704 10.704 0 00-7.628-3.148 10.708 10.708 0 00-7.629 3.148l-6.463 6.465a10.708 10.708 0 00-3.15 7.629c0 2.888 1.12 5.689 3.15 7.718l41.527 41.624H10.649C4.7 248.584 0 253.241 0 259.192v9.14c0 5.951 4.7 11.078 10.649 11.078h132.404l-41.997 41.856c-2.03 2.032-3.149 4.668-3.149 7.558 0 2.886 1.119 5.561 3.149 7.592l6.463 6.444c2.032 2.033 4.739 3.14 7.63 3.14 2.887 0 5.595-1.122 7.627-3.154l71.183-71.192a10.714 10.714 0 003.149-7.652c.006-2.903-1.112-5.626-3.151-7.661z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="input-group input-group--with-label input-group--with-icon input-group--input-bold input-group--input-fz-sm mb-0 hidden-desktop">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_to")}}</label>
                                            <input type="date" data-datepicker-mob-to name="date_to"  value="{{Session::get('to_date')}}" required>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356"
                                                 width="25" height="25">
                                                <path fill="#828C98"
                                                      d="M35.475 36.508V10h45.706v26.508h98.638V10h45.706v26.508H261V271H0V36.508h35.475zm30.413-11.215h-15.12v31.605h15.12V25.293zm144.344 0h-15.12v31.605h15.12V25.293zM15.293 255.707h230.414v-151.91H15.293v151.91zm0-167.203h230.414V51.8h-20.182v20.39h-45.706v-20.39H81.181v20.39H35.475v-20.39H15.293v36.703z"></path>
                                                <path fill="#828C98"
                                                      d="M117.866 123.678h25.266v15.293h-25.266v-15.293zM74.821 123.678h25.266v15.293H74.821v-15.293zM31.777 123.678h25.266v15.293H31.777v-15.293zM203.96 156.812h25.266v15.293H203.96v-15.293zM160.911 156.812h25.266v15.293h-25.266v-15.293zM117.866 156.812h25.266v15.293h-25.266v-15.293zM74.821 156.812h25.266v15.293H74.821v-15.293zM31.777 156.812h25.266v15.293H31.777v-15.293zM203.96 189.947h25.266v15.293H203.96v-15.293zM160.911 189.947h25.266v15.293h-25.266v-15.293zM117.866 189.947h25.266v15.293h-25.266v-15.293zM74.821 189.947h25.266v15.293H74.821v-15.293zM31.777 189.947h25.266v15.293H31.777v-15.293zM203.96 223.082h25.266v15.293H203.96v-15.293zM160.911 223.082h25.266v15.293h-25.266v-15.293zM117.866 223.082h25.266v15.293h-25.266v-15.293zM74.821 223.082h25.266v15.293H74.821v-15.293z"></path>
                                                <path fill="#828C98"
                                                      d="M162.043 256.341l71.182-71.193a10.704 10.704 0 017.628-3.148c2.891 0 5.598 1.117 7.629 3.148l6.463 6.465a10.707 10.707 0 013.149 7.629c0 2.888-1.118 5.689-3.149 7.718l-41.527 41.624h131.933c5.949 0 10.649 4.657 10.649 10.608v9.14c0 5.951-4.7 11.078-10.649 11.078H212.947l41.997 41.856c2.03 2.032 3.149 4.668 3.149 7.558 0 2.886-1.119 5.561-3.149 7.592l-6.463 6.444c-2.032 2.033-4.739 3.14-7.63 3.14a10.713 10.713 0 01-7.627-3.154l-71.183-71.192a10.714 10.714 0 01-3.149-7.652c-.006-2.903 1.112-5.626 3.151-7.661z"></path>
                                            </svg>
                                        </div>
                                        <div class="input-group input-group--with-label input-group--with-icon input-group--input-bold input-group--input-fz-sm mb-0 hidden-mobile">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_to")}}</label>
                                            <input type="text" data-datepicker-to name="date_to"
                                                   data-date-from-to-id="date-from-to"  value="{{Session::get('to_date')}}" required>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356"
                                                 width="25" height="25">
                                                <path fill="#828C98"
                                                      d="M35.475 36.508V10h45.706v26.508h98.638V10h45.706v26.508H261V271H0V36.508h35.475zm30.413-11.215h-15.12v31.605h15.12V25.293zm144.344 0h-15.12v31.605h15.12V25.293zM15.293 255.707h230.414v-151.91H15.293v151.91zm0-167.203h230.414V51.8h-20.182v20.39h-45.706v-20.39H81.181v20.39H35.475v-20.39H15.293v36.703z"></path>
                                                <path fill="#828C98"
                                                      d="M117.866 123.678h25.266v15.293h-25.266v-15.293zM74.821 123.678h25.266v15.293H74.821v-15.293zM31.777 123.678h25.266v15.293H31.777v-15.293zM203.96 156.812h25.266v15.293H203.96v-15.293zM160.911 156.812h25.266v15.293h-25.266v-15.293zM117.866 156.812h25.266v15.293h-25.266v-15.293zM74.821 156.812h25.266v15.293H74.821v-15.293zM31.777 156.812h25.266v15.293H31.777v-15.293zM203.96 189.947h25.266v15.293H203.96v-15.293zM160.911 189.947h25.266v15.293h-25.266v-15.293zM117.866 189.947h25.266v15.293h-25.266v-15.293zM74.821 189.947h25.266v15.293H74.821v-15.293zM31.777 189.947h25.266v15.293H31.777v-15.293zM203.96 223.082h25.266v15.293H203.96v-15.293zM160.911 223.082h25.266v15.293h-25.266v-15.293zM117.866 223.082h25.266v15.293h-25.266v-15.293zM74.821 223.082h25.266v15.293H74.821v-15.293z"></path>
                                                <path fill="#828C98"
                                                      d="M162.043 256.341l71.182-71.193a10.704 10.704 0 017.628-3.148c2.891 0 5.598 1.117 7.629 3.148l6.463 6.465a10.707 10.707 0 013.149 7.629c0 2.888-1.118 5.689-3.149 7.718l-41.527 41.624h131.933c5.949 0 10.649 4.657 10.649 10.608v9.14c0 5.951-4.7 11.078-10.649 11.078H212.947l41.997 41.856c2.03 2.032 3.149 4.668 3.149 7.558 0 2.886-1.119 5.561-3.149 7.592l-6.463 6.444c-2.032 2.033-4.739 3.14-7.63 3.14a10.713 10.713 0 01-7.627-3.154l-71.183-71.192a10.714 10.714 0 01-3.149-7.652c-.006-2.903 1.112-5.626 3.151-7.661z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="date-from-to date-from-to--center" id="date-from-to">
                                        <div class="flatpickr-hero" data-elem-from="[data-datepicker-from]"
                                             data-elem-to="[data-datepicker-to]" data-hidden data-lang="ru"></div>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "time")}}</label>
                                            <div class="custom-select-wrapper">
                                                <select class="custom-select custom-select--bold custom-select--uppercase"
                                                        name="time"
                                                        data-dropdown-css-class="custom-select-dropdown custom-select-dropdown--bold custom-select-dropdown--uppercase">
                                                    <option label="Выберите из списка"></option>
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
                                        </div>
                                    </div>
                                    <div>
                                        <div class="checkbox-group-2 checkbox-group-2--small checkbox-group-2--centered">
                                            <input id="single-return-in-another-location" type="checkbox"
                                                   name="another_location">
                                            <label for="single-return-in-another-location">{{App\Models\Translation::getTranslWord($words, $sel_lang, "return_another_place")}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="single-hero__button">
                            @if(!auth()->user())
                                <button data-url="{{route('one_car.page', $car->alias)}}#login" class="btn w-full car-page-login"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "send_request2")}}</span></button>
                            @else
                                <button class="btn w-full"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "send_request2")}}</span></button>
                            @endif

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="single-section-with-sidebar">
            <div class="container single-section-with-sidebar__container">
                <div class="single-section-with-sidebar__content">
                    <div class="single-section-with-sidebar__content-inner">
                        <div class="section-with-header">
                            <div class="section-with-header__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "characteristic")}}</div>
                            <div class="section-with-header__characteristics">
                                <div class="characteristic characteristic--ic-year">
                                    <span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "year_issue")}}</span><span>{{$car->year_created}}</span></div>
                                <div class="characteristic characteristic--ic-horsepower">
                                    <span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "horsepower")}}</span><span>{{$car->horsepower}}</span></div>
                                <div class="characteristic characteristic--ic-number-of-seats">
                                    <span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "number_of_seats")}}</span><span>{{$car->seats_number}}</span></div>
                                <div class="characteristic characteristic--ic-interior-color">
                                    <span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "interior_color")}}</span><span>{{$car->cabin_color}}</span></div>
                                <div class="characteristic characteristic--ic-engine">
                                    <span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "engine")}}</span><span>{{$car->engine}}</span></div>
                                <div class="characteristic characteristic--ic-transmission"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "transmission")}}</span><span>
                                                @if($car->transmission=="1")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "mechanical")}}
                                        @endif
                                        @if($car->transmission=="2")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "automat")}}
                                        @endif

                                            </span></div>
                                <div class="characteristic characteristic--ic-speed">
                                    <span>0-100 {{App\Models\Translation::getTranslWord($words, $sel_lang, "km_per_hour")}}</span><span>{{$car->time_to_100}}</span></div>
                                <div class="characteristic characteristic--ic-car-color">
                                    <span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "car_color")}}</span><span>{{$car->color}}</span></div>
                                <div class="characteristic characteristic--ic-max-speed">
                                    <span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "maximum_speed")}}</span><span>{{$car->max_speed}}</span></div>
                                <div class="characteristic characteristic--ic-trunk-capacity"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "trunk_capacity")}}</span><span>

                                        @if($car->trunk_capacity=="1")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "1_small_bag")}}
                                        @endif
                                        @if($car->trunk_capacity=="2")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "1_large_bag")}}
                                        @endif
                                        @if($car->trunk_capacity=="3")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "trunk_capacity_3")}}
                                        @endif
                                        @if($car->trunk_capacity=="4")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "trunk_capacity_4")}}
                                        @endif
                                        @if($car->trunk_capacity=="5")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "trunk_capacity_5")}}
                                        @endif
                                            </span></div>
                            </div>
                        </div>

                        <div class="single-section-with-sidebar__info mb-20 lg:mb-0">
                            @if($car->rent_type=="simple_rent")
                                <div class="section-with-header mb-20">
                                    <div class="section-with-header__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rent_terms")}}</div>
                                    <table class="single-section-with-sidebar__table">
                                        <tr>
                                            <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "deposit")}}:</td>
                                            <td>{{$car_currency->symbol}} {{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->deposit,$car_currency->dollar_rate) : '0'}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "age_limit")}}:</td>
                                            <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "from")}} {{$car->simpleRent ? $car->simpleRent->age_limit : ''}} {{App\Models\Translation::getTranslWord($words, $sel_lang, "years")}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "cost_per_1_km")}}:</td>
                                            <td>{{$car_currency->symbol}} {{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->const_for_one_km,$car_currency->dollar_rate) : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "driving_experience")}}:</td>
                                            <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "from")}} {{$car->simpleRent ? $car->simpleRent->driving_experience : ''}} {{App\Models\Translation::getTranslWord($words, $sel_lang, "years")}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="section-with-header mb-20 lg:mb-0">
                                    <div class="section-with-header__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rent_price")}}</div>
                                    <table class="single-section-with-sidebar__table">
                                        <tr>
                                            <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 1 {{App\Models\Translation::getTranslWord($words, $sel_lang, "days")}}</td>
                                            <td>{{$car_currency->symbol}} {{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->price_day_1,$car_currency->dollar_rate) : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 2 {{App\Models\Translation::getTranslWord($words, $sel_lang, "days")}}</td>
                                            <td>{{$car_currency->symbol}} {{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->price_day_2,$car_currency->dollar_rate) : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 3-6 {{App\Models\Translation::getTranslWord($words, $sel_lang, "days")}}</td>
                                            <td>{{$car_currency->symbol}} {{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->price_day_3_6,$car_currency->dollar_rate) : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 7-13 {{App\Models\Translation::getTranslWord($words, $sel_lang, "days")}}</td>
                                            <td>{{$car_currency->symbol}} {{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->price_day_7_13,$car_currency->dollar_rate) : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 14-20 {{App\Models\Translation::getTranslWord($words, $sel_lang, "days")}}</td>
                                            <td>{{$car_currency->symbol}} {{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->price_day_14_20,$car_currency->dollar_rate) : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 21-29 {{App\Models\Translation::getTranslWord($words, $sel_lang, "days")}}</td>
                                            <td>{{$car_currency->symbol}} {{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->price_day_21_29,$car_currency->dollar_rate) : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 30 + {{App\Models\Translation::getTranslWord($words, $sel_lang, "days")}}</td>
                                            <td>{{$car_currency->symbol}} {{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent->price_day_30,$car_currency->dollar_rate) : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "additionally")}}</td>
                                            <td>+{{$car_currency->symbol}}{{App\Models\Currency::CurrencyConverter($car->getPriceFromPercentVat($car->simpleRent->price_day_1, $setting->vat_tax),$car_currency->dollar_rate)}} VAT Tax</td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($car->rent_type=="with_driver")
                                <div class="section-with-header md:mb-20">

                                    <div class="section-with-header__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rent_price")}}</div>
                                    <table class="single-section-with-sidebar__table">
                                        <tr>
                                            <td>За 1 час, {{$car_currency->symbol}}</td>
                                            <td>{{$car_currency->symbol}} {{$car->driverRent ? $car->driverRent->price_per_hour_1 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 2 часа, {{$car_currency->symbol}}</td>
                                            <td>{{$car_currency->symbol}} {{$car->driverRent ? $car->driverRent->price_per_hour_2 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 3 часа, {{$car_currency->symbol}}</td>
                                            <td>{{$car_currency->symbol}} {{$car->driverRent ? $car->driverRent->price_per_hour_3 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 4 часа, {{$car_currency->symbol}}</td>
                                            <td>{{$car_currency->symbol}} {{$car->driverRent ? $car->driverRent->price_per_hour_4 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 5 часов, {{$car_currency->symbol}}</td>
                                            <td>{{$car_currency->symbol}} {{$car->driverRent ? $car->driverRent->price_per_hour_5 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 6 часов, {{$car_currency->symbol}}</td>
                                            <td>{{$car_currency->symbol}} {{$car->driverRent ? $car->driverRent->price_per_hour_6 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 7 часов, $</td>
                                            <td>$ {{$car->driverRent ? $car->driverRent->price_per_hour_7 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 8 часов, $</td>
                                            <td>$ {{$car->driverRent ? $car->driverRent->price_per_hour_8 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 9 часов, $</td>
                                            <td>$ {{$car->driverRent ? $car->driverRent->price_per_hour_9 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 10 часов, $</td>
                                            <td>$ {{$car->driverRent ? $car->driverRent->price_per_hour_10 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 11 часов, $</td>
                                            <td>$ {{$car->driverRent ? $car->driverRent->price_per_hour_11 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 12 часов, $</td>
                                            <td>$ {{$car->driverRent ? $car->driverRent->price_per_hour_12 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 13 часов, $</td>
                                            <td>$ {{$car->driverRent ? $car->driverRent->price_per_hour_13 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 14 часов, $</td>
                                            <td>$ {{$car->driverRent ? $car->driverRent->price_per_hour_14 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 15 часов, $</td>
                                            <td>$ {{$car->driverRent ? $car->driverRent->price_per_hour_15 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 16 часов, $</td>
                                            <td>$ {{$car->driverRent ? $car->driverRent->price_per_hour_16 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 17 часов, $</td>
                                            <td>$ {{$car->driverRent ? $car->driverRent->price_per_hour_17 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 18 часов, $</td>
                                            <td>$ {{$car->driverRent ? $car->driverRent->price_per_hour_18 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 19 часов, $</td>
                                            <td>$ {{$car->driverRent ? $car->driverRent->price_per_hour_19 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 20 часов, $</td>
                                            <td>$ {{$car->driverRent ? $car->driverRent->price_per_hour_20 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 21 часа, $</td>
                                            <td>$ {{$car->driverRent ? $car->driverRent->price_per_hour_21 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 22 часа, $</td>
                                            <td>$ {{$car->driverRent ? $car->driverRent->price_per_hour_22 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 23 часа, $</td>
                                            <td>$ {{$car->driverRent ? $car->driverRent->price_per_hour_23 : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>За 24 часа, $</td>
                                            <td>$ {{$car->driverRent ? $car->driverRent->price_per_hour_24 : ''}}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                        </div>
                        <div class="section-with-header hidden-mobile">
                            <div class="section-with-header__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "available_dates")}}</div>
                            <div class="single-section-with-sidebar__date">
                                <div class="single-section-with-sidebar__picker">
                                    <div class="flatpickr-hero flatpickr-hero--flat"
                                         data-elem-from="[data-datepicker-from]" data-elem-to="[data-datepicker-to]"
                                         data-lang="ru"></div>
                                </div>
                                {{--<div class="single-section-with-sidebar__date-info">--}}
                                    {{--<ul>--}}
                                        {{--<li>Доступно</li>--}}
                                        {{--<li>Недоступно</li>--}}
                                        {{--<li>Доступно на неполный день</li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="car-block mb-85 mt-85 md:mb-50 md:mt-50">
                        <div class="car-block__top">
                            <h2 class="block-title font-bold">{{App\Models\Translation::getTranslWord($words, $sel_lang, "interesting_cars_for_rent")}}</h2>
                        </div>
                        <div class="car-small-cards">
                            @foreach($other_cars as $other_car)
                                <a class="car-card car-card--small mb-20" href="{{route('one_car.page', $other_car->alias)}}">
                                    <div class="car-card__img">
                                        <img src="{{count($other_car->images) ? $other_car->images->sortBy('order_id')->first()->url : ""}}" alt="">
                                    </div>
                                    <div class="car-card__content">
                                        <div><span>{{$car_currency->symbol}} {{$other_car->simpleRent ? App\Models\Currency::CurrencyConverter($other_car->simpleRent ? $other_car->simpleRent->price_day_1 : $other_car->price_day_1,$car_currency->dollar_rate) : ''}}</span><span>{{$other_car->year_created}}</span></div>
                                        <div><span>{{$other_car->simpleRent ? App\Models\Currency::CurrencyConverter($other_car->simpleRent ? $other_car->simpleRent->price_day_1 : $other_car->price_day_1,$car_currency->dollar_rate) : ''}} {{$car_currency->symbol}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_one-day")}}</span></div>
                                    </div>
                                </a>
                            @endforeach
                            {{--<a class="car-card car-card--small mb-20" href="single.html">--}}
                                {{--<div class="car-card__img"><img src="img/cars/2.jpg" alt=""></div>--}}
                                {{--<div class="car-card__content">--}}
                                    {{--<div><span>Range Rover Sport SVR</span><span>2020</span></div>--}}
                                    {{--<div><span>126 $</span><span>за 1 день</span></div>--}}
                                {{--</div>--}}
                            {{--</a><a class="car-card car-card--small mb-20" href="single.html">--}}
                                {{--<div class="car-card__img"><img src="img/cars/3.jpg" alt=""></div>--}}
                                {{--<div class="car-card__content">--}}
                                    {{--<div><span>Range Rover Sport SVR</span><span>2020</span></div>--}}
                                    {{--<div><span>126 $</span><span>за 1 день</span></div>--}}
                                {{--</div>--}}
                            {{--</a><a class="car-card car-card--small mb-20" href="single.html">--}}
                                {{--<div class="car-card__img"><img src="img/cars/4.jpg" alt=""></div>--}}
                                {{--<div class="car-card__content">--}}
                                    {{--<div><span>Range Rover Sport SVR</span><span>2020</span></div>--}}
                                    {{--<div><span>126 $</span><span>за 1 день</span></div>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        </div>
                    </div>
                    <div class="ad-placeholder">
                        @if(count($car->banners))
                            @if($car->banners->first()->type=="image_link")
                                <a href="{{$car->banners->first()->src}}" target="_blank"><img src="{{$car->banners->first()->image}}" style="width: 100%;"></a>
                            @else
                                {!! $car->banners->first()->code !!}
                            @endif
                        @endif
                    </div>
                </div>
                <div class="single-section-with-sidebar__sidebar">
                    @if(count($car->banners)&&count($car->banners)>1)
                        @for($i=0; $i<count($car->banners); $i++)
                            <div class="ad-placeholder max-w-320 mb-30">
                                @if($car->banners[$i]->type=="image_link")
                                    <a href="{{$car->banners[$i]->src}}" target="_blank"><img src="{{$car->banners[$i]->image}}" style="width: 100%;"></a>
                                @else
                                    {!! $car->banners[$i]->code !!}
                                @endif
                            </div>
                        @endfor
                    @endif
                    {{--<div class="ad-placeholder max-w-320 mb-30"></div>--}}
                    {{--<div class="ad-placeholder max-w-320 mb-30"></div>--}}
                    {{--<div class="ad-placeholder max-w-320 mb-30"></div>--}}
                    {{--<div class="ad-placeholder max-w-320 mb-30"></div>--}}
                </div>
            </div>
        </div>
    </main>
@endsection
@section('js')
    @parent
    <script>
        $('.car-page-login').on('click', function(e)
        {
            e.preventDefault();
            var url = $(this).data('url');
            window.location.href = url;
            window.location.reload();
        })
    </script>
@stop