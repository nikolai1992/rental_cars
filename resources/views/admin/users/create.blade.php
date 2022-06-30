<?php

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
    <div class="box box-primary">
        {!! Form::open(['url'=>route('users.store'), 'class'=>'contact-form', 'method'=>'post']) !!}
        <div class="box-body">

            <div class="form-group">
                {!! Form::label('name', "Логин") !!}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    {!! Form::text('name', null, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>"Введите имя"]) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('first_name', "Имя") !!}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    {!! Form::text('first_name', null, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>"Введите имя"]) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('email', trans('admins.email')) !!}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    {!! Form::email('email', null, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>trans('admins.enter_email')]) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('password', trans('admins.password')) !!}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    {!! Form::password('password', ['class'=>'form-control', 'required'=>'required', 'placeholder'=>trans('admins.enter_password')]) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('active', trans('admins.active')) !!}
                <div class="input-group">

                    {!! Form::checkbox('active', null, null, array('id'=>'active')) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('sms_notification', "SMS Уведомление") !!}
                <div class="input-group">

                    {!! Form::checkbox('sms_notification', null, null, array('id'=>'sms_notification')) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('notification', "Новостные уведомления") !!}
                <div class="input-group">

                    {!! Form::checkbox('notification', null, null, array('id'=>'notification')) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('phone',"Телефон") !!}
                <input type="text" name="phone" id="phone" required class="form-control">
            </div>
            <div class="form-group">
                {!! Form::label('image', "Аватар") !!}
                <img style="width:150px; display:none;">
                <div class="input-group">
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('role',__('admins.role')) !!}
                <div class="input-group">

                    {!! Form::select('role_id', $roles, null, ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="dynamical-div">

            </div>
        </div>
        <!-- Submit -->
        <div class="box-footer">
            {!! Form::button(trans('admins.add'), ['class' => 'btn btn-primary','type'=>'submit']) !!}
            <a href="{{ route('users.index') }}" class="btn btn-warning">Отмена</a>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('js')
    <script>
        $('select[name="role_id"]').on('change', function () {
            if($(this).val()==3)
            {
                $(".dynamical-div").append(`@include('admin._partials.partner_fields')`)
            }else
            {
                $(".dynamical-div").html('');
            }
            console.log($(this).val());
        });
        $('body').on('change', 'input[name="image"]', function(event) {
            readURL2(this)
        });
        function readURL2(input) {
            console.log(input.files && input.files[0]);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    console.log($(input).parent().html());

                    $(input).parent().parent().find('img').attr('src', e.target.result).show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
