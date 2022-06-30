<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2018
 * Time: 11:18
 */
/**
 * @var \App\Models\StaticPages[] $models
 */
?>

@extends('adminlte::page')

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
    <h2>Соціальні спільноти</h2>
    <a href="{{route('social.create')}}">
    <button class="btn btn-sm btn-primary">Додати</button>
    </a>
    <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Іконка</th>
            <th>Лінк</th>
            <th>Дія</th>
        </tr>
        </thead>

        @foreach($socials as $social)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <img src="{{$social->icon}}" style="width:100px;">
                </td>
                <td><a href="{{$social->url}}" target="_blank">Лінк</a></td>
                <td>
                    <a href="{{route('social.edit',$social->id)}}"
                       class="fa fa-pencil"></a>
                    {{Form::open(['route'=>['social.destroy', $social->id], 'method'=>'delete'])}}
                    <button onclick="return confirm('{{trans('admins.sure')}}')" type="submit" class="delete"  title="Видалити">
                        <i class="fa fa-trash-o"></i>
                    </button>
                    {{Form::close()}}
                </td>
            </tr>
        @endforeach
        <tfoot>
        <tr>
            <th>#</th>
            <th>Іконка</th>
            <th>Лінк</th>
            <th>Дія</th>
        </tr>
        </tfoot>
    </table>
@endsection
