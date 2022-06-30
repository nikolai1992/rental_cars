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
        <h1>Статусы тикетов</h1>
    </div><br>
    <div class="row">
        <a href="{{route('ticket_status.create')}}">
            <button class="btn btn-sm btn-primary">Новый</button>
        </a>
    </div><br>
    <div class="row">
        <table  class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Имя</th>
                <th class="text-center">Действия</th>
            </tr>
            </thead>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{count($ticket->translates) ? $ticket->getTranslation('name') : ''}}</td>
                    <td class="text-center">
                        {{Form::open(['route'=>['ticket_status.destroy',$ticket->id], 'method'=>'delete'])}}
                        <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="Удалить">
                            <i class="fa fa-trash-o"></i>
                        </button>
                        {{Form::close()}}
                        <a href="{{route('ticket_status.edit',$ticket->id)}}"
                           class="text-info btn btn-link"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
            @endforeach
            <tfoot>
            <tr>
                <th>#</th>
                <th>Лого</th>
                <th>Бренд</th>
                <th class="text-center">Действия</th>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection

@section('js')

@endsection
