@extends('layouts.app')
@section('content')
    <!--Main content-->
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
                    <div class="user-block__content">
                        <div class="user-block__back"><a class="arrow-link arrow-link--reverse" href="{{route('partner_car.create.update', $model->id)}}">Назад</a></div>
                        <div class="user-block__nav">
                            <ul>
                                <li><a href="partner-add-car.html">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <circle cx="166" cy="226" r="10" fill="currentColor"></circle>
                                            <circle cx="166" cy="286" r="10" fill="currentColor"></circle>
                                            <circle cx="166" cy="346" r="10" fill="currentColor"></circle>
                                            <circle cx="166" cy="406" r="10" fill="currentColor"></circle>
                                            <path fill="currentColor" d="M226 236h120c5.522 0 10-4.478 10-10s-4.478-10-10-10H226c-5.522 0-10 4.478-10 10s4.478 10 10 10zM226 296h120c5.522 0 10-4.478 10-10s-4.478-10-10-10H226c-5.522 0-10 4.478-10 10s4.478 10 10 10zM226 356h120c5.522 0 10-4.478 10-10s-4.478-10-10-10H226c-5.522 0-10 4.478-10 10s4.478 10 10 10zM226 416h120c5.522 0 10-4.478 10-10s-4.478-10-10-10H226c-5.522 0-10 4.478-10 10s4.478 10 10 10z"></path>
                                            <path fill="currentColor" d="M406 90h-81.266C321.108 75.965 310.036 64.892 296 61.266V40c0-22.056-17.944-40-40-40s-40 17.944-40 40v21.266C201.965 64.892 190.892 75.965 187.266 90H106c-5.522 0-10 4.478-10 10v402c0 5.522 4.478 10 10 10h105c5.522 0 10-4.478 10-10s-4.478-10-10-10h-95V110h70v20c0 5.522 4.478 10 10 10h120c5.522 0 10-4.478 10-10v-20h70v382h-95c-5.522 0-10 4.478-10 10s4.478 10 10 10h105c5.522 0 10-4.478 10-10V100c0-5.522-4.477-10-10-10zM236 40c0-11.028 8.972-20 20-20s20 8.972 20 20v20h-40zm70 80H206v-20c0-11.028 8.972-20 20-20h60c11.028 0 20 8.972 20 20z"></path>
                                            <circle cx="256" cy="502" r="10" fill="currentColor"></circle>
                                        </svg>Описание</a></li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                    </svg>
                                </li>
                                <li class="active"><span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                          <path fill="currentColor" d="M14 24.138a5.575 5.575 0 005.569-5.568c0-3.072-2.498-5.57-5.569-5.57s-5.569 2.498-5.569 5.569A5.575 5.575 0 0014 24.138zM14 15c1.968 0 3.569 1.602 3.569 3.569S15.968 22.138 14 22.138s-3.569-1.601-3.569-3.568S12.032 15 14 15z"></path>
                          <path fill="currentColor" d="M1 0v52h50V0H1zm2 2h46v26.727l-10.324-9.464a1.026 1.026 0 00-.72-.262 1.002 1.002 0 00-.694.325l-9.794 10.727-4.743-4.743a1 1 0 00-1.368-.044L4.622 40H3V2zm46 48H3v-8h46v8zM7.649 40l14.324-12.611L32.275 37.69a.999.999 0 101.414-1.414l-4.807-4.807 9.181-10.054L49 31.44V40H7.649z"></path>
                        </svg>Фотографии</span></li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                    </svg>
                                </li>
                                <li><span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 249.425 249.425">
                          <path fill="currentColor" d="M206.79 81.505a6 6 0 00-6 6v149.919H12V48.635h146.792a6 6 0 000-12H6a6 6 0 00-6 6v200.789a6 6 0 006 6h200.79a6 6 0 006-6V87.505a6 6 0 00-6-6z"></path>
                          <path fill="currentColor" d="M247.667 1.758a5.998 5.998 0 00-8.485 0L80.416 160.523 41.023 121.13a5.998 5.998 0 00-8.485 0 5.999 5.999 0 000 8.484l43.636 43.636c1.171 1.172 2.707 1.758 4.243 1.758s3.071-.586 4.243-1.758L247.667 10.243a5.998 5.998 0 000-8.485z"></path>
                        </svg>Подтверждение</span></li>
                            </ul>
                        </div>
                        {!! Form::model($model,['url'=>route('partner_car.store.stage2'),'method'=>'POST','class'=>'user-inputs', 'files' => true]) !!}
                        <input type="hidden" value="{{$model->id}}" name="id">
                        <div class="user-block__add-car-add-media">
                            <p>Перед добавлением фотографий, пожалуйста, ознакомьтесь с <a class="underline" href="{{route('media_requirements.page')}}?route=partner_car.create.stage2&id={{$model->id}}">Требованиями к размещаемым фото</a></p>
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