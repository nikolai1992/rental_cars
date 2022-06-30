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
        {!! Form::model($model,['url'=>route('car_image.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'', 'files' => true]) !!}
        <div class="box-body">
            <input type="hidden" name="car_id" value="{{$car_id}}">
            <div class="pad form-group">
                <img src="{{ asset($model->url) }}" style="width:150px; {{$model->url==null ? "display:none;" : ''}}">
                <label for="url">Изображение</label>
                <input type="file" name="url" id="url" class="form-control camp_image"  value="{{ $model->url }}">
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('car.edit', $car_id) }}" class="btn btn-warning">Отмена</a>
        </div>
        {!! Form::close() !!}

    </div>
@stop

@section('js')
    @parent
    <script>
        $('body').on('change', '#url', function(event) {
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


