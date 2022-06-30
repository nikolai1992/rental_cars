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
        <a href="{{route('currency.create')}}">
            <button class="btn btn-sm btn-primary">Новая валюта</button>
        </a>
    </div><br>
    <div class="row">
        <div class="col-md-12">
            <table  class="example2 table table-bordered table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Валюта</th>
                    <th>Символ</th>
                    <th>Курс к 1$</th>
                    <th>Активная</th>
                    <th class="text-center">Действия</th>
                </tr>
                </thead>
                @foreach($currencies as $model)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$model->name}}</td>
                        <td>{{$model->symbol}}</td>
                        <td>{{$model->dollar_rate}}</td>
                        <td>{!! $model->active ? '<i class="fa fa-thumbs-o-up"></i>' : '<i class="fa fa-thumbs-down"></i>' !!}</td>
                        <td class="text-center">
                            @if($model->id!=1)
                                <a href="{{route('currency.edit',$model->id)}}"
                                   class="text-info btn btn-link"><i class="fa fa-pencil"></i></a>
                                {{Form::open(['route'=>['currency.destroy',$model->id], 'method'=>'delete'])}}
                                <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="Удалить">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                                {{Form::close()}}
                            @endif
                        </td>
                    </tr>
                @endforeach
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Валюта</th>
                    <th>Символ</th>
                    <th>Курс к 1$</th>
                    <th>Активная</th>
                    <th class="text-center">Действия</th>
                </tr>
                </tfoot>
            </table>
        </div>

    </div>

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
