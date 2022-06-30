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
        {!! Form::model($model,['url'=>route('translation.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'']) !!}
        <div class="box-body">
            <div class="pad form-group">
                <label for="name">Код слова(данное поле очень не рекоммендуется менять)</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $model->name }}">
            </div>
            @foreach($languages as $lang)
                <div class="pad form-group">
                    <label for="lang_{{$lang->code}}">{{$lang->code}}</label>
                    @if($model->translations)
                        @if($model->name=="advertising_placement_text")
                            <textarea name="lang[{{$lang->id}}]" class="form-control my-editor" >{{ $model->translations->where("language_id", $lang->id)->first() ?
                        $model->translations->where("language_id", $lang->id)->first()->value : '' }}</textarea>
                        @else
                            <input type="text" id="lang_{{$lang->code}}" name="lang[{{$lang->id}}]" class="form-control" value="{{ $model->translations->where("language_id", $lang->id)->first() ?
                        $model->translations->where("language_id", $lang->id)->first()->value : '' }}">
                        @endif

                    @else
                        <input type="text" id="lang_{{$lang->code}}" name="lang[{{$lang->id}}]" class="form-control" value="">
                    @endif

                </div>
            @endforeach
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('language.index') }}" class="btn btn-warning">Отмена</a>
        </div>
        {!! Form::close() !!}

    </div>
@stop

@section('js')
    @parent

@stop


