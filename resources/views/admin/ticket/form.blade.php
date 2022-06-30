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
        {!! Form::model($model,['url'=>route('ticket.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'']) !!}
        <div class="box-body">
            <div class="row">
                <div class="pad col-md-6">
                    <label for="theme">Tема тикета</label>
                    <select class="form-control" name="theme">
                        @foreach($themes as $theme)
                            <option {{$theme->id==$model->theme ? 'selected' : ''}}>{{$theme->getTranslation('name')}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a href="{{ route('ticket.index') }}" class="btn btn-warning">Отмена</a>
            </div>
            
        </div>
		{!! Form::close() !!}
        <div class="box-body">
			<div class="box-header with-bmodel">
				<br><h3 class="box-title">Переписка</h3>
			</div>
			<div class="row">
			
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Написать ответ
</button>
			</div><br>
            <table  class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Имя пользователя</th>
                    <th>Роль</th>
                    <th>Текст</th>
                    <th>Прикрепленый файл</th>
                    <th>Дата</th>
                    <th class="text-center">Действия</th>
                </tr>
                </thead>
                @foreach($model->dialogs as $dialog)
                    <tr>
                        <td>{{$dialog->user->name}}</td>
                        <td>{{$dialog->user->role->name}}</td>
                        <td class="dialog-text">{{$dialog->text}}</td>
                        <td>
                            @if($dialog->file)
                                <a href="{{asset($dialog->file)}}" target="_blank">Файл</a>
                            @endif
                        </td>
                        <td>{{$dialog->created_at}}</td>
                        <td class="text-center">
                            <a href="{{route('ticket_dialog.edit',$dialog->id)}}" data-url="{{route('ticket_dialog.update', $dialog->id)}}"
                               class="text-info btn btn-link"><i class="fa fa-pencil"></i></a>
                            {{Form::open(['route'=>['ticket_dialog.destroy',$dialog->id], 'method'=>'delete'])}}
                            <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="Удалить">
                                <i class="fa fa-trash-o"></i>
                            </button>
                            {{Form::close()}}
                        </td>
                    </tr>
                @endforeach
                <tfoot>
                <tr>
                    <th>Имя пользователя</th>
                    <th>Роль</th>
                    <th>Текст</th>
                    <th>Прикрепленый файл</th>
                    <th>Дата</th>
                    <th class="text-center">Действия</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
	<!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true" enctype="multipart/form-data">
        <div class="modal-dialog" role="document">
            <form action="{{route('ticket_dialog.store')}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PATCH">
                @csrf
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                <input type="hidden" name="ticket_id" value="{{$model->id}}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ответ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <textarea class="form-control" name="text"></textarea>
                        </div><br>
                        <div class="row">
                            <input id="create-ticket-atachment" type="file" name="file" accept="image/*" data-uploaded-text="Файл прикреплен">
                            <label for="create-ticket-atachment" tabindex="0">Прикрепить файл</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form action="{{route('ticket_dialog.store')}}" method="post" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
  <input type="hidden" name="ticket_id" value="{{$model->id}}">
  
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ответ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
              <textarea class="form-control" name="text"></textarea>
          </div><br>
          <div class="row">
              <input id="create-ticket-atachment" type="file" name="file" accept="image/*" data-uploaded-text="Файл прикреплен">
              <label for="create-ticket-atachment" tabindex="0">Прикрепить файл</label>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </form>
  </div>
</div>
@stop

@section('js')
    @parent
    <script>
        $('.btn-link').on('click', function(e){
            e.preventDefault();
            var url = $(this).data('url');
            $('#exampleModal2').find('form').attr("action", url);
            var text = $(this).parent().parent().find('.dialog-text').text();
            $('#exampleModal2').find('textarea').val(text);
            $('#exampleModal2').modal('toggle');
        });

    </script>

@stop


