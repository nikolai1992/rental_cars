<div class="catalog-card">
    <div class="catalog-card__img"><img src="{{count($car->images) ? $car->images->sortBy('order_id')->first()->url : ""}}" alt=""></div>
    <div class="catalog-card__content">
        <div class="catalog-card__title"><img src="{{$car->carBrand ? $car->carBrand->icon : ''}}" style="width: 30px;" alt="">{{$car->carBrand->name}} {{$car->model}}</div>
        @if($car->rent_type=="simple_rent")
            <div class="catalog-card__extra">{{$car->simpleRent ? $car->simpleRent->mileage_limit : '0'}} {{App\Models\Translation::getTranslWord($words, $sel_lang, "km_included_price_day")}}</div>
        @endif
        <div class="catalog-card__info">
            <div class="catalog-card__items">
                <div class="characteristic characteristic--ic-engine"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "engine")}}</span><span>{{$car->engine}}</span></div>
                <div class="characteristic characteristic--ic-transmission"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "transmission")}}</span><span>
                                                @if($car->transmission=="1")
                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "mechanical")}}
                        @endif
                        @if($car->transmission=="2")
                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "automat")}}
                        @endif</span></div>
                <div class="characteristic characteristic--ic-speed"><span>0-100 {{App\Models\Translation::getTranslWord($words, $sel_lang, "km_per_hour")}}</span><span>{{$car->time_to_100}} sec</span></div>
                <div class="characteristic characteristic--ic-number-of-seats"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "number_of_seats")}}</span><span>{{$car->seats_number}}</span></div>
            </div>
            <div class="catalog-card__price">
                @if($car->rent_type=="simple_rent")
                    <span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "price_per_one_day")}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "from")}}<span>{{$car_currency->symbol}} {{$car->simpleRent ? App\Models\Currency::CurrencyConverter($car->simpleRent ? $car->simpleRent->price_day_30 : 0, $car_currency->dollar_rate) : ''}}</span></span><span>+ {{$car_currency->symbol}}{{App\Models\Currency::CurrencyConverter($car->getPriceFromPercentVat($car->simpleRent ? $car->simpleRent->price_day_30 : 0, $setting->vat_tax),$car_currency->dollar_rate)}} VAT Tax</span>
                @endif
            </div>
        </div>
        <div class="catalog-card__bottom"><a class="btn-outlined btn-outlined--theme-accent min-w-190" href="{{route('one_car.page', $car->alias)}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "more_detail")}}</a></div>
    </div>
</div>