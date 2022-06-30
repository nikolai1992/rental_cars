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
        <h1>FAQ</h1>
    </div><br>
    <div class="row">
        <a href="{{route('faq.create')}}">
            <button class="btn btn-sm btn-primary">Новый пункт</button>
        </a>
    </div><br>
    <div class="row">
        <div class="col-md-12">
            <table  class="example2 table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Вопрос</th>
                    <th>Ответ</th>
                    <th>Приоритет</th>
                    <th class="text-center">Действия</th>
                </tr>
                </thead>
                @foreach($faqs->sortBy('order_id') as $faq)
                    <tr>
                        <td>{{count($faq->translates) ? $faq->getTranslation('question') : ''}}</td>
                        <td>{{count($faq->translates) ? $faq->getTranslation('answer') : ''}}</td>
                        <td>{{$faq->order_id}}</td>
                        <td class="text-center">
                            <a href="{{route('faq.edit',$faq->id)}}"
                               class="text-info btn btn-link"><i class="fa fa-pencil"></i></a>
                            {{Form::open(['route'=>['faq.destroy',$faq->id], 'method'=>'delete'])}}
                            <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="Удалить">
                                <i class="fa fa-trash-o"></i>
                            </button>
                            {{Form::close()}}
                        </td>
                    </tr>
                @endforeach
                <tfoot>
                <tr>
                    <th>Вопрос</th>
                    <th>Ответ</th>
                    <th>Приоритет</th>
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
