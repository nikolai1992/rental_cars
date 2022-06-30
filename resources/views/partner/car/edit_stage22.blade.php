@extends('layouts.app')
@section('content')
    <main class="main">
        <div class="mt-35 mb-200 md:mb-100">
            <div class="container">
                <div class="breadcrumbs mb-40">
                    <ul>
                        <li><a href="{{route('main.page')}}">Главная</a></li>
                        <li>Кабинет партнера</li>
                    </ul>
                </div>
                <div class="user-block">
                    <div class="user-block__content pt-20">
                        <div class="user-block__back"><a class="arrow-link arrow-link--reverse" href="{{route('partner_car.edit', $model->id)}}">Назад</a></div>
                        {!! Form::model($model,['url'=>route('partner_car.update.stage2', $model->id),'method'=>'POST','class'=>'user-inputs', 'files' => true]) !!}
                        <div class="user-block__add-car-add-media">
                            <p>Перед добавлением фотографий, пожалуйста, ознакомьтесь с <a class="underline" href="{{route('media_requirements.page')}}?route=partner_car.edit.stage2&id={{$model->id}}">Требованиями к размещаемым фото</a></p>
                            <div class="user-image-uploader mb-70 md:mb-40">
                                <input id="user-add-new-files" type="file" name="images[]" accept="image/*" multiple data-uploaded-text="Загружено файлов:">
                                <label for="user-add-new-files" tabindex="0"><span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                          <path fill="currentColor" d="M0 30v452h512V30zm482 422H30V60h452z"></path>
                          <path fill="currentColor" d="M452 90H60v332h392zm-30 30v211.777c-76.975-2.313-117.019-22.441-159.262-43.678-43.54-21.89-88.489-44.481-172.738-46.884V120zM90 392V271.223c76.975 2.313 117.019 22.441 159.262 43.678 43.54 21.89 88.489 44.481 172.738 46.884V392z"></path>
                          <path fill="currentColor" d="M331.5 271c33.359 0 60.5-27.141 60.5-60.5S364.859 150 331.5 150 271 177.141 271 210.5s27.141 60.5 60.5 60.5zm0-91c16.817 0 30.5 13.683 30.5 30.5S348.317 241 331.5 241 301 227.317 301 210.5s13.683-30.5 30.5-30.5z"></path>
                        </svg><span>Добавить изображения</span></span></label>
                            </div>
                            <p>Ссылка на видео</p>
                            <div class="input-group mb-70 md:mb-40">
                                <input type="text" name="video" value="{{$model->video}}">
                            </div>
                            <div class="user-inputs-btn user-inputs-btn--centered"><button type="submit" class="sm:min-w-0 sm:w-full btn-outlined btn-outlined--theme-accent2 min-w-330">Далее</button></div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection