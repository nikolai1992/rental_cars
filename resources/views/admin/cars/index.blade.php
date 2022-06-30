<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 10.07.2018
 * Time: 11:06
 */

?>
@extends('layouts.admin_app')

@section('content_header')
    @if(Session::has('flash_message'))
        <div class="container">
            <div class="alert alert-success">
                {{Session::get('flash_message')}}
            </div>
        </div>
    @endif
@stop

@section('content')
    <br>
    <div class="row">
        <h1>{{$title}}</h1>
    </div><br>
    <div class="row">
        <a href="{{route('car.create')}}">
            <button class="btn btn-sm btn-primary">Добавить новое</button>
        </a>
    </div><br>
    <div class="row">
        <h2>Аренда машины</h2>
        <table  class="example2 table table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Фото</th>
                <th>Марка</th>
                <th>Модель</th>
                <th>Класс</th>
                <th>Партнер</th>
                <th>Опубликовано</th>
                <th>Количество бронирований</th>
                <th class="text-center">Действия</th>
            </tr>
            </thead>
            @foreach($cars->where('rent_type', 'simple_rent') as $car)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        @if(count($car->images))
                            <img src="{{$car->images->sortBy('order_id')->first()->url}}" style="width: 150px;">
                        @endif
                    </td>
                    <td>{{$car->carBrand ? $car->carBrand->name : ''}}</td>
                    <td>{{$car->model}}</td>
                    <td>
                        {{$car->car_class=="vip" ? 'VIP класс' : ''}}
                        {{$car->car_class=="elites" ? 'Элит класс' : ''}}
                        {{$car->car_class=="suv" ? 'Внедорожники' : ''}}
                        {{$car->car_class=="super_car" ? 'Суперкары' : ''}}
                        {{$car->car_class=="sport_class" ? 'Спорт класс' : ''}}
                        {{$car->car_class=="business" ? 'Бизнес класс' : ''}}
                        {{$car->car_class=="middle" ? 'Средний класс' : ''}}
                        {{$car->car_class=="econom" ? 'Эконом класс' : ''}}
                        {{$car->car_class=="microbus" ? 'Микроавтобусы' : ''}}
                    </td>
                    <td>
                        {!! $car->partner ? "<a href='".route('users.edit', $car->partner->id)."'>".$car->partner->name."</a>" : ''!!}
                    </td>
                    <td><input type="checkbox" disabled {{$car->saved ? 'checked' : ''}}></td>
                    <td>{{$car->getTotalRentalCount()}}</td>
                    <td class="text-center">
                        <a href="{{route('car.edit',$car->id)}}"
                           class="text-info btn btn-link"><i class="fa fa-pencil"></i></a>
                        {{Form::open(['route'=>['car.destroy',$car->id], 'method'=>'delete'])}}
                        <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="Удалить">
                            <i class="fa fa-trash-o"></i>
                        </button>
                        {{Form::close()}}
                    </td>
                </tr>
            @endforeach
            <tfoot>
            <tr>
                <th>#</th>
                <th>Фото</th>
                <th>Марка</th>
                <th>Модель</th>
                <th>Класс</th>
                <th>Опубликовано</th>
                <th>Партнер</th>
                <th>Количество бронирований</th>
                <th class="text-center">Действия</th>
            </tr>
            </tfoot>
        </table>
        <h2>Аренда машины с водителем</h2>
        <table  class="example2 table table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Фото</th>
                <th>Марка</th>
                <th>Модель</th>
                <th>Класс</th>
                <th>Партнер</th>
                <th>Опубликовано</th>
                <th>Количество бронирований</th>
                <th class="text-center">Действия</th>
            </tr>
            </thead>
            @foreach($cars->where('rent_type', 'with_driver') as $car)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        @if(count($car->images))
                            <img src="{{$car->images->sortBy('order_id')->first()->url}}" style="width: 150px;">
                        @endif
                    </td>
                    <td>{{$car->carBrand ? $car->carBrand->name : ''}}</td>
                    <td>{{$car->model}}</td>
                    <td>
                        {{$car->car_class=="vip" ? 'VIP класс' : ''}}
                        {{$car->car_class=="elites" ? 'Элит класс' : ''}}
                        {{$car->car_class=="suv" ? 'Внедорожники' : ''}}
                        {{$car->car_class=="super_car" ? 'Суперкары' : ''}}
                        {{$car->car_class=="sport_class" ? 'Спорт класс' : ''}}
                        {{$car->car_class=="business" ? 'Бизнес класс' : ''}}
                        {{$car->car_class=="middle" ? 'Средний класс' : ''}}
                        {{$car->car_class=="econom" ? 'Эконом класс' : ''}}
                        {{$car->car_class=="microbus" ? 'Микроавтобусы' : ''}}
                    </td>
                    <td>
                        {!! $car->partner ? "<a href='".route('users.edit', $car->partner->id)."'>".$car->partner->name."</a>" : ''!!}
                    </td>
                    <td><input type="checkbox" disabled {{$car->saved ? 'checked' : ''}}></td>
                    <td>{{$car->getTotalRentalCount()}}</td>
                    <td class="text-center">
                        <a href="{{route('car.edit',$car->id)}}"
                           class="text-info btn btn-link"><i class="fa fa-pencil"></i></a>
                        {{Form::open(['route'=>['car.destroy',$car->id], 'method'=>'delete'])}}
                        <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="Удалить">
                            <i class="fa fa-trash-o"></i>
                        </button>
                        {{Form::close()}}
                    </td>
                </tr>
            @endforeach
            <tfoot>
            <tr>
                <th>#</th>
                <th>Фото</th>
                <th>Марка</th>
                <th>Модель</th>
                <th>Класс</th>
                <th>Партнер</th>
                <th>Опубликовано</th>
                <th>Количество бронирований</th>
                <th class="text-center">Действия</th>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection

@section('js')

@endsection
