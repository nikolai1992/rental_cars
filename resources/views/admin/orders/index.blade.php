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
        <h1>Аренда авто</h1>
    </div><br>
    <div class="row">
        <a href="{{route('order.create')}}">
            <button class="btn btn-sm btn-primary">Новый заказ</button>
        </a>
    </div><br>
    <div class="row">
        <table  class="example2 table table-bordered table-hover">
            <thead>
            <tr>
                <th>Номер заказа</th>
                <th>Имя клиента</th>
                <th>Email</th>
                <th>Время заказа</th>
                <th>Автомобиль</th>
                <th>Партнер</th>
                <th>Период аренды</th>
                <th>Общая сумма $</th>
                <th>Оплата</th>
                <th>Статус</th>
                <th class="text-center">Действия</th>
            </tr>
            </thead>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->order_number}}</td>
                    <td>{{$order->user ? $order->user->name : ''}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>
                        <img src="{{$order->car->images->sortBy('order_id')->first()->url}}" style="width: 100px;">
                        {{$order->car->carBrand->name}} {{$order->car->model}}
                    </td>
                    <td>
                        {!!  $order->car->partner ? "<a href='".route('users.edit', $order->car->partner->id)."'>".$order->car->partner->name."</a>" : ''!!}
                    </td>
                    <td>{{$order->from_date ? Carbon\Carbon::parse($order->from_date)->format('D, d/m/Y') : ''}} - {{$order->to_date ? Carbon\Carbon::parse($order->to_date)->format('D, d/m/Y') : ''}}</td>
                    <td>{{$order->total_price}}</td>
                    <td>
                        @if($order->payment_status=="upon_receipt")
                            При получении
                        @elseif($order->payment_status=="payed")
                            Оплачено 15%
                        @endif
                    </td>

                    <td>
                        @if($order->status=="rejected")
                            Отклонено
                        @elseif($order->status=="in_process")
                            В обработке
                        @elseif($order->status=="approved")
                            Подтверждено
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{route('order.edit',$order->id)}}"
                           class="text-info btn btn-link"><i class="fa fa-pencil"></i></a>
                        {{Form::open(['route'=>['order.destroy',$order->id], 'method'=>'delete'])}}
                        <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="Удалить">
                            <i class="fa fa-trash-o"></i>
                        </button>
                        {{Form::close()}}
                    </td>
                </tr>
            @endforeach
            <tfoot>
            <tr>
                <th>Номер заказа</th>
                <th>Имя клиента</th>
                <th>Email</th>
                <th>Время заказа</th>
                <th>Автомобиль</th>
                <th>Партнер</th>
                <th>Период аренды</th>
                <th>Общая сумма $</th>
                <th>Оплата</th>
                <th>Статус</th>
                <th class="text-center">Действия</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <br>
    <div class="row">
        <h1>Аренда авто с водителем</h1>
    </div><br>
    <div class="row">
        <a href="#">
            <button class="btn btn-sm btn-primary">Новый заказ</button>
        </a>
    </div><br>
    <div class="row">
        <table  class="example2 table table-bordered table-hover">
            <thead>
            <tr>
                <th>Номер заказа</th>
                <th>Имя клиента</th>
                <th>Пользователь</th>
                <th>Email</th>
                <th>Время заказа</th>
                <th>Автомобиль</th>
                <th>Партнер</th>
                <th>Дата бронирования</th>
                <th>Общая сумма $</th>
                <th>Статус</th>
                <th class="text-center">Действия</th>
            </tr>
            </thead>
            @foreach($ordersWithDriver as $order)
                <tr>
                    <td>{{$order->order_number}}</td>
                    <td>{{$order->fio}}</td>
                    <td><a href="{{$order->user ? route('users.edit', $order->user->id) : ''}}">{{$order->user ? $order->user->name : ''}}</a></td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>
                        <img src="{{$order->car->images->sortBy('order_id')->first()->url}}" style="width: 100px;">
                        {{$order->car->carBrand->name}} {{$order->car->model}}
                    </td>
                    <td>
                        {!! $order->car->partner ? "<a href='".route('users.edit', $order->car->partner->id)."'>".$order->car->partner->name."</a>" : ''!!}
                    </td>
                    <td>{{Carbon\Carbon::parse($order->date)->format('D, d/m/Y')}}</td>
                    <td>{{$order->price}}</td>
                    <td>
                        @if($order->status=="rejected")
                            Отклонено
                        @elseif($order->status=="in_process")
                            В обработке
                        @elseif($order->status=="approved")
                            Подтверждено
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{route('admin.order.with_driver.edit',$order->id)}}"
                           class="text-info btn btn-link"><i class="fa fa-pencil"></i></a>
                        {{Form::open(['route'=>['order.destroy',$order->id], 'method'=>'delete'])}}
                        <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="Удалить">
                            <i class="fa fa-trash-o"></i>
                        </button>
                        {{Form::close()}}
                    </td>
                </tr>
            @endforeach
            <tfoot>
            <tr>
                <th>Номер заказа</th>
                <th>Имя клиента</th>
                <th>Пользователь</th>
                <th>Email</th>
                <th>Время заказа</th>
                <th>Автомобиль</th>
                <th>Партнер</th>
                <th>Дата бронирования</th>
                <th>Общая сумма $</th>
                <th>Статус</th>
                <th class="text-center">Действия</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <br>
@endsection

@section('js')
    <script>
        $('.example2').DataTable({
            'paging': false,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });

    </script>
@endsection
