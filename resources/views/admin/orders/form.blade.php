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
        {!! Form::model($order,['url'=>route('order.'.($order->id ?'update':'store'),$order->id),'method'=>$order->id ?'PUT':'POST','class'=>'']) !!}
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
                    <label for="international_law">Имеет международные права</label>
                    <select name="international_law" id="international_law" class="form-control">
                        <option value="0" {{$order->international_law=="0" ? 'selected' : ''}}>Нет</option>
                        <option value="1" {{$order->international_law=="1" ? 'selected' : ''}}>Да</option>
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
                    <br>
                    <label for="from_date">Дата с</label>
                    <input type="date" value="{{$order->from_date ? Carbon\Carbon::parse($order->from_date)->format("Y-m-d") : ''}}" name="from_date">
                </div>
                <div class="pad col-md-6">
                    <br>
                    <label for="to_date">Дата до</label>
                    <input type="date" value="{{$order->to_date ? Carbon\Carbon::parse($order->to_date)->format("Y-m-d") : ''}}" name="to_date">
                </div>
                <div class="pad col-md-6">
                    <br>
                    <label for="another_location">Возврат в другом месте</label>
                    <input type="checkbox" {{$order->another_location ? "checked" : ''}} name="another_location">
                </div>
                <div class="pad col-md-6">
                    <label for="city">Место подачи авто</label>
                    <select name="city" id="city" class="form-control">
                        <option label="Выберите из списка"></option>
                        <option value="1" {{$order->city=="1" ? 'selected' : ''}}>Дубай (международный аэропорт дубай (DXB)</option>
                        <option value="2" {{$order->city=="2" ? 'selected' : ''}}>Абу-даби</option>
                        <option value="3" {{$order->city=="3" ? 'selected' : ''}}>Шарджа</option>
                        <option value="4" {{$order->city=="4" ? 'selected' : ''}}>Рас-эль-хайм</option>
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
                <div class="pad col-md-12">
                    <label for="message">Особые заметки</label>
                    <textarea name="message" class="form-control">{{$order->message}}</textarea>
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


