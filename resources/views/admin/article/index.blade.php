<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 10.07.2018
 * Time: 11:06
 */

?>
@extends('layouts.admin_app')

@section('content_header')
    @if(Session::has('flash_message'))
        <div class="container">
            <div class="alert alert-success">
                {{Session::get('flash_message')}}
            </div>
        </div>
    @endif
@stop

@section('content')
    <br>
    <div class="row">
        <h1>Статьи</h1>
    </div><br>
    <div class="row">
        <a href="{{route('article.create')}}">
            <button class="btn btn-sm btn-primary">Новая новость</button>
        </a>
    </div><br>
    <div class="row">
        <table  class="example2 table table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Изображение</th>
                <th>Заголовок</th>
                <th>Короткое описание</th>
                <th>Дата публикации</th>
                <th>Количество просмотров</th>
                <th class="text-center">Действия</th>
            </tr>
            </thead>
            @foreach($articles as $article)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        @if($article->image)
                            <img src="{{$article->image}}" style="width:150px;">
                        @endif
                    </td>
                    <td>{{count($article->translates) ? $article->getTranslation('name') : ''}}</td>
                    <td>{{count($article->translates) ? $article->getTranslation('short_text') : ''}}</td>
                    <td>{{$article->date_in ? Carbon\Carbon::parse($article->date_in)->format("Y-m-d") : ''}}</td>
                    <td>{{$article->views}}</td>
                    <td class="text-center">
                        {{Form::open(['route'=>['article.destroy',$article->id], 'method'=>'delete'])}}
                        <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="Удалить">
                            <i class="fa fa-trash-o"></i>
                        </button>
                        {{Form::close()}}
                        <a href="{{route('article.edit',$article->id)}}"
                           class="text-info btn btn-link"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
            @endforeach
            <tfoot>
            <tr>
                <th>#</th>
                <th>Изображение</th>
                <th>Заголовок</th>
                <th>Короткое описание</th>
                <th>Дата публикации</th>
                <th>Количество просмотров</th>
                <th class="text-center">Действия</th>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection

@section('js')

@endsection
