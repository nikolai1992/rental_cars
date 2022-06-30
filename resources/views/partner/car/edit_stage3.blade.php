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
                    <div class="user-block__content pt-20">
                        <div class="user-block__back"><a class="arrow-link arrow-link--reverse" href="{{route('partner_car.edit.stage2', $model->id)}}">Назад</a></div>
                        <div class="user-block__add-car-media">
                            <div class="user-block__add-car-media-text">Первое фото в этом списке является заглавным для каталога авто - оно будет отображаться рядом с информацией об авто и будет в первую очередь презентовать его. Поэтому советуем Вам отнестись ответственно к выбору заглавного фото.</div>
                            <div class="image-cards">
                                @foreach($model->images->sortBy('order_id') as $image)
                                    <div class="image-card">
                                        <div class="image-card__img">
                                            <div class="image-card__img-wrapper"><img src="{{$image->url}}" order_id="{{$image->order_id}}" alt=""></div>
                                        </div>
                                        <div class="image-card__controlls">
                                            @if($loop->iteration!=1)
                                                <a class="image-card__btn image-card__btn--top" href="{{route('partner_car.image.move_to_top', ["id"=>$model->id, "order_id"=>$loop->iteration])}}" title="Переместить вверх"></a>
                                                <a class="image-card__btn image-card__btn--up" href="{{route('partner_car.image.move_upper', ["id"=>$model->id, "order_id"=>$loop->iteration])}}" title="Переместить выше"></a>
                                            @endif
                                            @if($loop->iteration!=count($model->images))
                                                <a class="image-card__btn image-card__btn--down" href="{{route('partner_car.image.move_lower', ["id"=>$model->id, "order_id"=>$loop->iteration])}}" title="Переместить ниже"></a>
                                            @endif
                                                <a class="image-card__btn image-card__btn--rotate" href="{{route('partner_car.image.rotate', ["id"=>$image->id, "edit"=>true])}}" title="Повернуть"></a>
                                                <a class="image-card__btn image-card__btn--delete" href="{{route('partner_car.image.delete', ["id"=>$image->id, "edit"=>true])}}" title="Удалить фото"></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="user-inputs-btn user-inputs-btn--centered"><a class="sm:min-w-0 sm:w-full btn-outlined btn-outlined--theme-accent2 min-w-330" href="{{route('partner_car.edit.stage4', $model->alias)}}">Предварительный просмотр</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection