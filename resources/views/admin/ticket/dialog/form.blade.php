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
        <div class="box-header with-bmodel">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        {!! Form::model($model,['url'=>route('ticket_dialog.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'']) !!}
        <div class="box-body">
            <div class="row">
                <div class="pad col-md-6">
                    <label for="text">Tема тикета</label>
                    <textarea class="form-control" name="text" id="text">{{$model->text}}</textarea>
                </div>
            </div>
            <br>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a href="{{ route('ticket_dialog.index') }}" class="btn btn-warning">Отмена</a>
            </div>
            
        </div>
		{!! Form::close() !!}
    </div>
@stop

@section('js')
    @parent

@stop


