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
        {!! Form::model($model,['url'=>route('article.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'', 'files' => true]) !!}
        <div class="box-body">
            <div class="form-group">
                <label>Alias</label>
                <input type="text" class="form-control" name="alias" value="{{$model->alias}}">
            </div>

            @foreach($langs as $lang)
                <div class="pad form-group">
                    <label>Имя ({{$lang->name}})</label>
                    <textarea name="trans[{{$lang->id}}][name]" class="form-control">{{count($model->translates) ? $model->getTranslation('name', $lang->id) : ''}}</textarea>
                </div>
                <div class="pad form-group">
                    <label>Title ({{$lang->name}})</label>
                    <textarea name="trans[{{$lang->id}}][title]" class="form-control">{{count($model->translates) ? $model->getTranslation('title', $lang->id) : ''}}</textarea>
                </div>
                <div class="pad form-group">
                    <label>Короткое описание ({{$lang->name}})</label>
                    <textarea name="trans[{{$lang->id}}][short_text]" class="form-control">{{count($model->translates) ? $model->getTranslation('short_text', $lang->id) : ''}}</textarea>
                </div>
                <div class="pad form-group">
                    <label>Описание ({{$lang->name}})</label>
                    <textarea name="trans[{{$lang->id}}][text]" class="form-control my-editor">{{count($model->translates) ? $model->getTranslation('text', $lang->id) : ''}}</textarea>
                </div>

            @endforeach
                <div class="pad form-group">
                    <img src="{{ asset($model->image) }}" style="width:200px; {{$model->image==null ? "display:none" : ''}}">
                    <label for="image">Изображение</label>
                    <input type="file" name="image" id="image" class="form-control camp_image"  value="{{ $model->image }}">
                </div>
            <div class="pad form-group">
                <label>Дата публикации:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="date_in" value="{{$model->date_in??''}}" class="form-control pull-right" id="datepicker">
                </div>
            </div>

        </div>


        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('article.index') }}" class="btn btn-warning">Отмена</a>
        </div>
        {!! Form::close() !!}

    </div>
@stop

@section('js')
    @parent
    <script src="{{asset('assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script>
        $('body').on('change', '#image', function(event) {
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
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
    </script>
@stop


