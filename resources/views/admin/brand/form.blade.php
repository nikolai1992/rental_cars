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
        {!! Form::model($model,['url'=>route('car_brand.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'', 'files' => true]) !!}
        <div class="box-body">
            <div class="pad form-group">
                <label for="name">Имя</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $model->name }}">
            </div>
            <div class="pad form-group">
                <label for="alias">Alias</label>
                <input type="text" id="alias" name="alias" class="form-control" value="{{ $model->alias }}">
            </div>
            <div class="pad form-group">
                <img src="{{ asset($model->icon) }}" style="{{$model->icon==null ? "display:none" : ''}}">
                <label for="icon">Изображение</label>
                <input type="file" name="icon" id="icon" class="form-control camp_image"  value="{{ $model->icon }}">
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('car_brand.index') }}" class="btn btn-warning">Отмена</a>
        </div>
        {!! Form::close() !!}

    </div>
@stop

@section('js')
    @parent
    <script>
        $('body').on('change', '#icon', function(event) {
            console.log('camp_image')
            readURL2(this)
        });
        function readURL2(input) {
            console.log(input.files && input.files[0]);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    console.log($(input).parent().html());

                    $(input).parent().find('img').attr('src', e.target.result).show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@stop


