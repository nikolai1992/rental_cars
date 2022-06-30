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
        {!! Form::model($model,['url'=>route('currency.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'']) !!}
        <div class="box-body">
            <div class="pad form-group">
                <label for="name">Имя</label>
                <input type="text" name="name" class="form-control" value="{{ $model->name }}">
            </div>
            <div class="pad form-group">
                <label for="symbol">Символ</label>
                <input type="text" name="symbol" class="form-control" value="{{ $model->symbol }}">
            </div>
            <div class="pad form-group">
                <label for="dollar_rate">Курс к 1$</label>
                <input type="number" name="dollar_rate" class="form-control" step="0.01" value="{{ $model->dollar_rate }}">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="active"
                           class="minimal"
                           value="1"
                            {{ $model->active?'checked':'' }}>
                    Включить\Выключить
                </label>
            </div>
        </div>


        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('currency.index') }}" class="btn btn-warning">Отмена</a>
        </div>
        {!! Form::close() !!}

    </div>
@stop

@section('js')
    @parent
    <script>$('#lfm').filemanager('image');</script>
    <script>
        function addDesc() {
            const count = $('#attr-desc.active .desc').length;
            var desc = $('#attr-desc.active .desc:first-of-type').clone();
            desc.html(desc.html().replace(/\[0\]/gm, '[' + count + ']'));
            desc.find('.rem-desc').on('click', function () {
                $(this).parents('.small-box').remove();
            });
            desc.insertBefore($(this).parents('.small-box'));
        }

        $('.add-desc').on('click', addDesc);

        $('.rem-desc').on('click', function () {
            $(this).parents('.small-box').remove();
        });
    </script>
@stop


