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
        <a href="{{route('services.create')}}">
            <button class="btn btn-sm btn-primary">Новый сервис</button>
        </a>
    </div><br>
    <div class="row">
        <table  class="example2 table table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>@lang('admins.name')</th>
                <th>@lang('admins.status')</th>
                <th class="text-center">@lang('admins.edit')</th>
                <th class="text-center">@lang('admins.destroy')</th>
            </tr>
            </thead>
            @foreach($models as $model)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$model->name}}</td>
                    <td>{!! $model->status ? '<i class="fa fa-thumbs-o-up"></i>' : '<i class="fa fa-thumbs-down"></i>' !!}</td>
                    <td class="text-center">
                        <a href="{{route('services.edit',$model->id)}}"
                           class="text-info btn btn-link"><i class="fa fa-pencil"></i></a>
                    </td>
                    <td class="text-center">
                        {{Form::open(['route'=>['services.destroy',$model->id], 'method'=>'delete'])}}
                        <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="Удалить">
                            <i class="fa fa-trash-o"></i>
                        </button>
                        {{Form::close()}}
                    </td>
                </tr>
            @endforeach
            <tfoot>
            <tr>
                <th>#</th>
                <th>@lang('admins.name')</th>

                <th>@lang('admins.status')</th>
                <th class="text-center">@lang('admins.edit')</th>
                <th class="text-center">@lang('admins.destroy')</th>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection

@section('js')
    <script>
        $('.example2').DataTable({
            'paging': false,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });

    </script>
@endsection
