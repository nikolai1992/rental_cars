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
                                <div class="user-booking-result__content-title"><span><img src="{{asset('img/user/booking/icons/fail.svg')}}" alt="">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rejected_result_text")}}</span></div>
                                <div class="user-booking-result__content-text">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rejected_text_1")}}<br>{{App\Models\Translation::getTranslWord($words, $sel_lang, "rejected_text_2")}}</div>
                                <div class="user-booking-result__content-btn"><a class="sm:min-w-0 btn min-w-270" href="{{$search_cars}}"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "go_car_search")}}</span></a></div>
                            </div>
                        </div>
                        <div class="user-booking-result__sidebar">
                            <div class="car-booking-info">
                                <div class="car-booking-info__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "your_car")}}</div>
                                <div class="car-booking-info__car">
                                    <div><img src="{{count($order->car->images) ? asset($order->car->images->sortBy('order_id')->first()->url) : ""}}" alt="" style="width:327px; -ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-interpolation-mode:bicubic;float: left; max-width: 100%; height: auto; margin-bottom: 15px;"></div>
                                    <div>
                                        <div class="car-booking-info__car-date-block car-booking-info__car-date-block--from"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "receiving")}}</span><span>
                                        @if($order->location=="1")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "dubai")}}
										@elseif($order->location=="2")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "abu_dhabi")}}
										@elseif($order->location=="3")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "sharjah")}}
										@elseif($order->location=="4")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "ras-al-Khaim")}}
										@elseif($order->location=="5")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "all_uae")}}
										@endif
										</span><span>{{Carbon\Carbon::parse($order->date)->format('D, d/m/Y')}}, {{$order->time}}:00</span><a class="underline modal-open" href="#change-date">{{$words->where('name', "change")->first()->translations->where("language_id", $sel_lang->id)->first()->value}}</a></div>
                                        <div class="car-booking-info__car-date-block car-booking-info__car-date-block--to"><span>{{$words->where('name', "return")->first()->translations->where("language_id", $sel_lang->id)->first()->value}}</span><span>
										@if($order->location=="1")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "dubai")}}
										@elseif($order->location=="2")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "abu_dhabi")}}
										@elseif($order->location=="3")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "sharjah")}}
										@elseif($order->location=="4")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "ras-al-Khaim")}}
										@elseif($order->location=="5")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "all_uae")}}
										@endif
										</span><span>{{Carbon\Carbon::parse($order->date)->addHours($order->time)->addHours($order->duration)->format('d/m/Y H')}}:00</span><a class="underline modal-open" href="#change-date">{{App\Models\Translation::getTranslWord($words, $sel_lang, "change")}}</a></div>
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
                                    <div class="characteristic characteristic--ic-car-color"><span>{{$words->where('name', "car_color")->first()->translations->where("language_id", $sel_lang->id)->first()->value}}</span><span>{{$order->car->color}}</span></div>
                                </div>
                                <div class="car-booking-info__sum px-25 xs:px-0 lg:px-25 xxl:px-0">
                                    <div><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "total_amount_for_car_rental")}}</span><span>{{$car_currency->symbol}} {{App\Models\Currency::CurrencyConverter($order->price, $car_currency->dollar_rate)}}</span></div>
                                </div>
                                <div class="car-booking-info__sum-total px-25 xs:px-0 lg:px-25 xxl:px-0"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "total_amount_paid")}}</span><span>{{$car_currency->symbol}} {{App\Models\Currency::CurrencyConverter($order->price, $car_currency->dollar_rate)}}</span></div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--Footer-->
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