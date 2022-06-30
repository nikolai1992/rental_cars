@extends('layouts.app')
@section('content')
    <!--Main content-->
    <main class="main">
        <div class="mt-35 mb-200 md:mb-100">
            <div class="container">
                <div class="breadcrumbs mb-40">
                    <ul>
                        <li><a href="{{route('main.page')}}">{{$pages->where('alias', 'main')->first()->getTranslation('name')}}</a></li>
                        <li>{{$current_page->getTranslation('name')}}</li>
                    </ul>
                </div>
                <div class="section-with-sidebar">
                    <div class="section-with-sidebar__container">
                        <h2 class="block-title mb-30">{{$current_page->getTranslation('name')}}</h2>
                        <div class="text-block">
                            {!! $current_page->getTranslation('text') !!}
                        </div>
                    </div>
                    <div class="section-with-sidebar__sidebar">
                        <div class="sidebar-partnership mb-50">
                            <div class="sidebar-partnership__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "partnership")}}</div>
                            <div class="sidebar-partnership__text">{{App\Models\Translation::getTranslWord($words, $sel_lang, "partnership_text")}}</div><a class="sidebar-partnership__btn modal-open" href="#partner">{{App\Models\Translation::getTranslWord($words, $sel_lang, "request_for_partnership")}}</a>
                        </div>
                        <div class="sidebar-choose-a-car">
                            <div class="sidebar-choose-a-car__logo"><img src="{{asset('img/logo-sidebar-choose-a-car.png')}}" alt=""></div>
                            <div class="sidebar-choose-a-car__text">{{App\Models\Translation::getTranslWord($words, $sel_lang, "cars_for_travel")}}</div><a class="arrow-link arrow-link--white sidebar-choose-a-car__btn" href="{{route('cars.page')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_car")}}</a>
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
        $('.cars-sorting').on('change', function(){
            var url = $(this).val();
            window.location.href = url;
        });
    </script>
@stop