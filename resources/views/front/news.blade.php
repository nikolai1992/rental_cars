
@extends('layouts.app')
@section('content')
    <!--Main content-->
    <main class="main">
        <div class="mt-35 mb-200 md:mb-100">
            <div class="container">
                <div class="breadcrumbs mb-40">
                    <ul>
                        <li><a href="{{route('main.page')}}">{{$pages->where('alias', 'main')->first()->getTranslation('name')}}</a></li>
                        <li>{{$pages->where('alias', 'news')->first()->getTranslation('name')}}</li>
                    </ul>
                </div>
                <div class="section-with-sidebar">
                    <div class="section-with-sidebar__container">
                        <h2 class="block-title mb-30">{{$pages->where('alias', 'news')->first()->getTranslation('name')}}</h2>
                        <div class="news-section">
                            @foreach($news as $new)
                            <div class="news-item">
                                <div class="news-item__img"><img src="{{$new->image}}" alt=""></div>
                                <div class="news-item__content">
                                    <div class="news-item__date">{{Carbon\Carbon::parse($new->date_in)->format('d.m.Y')}}</div><a class="news-item__title" href="{{route('new.read.page', $new->alias)}}">{{$new->getTranslation('name')}}</a>
                                    <div class="news-item__text">{{$new->getTranslation('short_text')}}</div><a class="arrow-link news-item__more-link" href="{{route('new.read.page', $new->alias)}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "more_detail")}}</a>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        <div class="mt-40">
                            <div class="pagination">
                                <ul>
                                    @if($news->previousPageUrl())
                                        <li class="prev"><a href="{{$news->previousPageUrl()}}">&lsaquo;</a></li>
                                    @endif
                                    @for($i=1; $i<=(int)($news->lastPage()); $i++)
                                        @if($news->currentPage()==$i)
                                                <li class="active"><a href="#">{{$i}}</a></li>
                                        @else

                                            @if($i==1)
                                                    <li><a href="{{route('news.page')}}">{{$i}}</a></li>
                                            @else
                                                <li><a href="{{route('news.page').'\?page='.$i}}">{{$i}}</a></li>
                                            @endif
                                        @endif

                                    @endfor
                                        @if($news->nextPageUrl())
                                            <li class="next"><a href="{{$news->nextPageUrl()}}">&rsaquo;</a></li>
                                        @endif
                                </ul>
                            </div>
                        </div>
                        <div class="display-n" style="display: none">
                            {{ $news->links() }}
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
