<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2018
 * Time: 12:23
 */

/**
 * @var \App\Models\Service $order
 */
?>

@extends('layouts.admin_app')

@section('title',$title)
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        {{--{{dd($order)}}--}}
        {!! Form::model($order,['url'=>route('admin.order.with_driver.'.($order->id ?'update':'store'),$order->id),'method'=>$order->id ?'PUT':'POST','class'=>'']) !!}
        <div class="box-body">
            <div class="row">
                <div class="pad col-md-6">
                    <label for="fio">ФИО</label>
                    <input type="text" name="fio" class="form-control" value="{{$order->fio}}">
                </div>
                <div class="pad col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{$order->email}}">
                </div>
                <div class="pad col-md-6">
                    <label for="phone">Телефон</label>
                    <input type="text" name="phone" class="form-control" value="{{$order->phone}}">
                </div>
                <div class="pad col-md-6">
                    <label for="user_id">Пользователь</label>
                    {{ Form::select('user_id', $users, $order->user ? $order->user->id : null, ['class'=>'form-control select2', 'id'=>'user_id']) }}
                </div>
                <div class="pad col-md-6">
                    <label for="date">Дата</label>
                    <input type="date" class="form-control" value="{{$order->date ? Carbon\Carbon::parse($order->date)->format("Y-m-d") : ''}}" name="date">
                </div>
                <div class="pad col-md-6">
                    <label for="time">Время</label>
                    <select class="form-control" name="time">
                        <option label="Выберите из списка"></option>
                        @for($i=0; $i<=23; $i++)
                            <option value="{{$i}}" {{(int)$order->time==$i ? 'selected' : ''}}>{{$i<10 ? "0".$i : $i}}:00</option>
                        @endfor
                    </select>
                </div>
                <div class="pad col-md-6">
                    <label for="duration">Продолжительность(часов)</label>
                    <select class="form-control" name="duration">
                        <option label="Выберите из списка"></option>
                        @for($i=1; $i<=24; $i++)
                            <option value="{{$i}}" {{(int)$order->duration==$i ? 'selected' : ''}}>{{$i}} час(ов)</option>
                        @endfor
                    </select>
                </div>
                <div class="pad col-md-6">
                    <label for="location">Место подачи авто</label>
                    <select name="location" id="location" class="form-control">
                        <option label="Выберите из списка"></option>
                        <option value="1" {{$order->location=="1" ? 'selected' : ''}}>Дубай (международный аэропорт дубай (DXB)</option>
                        <option value="2" {{$order->location=="2" ? 'selected' : ''}}>Абу-даби</option>
                        <option value="3" {{$order->location=="3" ? 'selected' : ''}}>Шарджа</option>
                        <option value="4" {{$order->location=="4" ? 'selected' : ''}}>Рас-эль-хайм</option>
                    </select>
                </div>
                <div class="pad col-md-6">
                    <label for="car_id">Автомобиль</label>
                    <select name="car_id" id="car_id" class="form-control ">
                        <option label="Выберите из списка"></option>
                        @foreach($cars as $car)
                            <option value="{{$car->id}}" {{$car->id==$order->car_id ? "selected" : ''}}>{{$car->carBrand->name}} {{$car->model}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="pad col-md-6">
                    <label for="status">Статус</label>
                    <select name="status" id="status" class="form-control">
                        <option label="Выберите из списка"></option>
                        <option value="rejected" {{$order->status=="rejected" ? "selected" : ''}}>Отклонено</option>
                        <option value="in_process" {{$order->status=="in_process" ? "selected" : ''}}>В обработке</option>
                        <option value="approved" {{$order->status=="approved" ? "selected" : ''}}>Подтверждено</option>
                    </select>
                </div>
                <div class="pad col-md-6">
                    <label for="payment_status">Оплата</label>
                    <select name="payment_status" id="payment_status" class="form-control">
                        <option label="Выберите из списка"></option>
                        <option value="upon_receipt" {{$order->payment_status=="upon_receipt" ? "selected" : ''}}>При получении</option>
                        <option value="payed" {{$order->payment_status=="payed" ? "selected" : ''}}>Оплачено 15%</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a href="{{ route('order.index') }}" class="btn btn-warning">Отмена</a>
            </div>
            {!! Form::close() !!}

        </div>
@stop

@section('js')
    @parent

@stop


