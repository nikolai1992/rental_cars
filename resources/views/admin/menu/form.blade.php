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

@section('title',$title)
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">

            <h3 class="box-title">{{$title}}</h3>

        </div>


        {!! Form::model($model,['url'=>route('page.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'', 'files' => true]) !!}

        <div class="box-body">

            <div class="col-md-6">
                <div class="form-group">
                    <label>Имя страницы</label>
                    <input type="text" class="form-control" value="{{$model->name}}" readonly>
                </div>
                @if(!$model->basic)
                    <div class="form-group">
                        <label>Alias</label>
                        <input type="text" class="form-control" name="alias" value="{{$model->alias}}">
                    </div>
                @endif
                @foreach($langs as $lang)
                    <div class="pad form-group">
                        <label>Имя ({{$lang->name}})</label>
                        <textarea name="trans[{{$lang->id}}][name]" class="form-control">{{count($model->translations) ? $model->getTranslation('name', $lang->id) : ''}}</textarea>
                    </div>
                    <div class="pad form-group">
                        <label>Тitle ({{$lang->name}})</label>
                        <textarea name="trans[{{$lang->id}}][title]" class="form-control">{{count($model->translations) ? $model->getTranslation('title', $lang->id) : ''}}</textarea>
                    </div>
                    <div class="pad form-group">
                        <label>Описание ({{$lang->name}})</label>
                        <textarea name="trans[{{$lang->id}}][text]" class="form-control my-editor">{{count($model->translations) ? $model->getTranslation('text', $lang->id) : ''}}</textarea>
                    </div>

                @endforeach
                {{--<div class="form-group">--}}
                    {{--<label for="text">Текст</label>--}}
                    {{--<textarea name="text" class="form-control">{{$model->text}}</textarea>--}}
                {{--</div>--}}
                <div class="pad form-group">
                    <label>
                        <input type="checkbox" name="header" {{$model->header ? "checked" : ''}}> Выводить в хедере
                    </label>
                </div>
                <div class="pad form-group">
                    <label>
                        <input type="checkbox" name="footer" {{$model->footer ? "checked" : ''}}> Выводить в футере
                    </label>
                </div>
                <div class="pad form-group">
                    <label>
                        <input type="checkbox" name="footer_right" {{$model->footer_right ? "checked" : ''}}> Выводить в футере справа
                    </label>
                </div>
                <div class="pad form-group">
                    <label>
                        <input type="checkbox" name="mob_menu" {{$model->mob_menu ? "checked" : ''}}> Выводить в моб меню
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
    {{--<div class="row">--}}
        {{--<h1>Переводы</h1>--}}
    {{--</div><br>--}}

    {{--<div class="row">--}}
        {{--<table  class="example2 table table-bordered table-hover">--}}
            {{--<thead>--}}
            {{--<tr>--}}


                    {{--<th>Язык</th>--}}
                    {{--<th>Код слова</th>--}}
                    {{--<th>Значение</th>--}}

                {{--<th class="text-center">Действия</th>--}}
            {{--</tr>--}}
            {{--</thead>--}}
                {{--@foreach($model->translations as $translate)--}}
                    {{--<tr>--}}
                        {{--<td>{{$translate->lang->name}}</td>--}}
                        {{--<td>{{$translate->field}}</td>--}}
                        {{--<td>{{$translate->value}}</td>--}}
                        {{--<td>--}}
                            {{--<a href="{{route('page_translate.edit', $translate->id)}}" class="fa fa-pencil" title="{{trans('admins.edit')}}"></a>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
            {{--<tfoot>--}}
            {{--<tr>--}}
                {{--<th>Язык</th>--}}
                {{--<th>Код слова</th>--}}
                {{--<th>Значение</th>--}}
                {{--<th class="text-center">Действия</th>--}}
            {{--</tr>--}}
            {{--</tfoot>--}}
        {{--</table>--}}
    {{--</div>--}}
    @if($model->alias=="main")
        <div class="col-md-6">
            <h1>Баннера</h1>
            <div class="row">
                <a href="{{route('banner.create')}}?id={{$model->id}}&model=Page">
                    <button class="btn btn-sm btn-primary">Новый баннер</button>
                </a>
            </div><br>
            <div class="row">
                <table  class="example2 table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Баннер</th>
                        <th class="text-center">Действия</th>
                    </tr>
                    </thead>
                    @foreach($model->banners as $banner)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                @if($banner->type=="image_link")
                                    <a href="{{$banner->src}}" target="_blank"><img src="{{$banner->image}}" style="width: 150px;"></a>
                                @else
                                    {!! $banner->code !!}
                                @endif
                            </td>
                            <td class="text-center">
                                {{Form::open(['route'=>['banner.destroy',$banner->id], 'method'=>'delete'])}}
                                <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="Удалить">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                                {{Form::close()}}
                                <a href="{{route('banner.edit',$banner->id)}}?id={{$model->id}}&model=Page"
                                   class="text-info btn btn-link"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Изображение</th>
                        <th class="text-center">Действия</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @endif
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


