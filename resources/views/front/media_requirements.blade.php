@extends('layouts.app')
@section('content')
    <!--Main content-->
    <main class="main">
        <div class="mt-35 mb-200 md:mb-100">
            <div class="container">
                <div class="breadcrumbs mb-40">
                    <ul>
                        <li><a href="{{route('main.page')}}">{{$pages->where('alias', 'main')->first()->getTranslation('name')}}</a></li>
                        <li>Кабинет партнера</li>
                    </ul>
                </div>
                <div class="user-block">
                    <div class="user-block__content">
                        <div class="user-block__back"><a class="arrow-link arrow-link--reverse" href="{{route($route, $id)}}">Назад</a></div>
                        <div class="user-block__text-section">
                            <h3 class="user-block__text-section-title">{{$page->getTranslation('name')}}</h3>
                            {!! $page->getTranslation('text') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('js')
    @parent
    <script>
        $('.car-page-login').on('click', function(e)
        {
            e.preventDefault();
            var url = $(this).data('url');
            window.location.href = url;
            window.location.reload();
        })
    </script>
@stop