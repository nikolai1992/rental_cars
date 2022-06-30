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
        <h1>Языки</h1>
    </div><br>
    <div class="row">
        <a href="{{route('language.create')}}">
            <button class="btn btn-sm btn-primary">Новый язык</button>
        </a>
    </div><br>
    <div class="row">
        <table  class="example2 table table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Язык</th>
                <th>Код</th>
                <th>Активный</th>
                <th>Главный</th>
                <th class="text-center">Действия</th>
            </tr>
            </thead>
            @foreach($languages as $language)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$language->name}}</td>
                    <td>{{$language->code}}</td>
                    <td>{!! $language->active ? '<i class="fa fa-thumbs-o-up"></i>' : '<i class="fa fa-thumbs-down"></i>' !!}</td>
                    <td>{!! $language->main ? '<i class="fa fa-thumbs-o-up"></i>' : '<i class="fa fa-thumbs-down"></i>' !!}</td>
                    <td class="text-center">
                        <a href="{{route('language.edit',$language->id)}}"
                           class="text-info btn btn-link"><i class="fa fa-pencil"></i></a>
                        @if(count($languages)>1)
                            {{Form::open(['route'=>['language.destroy',$language->id], 'method'=>'delete'])}}
                            <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="Удалить">
                                <i class="fa fa-trash-o"></i>
                            </button>
                            {{Form::close()}}
                        @endif
                    </td>
                </tr>
            @endforeach
            <tfoot>
            <tr>
                <th>#</th>
                <th>Язык</th>
                <th>Код</th>
                <th>Активный</th>
                <th>Главный</th>
                <th class="text-center">Действия</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <div class="row">
        <h1>Переводы</h1>
    </div><br>
    <div class="row">
        <a href="{{route('translation.create')}}">
            <button class="btn btn-sm btn-primary">Новое слово</button>
        </a>
    </div><br>
    <div class="row">
        <table  class="example2 table table-bordered table-hover">
            <thead>
            <tr>
                <th>Код слова</th>
                @foreach($languages as $language)
                    <th>{{$language->code}}</th>
                @endforeach
                <th class="text-center">Действия</th>
            </tr>
            </thead>
                @foreach($words as $word)
                    <tr>
                        <td>{{$word->name}}</td>
                        @foreach($languages as $lang)
                            <td>{{$word->translations ? $word->translations->where('language_id', $lang->id)->first()->value : ''}}</td>
                        @endforeach
                        <td>
                            <a href="{{route('translation.edit', $word->id)}}" class="fa fa-pencil" title="{{trans('admins.edit')}}"></a>
                            {{Form::open(['route'=>['translation.destroy', $word->id], 'method'=>'delete'])}}
                            <button onclick="return confirm('Вы уверены что хотите удалить? Отменить удаление будет нельзя. Это может нарушить работу сайта')" type="submit" class="delete"  title="@lang('admins.destroy')">
                                <i class="fa fa-trash-o"></i>
                            </button>
                            {{Form::close()}}
                        </td>
                    </tr>
                @endforeach
            <tfoot>
            <tr>
                <th>Код слова</th>
                @foreach($languages as $language)
                    <th>{{$language->code}}</th>
                @endforeach
                <th class="text-center">Действия</th>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection

@section('js')

@endsection
