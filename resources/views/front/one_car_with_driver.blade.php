@extends('layouts.app')
@section('content')
    <!--Main content-->
    <main class="main">
        <div class="container">
            <div class="top-navigation">
                <div><a class="arrow-link arrow-link--reverse" href="{{route('cars_rent_with_driver.page')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "return_to_search")}}</a></div>
                <div>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{route('main.page')}}">{{$pages->where('alias', 'main')->first()->getTranslation('name')}}</a></li>
                            <li><a href="{{route('cars_rent_with_driver.page')}}">{{$pages->where('alias', 'rent-of-cars-with-driver')->first()->getTranslation('name')}}</a></li>
                            <li>{{$car->carBrand->name}} {{$car->model}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="single-hero mb-20">
                <div class="single-hero__top">
                    <div class="single-hero__title"><img src="{{$car->carBrand->icon}}"  style="width:30px;" alt="">{{$car->carBrand->name}} {{$car->model}}</div>
                    <div class="share">
                        <button class="share__btn share__link share__link--share"></button>
                        <div class="share__links">
                            <?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
                            <a class="share__link share__link--facebook" href="https://www.facebook.com/sharer/sharer.php?u={{$actual_link}}&t={{$car->carBrand->name}} {{$car->model}}" target="_blank" rel="noopener"></a>
                            <a class="share__link share__link--twitter" href="https://twitter.com/share?text={{$actual_link}}"></a>
                            <a class="share__link share__link--whatsapp" href="whatsapp://send?text={{$actual_link}}"></a>
                            <a class="share__link share__link--messenger" href="fb-messenger://share?link={{$actual_link}}"></a>
                            <a class="share__link share__link--viber" href="viber://forward?text={{$actual_link}}"></a>
                            <a class="share__link share__link--wechat" href="#"></a>
                        </div>
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
                                               data-caption="{{$car->brand}} {{$car->model}} - Видео"><img
                                                        src="{{asset($image->url)}}" alt=""></a>
                                        @else
                                            <a class="single-carousels__main-item" href="{{asset($image->url)}}"
                                               data-fancybox="gallery" data-caption="BMW X5 M Sport - Фото 1"><img
                                                        src="{{asset($image->url)}}" alt=""></a>
                                        @endif

                                    @endforeach
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-hero__side-2">
                        <div class="single-hero__price"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "price_for_3_hours")}}</span><span>{{$car_currency->symbol}} {{$car->driverRent ? App\Models\Currency::CurrencyConverter($car->driverRent->price_per_hour_3,$car_currency->dollar_rate) : '0'}}</span></div>
                        <ul class="single-hero__list">
                            @for($i=1; $i<=12; $i++)
                                <li>за {{$i}} часа
                                    <span><?php echo $car_currency->symbol." ".App\Models\Currency::CurrencyConverter($car->driverRent->{'price_per_hour_' . $i},$car_currency->dollar_rate);?></span></li>
                            @endfor
                        </ul>
                        <div class="single-hero__button"><!--
                  <button class="btn w-full"><span>Отправить заявку</span></button>-->
                            @if(!auth()->user())

                                <button data-url="{{route('one_car_with_driver.page', $car->alias)}}#login" class="btn w-full car-page-login"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "send_request2")}}</span></button>
                            @else
                                <a class="btn w-full" href="{{route('booking_cars_with_driver', $car->id)}}"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "send_request2")}}</span></a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-section-with-sidebar">
            <div class="container single-section-with-sidebar__container">
                <div class="single-section-with-sidebar__content">
                    <div class="single-section-with-sidebar__content-inner">
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
                            <div class="characteristic characteristic--ic-trunk-capacity">
                                <span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "trunk_capacity")}}</span><span>

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
                        <div class="single-section-with-sidebar__info">
                            <div class="section-with-header mb-20">
                                <div class="section-with-header__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rent_terms")}}</div>
                                <table class="single-section-with-sidebar__table">
                                    <tr>
                                        <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "airport")}}:</td>
                                        <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "customer_payment_parking")}} </td>
                                    </tr>
                                    <tr>
                                        <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "insurance")}}:</td>
                                        <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "full_passenger_insurance")}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "fuel_and_tax")}}:</td>
                                        <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "included_price")}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "reservation")}}:</td>
                                        <td>24/7</td>
                                    </tr>
                                    <tr>
                                        <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "payment")}}:</td>
                                        <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "hourly_prepayment")}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="section-with-header mb-20">
                                <div class="section-with-header__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "supplier_location")}}</div>
                                <div class="single-section-with-sidebar__map">
                                    <label>
                                        @if($car->work_location=="1")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "dubai")}}
                                        @elseif($car->work_location=="2")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "abu_dhabi")}}
                                        @elseif($car->work_location=="3")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "sharjah")}}
                                        @elseif($car->work_location=="4")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "ras-al-Khaim")}}
                                        @elseif($car->work_location=="5")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "all_uae")}}
                                        @endif
                                    </label>
                                    @if($car->work_location=="1")
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d462565.197682918!2d54.94754067719891!3d25.075085283759368!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f43496ad9c645%3A0xbde66e5084295162!2z0JTRg9Cx0LDQuSAtINCe0LHRitC10LTQuNC90LXQvdC90YvQtSDQkNGA0LDQsdGB0LrQuNC1INCt0LzQuNGA0LDRgtGL!5e0!3m2!1sru!2sua!4v1615055206237!5m2!1sru!2sua" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    @elseif($car->work_location=="2")
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d465132.60895358864!2d54.27842838424662!3d24.386572911004457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5e440f723ef2b9%3A0xc7cc2e9341971108!2z0JDQsdGDLdCU0LDQsdC4IC0g0J7QsdGK0LXQtNC40L3QtdC90L3Ri9C1INCQ0YDQsNCx0YHQutC40LUg0K3QvNC40YDQsNGC0Ys!5e0!3m2!1sru!2sua!4v1615054906276!5m2!1sru!2sua" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    @elseif($car->work_location=="3")
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d230822.80155215692!2d55.37051792288389!3d25.317429147454245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5f5fede7964b%3A0x2a830aa19c1f6d89!2z0KjQsNGA0LTQttCwIC0g0J7QsdGK0LXQtNC40L3QtdC90L3Ri9C1INCQ0YDQsNCx0YHQutC40LUg0K3QvNC40YDQsNGC0Ys!5e0!3m2!1sru!2sua!4v1615055272210!5m2!1sru!2sua" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    @elseif($car->work_location=="4")
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d819370.9627001019!2d55.48013046960838!3d25.68811566771454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ef6710e4cd209a7%3A0xb99e670ca684e20f!2z0KDQsNGBLdGN0LvRjC3QpdCw0LnQvNCwIC0g0J7QsdGK0LXQtNC40L3QtdC90L3Ri9C1INCQ0YDQsNCx0YHQutC40LUg0K3QvNC40YDQsNGC0Ys!5e0!3m2!1sru!2sua!4v1615055379902!5m2!1sru!2sua" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="car-block mb-85 mt-85 md:mb-50 md:mt-50">
                        <div class="car-block__top">
                            <h2 class="block-title font-bold">{{App\Models\Translation::getTranslWord($words, $sel_lang, "interesting_cars_for_rent")}}</h2>
                        </div>
                        <div class="car-small-cards">
                            @foreach($other_cars as $other_car)
                                <a class="car-card car-card--small mb-20" href="{{route('one_car_with_driver.page', $other_car->alias)}}">
                                    <div class="car-card__img"><img src="{{count($other_car->images) ? $other_car->images->sortBy('order_id')->first()->url : ""}}" alt=""></div>
                                    <div class="car-card__content">
                                        <div><span>{{$other_car->carBrand->name}} {{$other_car->model}}</span><span>{{$other_car->year_created}}</span></div>
                                        <div><span>{{$car->driverRent ? App\Models\Currency::CurrencyConverter($car->driverRent->price_per_hour_3,$car_currency->dollar_rate) : ''}} {{$car_currency->symbol}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "price_for_3_hours")}}</span></div>
                                    </div>
                                </a>
                            @endforeach
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