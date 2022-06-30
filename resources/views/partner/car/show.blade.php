@extends('layouts.app')
@section('content')
    <!--Main content-->
    <main class="main">
        <div class="mt-35 mb-200 md:mb-100">
            <div class="container">
                <div class="breadcrumbs mb-40">
                    <ul>
                        <li><a href="{{route('main.page')}}">{{$pages->where('alias', 'main')->first()->getTranslation('name')}}</a></li>
                        <li>{{App\Models\Translation::getTranslWord($words, $sel_lang, "partners_office")}}</li>
                    </ul>
                </div>
                <div class="user-block">
                    <div class="user-block__content">
                        <div class="user-block__back"><a class="arrow-link arrow-link--reverse" href="{{route('partner_car.create.stage2', $model->id)}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "back")}}</a></div>
                        <div class="user-block__nav">
                            <ul>
                                <li><a href="{{route('partner_car.create.update', $model->id)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <circle cx="166" cy="226" r="10" fill="currentColor"></circle>
                                            <circle cx="166" cy="286" r="10" fill="currentColor"></circle>
                                            <circle cx="166" cy="346" r="10" fill="currentColor"></circle>
                                            <circle cx="166" cy="406" r="10" fill="currentColor"></circle>
                                            <path fill="currentColor" d="M226 236h120c5.522 0 10-4.478 10-10s-4.478-10-10-10H226c-5.522 0-10 4.478-10 10s4.478 10 10 10zM226 296h120c5.522 0 10-4.478 10-10s-4.478-10-10-10H226c-5.522 0-10 4.478-10 10s4.478 10 10 10zM226 356h120c5.522 0 10-4.478 10-10s-4.478-10-10-10H226c-5.522 0-10 4.478-10 10s4.478 10 10 10zM226 416h120c5.522 0 10-4.478 10-10s-4.478-10-10-10H226c-5.522 0-10 4.478-10 10s4.478 10 10 10z"></path>
                                            <path fill="currentColor" d="M406 90h-81.266C321.108 75.965 310.036 64.892 296 61.266V40c0-22.056-17.944-40-40-40s-40 17.944-40 40v21.266C201.965 64.892 190.892 75.965 187.266 90H106c-5.522 0-10 4.478-10 10v402c0 5.522 4.478 10 10 10h105c5.522 0 10-4.478 10-10s-4.478-10-10-10h-95V110h70v20c0 5.522 4.478 10 10 10h120c5.522 0 10-4.478 10-10v-20h70v382h-95c-5.522 0-10 4.478-10 10s4.478 10 10 10h105c5.522 0 10-4.478 10-10V100c0-5.522-4.477-10-10-10zM236 40c0-11.028 8.972-20 20-20s20 8.972 20 20v20h-40zm70 80H206v-20c0-11.028 8.972-20 20-20h60c11.028 0 20 8.972 20 20z"></path>
                                            <circle cx="256" cy="502" r="10" fill="currentColor"></circle>
                                        </svg>{{App\Models\Translation::getTranslWord($words, $sel_lang, "description")}}</a></li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                    </svg>
                                </li>
                                <li><a href="{{route('partner_car.create.stage2', $model->id)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                            <path fill="currentColor" d="M14 24.138a5.575 5.575 0 005.569-5.568c0-3.072-2.498-5.57-5.569-5.57s-5.569 2.498-5.569 5.569A5.575 5.575 0 0014 24.138zM14 15c1.968 0 3.569 1.602 3.569 3.569S15.968 22.138 14 22.138s-3.569-1.601-3.569-3.568S12.032 15 14 15z"></path>
                                            <path fill="currentColor" d="M1 0v52h50V0H1zm2 2h46v26.727l-10.324-9.464a1.026 1.026 0 00-.72-.262 1.002 1.002 0 00-.694.325l-9.794 10.727-4.743-4.743a1 1 0 00-1.368-.044L4.622 40H3V2zm46 48H3v-8h46v8zM7.649 40l14.324-12.611L32.275 37.69a.999.999 0 101.414-1.414l-4.807-4.807 9.181-10.054L49 31.44V40H7.649z"></path>
                                        </svg>{{App\Models\Translation::getTranslWord($words, $sel_lang, "photo")}}</a></li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                    </svg>
                                </li>
                                <li class="active"><span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 249.425 249.425">
                          <path fill="currentColor" d="M206.79 81.505a6 6 0 00-6 6v149.919H12V48.635h146.792a6 6 0 000-12H6a6 6 0 00-6 6v200.789a6 6 0 006 6h200.79a6 6 0 006-6V87.505a6 6 0 00-6-6z"></path>
                          <path fill="currentColor" d="M247.667 1.758a5.998 5.998 0 00-8.485 0L80.416 160.523 41.023 121.13a5.998 5.998 0 00-8.485 0 5.999 5.999 0 000 8.484l43.636 43.636c1.171 1.172 2.707 1.758 4.243 1.758s3.071-.586 4.243-1.758L247.667 10.243a5.998 5.998 0 000-8.485z"></path>
                        </svg>{{App\Models\Translation::getTranslWord($words, $sel_lang, "confirmation")}}</span></li>
                            </ul>
                        </div>
                        <div class="user-block__preview mb-90 md:mb-50">
                            <div class="single-hero border-none mb-40 md:mb-0">
                                <div class="single-hero__top">
                                    <div class="single-hero__title"><img src="{{$model->carBrand->icon}}" style="width:30px;" alt="">{{$model->carBrand->name}} {{$model->model}}</div>
                                </div>
                                <div class="single-hero__sides">
                                    <div class="single-hero__side-1">
                                        <div class="single-carousels">
                                            <div class="single-carousels__main single-owl-carousel">
                                                <div class="owl-carousel">
                                                    @foreach($model->images->sortBy('order_id') as $image)
                                                        @if($loop->iteration==1)
                                                            <a class="single-carousels__main-item {{$model->video ? "single-carousels__main-item--video" : ''}}"
                                                               href="{{$model->video ? $model->video : asset($image->url)}}" data-fancybox="gallery"
                                                               data-caption="{{$model->carBrand->name}} {{$model->model}}{{$model->video ? " - Видео" : ''}}"><img
                                                                        src="{{asset($image->url)}}" alt=""></a>
                                                        @else
                                                            <a class="single-carousels__main-item" href="{{asset($image->url)}}"
                                                               data-fancybox="gallery" data-caption="BMW X5 M Sport - Фото 1"><img
                                                                        src="{{asset($image->url)}}" alt=""></a>
                                                        @endif

                                                    {{--@if($loop->iteration==1)--}}
                                                            {{--<a class="single-carousels__main-item single-carousels__main-item--video" href="{{$model->video}}" data-fancybox="gallery" data-caption="{{$model->brand}} {{$model->model}} - Видео"><img src="{{asset($image->url)}}" alt=""></a>--}}
                                                        {{--@else--}}
                                                            {{--<a class="single-carousels__main-item" href="{{asset($image->url)}}" data-fancybox="gallery" data-caption="BMW X5 M Sport - Фото 1"><img src="{{asset($image->url)}}" alt=""></a>--}}
                                                        {{--@endif--}}

                                                    @endforeach
                                                </div>
                                                    {{--<a class="single-carousels__main-item" href="img/cars/1/1-big.jpg" data-fancybox="gallery" data-caption="BMW X5 M Sport - Фото 1"><img src="img/cars/1/1-medium.jpg" alt=""></a><a class="single-carousels__main-item" href="img/cars/1/2-big.jpg" data-fancybox="gallery" data-caption="BMW X5 M Sport - Фото 2"><img src="img/cars/1/2-medium.jpg" alt=""></a><a class="single-carousels__main-item" href="img/cars/1/3-big.jpg" data-fancybox="gallery" data-caption="BMW X5 M Sport - Фото 3"><img src="img/cars/1/3-medium.jpg" alt=""></a></div>--}}
                                                <div class="single-carousels__main-counter"><span>0</span><span>0</span></div>
                                            </div>
                                            <div class="single-carousels__nav">
                                                <div class="single-carousels__nav-inner">
                                                    <div class="owl-carousel">
                                                        @foreach($model->images->sortBy('order_id') as $image)
                                                            <div class="single-carousels__nav-item  {{$loop->iteration==1&&$model->video ? 'single-carousels__nav-item--video' : ''}}"><img src="{{$image->url}}" alt=""></div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form class="single-hero__side-2">
                                        @if($model->rent_type=="simple_rent")
                                            <div class="single-hero__price">
                                                <span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "price_per_one_day")}}</span><span>{{$car_currency->symbol}} {{$model->simpleRent ? App\Models\Currency::CurrencyConverter($model->simpleRent->price_day_30,$car_currency->dollar_rate) : '0'}}</span><span>+ {{$car_currency->symbol}}{{App\Models\Currency::($model->getPriceFromPercentVat($model->simpleRent->price_day_30, $setting->vat_tax),$car_currency->dollar_rate)}} VAT Tax</span>
                                            </div>
                                        @elseif($model->rent_type=="with_driver")
                                            <div class="single-hero__price"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "price_one_hour")}}<</span><span>{{$car_currency->symbol}} {{$model->driverRent ? App\Models\Currency::CurrencyConverter($model->driverRent->price_per_hour_1, $setting->vat_tax) : ''}}</span><span>+ {{$car_currency->symbol}}{{App\Models\Currency::CurrencyConverter($model->getPriceFromPercentVat($model->driverRent->price_per_hour_1, $setting->vat_tax),$car_currency->dollar_rate)}} VAT Tax</span></div>
                                            <ul class="single-hero__list">
                                                @for($i=1; $i<=12; $i++)
                                                    <li>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} {{$i}} {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours")}} <span><?php echo $car_currency->symbol." ".App\Models\Currency::CurrencyConverter($model->driverRent->{'price_per_hour_'.$i},$car_currency->dollar_rate);?></span></li>
                                                @endfor
                                            </ul>
                                        @endif
                                        @if($model->rent_type=="simple_rent")
                                            <div class="check mb-40 xl:mb-30 xxl:mb-20">{{$model->simpleRent ? $model->simpleRent->mileage_limit : '0'}} {{App\Models\Translation::getTranslWord($words, $sel_lang, "km_included_price_day")}}</div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                            <div class="user-block__preview-info">
                                <div class="section-with-header">
                                    <div class="section-with-header__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "characteristic")}}</div>
                                    <div class="section-with-header__characteristics">
                                        <div class="characteristic characteristic--ic-year"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "year_issue")}}</span><span>{{$model->year_created}}</span></div>
                                        <div class="characteristic characteristic--ic-horsepower"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "horsepower")}}</span><span>{{$model->horsepower}}</span></div>
                                        <div class="characteristic characteristic--ic-number-of-seats"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "number_of_seats")}}</span><span>{{$model->seats_number}}</span></div>
                                        <div class="characteristic characteristic--ic-interior-color"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "interior_color")}}</span><span>{{$model->cabin_color}}</span></div>
                                        <div class="characteristic characteristic--ic-engine"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "engine")}}</span><span>{{$model->engine}}</span></div>
                                        <div class="characteristic characteristic--ic-transmission"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "transmission")}}</span><span>
                                                @if($model->transmission=="1")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "mechanical")}}
                                                @endif
                                                @if($model->transmission=="2")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "automat")}}
                                                @endif

                                            </span></div>
                                        <div class="characteristic characteristic--ic-speed"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "0_100kmh")}}</span><span>{{$model->time_to_100}}</span></div>
                                        <div class="characteristic characteristic--ic-car-color"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "car_color")}}</span><span>{{$model->color}}</span></div>
                                        <div class="characteristic characteristic--ic-max-speed"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "maximum_speed")}}</span><span>{{$model->max_speed}}</span></div>
                                        <div class="characteristic characteristic--ic-trunk-capacity"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "trunk_capacity")}}</span><span>

                                                @if($model->trunk_capacity=="1")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "1_small_bag")}}
                                                @endif
                                                @if($model->trunk_capacity=="2")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "1_large_bag")}}
                                                @endif
                                                @if($model->trunk_capacity=="3")
                                                        {{App\Models\Translation::getTranslWord($words, $sel_lang, "trunk_capacity_3")}}
                                                @endif
                                                @if($model->trunk_capacity=="4")
                                                        {{App\Models\Translation::getTranslWord($words, $sel_lang, "trunk_capacity_4")}}
                                                @endif
                                                @if($model->trunk_capacity=="5")
                                                        {{App\Models\Translation::getTranslWord($words, $sel_lang, "trunk_capacity_5")}}
                                                @endif
                                            </span></div>
                                    </div>
                                </div>
                                <div class="user-block__preview-info-tables">
                                    @if($model->rent_type=="simple_rent")
                                        <div class="section-with-header md:mb-20">

                                            <div class="section-with-header__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rent_terms")}}</div>
                                            <table class="single-section-with-sidebar__table">
                                                <tr>
                                                    <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "deposit")}}:</td>
                                                    <td>{{$car_currency->symbol}} {{$model->simpleRent ? App\Models\Currency::CurrencyConverter($model->simpleRent->deposit,$car_currency->dollar_rate) : '0'}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "age_limit")}}:</td>
                                                    <td>от {{$model->simpleRent ? $model->simpleRent->age_limit : ''}} года</td>
                                                </tr>
                                                <tr>
                                                    <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "cost_per_1_km")}}:</td>
                                                    <td>{{$car_currency->symbol}} {{$model->simpleRent ? App\Models\Currency::CurrencyConverter($model->simpleRent->const_for_one_km,$car_currency->dollar_rate) : ''}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "driving_experience")}}:</td>
                                                    <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "from")}} {{$model->simpleRent ? $model->simpleRent->driving_experience : ''}} {{App\Models\Translation::getTranslWord($words, $sel_lang, "of_the_year")}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="section-with-header">
                                            <div class="section-with-header__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rent_price")}}</div>
                                            <table class="single-section-with-sidebar__table">
                                                <tr>
                                                    <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_1_day")}}</td>
                                                    <td>{{$model->simpleRent ? $car_currency->symbol." ".App\Models\Currency::CurrencyConverter($model->simpleRent->price_day_1,$car_currency->dollar_rate) : ''}}</td>

                                                </tr>
                                                <tr>
                                                    <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_2_days")}}</td>
                                                    <td>{{$model->simpleRent ? $car_currency->symbol." ".App\Models\Currency::CurrencyConverter($model->simpleRent->price_day_2,$car_currency->dollar_rate) : ''}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_3_6_days")}}</td>
                                                    <td>{{$model->simpleRent ? $car_currency->symbol." ".App\Models\Currency::CurrencyConverter($model->simpleRent->price_day_3_6,$car_currency->dollar_rate) : ''}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_7_13_days")}}</td>
                                                    <td>{{$model->simpleRent ? $car_currency->symbol." ".App\Models\Currency::CurrencyConverter($model->simpleRent->price_day_7_13,$car_currency->dollar_rate) : ''}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_14_20_days")}}</td>
                                                    <td>{{$model->simpleRent ? $car_currency->symbol." ".App\Models\Currency::CurrencyConverter($model->simpleRent->price_day_14_20,$car_currency->dollar_rate) : ''}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_21_29_days")}}</td>
                                                    <td>{{$model->simpleRent ? $car_currency->symbol." ".App\Models\Currency::CurrencyConverter($model->simpleRent->price_day_21_29,$car_currency->dollar_rate) : ''}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_30_days")}}</td>
                                                    <td>{{$model->simpleRent ? $car_currency->symbol." ".App\Models\Currency::CurrencyConverter($model->simpleRent->price_day_30,$car_currency->dollar_rate) : ''}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "additionally")}}</td>
                                                    <td>+{{$setting->vat_tax}}% VAT Tax</td>
                                                </tr>
                                            </table>
                                        </div>

                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="user-inputs-btn user-inputs-btn--centered"><a class="sm:min-w-0 sm:w-full btn-outlined btn-outlined--theme-accent3 min-w-330" href="{{route('partner_car.publish', $model->id)}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "add_to_catalog")}}</a><a class="sm:min-w-0 sm:w-full btn-outlined btn-outlined--theme-accent2 min-w-330" href="{{route('partner_car.create.update', $model->id)}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "edit")}}</a></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection