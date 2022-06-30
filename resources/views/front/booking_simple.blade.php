@extends('layouts.app')
@section('content')
    <!--Main content-->
    <main class="main">
        <div class="container">
            <div class="top-navigation">
                <div><a class="arrow-link arrow-link--reverse" href="{{route('one_car.page', $car->alias)}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "back")}}</a></div>
                <div>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{route('main.page')}}">{{$pages->where('alias', 'main')->first()->getTranslation('name')}}</a></li>
                            <li><a href="{{route('brands.page')}}">{{$pages->where('alias', 'car_brands')->first()->getTranslation('name')}}</a></li>
                            <li><a href="{{route('sort_cars_by_brand', $car->carBrand->name)}}">{{$car->carBrand->name}}</a></li>
                            <li><a href="{{route('one_car.page', $car->alias)}}">{{$car->carBrand->name}} {{$car->model}}</a></li>
                            <li>{{App\Models\Translation::getTranslWord($words, $sel_lang, "reservation")}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="two-steps"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "enter_your_data")}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "confirm_your_booking")}}</span></div>
            <form class="booking" action="{{route('simple_rent.send_mail')}}" method="post">
                @csrf
                <input type="hidden" value="{{$total_price_per_days}}" name="total_per_days">
                <input type="hidden" value="{{$vat_tax_price}}" name="vat_tax">
                <input type="hidden" value="{{$final_price}}" name="total_price">
                <input type="hidden" value="{{$car->id}}" name="car_id">
                <input type="hidden" value="{{$data_from}}" name="from_date">
                <input type="hidden" value="{{$data_to}}" name="from_to">
                <input type="hidden" value="{{$time}}" name="time">
                <input type="hidden" value="{{$diffDays}}" name="diffDays">
                <input type="hidden" value="{{$another_location}}" name="another_location">
                <input type="hidden" value="0" name="pay_fifteen">
                <div class="booking__content lg:mb-35">
                    <div class="booking__text mb-35">{{App\Models\Translation::getTranslWord($words, $sel_lang, "client_name_text")}}</div>
                    <div class="mb-35">
                        <div class="input-group input-group--with-label mb-0">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "FIO")}} <span class="text-red">*</span></label>
                            <input type="text" name="fio" required>
                        </div>
                    </div>
                    <div class="booking__2col mb-35">
                        <div class="input-group input-group--with-label mb-0 md:mb-35">
                            <label>E-mail <span class="text-red">*</span></label>
                            <input type="email" name="email" value="{{auth()->user() ? auth()->user()->email : ''}}" required>
                        </div>
                        <div class="input-group input-group--with-label mb-0 md:mb-35">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "phone")}} <span class="text-red">*</span></label>
                            <input type="text" name="phone" value="{{auth()->user() ? auth()->user()->phone : ''}}"  required>
                        </div>
                    </div>
                    <div class="booking__radioboxes mb-35">
                        <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "international_rights")}} <span class="text-red">*</span></label>
                        <div>
                            <div class="radio-group">
                                <input id="booking-radio-1" type="radio" name="international_law" value="1" checked>
                                <label for="booking-radio-1">{{App\Models\Translation::getTranslWord($words, $sel_lang, "yes")}}</label>
                            </div>
                            <div class="radio-group">
                                <input id="booking-radio-2" type="radio" name="international_law" value="0">
                                <label for="booking-radio-2">{{App\Models\Translation::getTranslWord($words, $sel_lang, "no")}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-35">
                        <div class="input-group input-group--with-label mb-0">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "car_pick_location")}} <span class="text-red">*</span></label>
                            <div class="custom-select-wrapper">
                                <select class="custom-select custom-select--bold custom-select--uppercase" name="city" data-dropdown-css-class="custom-select-dropdown custom-select-dropdown--bold custom-select-dropdown--uppercase" required>
                                    <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                    <option value="1" {{$city=="1" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "dubai2")}}</option>
                                    <option value="2" {{$city=="2" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "abu_dhabi")}}</option>
                                    <option value="3" {{$city=="3" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "sharjah")}}</option>
                                    <option value="4" {{$city=="4" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "ras-al-Khaim")}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-35">
                        <div class="input-group input-group--with-label input-group--with-label-white">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "special_notice")}} <span class="text-red">*</span></label>
                            <textarea name="message" placeholder="{{App\Models\Translation::getTranslWord($words, $sel_lang, "car_delivery_address")}}" required=""></textarea>
                        </div>
                    </div>
                    <div class="mb-35">
                        <div class="checkbox-group-2">
                            <input id="booking-terms-checkbox" name="condition_and_politic" type="checkbox" required>
                            <label for="booking-terms-checkbox">{{App\Models\Translation::getTranslWord($words, $sel_lang, "yes_read")}} <a class="underline" href="{{route('dynamical.page', 'rent_condition')}}" target="_blank">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rent_terms")}}</a> {{App\Models\Translation::getTranslWord($words, $sel_lang, "and")}} <a class="underline" href="{{route('dynamical.page', 'privacy_policy')}}" target="_blank">{{$pages->where('alias', "privacy_policy")->first()->getTranslation('name')}}</a></label>
                        </div>
                    </div>
                    <div class="mb-80 lg:mb-35">
                        <div class="captcha-placeholder"><div class="g-recaptcha" data-sitekey="6LfzSzAaAAAAAIxMPCfTNBb4zrUbRkXyU9yE3CAM"></div></div>
                    </div>
                    <div class="booking__2col mt-auto">
                        <div class="booking__btn-with-text md:mb-35">
                            <button class="btn-outlined btn-outlined--theme-accent3 pay-btn">{{App\Models\Translation::getTranslWord($words, $sel_lang, "pay_and_book")}}</button><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "it_is_guaranteed")}}</span>
                        </div>
                        <div class="booking__btn-with-text md:mb-0">
                  <button class="btn-outlined btn-outlined--theme-accent2">{{App\Models\Translation::getTranslWord($words, $sel_lang, "leave_request_online")}}</button><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "you_get_this_car")}}</span>
                        </div>
                    </div>
                </div>
                <div class="booking__sidebar">
                    <div class="car-booking-info h-full">
                        <div class="car-booking-info__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "your_car")}}</div>
                        <div class="car-booking-info__car">
                            <div><img src="{{$car->images->sortBy('order_id')->first()->url}}" style="max-width: 215px" alt=""></div>
                            <div>

                                <div class="car-booking-info__car-date-block car-booking-info__car-date-block--from"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "receiving")}}</span>
                                    <span>@if($city=="1")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "dubai")}}
                                        @elseif($city=="2")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "abu_dhabi")}}
                                        @elseif($city=="3")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "sharjah")}}
                                        @elseif($city=="4")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "ras-al-Khaim")}}
                                        @elseif($city=="5")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "all_uae")}}
                                        @endif
                                    </span><span>{{Carbon\Carbon::parse($data_from)->format('D, d/m/Y')}}, {{$time<10 ? "0".$time : $time}}:00</span><a class="underline modal-open" href="#change-date">{{App\Models\Translation::getTranslWord($words, $sel_lang, "change")}}</a></div>
                                <div class="car-booking-info__car-date-block car-booking-info__car-date-block--to"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "return")}}</span>
                                    <span>
                                        @if($city=="1")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "dubai")}}
                                        @elseif($city=="2")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "abu_dhabi")}}
                                        @elseif($city=="3")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "sharjah")}}
                                        @elseif($city=="4")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "ras-al-Khaim")}}
                                        @elseif($city=="5")
                                            {{App\Models\Translation::getTranslWord($words, $sel_lang, "all_uae")}}
                                        @endif
                                    </span><span>{{Carbon\Carbon::parse($data_to)->format('D, d/m/Y')}}, 10:00</span><a class="underline modal-open" href="#change-date">{{App\Models\Translation::getTranslWord($words, $sel_lang, "change")}}</a></div>
                            </div>
                        </div>
                        <div class="car-booking-info__car-name"><img src="{{$car->carBrand ? $car->carBrand->icon : ''}}" alt="">{{$car->carBrand->name}} {{$car->model}}</div>
                        <div class="car-booking-info__sum px-25 xs:px-0 lg:px-25 xxl:px-0">
                            <div><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "total_amount_for_car_rental")}} {{$diffDays}} {{App\Models\Translation::getTranslWord($words, $sel_lang, "days2")}}</span><span>{{$car_currency->symbol}} {{App\Models\Currency::CurrencyConverter($total_price_per_days,$car_currency->dollar_rate)}}</span></div>
                            <div><span>VAT Tax ({{$setting->vat_tax}}%)</span><span>+ {{$car_currency->symbol}} {{App\Models\Currency::CurrencyConverter($vat_tax_price,$car_currency->dollar_rate)}}</span></div>
                        </div>
                        <div class="car-booking-info__sum-total px-25 xs:px-0 lg:px-25 xxl:px-0"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "total_amount_paid")}}</span><span>{{$car_currency->symbol}} {{App\Models\Currency::CurrencyConverter($final_price,$car_currency->dollar_rate)}}</span></div>
                        <div class="car-booking-info__deposit px-25 xs:px-0 lg:px-25 xxl:px-0"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "deposit")}}</span><span>{{$car_currency->symbol}} {{App\Models\Currency::CurrencyConverter($car->simpleRent->deposit,$car_currency->dollar_rate)}}</span></div>
                        <div class="px-25 mb-35 xs:px-0 lg:px-25 xxl:px-0">
                            <div class="check">{{$car->simpleRent ? $car->simpleRent->mileage_limit : '0'}} {{App\Models\Translation::getTranslWord($words, $sel_lang, "km_included_price_day")}}</div>
                        </div>
                        <div class="car-booking-info__btn px-25 mb-35 xs:px-0 lg:px-25 xxl:px-0">
                  <button class="btn w-full"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "leave_request_online")}}</span></button>
                        </div>
                        <div class="car-booking-info__special-block">
                            <div><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "pay_text2")}}:</span><span>{{$car_currency->symbol}} {{App\Models\Currency::CurrencyConverter(round($final_price/100*15, 2),$car_currency->dollar_rate)}}</span></div><a class="btn btn--theme-accent3 w-full pay-btn" href="#"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "pay_and_book")}}</span></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <div class="modal modal--change-dates modal--gray mfp-hide" id="change-date">
        <div class="modal__inner">
            <button class="close-button modal__close modal__close--inside"></button>
            <form class="modal__form" action="{{route('booking_cars_simple_rent', $car->id)}}" method="get">
                <div class="modal__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "you_can_change")}}</div>
                <div class="modal__dates">
                    <div class="modal__date">
                        <div>{{App\Models\Translation::getTranslWord($words, $sel_lang, "receiving")}}</div>
                        <div>
                            <div>
                                <div class="input-group input-group--with-label mb-0">
                                    <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "city")}}</label>
                                    <div class="custom-select-wrapper">
                                        <select class="custom-select custom-select--bold custom-select--uppercase" name="city" data-dropdown-css-class="custom-select-dropdown custom-select-dropdown--bold custom-select-dropdown--uppercase">
                                            <option label="Выберите из списка"></option>
                                            <option value="1">{{App\Models\Translation::getTranslWord($words, $sel_lang, "dubai")}}</option>
                                            <option value="2">{{App\Models\Translation::getTranslWord($words, $sel_lang, "abu_dhabi")}}</option>
                                            <option value="3">{{App\Models\Translation::getTranslWord($words, $sel_lang, "sharjah")}}</option>
                                            <option value="4">{{App\Models\Translation::getTranslWord($words, $sel_lang, "ras-al-Khaim")}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal__date-2col">
                                <div>
                                    <div class="input-group input-group--with-label input-group--with-icon input-group--input-bold input-group--input-fz-sm mb-0 hidden-desktop">
                                        <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_from")}}</label>
                                        <input type="date" data-datepicker-mob-from name="date_from" required>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356" width="25" height="25">
                                            <path fill="#828C98" d="M320.525 36.508V10h-45.706v26.508h-98.638V10h-45.706v26.508H95V271h261V36.508h-35.475zm-30.413-11.215h15.12v31.605h-15.12V25.293zm-144.344 0h15.12v31.605h-15.12V25.293zm194.939 230.414H110.293v-151.91h230.414v151.91zm0-167.203H110.293V51.8h20.182v20.39h45.706v-20.39h98.638v20.39h45.706v-20.39h20.182v36.703z"></path>
                                            <path fill="#828C98" d="M238.134 123.678h-25.266v15.293h25.266v-15.293zM281.179 123.678h-25.266v15.293h25.266v-15.293zM324.223 123.678h-25.266v15.293h25.266v-15.293zM152.04 156.812h-25.266v15.293h25.266v-15.293zM195.089 156.812h-25.266v15.293h25.266v-15.293zM238.134 156.812h-25.266v15.293h25.266v-15.293zM281.179 156.812h-25.266v15.293h25.266v-15.293zM324.223 156.812h-25.266v15.293h25.266v-15.293zM152.04 189.947h-25.266v15.293h25.266v-15.293zM195.089 189.947h-25.266v15.293h25.266v-15.293zM238.134 189.947h-25.266v15.293h25.266v-15.293zM281.179 189.947h-25.266v15.293h25.266v-15.293zM324.223 189.947h-25.266v15.293h25.266v-15.293zM152.04 223.082h-25.266v15.293h25.266v-15.293zM195.089 223.082h-25.266v15.293h25.266v-15.293zM238.134 223.082h-25.266v15.293h25.266v-15.293zM281.179 223.082h-25.266v15.293h25.266v-15.293z"></path>
                                            <path fill="#828C98" d="M193.957 256.341l-71.182-71.193a10.704 10.704 0 00-7.628-3.148 10.708 10.708 0 00-7.629 3.148l-6.463 6.465a10.708 10.708 0 00-3.15 7.629c0 2.888 1.12 5.689 3.15 7.718l41.527 41.624H10.649C4.7 248.584 0 253.241 0 259.192v9.14c0 5.951 4.7 11.078 10.649 11.078h132.404l-41.997 41.856c-2.03 2.032-3.149 4.668-3.149 7.558 0 2.886 1.119 5.561 3.149 7.592l6.463 6.444c2.032 2.033 4.739 3.14 7.63 3.14 2.887 0 5.595-1.122 7.627-3.154l71.183-71.192a10.714 10.714 0 003.149-7.652c.006-2.903-1.112-5.626-3.151-7.661z"></path>
                                        </svg>
                                    </div>
                                    <div class="input-group input-group--with-label input-group--with-icon input-group--input-bold input-group--input-fz-sm mb-0 hidden-mobile">
                                        <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_from")}}</label>
                                        <input type="text" data-datepicker-from name="date_from" data-date-from-to-id="date-from-to" required>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356" width="25" height="25">
                                            <path fill="#828C98" d="M320.525 36.508V10h-45.706v26.508h-98.638V10h-45.706v26.508H95V271h261V36.508h-35.475zm-30.413-11.215h15.12v31.605h-15.12V25.293zm-144.344 0h15.12v31.605h-15.12V25.293zm194.939 230.414H110.293v-151.91h230.414v151.91zm0-167.203H110.293V51.8h20.182v20.39h45.706v-20.39h98.638v20.39h45.706v-20.39h20.182v36.703z"></path>
                                            <path fill="#828C98" d="M238.134 123.678h-25.266v15.293h25.266v-15.293zM281.179 123.678h-25.266v15.293h25.266v-15.293zM324.223 123.678h-25.266v15.293h25.266v-15.293zM152.04 156.812h-25.266v15.293h25.266v-15.293zM195.089 156.812h-25.266v15.293h25.266v-15.293zM238.134 156.812h-25.266v15.293h25.266v-15.293zM281.179 156.812h-25.266v15.293h25.266v-15.293zM324.223 156.812h-25.266v15.293h25.266v-15.293zM152.04 189.947h-25.266v15.293h25.266v-15.293zM195.089 189.947h-25.266v15.293h25.266v-15.293zM238.134 189.947h-25.266v15.293h25.266v-15.293zM281.179 189.947h-25.266v15.293h25.266v-15.293zM324.223 189.947h-25.266v15.293h25.266v-15.293zM152.04 223.082h-25.266v15.293h25.266v-15.293zM195.089 223.082h-25.266v15.293h25.266v-15.293zM238.134 223.082h-25.266v15.293h25.266v-15.293zM281.179 223.082h-25.266v15.293h25.266v-15.293z"></path>
                                            <path fill="#828C98" d="M193.957 256.341l-71.182-71.193a10.704 10.704 0 00-7.628-3.148 10.708 10.708 0 00-7.629 3.148l-6.463 6.465a10.708 10.708 0 00-3.15 7.629c0 2.888 1.12 5.689 3.15 7.718l41.527 41.624H10.649C4.7 248.584 0 253.241 0 259.192v9.14c0 5.951 4.7 11.078 10.649 11.078h132.404l-41.997 41.856c-2.03 2.032-3.149 4.668-3.149 7.558 0 2.886 1.119 5.561 3.149 7.592l6.463 6.444c2.032 2.033 4.739 3.14 7.63 3.14 2.887 0 5.595-1.122 7.627-3.154l71.183-71.192a10.714 10.714 0 003.149-7.652c.006-2.903-1.112-5.626-3.151-7.661z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <div class="input-group input-group--with-label mb-0">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal__date">
                        <div>{{App\Models\Translation::getTranslWord($words, $sel_lang, "return")}}</div>
                        <div>
                            <div class="modal__date-2col">
                                <div>
                                    <div class="input-group input-group--with-label input-group--with-icon input-group--input-bold input-group--input-fz-sm mb-0 hidden-desktop">
                                        <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_to")}}</label>
                                        <input type="date" data-datepicker-mob-to name="date_to" required>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356" width="25" height="25">
                                            <path fill="#828C98" d="M35.475 36.508V10h45.706v26.508h98.638V10h45.706v26.508H261V271H0V36.508h35.475zm30.413-11.215h-15.12v31.605h15.12V25.293zm144.344 0h-15.12v31.605h15.12V25.293zM15.293 255.707h230.414v-151.91H15.293v151.91zm0-167.203h230.414V51.8h-20.182v20.39h-45.706v-20.39H81.181v20.39H35.475v-20.39H15.293v36.703z"></path>
                                            <path fill="#828C98" d="M117.866 123.678h25.266v15.293h-25.266v-15.293zM74.821 123.678h25.266v15.293H74.821v-15.293zM31.777 123.678h25.266v15.293H31.777v-15.293zM203.96 156.812h25.266v15.293H203.96v-15.293zM160.911 156.812h25.266v15.293h-25.266v-15.293zM117.866 156.812h25.266v15.293h-25.266v-15.293zM74.821 156.812h25.266v15.293H74.821v-15.293zM31.777 156.812h25.266v15.293H31.777v-15.293zM203.96 189.947h25.266v15.293H203.96v-15.293zM160.911 189.947h25.266v15.293h-25.266v-15.293zM117.866 189.947h25.266v15.293h-25.266v-15.293zM74.821 189.947h25.266v15.293H74.821v-15.293zM31.777 189.947h25.266v15.293H31.777v-15.293zM203.96 223.082h25.266v15.293H203.96v-15.293zM160.911 223.082h25.266v15.293h-25.266v-15.293zM117.866 223.082h25.266v15.293h-25.266v-15.293zM74.821 223.082h25.266v15.293H74.821v-15.293z"></path>
                                            <path fill="#828C98" d="M162.043 256.341l71.182-71.193a10.704 10.704 0 017.628-3.148c2.891 0 5.598 1.117 7.629 3.148l6.463 6.465a10.707 10.707 0 013.149 7.629c0 2.888-1.118 5.689-3.149 7.718l-41.527 41.624h131.933c5.949 0 10.649 4.657 10.649 10.608v9.14c0 5.951-4.7 11.078-10.649 11.078H212.947l41.997 41.856c2.03 2.032 3.149 4.668 3.149 7.558 0 2.886-1.119 5.561-3.149 7.592l-6.463 6.444c-2.032 2.033-4.739 3.14-7.63 3.14a10.713 10.713 0 01-7.627-3.154l-71.183-71.192a10.714 10.714 0 01-3.149-7.652c-.006-2.903 1.112-5.626 3.151-7.661z"></path>
                                        </svg>
                                    </div>
                                    <div class="input-group input-group--with-label input-group--with-icon input-group--input-bold input-group--input-fz-sm mb-0 hidden-mobile">
                                        <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_to")}}</label>
                                        <input type="text" data-datepicker-to name="date_to" data-date-from-to-id="date-from-to" required>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356" width="25" height="25">
                                            <path fill="#828C98" d="M35.475 36.508V10h45.706v26.508h98.638V10h45.706v26.508H261V271H0V36.508h35.475zm30.413-11.215h-15.12v31.605h15.12V25.293zm144.344 0h-15.12v31.605h15.12V25.293zM15.293 255.707h230.414v-151.91H15.293v151.91zm0-167.203h230.414V51.8h-20.182v20.39h-45.706v-20.39H81.181v20.39H35.475v-20.39H15.293v36.703z"></path>
                                            <path fill="#828C98" d="M117.866 123.678h25.266v15.293h-25.266v-15.293zM74.821 123.678h25.266v15.293H74.821v-15.293zM31.777 123.678h25.266v15.293H31.777v-15.293zM203.96 156.812h25.266v15.293H203.96v-15.293zM160.911 156.812h25.266v15.293h-25.266v-15.293zM117.866 156.812h25.266v15.293h-25.266v-15.293zM74.821 156.812h25.266v15.293H74.821v-15.293zM31.777 156.812h25.266v15.293H31.777v-15.293zM203.96 189.947h25.266v15.293H203.96v-15.293zM160.911 189.947h25.266v15.293h-25.266v-15.293zM117.866 189.947h25.266v15.293h-25.266v-15.293zM74.821 189.947h25.266v15.293H74.821v-15.293zM31.777 189.947h25.266v15.293H31.777v-15.293zM203.96 223.082h25.266v15.293H203.96v-15.293zM160.911 223.082h25.266v15.293h-25.266v-15.293zM117.866 223.082h25.266v15.293h-25.266v-15.293zM74.821 223.082h25.266v15.293H74.821v-15.293z"></path>
                                            <path fill="#828C98" d="M162.043 256.341l71.182-71.193a10.704 10.704 0 017.628-3.148c2.891 0 5.598 1.117 7.629 3.148l6.463 6.465a10.707 10.707 0 013.149 7.629c0 2.888-1.118 5.689-3.149 7.718l-41.527 41.624h131.933c5.949 0 10.649 4.657 10.649 10.608v9.14c0 5.951-4.7 11.078-10.649 11.078H212.947l41.997 41.856c2.03 2.032 3.149 4.668 3.149 7.558 0 2.886-1.119 5.561-3.149 7.592l-6.463 6.444c-2.032 2.033-4.739 3.14-7.63 3.14a10.713 10.713 0 01-7.627-3.154l-71.183-71.192a10.714 10.714 0 01-3.149-7.652c-.006-2.903 1.112-5.626 3.151-7.661z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <div class="checkbox-group-2 checkbox-group-2--small checkbox-group-2--centered">
                                        <input id="change-date-return-in-another-location" type="checkbox" name="change-date-return-in-another-location">
                                        <label for="change-date-return-in-another-location">{{App\Models\Translation::getTranslWord($words, $sel_lang, "return_another_place")}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="relocation-point"></div>
                </div>
                <div class="modal__date-btn-group">
                    <button class="btn-outlined btn-outlined--theme-accent2 w-full">{{App\Models\Translation::getTranslWord($words, $sel_lang, "save_changes")}}</button>
                </div>
            </form>
        </div>
    </div>
    <div class="date-from-to date-from-to--center" id="date-from-to" data-relocate-to="#relocation-point">
        <div class="flatpickr-hero" data-elem-from="[data-datepicker-from]" data-elem-to="[data-datepicker-to]" data-hidden data-lang="ru"></div>
    </div>
@endsection



@section('js')
    @parent
    <script>

        $('.w-full').on("click", function(){
            $('.booking').submit();
        });
		$('body').on('click', '.pay-btn', function(e) {
            e.preventDefault();
            console.log('click');
			$('input[name="pay_fifteen"]').val('1');
            $('.btn-outlined--theme-accent2').trigger('click');
        });
    </script>
@stop