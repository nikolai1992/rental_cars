<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2018
 * Time: 11:18
 */
/**
 * @var \App\Models\Menu[] $models
 */
?>

@extends('layouts.admin_app')

@section('css')
    @parent
    <style>
        .box{
            margin-bottom: 1px;
        }
    </style>
@endsection
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
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Редактируемые страницы</h3>
        </div>
        <div class="row">
            <a href="{{route('page.create')}}">
                <button class="btn btn-sm btn-primary">Добавить новую</button>
            </a>
        </div><br>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Страница</th>
                    <th>Выводится в хедере</th>
                    <th>Выводится в футере</th>
                    <th>Выводится в футере(справа)</th>
                    <th>Выводится в моб меню</th>
                    <th>{{trans('admins.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($models as $page)
                    <tr>
                        <td>{{$page->id}}</td>
                        <td>{{$page->name}}</td>
                        <td><input type="checkbox" name="header" {{$page->header ? "checked" : ''}} disabled></td>
                        <td><input type="checkbox" name="footer" {{$page->footer ? "checked" : ''}} disabled></td>
                        <td><input type="checkbox" name="footer" {{$page->footer_right ? "checked" : ''}} disabled></td>
                        <td><input type="checkbox" name="mob_menu" {{$page->mob_menu ? "checked" : ''}} disabled></td>
                        <td>
                            <a href="{{route('page.edit', $page->id)}}" class="fa fa-pencil" title="{{trans('admins.edit')}}"></a>
                            @if(!$page->basic)
                                {{Form::open(['route'=>['page.destroy',$page->id], 'method'=>'delete'])}}
                                <button onclick="return confirm('Вы уверены, что хотите удалить данную страницу?')" type="submit" class="delete"  title="Удалить">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                                {{Form::close()}}
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
