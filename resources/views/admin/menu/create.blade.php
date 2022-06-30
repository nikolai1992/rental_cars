<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2018
 * Time: 12:23
 */

use App\Models\Menu;

/**
 * @var \App\Models\Menu          $model
 * @var \App\Models\StaticPages[] $pages
 */
?>

@extends('layouts.admin_app')

@section('title',"Добавление новой страницы")
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">

            <h3 class="box-title">Добавление новой страницы</h3>

        </div>


        {!! Form::model($model,['url'=>route('page.store'),'method'=>'POST','class'=>'', 'files' => true]) !!}

        <div class="box-body">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Имя страницы</label>
                    <input type="text" class="form-control" name="name" value="{{$model->name}}">
                </div>
                <div class="form-group">
                    <label>Alias</label>
                    <input type="text" class="form-control" name="alias" value="{{$model->alias}}">
                </div>
                @foreach($langs as $lang)
                    <div class="pad form-group">
                        <label>Имя(перевод) ({{$lang->name}})</label>
                        <input name="trans[{{$lang->id}}][name]" class="form-control" value="">
                    </div>
                    <div class="pad form-group">
                        <label>Текст(перевод) ({{$lang->name}})</label>
                        <textarea name="trans[{{$lang->id}}][text]" class="form-control my-editor"></textarea>
                    </div>
                @endforeach
                <div class="pad form-group">
                    <label>
                        <input type="checkbox" name="header"> Выводить в хедере
                    </label>
                </div>
                <div class="pad form-group">
                    <label>
                        <input type="checkbox" name="footer"> Выводить в футере
                    </label>
                </div>
                <div class="pad form-group">
                    <label>
                        <input type="checkbox" name="footer_right"> Выводить в футере(справа)
                    </label>
                </div>
                <div class="pad form-group">
                    <label>
                        <input type="checkbox" name="mob_menu"> Выводить в моб меню
                    </label>
                </div>
                {{--<div class="form-group">--}}
                {{--<label for="Alias">Alias</label>--}}
                {{--<input type="text" name="slug" class="form-control" id="Alias" placeholder="Enter slug" value="{{$model->slug??''}}">--}}
                {{--</div>--}}

            </div>

        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary" style="    margin: 20px 5px 0 0;">Сохранить</button>
            <a href="{{ route('page.index') }}" class="btn btn-warning" style="    margin: 20px 0 0 0;">Отмена</a>
        </div>
        {!! Form::close() !!}


    </div>
@stop

@section('css')
    @parent
    <link rel="stylesheet" href="{{asset('vendor/select2/dist/css/select2.min.css')}}">
@stop
@section('js')
    @parent
    <script src="{{asset('vendor/select2/dist/js/select2.full.min.js')}}"></script>
    <script>
        $('.select2').select2();
        $('#lfm').filemanager('image');
        $('#background').filemanager('image');
        $('#background12').filemanager('image');
        $('#background13').filemanager('image');
        $('#background14').filemanager('image');
        $('#background2').filemanager('image');
        var table;

        function initTable() {
            table = $('.example2').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false
            });
        }
        function delete_partner(e, _this)
        {

            e.preventDefault(e);
            if (confirm('Вы уверенны?'))
                $.ajax({
                    url: _this.getAttribute("data-url"),
                    method: 'delete',
                    success: function (resp) {
                        if (resp == 1) {
                            location.reload();
                        }
                    }
                });
            // });
        }
        initTable();
    </script>
@stop


