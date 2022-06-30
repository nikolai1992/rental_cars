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
        {!! Form::model($model,['url'=>route('payment_method.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'', 'files' => true]) !!}
        <div class="box-body">
            <div class="row">
                <div class="pad form-group">
                    <img src="{{ asset($model->icon) }}" style="width:150px; {{$model->url==null ? "display:none;" : ''}}">
                    <label for="icon">Иконка</label>
                    <input type="file" name="icon" id="icon" class="form-control"  value="{{ $model->icon }}">
                </div>
            </div>


        </div>
        <div class="box-footer">
            <br>
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('setting.index') }}" class="btn btn-warning">Отмена</a>
        </div>
        {!! Form::close() !!}

    </div>
@stop

@section('js')
    @parent
    <script>
        $('body').on('change', '#type', function(event) {
            console.log($(this).val())
            if($(this).val()=="script")
            {
                $('.image-link-div').hide();
                $('.script-div').show();
            }
            if($(this).val()=="image_link")
            {
                $('.image-link-div').show();
                $('.script-div').hide();
            }
        });
        $('body').on('change', '#icon', function(event) {
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


