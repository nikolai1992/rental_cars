@extends('layouts.app')
@section('content')
    <!--Main content-->
    <main class="main">
        <div class="container">
            <div class="top-navigation">
                <div><a class="arrow-link arrow-link--reverse" href="{{$car_page_url}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "back")}}</a></div>
                <div>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{route('main.page')}}">{{$pages->where('alias', 'main')->first()->getTranslation('name')}}</a></li>
                            <li><a href="{{route('brands.page')}}">{{$pages->where('alias', 'car_brands')->first()->getTranslation('name')}}</a></li>
                            <li><a href="{{route('sort_cars_by_brand', $car->carBrand->name)}}">{{$car->carBrand->name}}</a></li>
                            <li><a href="{{$car_page_url}}">{{$car->carBrand->name}} {{$car->model}}</a></li>
                            <li>{{App\Models\Translation::getTranslWord($words, $sel_lang, "reservation")}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="booking-thanks">
                <div class="booking-thanks__message">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="#079C49" d="M256 512C114.836 512 0 397.164 0 256S114.836 0 256 0s256 114.836 256 256-114.836 256-256 256zm0-480C132.48 32 32 132.48 32 256s100.48 224 224 224 224-100.48 224-224S379.52 32 256 32zm0 0"></path>
                        <path fill="#079C49" d="M232 341.332c-4.098 0-8.191-1.555-11.309-4.691l-69.332-69.332c-6.25-6.254-6.25-16.387 0-22.637s16.383-6.25 22.637 0l58.024 58.027 127.363-127.36c6.25-6.25 16.383-6.25 22.633 0s6.25 16.384 0 22.634L243.348 336.64A16.03 16.03 0 01232 341.332zm0 0"></path>
                    </svg><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "thank_text")}}</span>
                </div>
                <div class="booking-thanks__img"></div>
            </div>
        </div>
    </main>
@endsection