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
        <h1>Список тикетов</h1>
    </div><br>
    <div class="row">
        <div class="col-md-12">
            <table  class="example2 table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Номер запроса</th>
                    <th>Пользователь</th>
                    <th>Роль</th>
                    <th>Тема</th>
                    <th>Вопрос</th>
                    <th>Последнее сообщение</th>
                    <th class="text-center">Действия</th>
                </tr>
                </thead>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{$ticket->id}}</td>
                        <td>{{$ticket->user->name}}</td>
                        <td>{{$ticket->user->role->name}}</td>
                        <td>
                            @if($ticket->status)
                            {{count($ticket->status->translates) ? $ticket->status->getTranslation('name') : ''}}
                            @endif
                        </td>
                        <td>{{$ticket->dialogs->first() ? mb_strimwidth($ticket->dialogs->first()->text, 0, 100, "...") : ""}}</td>
                        <td>{{$ticket->dialogs->last() ? mb_strimwidth($ticket->dialogs->last()->text, 0, 100, "...") : ""}}</td>
                        <td class="text-center">
                            <a href="{{route('ticket.edit',$ticket->id)}}"
                               class="text-info btn btn-link"><i class="fas fa-eye"></i></a>
                            {{Form::open(['route'=>['ticket.destroy',$ticket->id], 'method'=>'delete'])}}
                            <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="Удалить">
                                <i class="fa fa-trash-o"></i>
                            </button>
                            {{Form::close()}}
                        </td>
                    </tr>
                @endforeach
                <tfoot>
                <tr>
                    <th>Номер запроса</th>
                    <th>Пользователь</th>
                    <th>Роль</th>
                    <th>Тема</th>
                    <th>Вопрос</th>
                    <th>Последнее сообщение</th>
                    <th class="text-center">Действия</th>
                </tr>
                </tfoot>
            </table>
        </div>

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
