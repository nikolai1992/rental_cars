@extends('layouts.app')
@section('content')
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
                        <div class="user-block__back"><a class="arrow-link arrow-link--reverse" href="{{route('partner_car.index')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "back")}}</a></div>
                        <div class="user-block__nav">
                            <ul>
                                <li class="active"><span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                          <circle cx="166" cy="226" r="10" fill="currentColor"></circle>
                          <circle cx="166" cy="286" r="10" fill="currentColor"></circle>
                          <circle cx="166" cy="346" r="10" fill="currentColor"></circle>
                          <circle cx="166" cy="406" r="10" fill="currentColor"></circle>
                          <path fill="currentColor" d="M226 236h120c5.522 0 10-4.478 10-10s-4.478-10-10-10H226c-5.522 0-10 4.478-10 10s4.478 10 10 10zM226 296h120c5.522 0 10-4.478 10-10s-4.478-10-10-10H226c-5.522 0-10 4.478-10 10s4.478 10 10 10zM226 356h120c5.522 0 10-4.478 10-10s-4.478-10-10-10H226c-5.522 0-10 4.478-10 10s4.478 10 10 10zM226 416h120c5.522 0 10-4.478 10-10s-4.478-10-10-10H226c-5.522 0-10 4.478-10 10s4.478 10 10 10z"></path>
                          <path fill="currentColor" d="M406 90h-81.266C321.108 75.965 310.036 64.892 296 61.266V40c0-22.056-17.944-40-40-40s-40 17.944-40 40v21.266C201.965 64.892 190.892 75.965 187.266 90H106c-5.522 0-10 4.478-10 10v402c0 5.522 4.478 10 10 10h105c5.522 0 10-4.478 10-10s-4.478-10-10-10h-95V110h70v20c0 5.522 4.478 10 10 10h120c5.522 0 10-4.478 10-10v-20h70v382h-95c-5.522 0-10 4.478-10 10s4.478 10 10 10h105c5.522 0 10-4.478 10-10V100c0-5.522-4.477-10-10-10zM236 40c0-11.028 8.972-20 20-20s20 8.972 20 20v20h-40zm70 80H206v-20c0-11.028 8.972-20 20-20h60c11.028 0 20 8.972 20 20z"></path>
                          <circle cx="256" cy="502" r="10" fill="currentColor"></circle>
                        </svg>{{App\Models\Translation::getTranslWord($words, $sel_lang, "description")}}</span></li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                    </svg>
                                </li>
                                <li><span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                          <path fill="currentColor" d="M14 24.138a5.575 5.575 0 005.569-5.568c0-3.072-2.498-5.57-5.569-5.57s-5.569 2.498-5.569 5.569A5.575 5.575 0 0014 24.138zM14 15c1.968 0 3.569 1.602 3.569 3.569S15.968 22.138 14 22.138s-3.569-1.601-3.569-3.568S12.032 15 14 15z"></path>
                          <path fill="currentColor" d="M1 0v52h50V0H1zm2 2h46v26.727l-10.324-9.464a1.026 1.026 0 00-.72-.262 1.002 1.002 0 00-.694.325l-9.794 10.727-4.743-4.743a1 1 0 00-1.368-.044L4.622 40H3V2zm46 48H3v-8h46v8zM7.649 40l14.324-12.611L32.275 37.69a.999.999 0 101.414-1.414l-4.807-4.807 9.181-10.054L49 31.44V40H7.649z"></path>
                        </svg>{{App\Models\Translation::getTranslWord($words, $sel_lang, "photo")}}</span></li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                    </svg>
                                </li>
                                <li><span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 249.425 249.425">
                          <path fill="currentColor" d="M206.79 81.505a6 6 0 00-6 6v149.919H12V48.635h146.792a6 6 0 000-12H6a6 6 0 00-6 6v200.789a6 6 0 006 6h200.79a6 6 0 006-6V87.505a6 6 0 00-6-6z"></path>
                          <path fill="currentColor" d="M247.667 1.758a5.998 5.998 0 00-8.485 0L80.416 160.523 41.023 121.13a5.998 5.998 0 00-8.485 0 5.999 5.999 0 000 8.484l43.636 43.636c1.171 1.172 2.707 1.758 4.243 1.758s3.071-.586 4.243-1.758L247.667 10.243a5.998 5.998 0 000-8.485z"></path>
                        </svg>{{App\Models\Translation::getTranslWord($words, $sel_lang, "confirmation")}}</span></li>
                            </ul>
                        </div>
                        <div class="user-block__tabs-toggler"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "Choose_type_rental")}}</span>
                            <div class="radio-group">
                                <input id="add-new-tab-toggler-1" type="radio" name="car[rent_type]" value="simple_rent"
                                        {{$model->rent_type=="simple_rent"||$model->rent_type==null ? 'checked' : ''}}>
                                <label class="mb-0" for="add-new-tab-toggler-1">{{App\Models\Translation::getTranslWord($words, $sel_lang, "car_rent")}}</label>
                            </div>
                            <div class="radio-group">
                                <input id="add-new-tab-toggler-2" type="radio" name="car[rent_type]" value="with_driver"
                                        {{$model->rent_type=="with_driver" ? 'checked' : ''}}>
                                <label class="mb-0" for="add-new-tab-toggler-2">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rent_with_driver")}}</label>
                            </div>
                        </div>
                        <div class="user-block__add-car-tab {{$model->rent_type=="simple_rent"||$model->rent_type==null ? 'active' : ''}}">
                            {!! Form::model($model,['url'=>route('partner_car.store'),'method'=>'POST','class'=>'user-inputs']) !!}
                                <input type="hidden" value="simple_rent" name="car[rent_type]">
                                <h3 class="user-inputs__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "car_characteristics")}}</h3>
                                <div class="user-inputs__row mb-55">
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "brand")}} <span class="text-red">*</span></label>
                                            <div class="custom-select-wrapper">
                                                <select class="custom-select" name="car[brand_id]" required>
                                                    <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                                    @foreach($brandss as $brand)
                                                        <option value="{{$brand->id}}" {{$model->brand_id==$brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "model")}} <span class="text-red">*</span></label>
                                            <input type="text" name="car[model]" value="{{$model->model}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "year_issue")}} <span class="text-red">*</span></label>
                                            <div class="custom-select-wrapper">
                                                <select class="custom-select" name="car[year_created]">
                                                    <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                                    <option value="2014" {{$model->year_created=="2014" ? 'selected' : ''}}>2014</option>
                                                    <option value="2015" {{$model->year_created=="2015" ? 'selected' : ''}}>2015</option>
                                                    <option value="2016" {{$model->year_created=="2016" ? 'selected' : ''}}>2016</option>
                                                    <option value="2017" {{$model->year_created=="2017" ? 'selected' : ''}}>2017</option>
                                                    <option value="2018" {{$model->year_created=="2018" ? 'selected' : ''}}>2018</option>
                                                    <option value="2019" {{$model->year_created=="2019" ? 'selected' : ''}}>2019</option>
                                                    <option value="2020" {{$model->year_created=="2020" ? 'selected' : ''}}>2020</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "engine")}} <span class="text-red">*</span></label>
                                            <input type="text" name="car[engine]" value="{{$model->engine}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "horsepower")}} <span class="text-red">*</span></label>
                                            <input type="text" name="car[horsepower]" value="{{$model->horsepower}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "transmission")}} <span class="text-red">*</span></label>
                                            <div class="custom-select-wrapper">
                                                <select class="custom-select" name="car[transmission]">
                                                    <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                                    <option value="1" {{$model->transmission=="1" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "mechanical")}}</option>
                                                    <option value="2" {{$model->transmission=="2" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "automat")}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "maximum_speed")}}, {{App\Models\Translation::getTranslWord($words, $sel_lang, "km_per_hour")}} <span class="text-red">*</span></label>
                                            <input type="text" value="{{$model->max_speed}}" name="car[max_speed]" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "time_to_100")}} <span class="text-red">*</span></label>
                                            <input type="text" value="{{$model->time_to_100}}" name="car[time_to_100]" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "number_of_seats")}} <span class="text-red">*</span></label>
                                            <input type="number" value="{{$model->seats_number}}" name="car[seats_number]" required>
                                        </div>
                                    </div>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "car_color")}} <span class="text-red">*</span></label>
                                            <input type="text" name="car[color]" value="{{$model->color}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "interior_color")}} <span class="text-red">*</span></label>
                                            <input type="text" name="car[cabin_color]" value="{{$model->cabin_color}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "trunk_capacity")}} <span class="text-red">*</span></label>
                                            <div class="custom-select-wrapper">
                                                <select class="custom-select" name="car[trunk_capacity]">
                                                    <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                                    <option value="1" {{$model->trunk_capacity=="1" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "1_small_bag")}}</option>
                                                    <option value="2" {{$model->trunk_capacity=="2" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "1_large_bag")}}</option>
                                                    <option value="3" {{$model->trunk_capacity=="3" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "trunk_capacity_3")}}</option>
                                                    <option value="4" {{$model->trunk_capacity=="4" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "trunk_capacity_4")}}</option>
                                                    <option value="5" {{$model->trunk_capacity=="5" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "trunk_capacity_5")}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-inputs__row user-inputs__row--half mb-55">
                                    <h3 class="user-inputs__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rent_terms")}}</h3>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "deposit_usd")}} <span class="text-red">*</span></label>
                                            <input type="number" name="rent[deposit]" value="{{$model->simpleRent ? $model->simpleRent->deposit : ''}}" required step="0.01">
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "mileage_limit_per_day_km")}} <span class="text-red">*</span></label>
                                            <input type="number" name="rent[mileage_limit]" value="{{$model->simpleRent ? $model->simpleRent->mileage_limit : ''}}" required step="0.01">
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "cost_1_km_usd")}} <span class="text-red">*</span></label>
                                            <input type="number" name="rent[const_for_one_km]" value="{{$model->simpleRent ? $model->simpleRent->const_for_one_km : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "age_limit")}} <span class="text-red">*</span></label>
                                            <input type="number" name="rent[age_limit]" value="{{$model->simpleRent ? $model->simpleRent->age_limit : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "driving_experience")}} <span class="text-red">*</span></label>
                                            <input type="number" name="rent[driving_experience]" value="{{$model->simpleRent ? $model->simpleRent->driving_experience : ''}}" step="0.1" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-inputs__row user-inputs__row--second-half mb-55">
                                    <h3 class="user-inputs__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rent_price")}}</h3>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_1_day")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_day_1]" value="{{$model->simpleRent ? $model->simpleRent->price_day_1 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_2_days")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_day_2]" value="{{$model->simpleRent ? $model->simpleRent->price_day_2 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_3_6_days")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_day_3_6]" value="{{$model->simpleRent ? $model->simpleRent->price_day_3_6 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_7_13_days")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_day_7_13" value="{{$model->simpleRent ? $model->simpleRent->price_day_7_13 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_14_20_days")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_day_14_20]" value="{{$model->simpleRent ? $model->simpleRent->price_day_14_20 : ''}}" step="0.01" required>
                                        </div>
                                    </div>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_21_29_days")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_day_21_29]" value="{{$model->simpleRent ? $model->simpleRent->price_day_21_29 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_30_days")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_day_30]" value="{{$model->simpleRent ? $model->simpleRent->price_day_30 : ''}}" step="0.01" required>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="user-inputs__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "other_conditions")}}</h3>
                                <div class="user-inputs__row mb-70">
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "location_car")}}</label>
                                            <div class="custom-select-wrapper">
                                                <select class="custom-select custom-select--bold custom-select--uppercase" name="car[work_location]" data-dropdown-css-class="custom-select-dropdown custom-select-dropdown--bold custom-select-dropdown--uppercase">
                                                    <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                                    <option value="1" {{$model->work_location=="1" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "dubai")}}</option>
                                                    <option value="2" {{$model->work_location=="2" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "abu_dhabi")}}</option>
                                                    <option value="3" {{$model->work_location=="3" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "sharjah")}}</option>
                                                    <option value="4" {{$model->work_location=="4" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "ras-al-Khaim")}}</option>
                                                    <option value="5" {{$model->work_location=="5" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "all_uae")}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-inputs-btn user-inputs-btn--centered"><button type="submit" class="sm:min-w-0 sm:w-full btn-outlined btn-outlined--theme-accent2 min-w-330">{{App\Models\Translation::getTranslWord($words, $sel_lang, "further")}}</button></div>
                            {!! Form::close() !!}

                        </div>
                        <div class="user-block__add-car-tab {{$model->rent_type=="with_driver" ? 'active' : ''}}">
                            {!! Form::model($model,['url'=>route('partner_car.store'),'method'=>'POST','class'=>'user-inputs']) !!}
                                <input type="hidden" value="with_driver" name="car[rent_type]">
                                <h3 class="user-inputs__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "car_characteristics")}}</h3>
                                <div class="user-inputs__row mb-55">
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "brand")}} <span class="text-red">*</span></label>
                                            <div class="custom-select-wrapper">
                                                <select class="custom-select" name="car[brand_id]" required>
                                                    <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                                    @foreach($brands as $brand)
                                                        <option value="{{$brand->id}}" {{$model->brand_id==$brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "model")}} <span class="text-red">*</span></label>
                                            <input type="text" name="car[model]" value="{{$model->model}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "year_issue")}} <span class="text-red">*</span></label>
                                            <div class="custom-select-wrapper">
                                                <select class="custom-select" name="car[year_created]">
                                                    <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                                    <option value="2014" {{$model->year_created=="2014" ? 'selected' : ''}}>2014</option>
                                                    <option value="2015" {{$model->year_created=="2015" ? 'selected' : ''}}>2015</option>
                                                    <option value="2016" {{$model->year_created=="2016" ? 'selected' : ''}}>2016</option>
                                                    <option value="2017" {{$model->year_created=="2017" ? 'selected' : ''}}>2017</option>
                                                    <option value="2018" {{$model->year_created=="2018" ? 'selected' : ''}}>2018</option>
                                                    <option value="2019" {{$model->year_created=="2019" ? 'selected' : ''}}>2019</option>
                                                    <option value="2020" {{$model->year_created=="2020" ? 'selected' : ''}}>2020</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "engine")}} <span class="text-red">*</span></label>
                                            <input type="text" name="car[engine]" value="{{$model->engine}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "horsepower")}} <span class="text-red">*</span></label>
                                            <input type="text" name="car[horsepower]" value="{{$model->horsepower}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "transmission")}} <span class="text-red">*</span></label>
                                            <div class="custom-select-wrapper">
                                                <select class="custom-select" name="car[transmission]">
                                                    <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                                    <option value="1" {{$model->transmission=="1" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "mechanical")}}</option>
                                                    <option value="2" {{$model->transmission=="2" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "automat")}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "max_speed_km_h")}} <span class="text-red">*</span></label>
                                            <input type="text" value="{{$model->max_speed}}" name="car[max_speed]" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "time_to_100")}} <span class="text-red">*</span></label>
                                            <input type="text" value="{{$model->time_to_100}}" name="car[time_to_100]" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "number_of_seats")}} <span class="text-red">*</span></label>
                                            <input type="text" value="{{$model->seats_number}}" name="car[seats_number]" required>
                                        </div>
                                    </div>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "car_color2")}} <span class="text-red">*</span></label>
                                            <input type="text" name="car[color]" value="{{$model->color}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "interior_color")}} <span class="text-red">*</span></label>
                                            <input type="text" name="car[cabin_color]" value="{{$model->cabin_color}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "trunk_capacity")}} <span class="text-red">*</span></label>
                                            <div class="custom-select-wrapper">
                                                <select class="custom-select" name="car[trunk_capacity]">
                                                    <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                                    <option value="1" {{$model->trunk_capacity=="1" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "1_small_bag")}}</option>
                                                    <option value="2" {{$model->trunk_capacity=="2" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "1_large_bag")}}</option>
                                                    <option value="3" {{$model->trunk_capacity=="3" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "trunk_capacity_3")}}</option>
                                                    <option value="4" {{$model->trunk_capacity=="4" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "trunk_capacity_4")}}</option>
                                                    <option value="5" {{$model->trunk_capacity=="5" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "trunk_capacity_5")}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-inputs__row mb-55">
                                    <h3 class="user-inputs__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rent_price")}}</h3>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 1 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hour")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_1]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_1 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 2 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_2]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_2 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 3 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_3]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_3 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 4 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_4]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_4 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 5 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_5]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_5 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 6 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_6]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_6 : ''}}" step="0.01" required>
                                        </div>
                                    </div>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 7 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_7]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_7 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 8 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_8]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_8 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 9 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_9]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_9 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 10 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_10]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_10 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 11 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_11]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_11 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 12 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_12]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_12 : ''}}" step="0.01" required>
                                        </div>
                                    </div>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 13 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_13]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_13 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 14 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_14]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_14 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 15 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_15]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_15 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 16 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_16]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_16 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 17 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_17]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_17 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 18 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_18]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_18 : ''}}" step="0.01" required>
                                        </div>
                                    </div>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 19 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name=rent[price_per_hour_19]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_19 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 20 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_20]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_20 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 21 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hour")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_21]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_21 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 22 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_22]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_22 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 23 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_23]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_23 : ''}}" step="0.01" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 24 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_24]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_24 : ''}}" step="0.01" required>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="user-inputs__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "other_conditions")}}</h3>
                                <div class="user-inputs__row mb-70">
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "location_car")}}</label>
                                            <div class="custom-select-wrapper">
                                                <select class="custom-select custom-select--bold custom-select--uppercase" name="car[work_location]" data-dropdown-css-class="custom-select-dropdown custom-select-dropdown--bold custom-select-dropdown--uppercase">
                                                    <option label="{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_from_list")}}"></option>
                                                    <option value="1" {{$model->work_location=="1" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "dubai")}}</option>
                                                    <option value="2" {{$model->work_location=="2" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "abu_dhabi")}}</option>
                                                    <option value="3" {{$model->work_location=="3" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "sharjah")}}</option>
                                                    <option value="4" {{$model->work_location=="4" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "ras-al-Khaim")}}</option>
                                                    <option value="5" {{$model->work_location=="5" ? 'selected' : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "all_uae")}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="user-inputs-btn user-inputs-btn--centered"><button class="sm:min-w-0 sm:w-full btn-outlined btn-outlined--theme-accent2 min-w-330">{{App\Models\Translation::getTranslWord($words, $sel_lang, "further")}}</button></div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection