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
        {!! Form::model($model,['url'=>route('banner.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'', 'files' => true]) !!}
        <div class="box-body">
            <div class="row">
                <input type="hidden" name="id" value="{{$id}}">
                <input type="hidden" name="model_name" value="{{$model_name}}">
                <div class="pad col-md-6">
                    <label for="type">Тип рекламы</label>
                    <select class="form-control" name="type" id="type">
                        <option value="image_link" {{$model->type=="image_link" ? "selected" : ''}}>Картинка и ссылка</option>
                        <option value="script" {{$model->type=="script" ? "selected" : ''}}>Запуск скрипта</option>
                    </select>
                </div>
                <div class="image-link-div col-md-12" style="{{$model->type=="script" ? 'display:none' : ''}}">
                    <div class="row">
                        <div class="pad col-md-6">
                            <img src="{{ asset($model->image) }}" style="width:150px; {{$model->image==null ? "display:none;" : ''}}">
                            <label for="image">Изображение</label>
                            <input type="file" name="image" id="image"  class="form-control image"  value="{{ $model->image }}">
                        </div>
                        <div class="pad col-md-6">
                            <label for="src">Ссылка</label>
                            <input type="text" class="form-control" name="src" value="{{$model->src}}">
                        </div>
                    </div>

                </div>
                <div class="script-div col-md-12" style="{{$model->type!="script" ? 'display:none' : ''}}">
                    <div class="pad col-md-6">
                        <label for="code">Script</label>
                        <textarea name="code" class="form-control">{{$model->code}}</textarea>
                    </div>
                </div>
            </div>


        </div>
        <div class="box-footer">
            <br>
            <button type="submit" class="btn btn-primary">Сохранить</button>
            @if($model_name=="Page")
                <a href="{{ route('page.edit', $id) }}" class="btn btn-warning">Отмена</a>
            @elseif($model_name=="Car")
                <a href="{{ route('car.edit', $id) }}" class="btn btn-warning">Отмена</a>
            @endif
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
    </script>
@stop


