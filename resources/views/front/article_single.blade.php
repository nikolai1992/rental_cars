
@extends('layouts.app')
@section('content')
    <!--Main content-->
    <main class="main">
        <div class="mt-35 mb-200 md:mb-100">
            <div class="container">
                <div class="breadcrumbs mb-40">
                    <ul>
                        <li><a href="{{route('main.page')}}">{{$pages->where('alias', 'main')->first()->getTranslation('name')}}</a></li>
                        <li><a href="{{route('news.page')}}">{{$pages->where('alias', 'news')->first()->getTranslation('name')}}</a></li>
                        <li>{{$current_page->getTranslation('name')}}</li>
                    </ul>
                </div>
                <div class="section-with-sidebar">
                    <div class="section-with-sidebar__container">
                        <h2 class="block-title mb-30">{{$current_page->getTranslation('name')}}</h2>
                        <div class="article">
                            <div class="article__top">
                                <div class="date-block">{{Carbon\Carbon::parse($current_page->date_in)->format('d.m.Y')}}</div>
                            </div>
                            <div class="article__content"><img src="{{asset($current_page->image)}}" alt="">
                                {!! $current_page->getTranslation('text') !!}
                            </div>
                            <div class="article__bottom">
                                <div class="article__views">{{$current_page->views}} {{App\Models\Translation::getTranslWord($words, $sel_lang, "views")}}</div>
                                <?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
                                <div class="article__social">
                                    <a class="social-icon social-icon--facebook" href="https://www.facebook.com/sharer/sharer.php?u={{$actual_link}}"></a>
                                    <a class="social-icon social-icon--twitter" href="https://twitter.com/share?text={{$actual_link}}"></a>
                                </div>
                            </div>
                        </div>
                        <div class="page-title mb-40">{{App\Models\Translation::getTranslWord($words, $sel_lang, "comments")}}</div>
                        <div class="comments-block mb-90 lg:mb-0">
                            <!--Есть комментарии-->
                            <div class="comments mb-40">
                                @foreach($current_page->comments as $com)
                                    <div class="comment">
                                        <div class="comment__top">
                                            <div class="comment__name comment__name--accent">{{$com->user->role->alias=="admin" ? "RENTAL CARS" : $com->user->name}}</div>
                                        </div>
                                        <div class="comment__text">{{$com->text}}</div>
                                        <div class="comment__bottom">
                                            <div class="date-block comment__date">{{Carbon\Carbon::parse($com->created_at)->format('d.m.Y H:i')}}</div>
                                            @if(auth()->user())
                                                @if(auth()->user()->role->alias=="admin")
                                                    <a class="edit-review-btn" data-comment_id="{{$com->id}}" href="{{route('article_comment.edit', $com->id)}}?alias={{$current_page->alias}}">Редактировать</a>
                                                    {{Form::open(['route'=>['article_comment.destroy',$com->id], 'method'=>'delete'])}}
                                                    <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="Удалить">
                                                        Удалить
                                                    </button>
                                                    {{Form::close()}}
                                                @endif

                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                {{--<div class="comment">--}}
                                    {{--<div class="comment__top">--}}
                                        {{--<div class="comment__name comment__name--accent">ьпалпьальв</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="comment__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut im ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem.</div>--}}
                                    {{--<div class="comment__bottom">--}}
                                        {{--<div class="date-block comment__date">02.04.2020 12:00</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                            <!--Если есть комментарии и если их нет--><!--
                  <div class="comments-user-section"><a class="modal-open" href="#login">Войдите</a> или <a class="modal-open" href="#signup">зарегистрируйтесь</a>, чтобы оставлять комментарии</div>-->
                            <!--Если есть комментарии и вход выполнен-->
                            @if(auth()->user())
                                <div class="comments-user-section"><a href="#" data-write-a-comment>{{App\Models\Translation::getTranslWord($words, $sel_lang, "write_comment")}}</a></div>
                            @endif
                            <!--Если нет комментариев и вход выполнен--><!--
                  <div class="comments-user-section">
                    <div class="comments-user-section__no-comments-text">Комментариев не найдено. Вы можете быть первым, кто оставит комментарий.</div><a href="#" data-write-a-comment>Написать комментарий</a>
                  </div>-->

                            <form class="write-a-comment max-w-765 {{isset($comment) ? "active" : ''}}" action="{{isset($comment) ? route('article_comment.update', $comment->id) : route('article.write_comment')}}" method="post">
                                @if(auth()->user())
                                @csrf
                                <input name="user_id" value="{{auth()->user()->id}}" type="hidden">
                                <input name="article_id" value="{{$current_page->id}}" type="hidden">
                                @endif
                                @if(isset($comment))
                                   <input name="_method" value="PATCH" type="hidden">
                                @endif
                                <textarea name="text" required>{{isset($comment) ? $comment->text : ''}}</textarea>
                                <button title="Отправить сообщение">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="23" height="23">
                                        <path fill="currentColor" d="M464 4.3L16 262.7C-7 276-4.7 309.9 19.8 320L160 378v102c0 30.2 37.8 43.3 56.7 20.3l60.7-73.8 126.4 52.2c19.1 7.9 40.7-4.2 43.8-24.7l64-417.1C515.7 10.2 487-9 464 4.3zM192 480v-88.8l54.5 22.5L192 480zm224-30.9l-206.2-85.2 199.5-235.8c4.8-5.6-2.9-13.2-8.5-8.4L145.5 337.3 32 290.5 480 32l-64 417.1z"></path>
                                    </svg>
                                </button>
                            </form>
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
                <div class="mt-0 lg:mt-50">
                    <div class="page-title mb-25">{{App\Models\Translation::getTranslWord($words, $sel_lang, "read_also")}}</div>
                    <div class="articles-slider single-owl-carousel">
                        <div class="owl-carousel">
                            @foreach($news as $n)
                            <a class="articles-slider__item" href="{{route('new.read.page', $n->alias)}}">
                                <div class="articles-slider__item-img">
                                    <img src="{{$n->image}}" alt="">
                                </div>
                                <div class="articles-slider__item-content">
                                    <div class="date-block articles-slider__item-date">{{Carbon\Carbon::parse($n->date_in)->format('d.m.Y')}}</div>
                                    <div class="articles-slider__item-title">{{mb_strimwidth($n->getTranslation('name'), 0, 75, "...")}}</div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
