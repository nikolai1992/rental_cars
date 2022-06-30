@extends('layouts.app')
@section('content')
    <!--Main content-->
    <main class="main">
        <div class="container">
            <div class="brands">
                <div class="breadcrumbs mb-50">
                    <ul>
                        <li><a href="{{route('main.page')}}">{{$pages->where('alias', 'main')->first()->getTranslation('name')}}</a></li>
                        <li>{{$pages->where('alias', 'car_brands')->first()->getTranslation('name')}}</li>
                    </ul>
                </div>
                <h2 class="block-title mb-30 font-bold">{{$pages->where('alias', 'car_brands')->first()->getTranslation('name')}}</h2>
                <div class="car-brands">
                    @foreach($brands as $brand)
                    <a class="car-brand" href="{{route('sort_cars_by_brand', $brand->alias)}}">
                        <div class="car-brand__img">
                            <img src="{{$brand->icon}}" alt="">
                        </div>
                        <div class="car-brand__content">
                            <span>{{$brand->name}}</span>
                            <span>{{count($brand->cars()->where('rent_type', 'simple_rent')->where('saved', true)->get())}} {{$words->where('name', "auto2")->first()->translations->where("language_id", $sel_lang->id)->first()->value}} </span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection