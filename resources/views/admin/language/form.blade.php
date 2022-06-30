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
        {!! Form::model($model,['url'=>route('language.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'']) !!}
        <div class="box-body">
            <div class="pad form-group">
                <label for="name">Имя</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $model->name }}">
            </div>
            <div class="pad form-group">
                <label for="text">Code</label>
                <select name="code" class="form-control">
                    @if(App\Language::where('code', "ru")->first())
                        @if($model->code=="ru")
                            <option value="ru" selected>Русский</option>
                        @endif
                    @else
                        <option value="ru">Русский</option>
                    @endif
                        @if(App\Language::where('code', "en")->first())
                            @if($model->code=="en")
                                <option value="en" selected>English</option>
                            @endif
                        @else
                            <option value="en">English</option>
                        @endif
                        @if(App\Language::where('code', "ar")->first())
                            @if($model->code=="ar")
                                <option value="ar" selected>Arabic</option>
                            @endif
                        @else
                            <option value="ar">Arabic</option>
                        @endif
                        @if(App\Language::where('code', "zh")->first())
                            @if($model->code=="zh")
                                <option value="zh" selected>Chinese</option>
                            @endif
                        @else
                            <option value="zh">Chinese</option>
                        @endif
                        @if(App\Language::where('code', "ge")->first())
                            @if($model->code=="ge")
                                <option value="ge" selected>German</option>
                            @endif
                        @else
                            <option value="ge">German</option>
                        @endif
                        @if(App\Language::where('code', "fr")->first())
                            @if($model->code=="fr")
                                <option value="fr" selected>French</option>
                            @endif
                        @else
                            <option value="fr">French</option>
                        @endif
                        @if(App\Language::where('code', "it")->first())
                            @if($model->code=="it")
                                <option value="it" selected>Italian</option>
                            @endif
                        @else
                            <option value="it">Italian</option>
                        @endif
                        @if(App\Language::where('code', "es")->first())
                            @if($model->code=="es")
                                <option value="es" selected>Spanish</option>
                            @endif
                        @else
                            <option value="es">Spanish</option>
                        @endif
                </select>
            </div>
            <div class="pad form-group">
                <label for="active">Активный</label>
                <input type="checkbox" id="active" name="active"
                       value="1"
                        {{ $model->active?'checked':'' }}>
            </div>
            <div class="pad form-group">
                <label for="default">Главный</label>
                <input type="checkbox" name="main"
                       value="1" {{ $model->main?'checked':'' }}>
            </div>
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


