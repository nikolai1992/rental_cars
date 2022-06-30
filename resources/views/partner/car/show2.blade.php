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
                    <div class="user-block__content pt-20">
                        <div class="user-block__back"><a class="arrow-link arrow-link--reverse" href="{{route('partner_car.edit.stage2', $model->id)}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "back")}}</a></div>
                        <div class="user-block__preview mb-90 md:mb-50">
                            <div class="single-hero border-none mb-40 md:mb-0">
                                <div class="single-hero__top">
                                    <div class="single-hero__title"><img src="{{$model->carBrand ? $model->carBrand->icon : ''}}" style="width: 30px" alt="">{{$model->brand}} {{$model->model}}</div>
                                </div>
                                <div class="single-hero__sides">
                                    <div class="single-hero__side-1">
                                        <div class="single-carousels">
                                            <div class="single-carousels__main single-owl-carousel">
                                                <div class="owl-carousel">
                                                    @foreach($model->images->sortBy('order_id') as $image)
                                                        @if($loop->iteration==1)
                                                            <a class="single-carousels__main-item single-carousels__main-item--video" href="{{$model->video}}" data-fancybox="gallery" data-caption="{{$model->brand}} {{$model->model}}{{$model->video ? " - Видео" : ''}}"><img src="{{asset($image->url)}}" alt=""></a>
                                                        @else
                                                            <a class="single-carousels__main-item" href="{{asset($image->url)}}" data-fancybox="gallery" data-caption="BMW X5 M Sport - Фото 1"><img src="{{asset($image->url)}}" alt=""></a>
                                                        @endif

                                                    @endforeach
                                                </div>
                                                <div class="single-carousels__main-counter"><span>0</span><span>0</span></div>
                                            </div>
                                            <div class="single-carousels__nav">
                                                <div class="single-carousels__nav-inner">
                                                    <div class="owl-carousel">
                                                        @foreach($model->images->sortBy('order_id') as $image)
                                                            <div class="single-carousels__nav-item {{$loop->iteration==1 ? 'single-carousels__nav-item--video' : ''}}"><img src="{{$image->url}}"  alt=""></div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form class="single-hero__side-2">
                                        @if($model->rent_type=="simple_rent")
                                            <div class="single-hero__price"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "price_per_one_day")}}</span><span>{{$car_currency->symbol}} {{$model->simpleRent ? App\Models\Currency::CurrencyConverter($model->simpleRent->price_day_1, $car_currency->dollar_rate) : ''}}</span><span>+ {{$car_currency->symbol}}{{App\Models\Currency::CurrencyConverter($model->getPriceFromPercentVat($model->simpleRent->price_day_1, $setting->vat_tax),$car_currency->dollar_rate)}} VAT Tax</span></div>
                                        @elseif($model->rent_type=="with_driver")
                                            <div class="single-hero__price"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "price_one_hour")}}</span><span>{{$car_currency->symbol}} {{$model->driverRent ? App\Models\Currency::CurrencyConverter($model->driverRent->price_per_hour_1, $car_currency->dollar_rate) : ''}}</span><span>+ {{$car_currency->symbol}}{{App\Models\Currency::CurrencyConverter($model->getPriceFromPercentVat($model->driverRent->price_per_hour_1, $setting->vat_tax),$car_currency->dollar_rate)}} VAT Tax</span></div>
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
                                                    <td>{{$model->simpleRent ? $car_currency->symbol." ".App\Models\Currency::CurrencyConverter($model->simpleRent->deposit,$car_currency->dollar_rate) : ''}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "age_limit")}}:</td>
                                                    <td>от {{$model->simpleRent ? $model->simpleRent->age_limit : ''}} года</td>
                                                </tr>
                                                <tr>
                                                    <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "cost_per_1_km")}}:</td>
                                                    <td>{{$model->simpleRent ? $car_currency->symbol." ".App\Models\Currency::CurrencyConverter($model->simpleRent->const_for_one_km,$car_currency->dollar_rate) : ''}}</td>
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
                        <div class="user-inputs-btn user-inputs-btn--centered"><a class="sm:min-w-0 sm:w-full btn-outlined btn-outlined--theme-accent2 min-w-330" href="{{route('partner_car.index')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "save_changes")}}</a></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection