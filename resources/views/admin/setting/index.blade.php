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
        {!! Form::model($model,['url'=>route('setting.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'']) !!}
        <div class="box-body">
            <div class="pad form-group">
                <label for="vat_tax">VAT Tax, $</label>
                <input type="number" id="vat_tax" name="vat_tax" class="form-control" value="{{ $model->vat_tax }}" min="0" max="100">
            </div>
        </div>
        <div class="box-body">
            <div class="pad form-group">
                <label for="email">Email принимающий заявки</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $model->email }}">
            </div>
        </div>
        <div class="box-body">
            <div class="pad form-group">
                <label for="social1">Twitter</label>
                <input type="text" id="social1" name="social[twitter]" class="form-control" value="{{ $socials->where('name', 'twitter')->first()->url }}">
            </div>
        </div>
        <div class="box-body">
            <div class="pad form-group">
                <label for="social2">Facebook</label>
                <input type="text" id="social2" name="social[facebook]" class="form-control" value="{{ $socials->where('name', 'facebook')->first()->url }}">
            </div>
        </div>
        <div class="box-body">
            <div class="pad form-group">
                <label for="social3">YouTube</label>
                <input type="text" id="social3" name="social[youtube]" class="form-control" value="{{ $socials->where('name', 'youtube')->first()->url }}">
            </div>
        </div>
        <div class="box-body">
            <div class="pad form-group">
                <label for="social4">Instagram</label>
                <input type="text" id="social4" name="social[instagram]" class="form-control" value="{{ $socials->where('name', 'instagram')->first()->url }}">
            </div>
        </div>
        <div class="box-header with-border">
            <h3 class="box-title">Статистика работы(лендинг)</h3>
        </div>
        <div class="box-body">
            <div class="pad form-group">
                <label for="companies">Кол-во компаний по аренде авто</label>
                <input type="text" id="companies" name="statistic[companies]" class="form-control" value="{{ $model->companies }}">
            </div>
        </div>
        <div class="box-body">
            <div class="pad form-group">
                <label for="auto">Кол-во авто для аренды</label>
                <input type="text" id="auto" name="statistic[auto]" class="form-control" value="{{ $model->auto }}">
            </div>
        </div>
        <div class="box-body">
            <div class="pad form-group">
                <label for="clients">Кол-во клиентов забронировавших авто</label>
                <input type="text" id="auto" name="statistic[clients]" class="form-control" value="{{ $model->clients }}">
            </div>
        </div>
        <div class="box-body">
            <div class="pad form-group">
                <label for="seconds">Кол-во секунд время бронирования авто</label>
                <input type="text" id="seconds" name="statistic[seconds]" class="form-control" value="{{ $model->seconds }}">
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
        {!! Form::close() !!}
        <div class="row">
            <h1>Иконки способов оплаты</h1>
        </div><br>
        <div class="row">
            <a href="{{route('payment_method.create')}}">
                <button class="btn btn-sm btn-primary">Добавить</button>
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
                @foreach($pm_icons as $icon)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            @if($icon->icon)
                                <img src="{{asset($icon->icon)}}" style="width:150px;">
                            @endif
                        </td>
                        <td class="text-center">
                            {{Form::open(['route'=>['payment_method.destroy',$icon->id], 'method'=>'delete'])}}
                            <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="Удалить">
                                <i class="fa fa-trash-o"></i>
                            </button>
                            {{Form::close()}}
                            <a href="{{route('payment_method.edit',$icon->id)}}"
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
@stop

@section('js')
    @parent

@stop


