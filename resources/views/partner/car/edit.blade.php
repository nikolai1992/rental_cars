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
                        <div class="user-block__back"><a class="arrow-link arrow-link--reverse" href="{{route('partner_car.index')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "back")}}</a></div>
                        <div class="user-block__tabs-toggler"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "Choose_type_rental")}}</span>
                            <div class="radio-group">
                                <input id="add-new-tab-toggler-1" type="radio" {{$model->rent_type=="simple_rent" ? 'checked' : ''}} name="car[rent_type]" value="simple_rent">
                                <label class="mb-0" for="add-new-tab-toggler-1">{{App\Models\Translation::getTranslWord($words, $sel_lang, "car_rent")}}</label>
                            </div>
                            <div class="radio-group">
                                <input id="add-new-tab-toggler-2" type="radio" name="car[rent_type]" {{$model->rent_type=="with_driver" ? 'checked' : ''}} value="with_driver">
                                <label class="mb-0" for="add-new-tab-toggler-2">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rent_with_driver")}}</label>
                            </div>
                        </div>
                        <div class="user-block__add-car-tab {{$model->rent_type=="simple_rent" ? 'active' : ''}}">
                            {!! Form::model($model,['url'=>route('partner_car.update', $model->id),'method'=>'PATCH','class'=>'user-inputs']) !!}
                                <h3 class="user-inputs__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "car_characteristics")}}</h3>
                            <input type="hidden" value="simple_rent" name="car[rent_type]">
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
                                <div class="user-inputs__row user-inputs__row--half mb-55">
                                    <h3 class="user-inputs__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rent_terms")}}</h3>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "deposit_usd")}} <span class="text-red">*</span></label>
                                            <input type="number" name="rent[deposit]" step="0.01" value="{{$model->simpleRent ? $model->simpleRent->deposit : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "mileage_limit_per_day_km")}} <span class="text-red">*</span></label>
                                            <input type="number" name="rent[mileage_limit]" value="{{$model->simpleRent ? $model->simpleRent->mileage_limit : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "cost_1_km_usd")}} <span class="text-red">*</span></label>
                                            <input type="number" name="rent[const_for_one_km]" step="0.01" value="{{$model->simpleRent ? $model->simpleRent->const_for_one_km : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "cost_1_km_usd")}} <span class="text-red">*</span></label>
                                            <input type="number" name="rent[age_limit]" value="{{$model->simpleRent ? $model->simpleRent->age_limit : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "driving_experience")}} <span class="text-red">*</span></label>
                                            <input type="number" name="rent[driving_experience]" step="0.01" value="{{$model->simpleRent ? $model->simpleRent->driving_experience : ''}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-inputs__row user-inputs__row--second-half mb-55">
                                    <h3 class="user-inputs__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rent_price")}}</h3>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_1_day")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_day_1]" step="0.01" value="{{$model->simpleRent ? $model->simpleRent->price_day_1 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_2_days")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_day_2]" step="0.01" value="{{$model->simpleRent ? $model->simpleRent->price_day_2 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_3_6_days")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_day_3_6]" step="0.01" value="{{$model->simpleRent ? $model->simpleRent->price_day_3_6 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_7_13_days")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_day_7_13]" step="0.01" value="{{$model->simpleRent ? $model->simpleRent->price_day_7_13 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_14_20_days")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_day_14_20]" step="0.01" value="{{$model->simpleRent ? $model->simpleRent->price_day_14_20 : ''}}" required>
                                        </div>
                                    </div>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_21_29_days")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_day_21_29]" step="0.01" value="{{$model->simpleRent ? $model->simpleRent->price_day_21_29 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per_30_days")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_day_30]" step="0.01" value="{{$model->simpleRent ? $model->simpleRent->price_day_30 : ''}}" required>
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
                        <div class="user-block__add-car-tab  {{$model->rent_type=="with_driver" ? 'active' : ''}}">
                            {!! Form::model($model,['url'=>route('partner_car.update', $model->id),'method'=>'PATCH','class'=>'user-inputs']) !!}
                            <input type="hidden" value="with_driver" name="rent_type">
                            <h3 class="user-inputs__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "car_characteristics")}}</h3>
                                <div class="user-inputs__row mb-55">
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "brand")}} <span class="text-red">*</span></label>
                                            <div class="custom-select-wrapper">
                                                <select class="custom-select" name=car[brand_id]" required>
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
                                            <input type="number" name="rent[price_per_hour_1]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_1 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 2 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_2]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_2 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 3 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_3]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_3 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 4 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_4]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_4 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 5 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_5]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_5 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 6 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_6]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_6 : ''}}" required>
                                        </div>
                                    </div>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 7 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_7]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_7 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 8 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_8]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_8 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 9 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_9]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_9 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 10 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_10]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_10 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 11 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_11]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_11 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 12 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_12]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_12 : ''}}" required>
                                        </div>
                                    </div>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 13 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_13]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_13 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 14 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_14]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_14 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 15 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_15]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_15 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 16 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_16]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_16 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 17 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_17]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_17 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 18 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_18]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_18 : ''}}" required>
                                        </div>
                                    </div>
                                    <div class="user-inputs__col">
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 19 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_19]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_19 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 20 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours2")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_20]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_20 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 21 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hour")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_21]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_21 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 22 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_22]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_22 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-20">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 23 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_23]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_23 : ''}}" required>
                                        </div>
                                        <div class="input-group input-group--with-label mb-0">
                                            <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "per")}} 24 {{App\Models\Translation::getTranslWord($words, $sel_lang, "hours")}}, $ <span class="text-red">*</span></label>
                                            <input type="number" name="rent[price_per_hour_24]" value="{{$model->driverRent ? $model->driverRent->price_per_hour_24 : ''}}" required>
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