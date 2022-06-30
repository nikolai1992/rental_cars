<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2018
 * Time: 12:23
 */

/**
 * @var \App\Models\Service $model
 */
?>

@extends('layouts.admin_app')

@section('title',$title)
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        {{--{{dd($model)}}--}}
        {!! Form::model($model,['url'=>route('car.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'', 'files' => true]) !!}
        <div class="box-body">
            <div class="row">
                <div class="pad col-md-4">
                    <label for="brand_id">Марка</label>
                    <select class="form-control" name="car[brand_id]" id="brand_id" required>
                        @foreach($brands2 as $brand)
                            <option value="{{$brand->id}}" {{$model->brand_id==$brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="pad col-md-4">
                    <label for="alias">Alias</label>
                    <input type="text" id="alias" name="car[alias]" class="form-control" value="{{ $model->alias }}">
                </div>
                <div class="pad col-md-4">
                    <label for="model">Модель</label>
                    <input type="text" id="model" name="car[model]" class="form-control" value="{{ $model->model }}">
                </div>
                <div class="pad col-md-4">
                    <label for="year_created">Год выпуска</label>
                    <select class="form-control" name="car[year_created]" required>
                        <option label="Выберите из списка"></option>
                        <option value="2014" {{$model->year_created=="2014" ? 'selected' : ''}}>2014</option>
                        <option value="2015" {{$model->year_created=="2015" ? 'selected' : ''}}>2015</option>
                        <option value="2016" {{$model->year_created=="2016" ? 'selected' : ''}}>2016</option>
                        <option value="2017" {{$model->year_created=="2017" ? 'selected' : ''}}>2017</option>
                        <option value="2018" {{$model->year_created=="2018" ? 'selected' : ''}}>2018</option>
                        <option value="2019" {{$model->year_created=="2019" ? 'selected' : ''}}>2019</option>
                        <option value="2020" {{$model->year_created=="2020" ? 'selected' : ''}}>2020</option>
                    </select>
                </div>
                <div class="pad col-md-4">
                    <label for="engine">Двигатель</label>
                    <input type="text" id="engine" name="car[engine]" class="form-control" value="{{ $model->engine }}">
                </div>
                <div class="pad col-md-4">
                    <label for="horsepower">Лошадиные силы</label>
                    <input type="text" id="horsepower" name="car[horsepower]" class="form-control" value="{{ $model->horsepower }}">
                </div>
                <div class="pad col-md-4">
                    <label for="transmission">Коробка передач</label>
                    <select class="form-control" name="car[transmission]" required>
                        <option label="Выберите из списка"></option>
                        <option value="1" {{$model->transmission=="1" ? 'selected' : ''}}>Механическая</option>
                        <option value="2" {{$model->transmission=="2" ? 'selected' : ''}}>Автомат</option>
                    </select>
                </div>
                <div class="pad col-md-4">
                    <label for="max_speed">Максимальная скорость, км/ч </label>
                    <input type="text" id="max_speed" name="car[max_speed]" class="form-control" value="{{ $model->max_speed }}">
                </div>
                <div class="pad col-md-4">
                    <label for="time_to_100">Время разгона до 100 км/ч </label>
                    <input type="text" id="time_to_100" name="car[time_to_100]" class="form-control" value="{{ $model->time_to_100 }}">
                </div>
                <div class="pad col-md-4">
                    <label for="seats_number">Количество мест </label>
                    <input type="number" id="seats_number" name="car[seats_number]" class="form-control" value="{{ $model->seats_number }}">
                </div>
                <div class="pad col-md-4">
                    <label for="color">Цвет автомобиля </label>
                    <input type="text" id="color" name="car[color]" class="form-control" value="{{ $model->color }}">
                </div>
                <div class="pad form-group">
                    <label for="cabin_color">Цвет салона </label>
                    <input type="text" id="cabin_color" name="car[cabin_color]" class="form-control" value="{{ $model->cabin_color }}">
                </div>
                <div class="pad col-md-4">
                    <label for="trunk_capacity">Вместительность багажника </label>
                    <select class="form-control" name="car[trunk_capacity]" required>
                        <option label="Выберите из списка"></option>
                        <option value="1" {{$model->trunk_capacity=="1" ? 'selected' : ''}}>1 маленькая сумка</option>
                        <option value="2" {{$model->trunk_capacity=="2" ? 'selected' : ''}}>1 большая сумка</option>
                        <option value="3" {{$model->trunk_capacity=="3" ? 'selected' : ''}}>1 маленькая сумка + 1 большая сумка</option>
                        <option value="4" {{$model->trunk_capacity=="4" ? 'selected' : ''}}>2 маленьких сумки+ 2 больших  сумки</option>
                        <option value="5" {{$model->trunk_capacity=="5" ? 'selected' : ''}}>1 маленькая сумка + 3 больших сумки</option>
                    </select>
                </div>
                <div class="pad col-md-4">
                    <label for="work_location">Прочие условия </label>
                    <select class="form-control" name="car[work_location]" id="work_location" required>
                        <option label="Выберите из списка"></option>
                        <option value="1" {{$model->work_location=="1" ? 'selected' : ''}}>Дубай</option>
                        <option value="2" {{$model->work_location=="2" ? 'selected' : ''}}>Абу-даби</option>
                        <option value="3" {{$model->work_location=="3" ? 'selected' : ''}}>Шарджа</option>
                        <option value="4" {{$model->work_location=="4" ? 'selected' : ''}}>Рас-эль-хайм</option>
                        <option value="5" {{$model->work_location=="5" ? 'selected' : ''}}>Все ОАЭ</option>
                    </select>
                </div>
                <div class="pad col-md-4">
                    <label for="car_class">Класс автомобиля </label>
                    <select class="form-control" name="car[car_class]" id="car_class">
                        <option label="Выберите из списка"></option>
                        <option value="vip" {{$model->car_class=="vip" ? 'selected' : ''}}>VIP класс</option>
                        <option value="elites" {{$model->car_class=="elites" ? 'selected' : ''}}>Элит класс</option>
                        <option value="suv" {{$model->car_class=="suv" ? 'selected' : ''}}>Внедорожники</option>
                        <option value="super_car" {{$model->car_class=="super_car" ? 'selected' : ''}}>Суперкары</option>
                        <option value="sport_class" {{$model->car_class=="sport_class" ? 'selected' : ''}}>Спорт класс</option>
                        <option value="business" {{$model->car_class=="business" ? 'selected' : ''}}>Бизнес класс</option>
                        <option value="middle" {{$model->car_class=="middle" ? 'selected' : ''}}>Средний класс</option>
                        <option value="econom" {{$model->car_class=="econom" ? 'selected' : ''}}>Эконом класс</option>
                        <option value="microbus" {{$model->car_class=="microbus" ? 'selected' : ''}}>Микроавтобусы</option>
                    </select>
                </div>
                <div class="pad col-md-4">
                    <label for="video">Видео </label>
                    <input type="text" id="video" name="car[video]" class="form-control" value="{{ $model->video }}">
                </div>
                <div class="pad col-md-4">
                    <label for="user_id">Партнер </label>
                    <select class="form-control" name="car[user_id]" id="user_id">
                        <option label="Выберите из списка"></option>
                        @foreach($partners as $partner)
                            <option value="{{$partner->id}}" {{$partner->id==$model->user_id ? 'selected' : ''}}>{{$partner->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="pad col-md-4">
                    <br><br>
                    <label>
                        <input type="radio" name="car[rent_type]" id="rent_type1" {{$model->rent_type=="simple_rent"&&$model->id ? 'checked' : ''}} value="simple_rent">
                        Аренда авто
                    </label>
                    <label>
                        <input type="radio" name="car[rent_type]" id="rent_type2" {{$model->rent_type=="with_driver" ? 'checked' : ''}} value="with_driver">
                        Аренда с водителем
                    </label>
                </div>

            </div>

            <div class="dynamical-div row">
                @if($model->rent_type==null||$model->rent_type=="simple_rent")
                    @include('admin._partials.simple_rent', compact('model'))
                @endif
                @if($model->rent_type=="with_driver")
                    @include('admin._partials.with_driver_rent', compact('model'))
                @endif
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('saved', "Сохранено и опубликовано") !!}
            <div class="input-group">

                {!! Form::checkbox('car[saved]', null, $model->saved, array('id'=>'saved')) !!}
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('car.index') }}" class="btn btn-warning">Отмена</a>
        </div>
        {!! Form::close() !!}
        @if($model->id)
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <h1>Галерея</h1>
                    </div><br>
                    <div class="row">
                        <a href="{{route('car_image.create')}}?id={{$model->id}}">
                            <button class="btn btn-sm btn-primary">Новое изображение</button>
                        </a>
                    </div><br>
                    <div class="row">
                        <table  class="example2 table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Изображение</th>
                                <th class="text-center">Действия</th>
                            </tr>
                            </thead>
                            @foreach($model->images->sortBy('order_id') as $image)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><img src="{{$image->url}}" style="width: 150px;"></td>
                                    <td class="text-center">
                                        @if($loop->iteration!=1)
                                            <a href="{{route('admin.car.image.move_upper', ["order_id"=>$loop->iteration, "id"=>$model->id])}}"
                                               class="text-info btn btn-link" title="Поместить выше"><i class="fas fa-arrow-up"></i></a>
                                            <a href="{{route('admin.car.image.move_to_top', ["order_id"=>$loop->iteration, "id"=>$model->id])}}"
                                               class="text-info btn btn-link" title="Поместить первой"><i class="fas fa-level-up-alt"></i></a>
                                        @endif
                                        @if($loop->iteration!=count($model->images))
                                            <a href="{{route('admin.car.image.move_lower', ["order_id"=>$loop->iteration, "id"=>$model->id])}}"
                                               class="text-info btn btn-link" title="Поместить ниже"><i class="fas fa-arrow-down"></i></a>
                                        @endif
                                        <a href="{{route('admin.car.image.rotate', $image->id)}}"
                                           class="text-info btn btn-link" title="Перевернуть"><i class="fas fa-undo"></i></a>
                                        {{Form::open(['route'=>['car_image.destroy',$image->id], 'method'=>'delete'])}}
                                        <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="Удалить">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                        {{Form::close()}}
                                        <a href="{{route('car_image.edit',$image->id)}}"
                                           class="text-info btn btn-link"><i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Изображение</th>
                                <th class="text-center">Действия</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <h1>Баннера</h1>
                    <div class="row">
                        <a href="{{route('banner.create')}}?id={{$model->id}}&model=Car">
                            <button class="btn btn-sm btn-primary">Новое изображение</button>
                        </a>
                    </div><br>
                    <div class="row">
                        <table  class="example2 table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Баннер</th>
                                <th class="text-center">Действия</th>
                            </tr>
                            </thead>
                            @foreach($model->banners as $banner)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        @if($banner->type=="image_link")
                                            <a href="{{$banner->src}}" target="_blank"><img src="{{$banner->image}}" style="width: 150px;"></a>
                                        @else
                                            {!! $banner->code !!}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{Form::open(['route'=>['banner.destroy',$banner->id], 'method'=>'delete'])}}
                                        <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="Удалить">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                        {{Form::close()}}
                                        <a href="{{route('banner.edit',$banner->id)}}?id={{$model->id}}&model=Car"
                                           class="text-info btn btn-link"><i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Изображение</th>
                                <th class="text-center">Действия</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        @endif

    </div>
@stop

@section('js')
    @parent
    <script>
        $('body').on('change', 'input[name="car[rent_type]"]', function(event) {
            console.log($(this).val())
            var value = $(this).val();
            if(value=="simple_rent")
            {
                $('.dynamical-div').html(`@include('admin._partials.simple_rent', compact('model'))`);
            }
            if(value=="with_driver")
            {
                $('.dynamical-div').html(`@include('admin._partials.with_driver_rent', compact('model'))`);
            }
        });
        $('body').on('change', '#icon', function(event) {
            console.log('camp_image')
            readURL2(this)
        });
        function readURL2(input) {
            console.log(input.files && input.files[0]);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    console.log($(input).parent().html());

                    $(input).parent().find('img').attr('src', e.target.result).show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@stop


