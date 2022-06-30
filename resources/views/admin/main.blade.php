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
            <h3 class="box-title">Админ панель администратора</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">

        </div>
        <!-- /.box-body -->
    </div>
@endsection
