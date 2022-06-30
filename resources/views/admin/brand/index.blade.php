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
        <h1>Марки автомобилей</h1>
    </div><br>
    <div class="row">
        <a href="{{route('car_brand.create')}}">
            <button class="btn btn-sm btn-primary">Новая марка</button>
        </a>
    </div><br>
    <div class="row">
        <table  class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Лого</th>
                <th>Бренд</th>
                <th class="text-center">Действия</th>
            </tr>
            </thead>
            @foreach($brands2 as $brand)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><img src="{{$brand->icon}}" style="width: 50px;"></td>
                    <td>{{$brand->name}}</td>
                    <td class="text-center">
                        {{Form::open(['route'=>['car_brand.destroy',$brand->id], 'method'=>'delete'])}}
                        <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="Удалить">
                            <i class="fa fa-trash-o"></i>
                        </button>
                        {{Form::close()}}
                        <a href="{{route('car_brand.edit',$brand->id)}}"
                           class="text-info btn btn-link"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
            @endforeach
            <tfoot>
            <tr>
                <th>#</th>
                <th>Лого</th>
                <th>Бренд</th>
                <th class="text-center">Действия</th>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection

@section('js')

@endsection
