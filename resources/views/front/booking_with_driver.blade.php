@extends('layouts.app')
@section('content')
    <!--Main content-->
    <main class="main">
        <div class="container">
            <div class="top-navigation">
                <div><a class="arrow-link arrow-link--reverse" href="{{route('one_car.page', $car->alias)}}">Назад</a></div>
                <div>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{route('main.page')}}">{{$pages->where('alias', 'main')->first()->getTranslation('name')}}</a></li>
                            <li><a href="{{route('cars_rent_with_driver.page')}}">{{$pages->where('alias', 'rent-of-cars-with-driver')->first()->getTranslation('name')}}</a></li>
                            <li><a href="{{route('one_car_with_driver.page', $car->alias)}}">{{$car->carBrand->name}} {{$car->model}}</a></li>
                            <li>{{App\Models\Translation::getTranslWord($words, $sel_lang, "reservation")}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="two-steps"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "enter_your_data")}}</span><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "confirm_your_booking")}}</span></div>
            <form class="booking booking--wide-content" action="{{route('with_driver_rent.send_mail')}}" method="post">
                @csrf
                <input name="total_price" type="hidden" value="{{$final_price}}">
                <input name="car_id" type="hidden" value="{{$car->id}}">
                <div class="booking__content">
                    <div class="mb-35">
                        <div class="input-group input-group--with-label mb-0">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "FIO")}} <span class="text-red">*</span></label>
                            <input type="text" name="fio" required>
                        </div>
                    </div>
                    <div class="booking__2col mb-35">
                        <div class="input-group input-group--with-label mb-0 md:mb-35">
                            <label>E-mail <span class="text-red">*</span></label>
                            <input type="text" name="email" required value="{{auth()->user() ? auth()->user()->email : ''}}">
                        </div>
                        <div class="input-group input-group--with-label mb-0 md:mb-35">
                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "phone")}} <span class="text-red">*</span></label>
                            <input type="text" name="phone" required value="{{auth()->user() ? auth()->user()->phone : ''}}">
                        </div>
                    </div>
                    <div class="booking__2col mb-35">
                        <div class="booking__2col-2col">
                            <div>
                                <div class="input-group input-group--with-label input-group--with-icon input-group--input-bold input-group--input-fz-sm mb-0 md:mb-35">
                                    <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "data")}}</label>
                                    <input class="flatpickr" type="text" name="date" data-lang="ru" value="{{Session::get('date')}}" required>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 356 356" width="25" height="25">
                                        <path fill="#828C98" d="M320.525 36.508V10h-45.706v26.508h-98.638V10h-45.706v26.508H95V271h261V36.508h-35.475zm-30.413-11.215h15.12v31.605h-15.12V25.293zm-144.344 0h15.12v31.605h-15.12V25.293zm194.939 230.414H110.293v-151.91h230.414v151.91zm0-167.203H110.293V51.8h20.182v20.39h45.706v-20.39h98.638v20.39h45.706v-20.39h20.182v36.703z"></path>
                                        <path fill="#828C98" d="M238.134 123.678h-25.266v15.293h25.266v-15.293zM281.179 123.678h-25.266v15.293h25.266v-15.293zM324.223 123.678h-25.266v15.293h25.266v-15.293zM152.04 156.812h-25.266v15.293h25.266v-15.293zM195.089 156.812h-25.266v15.293h25.266v-15.293zM238.134 156.812h-25.266v15.293h25.266v-15.293zM281.179 156.812h-25.266v15.293h25.266v-15.293zM324.223 156.812h-25.266v15.293h25.266v-15.293zM152.04 189.947h-25.266v15.293h25.266v-15.293zM195.089 189.947h-25.266v15.293h25.266v-15.293zM238.134 189.947h-25.266v15.293h25.266v-15.293zM281.179 189.947h-25.266v15.293h25.266v-15.293zM324.223 189.947h-25.266v15.293h25.266v-15.293zM152.04 223.082h-25.266v15.293h25.266v-15.293zM195.089 223.082h-25.266v15.293h25.266v-15.293zM238.134 223.082h-25.266v15.293h25.266v-15.293zM281.179 223.082h-25.266v15.293h25.266v-15.293z"></path>
                                        <path fill="#828C98" d="M193.957 256.341l-71.182-71.193a10.704 10.704 0 00-7.628-3.148 10.708 10.708 0 00-7.629 3.148l-6.463 6.465a10.708 10.708 0 00-3.15 7.629c0 2.888 1.12 5.689 3.15 7.718l41.527 41.624H10.649C4.7 248.584 0 253.241 0 259.192v9.14c0 5.951 4.7 11.078 10.649 11.078h132.404l-41.997 41.856c-2.03 2.032-3.149 4.668-3.149 7.558 0 2.886 1.119 5.561 3.149 7.592l6.463 6.444c2.032 2.033 4.739 3.14 7.63 3.14 2.887 0 5.595-1.122 7.627-3.154l71.183-71.192a10.714 10.714 0 003.149-7.652c.006-2.903-1.112-5.626-3.151-7.661z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <div class="input-group input-group--with-label mb-0 md:mb-35">
                                    <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "time")}}</label>
                                    <div class="custom-select-wrapper">
                                        <select class="custom-select custom-select--bold custom-select--uppercase time-select" name="time" data-dropdown-css-class="custom-select-dropdown custom-select-dropdown--bold custom-select-dropdown--uppercase">
                                            <option label="Выберите из списка"></option>
                                            @for($i=0; $i<=23; $i++)
                                                <option value="{{$i}}" {{Session::get('time')==$i ? 'selected' : ''}}>{{$i<10 ? "0".$i : $i}}:00</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group input-group--with-label mb-0">
                            <label>Продолжительность аренды</label>
                            <div class="custom-select-wrapper">
                                <select class="custom-select custom-select--bold custom-select--uppercase select-date" name="duration" data-dropdown-css-class="custom-select-dropdown custom-select-dropdown--bold custom-select-dropdown--uppercase" data-placeholder="Выберите из списка">
                                    <option label="Выберите из списка"></option>
                                    <option value="1">1 час</option>
                                    <option value="2">2 часа</option>
                                    <option value="3" selected>3 часа</option>
                                    <option value="4">4 часа</option>
                                    <option value="5">5 часов (полдня)</option>
                                    <option value="6">6 часов</option>
                                    <option value="7">7 часов</option>
                                    <option value="8">8 часов</option>
                                    <option value="9">9 часов</option>
                                    <option value="10">10 часов (полный день)</option>
                                    <option value="11">11 часов</option>
                                    <option value="12">12 часов</option>
                                    <option value="13">13 часов</option>
                                    <option value="14">14 часов</option>
                                    <option value="15">15 часов</option>
                                    <option value="16">16 часов</option>
                                    <option value="17">17 часов</option>
                                    <option value="18">18 часов</option>
                                    <option value="19">19 часов</option>
                                    <option value="20">20 часов</option>
                                    <option value="21">21 часов</option>
                                    <option value="22">22 часов</option>
                                    <option value="23">23 часа</option>
                                    <option value="24">24 часа</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-35">
                        <div class="input-group input-group--with-label mb-0">
                            <label>Место следования <span class="text-red">*</span></label>
                            <div class="custom-select-wrapper">
                                <select class="custom-select custom-select--bold custom-select--uppercase" name="location" data-dropdown-css-class="custom-select-dropdown custom-select-dropdown--bold custom-select-dropdown--uppercase" required>
                                    <option label="Выберите из списка"></option>
                                    <option value="1" {{Session::get('work_location')=="1" ? 'selected' : ''}}>Дубай (международный аэропорт дубай (DXB)</option>
                                    <option value="2" {{Session::get('work_location')=="2" ? 'selected' : ''}}>Абу-даби</option>
                                    <option value="3" {{Session::get('work_location')=="3" ? 'selected' : ''}}>Шарджа</option>
                                    <option value="4" {{Session::get('work_location')=="4" ? 'selected' : ''}}>Рас-эль-хайм</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-80 lg:mb-35">
                        <div class="captcha-placeholder"><div class="g-recaptcha" data-sitekey="6LfzSzAaAAAAAIxMPCfTNBb4zrUbRkXyU9yE3CAM"></div></div>
                    </div>
                    <div class="booking__btn-centered">
                <button class="btn booking__btn-centered-btn"><span>Оставить заявку</span></button>
                    </div>
                </div>
                <div class="booking__sidebar">
                    <div class="car-booking-info">
                        <div class="car-booking-info__title">Ваш автомобиль</div>
                        <div class="car-booking-info__car">
                            <div><img src="{{$car->images->sortBy('order_id')->first()->url}}" style="max-width: 215px" alt=""></div>
                            <div>
                                <div class="car-booking-info__car-date-block car-booking-info__car-date-block--from"><span>Подача авто</span><span>{{Session::get('date')!=null ? Carbon\Carbon::parse(Session::get('date'))->format('D, d/m/y')."," : ""}} {{Session::get('time')!=null ?
                                Session::get('time')<10 ? "0".Session::get('time') : Session::get('time')
                                : "00"}}:00</span></div>
                                <div class="car-booking-info__car-date-block car-booking-info__car-date-block--location"><span>Место следования</span><span class="selected-place">
                                        @if(Session::get('work_location')=="1")
                                            Дубай
                                        @elseif(Session::get('work_location')=="2")
                                            Абу-даби
                                        @elseif(Session::get('work_location')=="3")
                                            Шарджа
                                        @elseif(Session::get('work_location')=="4")
                                            Рас-эль-хайм
                                        @endif
                                    </span></div>
                                <div class="car-booking-info__car-date-block car-booking-info__car-date-block--time"><span>Продолжительность</span><span class="selected-duration">3 часа</span></div>
                            </div>
                        </div>
                        <div class="car-booking-info__car-name"><img src="{{$car->carBrand ? $car->carBrand->icon : ''}}" alt="">{{$car->carBrand->name}} {{$car->model}}</div>
                        <div class="car-booking-info__sum car-booking-info__sum--single px-25 xs:px-0 lg:px-25 xxl:px-0">
                            <div><span class="total-price-text"></span><span class="total_price">{{App\Models\Currency::CurrencyConverter($final_price,$car_currency->dollar_rate)}} {{$car_currency->symbol}}</span></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

@endsection
@section('js')
    @parent
    <script>
        // $('select[name="date"]').on('change', function(){
        //     // console.log($(this).val())
        //     // var birthday = new Date('1995-12-17T03:24:00');
        // });
        $('select[name="location"]').on('change', function(){
            var location = $(this).find('option:selected').text();
            $('.selected-place').text(location);
        });
        function getDeliveryDate()
        {
            var date = $('input[name="date"]').val();
            console.log($('input[name="time"]').val());
            var time = parseInt($('.time-select').children("option:selected").text());
            time = time<10 ? "0"+time+":00" : time+":00";
            var new_date = date+", "+time;
            $('.car-booking-info__car-date-block--from span:eq(1)').text(new_date);
        }
        $('input[name="date"]').on("change", function(){
            getDeliveryDate();
        });
        $('.time-select').on("change", function(){
            getDeliveryDate();
        });
        $('select[name="duration"]').on('change', function(){
            var duration = $(this).val();
            $('.selected-duration').text(duration+' часов');
            var car_id = '{{$car->id}}';
            $.ajax({
                url: '{{route('with_driver_rent.getPrice')}}',
                type: "POST",
                data: {
                    duration: duration,
                    car_id: car_id,
                    _token: '@csrf',
                },
                success: function (data) {
                    var text = "Общая сумма за аренду авто с водителем за "+duration+" часов";
                    $('.total-price-text').text(text);
                    $('.total_price').text(data);
                    $('input[name="total_price"]').val(data);
                }
            });
        });
        console.log('script')
        $('.w-full').on("click", function(){
            $('.booking').submit();
        });
    </script>
@stop