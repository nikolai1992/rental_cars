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
        {!! Form::model($model,['url'=>route('faq.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'']) !!}
        <div class="box-body">
            <div class="pad form-group">
                <label for="order_id">Приоритет</label>
                <input type="number" name="order_id" class="form-control" value="{{ $model->order_id }}">
            </div>
            @foreach($langs as $lang)
                <div class="pad form-group">
                    <label>Вопрос ({{$lang->name}})</label>
                    <textarea name="trans[{{$lang->id}}][question]" class="form-control">{{count($model->translates) ? $model->getTranslation('question', $lang->id) : ''}}</textarea>
                </div>
                <div class="pad form-group">
                    <label>Ответ ({{$lang->name}})</label>
                    <textarea name="trans[{{$lang->id}}][answer]" class="form-control">{{count($model->translates) ? $model->getTranslation('answer', $lang->id) : ''}}</textarea>
                </div>
            @endforeach
        </div>


        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('faq.index') }}" class="btn btn-warning">Отмена</a>
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


