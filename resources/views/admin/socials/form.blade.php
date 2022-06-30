<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 10.07.2018
 * Time: 11:06
 */

?>
@extends('layouts.admin_form')

@section('title',$title)
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{$title}}</h3>

        </div>

        {!! Form::model($model,['url'=>route('social.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'', 'files' => true]) !!}
        <div class="box-body">
            <div class="pad form-group localize">
                <label for="url">Линк</label>
                <input type="text" class="form-control" name="url" value="{{$model->url}}">
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary save-btn">Сохранить</button>
            <a href="{{route('social.index')}}" class="btn-warning btn">Отмена</a>
        </div>
        {!! Form::close() !!}

    </div>
@endsection

@section('js')
    @parent
    <script>$('#lfm').filemanager('image');</script>
@endsection