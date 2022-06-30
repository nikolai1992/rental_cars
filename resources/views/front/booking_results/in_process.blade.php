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
                    <div class="user-booking-result">
                        <div class="user-booking-result__content">
                            <div class="user-booking-result__content-inner">
                                <div class="user-booking-result__content-title"><span><img src="{{asset('img/user/booking/icons/processing.svg')}}" alt="">{{App\Models\Translation::getTranslWord($words, $sel_lang, "booking_request_processing")}}</span></div>
                                <div class="user-booking-result__content-text">{{App\Models\Translation::getTranslWord($words, $sel_lang, "review_your_booking_request_almost_complete")}}<br>{{App\Models\Translation::getTranslWord($words, $sel_lang, "will_inform_about")}}</div>
                                <div class="user-booking-result__content-btn-group">
                                    <button class="btn-outlined min-w-220" data-show-and-active="#user-booking-result-hidden-text">{{App\Models\Translation::getTranslWord($words, $sel_lang, "cancel_order")}}</button><a class="btn-outlined btn-outlined--theme-accent2 min-w-220" href="{{route('faq')}}">FAQ</a>
                                </div>
                                <div class="user-booking-result__hidden-text" id="user-booking-result-hidden-text" hidden>{{App\Models\Translation::getTranslWord($words, $sel_lang, "for_cancel_order")}} <a class="underline" href="{{$create_ticket}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "create_ticket")}}</a> {{App\Models\Translation::getTranslWord($words, $sel_lang, "in_your_personal_account")}}</div>
                            </div>
                        </div>
                        <div class="user-booking-result__sidebar">
                            <div class="car-booking-info">
                                <div class="car-booking-info__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "your_car")}}</div>
                                <div class="car-booking-info__car">
                                    <div><img src="{{count($order->car->images) ? asset($order->car->images->sortBy('order_id')->first()->url) : ""}}" alt="" style="width:327px; -ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-interpolation-mode:bicubic;float: left; max-width: 100%; height: auto; margin-bottom: 15px;"></div>
                                    <div>
                                        <div class="car-booking-info__car-date-block car-booking-info__car-date-block--from"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "receiving")}}</span><span>
										@if($order->city=="1")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "dubai")}}
                                        @elseif($order->city=="2")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "abu_dhabi")}}
                                        @elseif($order->city=="3")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "sharjah")}}
                                        @elseif($order->city=="4")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "ras-al-Khaim")}}
                                        @elseif($order->city=="5")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "all_uae")}}
                                        @endif
										</span><span>{{Carbon\Carbon::parse($order->from_date)->format('D, d/m/Y')}}, {{$order->time}}:00</span><a class="underline modal-open" href="#change-date">{{App\Models\Translation::getTranslWord($words, $sel_lang, "change")}}</a></div>
                                        <div class="car-booking-info__car-date-block car-booking-info__car-date-block--to"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "return")}}</span><span>
										@if($order->city=="1")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "dubai")}}
                                        @elseif($order->city=="2")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "abu_dhabi")}}
                                        @elseif($order->city=="3")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "sharjah")}}
                                        @elseif($order->city=="4")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "ras-al-Khaim")}}
                                        @elseif($order->city=="5")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "all_uae")}}
                                        @endif
										</span><span>{{Carbon\Carbon::parse($order->to_date)->format('D, d/m/Y')}}, 10:00</span><a class="underline modal-open" href="#change-date">{{App\Models\Translation::getTranslWord($words, $sel_lang, "change")}}</a></div>
                                    </div>
                                </div>
                                <div class="car-booking-info__car-name"><img src="{{$order->car->carBrand->icon}}" style="width:30px;" alt="">{{$order->car->carBrand->name}} {{$order->car->model}}</div>
                                <div class="car-booking-info__characteristics">
                                    <div class="characteristic characteristic--ic-year"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "year_issue")}}</span><span>{{$order->car->year_created}}</span></div>
                                    <div class="characteristic characteristic--ic-transmission"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "transmission")}}</span><span>
									 @if($order->car->transmission=="1")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "mechanical")}}
                                        @endif
                                        @if($order->car->transmission=="2")
                                             {{App\Models\Translation::getTranslWord($words, $sel_lang, "automat")}}
                                        @endif
									</span></div>
                                    <div class="characteristic characteristic--ic-car-color"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "car_color")}}</span><span>{{$order->car->color}}</span></div>
                                </div>
                                <div class="car-booking-info__sum px-25 xs:px-0 lg:px-25 xxl:px-0">
                                    <div><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "total_amount_for_car_rental")}} {{$diffDays}} {{App\Models\Translation::getTranslWord($words, $sel_lang, "days2")}}</span><span>{{$car_currency->symbol}} {{App\Models\Currency::CurrencyConverter($order->total_per_days, $car_currency->dollar_rate)}}</span></div>
                                    <div><span>VAT Tax ({{$setting->vat_tax}}%)</span><span>+ {{$car_currency->symbol}}{{App\Models\Currency::CurrencyConverter($order->vat_tax,$car_currency->dollar_rate)}}</span></div>
                                </div>
                                <div class="car-booking-info__sum-total px-25 xs:px-0 lg:px-25 xxl:px-0"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "total_amount_paid")}}</span><span>{{$car_currency->symbol}} {{App\Models\Currency::CurrencyConverter($order->total_price,$car_currency->dollar_rate)}}</span></div>
                                <div class="car-booking-info__deposit px-25 xs:px-0 lg:px-25 xxl:px-0"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "deposit")}}</span><span>{{$car_currency->symbol}} {{App\Models\Currency::CurrencyConverter($order->car->simpleRent->deposit, $car_currency->dollar_rate)}}</span></div>
                                <div class="px-25 mb-35 xs:px-0 lg:px-25 xxl:px-0">
                                    <div class="check">{{$order->car->simpleRent ? $order->car->simpleRent->mileage_limit : '0'}} {{App\Models\Translation::getTranslWord($words, $sel_lang, "km_included_price_day")}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('js')
    @parent

@stop