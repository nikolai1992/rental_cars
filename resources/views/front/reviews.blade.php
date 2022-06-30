@extends('layouts.app')
@section('content')
    <!--Main content-->
    <main class="main">
        <div class="mt-35 mb-200 md:mb-100">
            <div class="container">
                <div class="breadcrumbs mb-40">
                    <ul>
                        <li><a href="{{route('main.page')}}">{{$pages->where('alias', 'main')->first()->getTranslation('name')}}</a></li>
                        <li>{{$pages->where('alias', 'reviews')->first()->getTranslation('name')}}</li>
                    </ul>
                </div>
                <div class="section-with-sidebar">
                    <div class="section-with-sidebar__container">
                        <h2 class="block-title mb-30">{{$pages->where('alias', 'reviews')->first()->getTranslation('name')}}</h2>
                        <div class="comments-block comments-block--pr mb-90 lg:mb-0">
                            <form class="write-a-comment pb-40 simple-border-bottom mb-40 {{\Request::route()->getName()=='review.edit' ? "active" : ""}}" action="{{\Request::route()->getName()!='review.edit' ? route('send_review') : route('review.update', $model->id)}}" method="post">
                                @csrf
                                <input type="hidden" name="review_id" value="{{isset($model) ? $model->review_id : ''}}">
                                @if(\Request::route()->getName()!='review.edit')
                                <div class="set-rating mb-15">
                                    <input id="account-reviews-1-star-5" type="radio" name="rating" value="5" required>
                                    <label for="account-reviews-1-star-5"></label>
                                    <input id="account-reviews-1-star-4" type="radio" name="rating" value="4" required>
                                    <label for="account-reviews-1-star-4"></label>
                                    <input id="account-reviews-1-star-3" type="radio" name="rating" value="3" required>
                                    <label for="account-reviews-1-star-3"></label>
                                    <input id="account-reviews-1-star-2" type="radio" name="rating" value="2" required>
                                    <label for="account-reviews-1-star-2"></label>
                                    <input id="account-reviews-1-star-1" type="radio" name="rating" value="1" required>
                                    <label for="account-reviews-1-star-1"></label>
                                </div>
                                @else
                                    <div class="set-rating mb-15">
                                        <input id="account-reviews-1-star-5" type="radio" name="rating" {{$model->rating=="5" ? 'checked' : ''}} value="5" required>
                                        <label for="account-reviews-1-star-5"></label>
                                        <input id="account-reviews-1-star-4" type="radio" name="rating" {{$model->rating=="4" ? 'checked' : ''}} value="4" required>
                                        <label for="account-reviews-1-star-4"></label>
                                        <input id="account-reviews-1-star-3" type="radio" name="rating" {{$model->rating=="3" ? 'checked' : ''}} value="3" required>
                                        <label for="account-reviews-1-star-3"></label>
                                        <input id="account-reviews-1-star-2" type="radio" name="rating" {{$model->rating=="2" ? 'checked' : ''}} value="2" required>
                                        <label for="account-reviews-1-star-2"></label>
                                        <input id="account-reviews-1-star-1" type="radio" name="rating" {{$model->rating=="1" ? 'checked' : ''}} value="1" required>
                                        <label for="account-reviews-1-star-1"></label>
                                    </div>
                                    <input type="hidden" name="_method" value="PATCH">
                                @endif
                                <textarea class="mb-25 shadow-none" name="text" required>{{isset($model) ? $model->text : ''}}</textarea>
                                @if(\Request::route()->getName()!='review.edit')
                                    <div class="input-group mb-70">
                                        <label>Оставьте ссылку на автомобиль, о котором Вы пишете отзыв (необязательно)</label>
                                        <input type="text" name="link">
                                    </div>
                                @else
                                    @if(isset($model))
                                        @if(!$model->review_id)
                                            <div class="input-group mb-70">
                                                <label>Оставьте ссылку на автомобиль, о котором Вы пишете отзыв (необязательно)</label>
                                                <input type="text" name="link" value="{{$model->link}}">
                                            </div>
                                        @endif
                                    @endif
                                @endif
                                <div class="write-a-comment__btn">
                                    <button class="btn-outlined btn-outlined--theme-accent2 min-w-220">Опубликовать</button>
                                </div>
                            </form>
                            <!--Есть отзывы-->
                            <div class="comments">
                                <!--Если вход не выполнен--><!--
                    <div class="comments-user-section pb-40 simple-border-bottom mb-40"><a class="modal-open" href="#login">Войдите</a> или <a class="modal-open" href="#signup">зарегистрируйтесь</a>, чтобы оставлять отзывы</div>-->
                                <!--Если вход выполнен-->
                                @if(\Request::route()->getName()!='review.edit')
                                @if(auth()->user())
                                    <div class="comments__top pb-40 simple-border-bottom mb-40">
                                        <div class="comments__top-title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "write_your_review")}}</div>
                                        <button class="btn-outlined btn-outlined--theme-accent2 min-w-220" data-write-a-comment>{{App\Models\Translation::getTranslWord($words, $sel_lang, "give_feedback")}}</button>
                                    </div>
                                @endif
                                @endif
                                @foreach($reviews->where('review_id', null) as $review)
                                <div class="comment pb-40 simple-border-bottom mb-40">
                                    <div class="comment__top">
                                        <div class="comment__name">{{$review->user->role->alias=="admin" ? "RENTAL CARS" :  $review->user->name}}</div>
                                        <div class="star-rating">
                                            <div class="star-rating__inner" style="width: {{20*$review->rating}}%"></div>
                                        </div>
                                        <div class="comment__top-right-side">
                                            <div class="date-block comment__date">{{Carbon\Carbon::parse($review->created_at)->format('d.m.Y')}}</div><a class="comment__attached-link" href="{{$review->link}}" title="Посмотреть это авто"></a>
                                        </div>
                                    </div>
                                    <div class="comment__text">{{$review->text}}</div>
                                    <div class="comment__bottom">
                                        @if(auth()->user())
                                            <button class="comment__reply" data-write-a-comment data-do-not-hide data-hide=".comments__top" data-review_id="{{$review->id}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "reply")}}</button>

                                            @if(auth()->user()->role->alias=="admin")
                                                <a class="edit-review-btn" data-comment_id="{{$review->id}}" href="{{route('review.edit', $review->id)}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "edit")}}</a>
                                                {{Form::open(['route'=>['review.destroy',$review->id], 'method'=>'delete'])}}
                                                <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="{{App\Models\Translation::getTranslWord($words, $sel_lang, "delete")}}">
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "delete")}}
                                                </button>
                                                {{Form::close()}}
                                            @endif

                                        @endif
                                    </div>
                                    @if($review->comments->count())

                                    <div class="comments">
                                        <?php $comments = $review->comments;?>
                                        @include('_partials.comments', compact('comments'))
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            <!--Нет отзывов и вход не выполнен--><!--
                  <div class="comments-user-section"><a class="modal-open" href="#login">Войдите</a> или <a class="modal-open" href="#signup">зарегистрируйтесь</a>, чтобы оставлять отзывы</div>-->
                            <!--Нет отзывов и вход выполнен--><!--
                  <div class="comments-user-section">
                    <div class="comments-user-section__no-comments-text">Вы можете быть первым, кто оставит отзыв.</div><a href="#" data-write-a-comment>Написать отзыв</a>
                  </div>-->
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
                    <div class="page-title mb-25">{{$pages->where('alias', 'news')->first()->getTranslation('name')}}</div>
                    <div class="articles-slider single-owl-carousel">
                        <div class="owl-carousel">
                            @foreach($news as $n)
                            <a class="articles-slider__item" href="{{route('new.read.page', $n->alias)}}">
                                <div class="articles-slider__item-img">
                                    <img src="{{asset($n->image)}}" alt="">
                                </div>
                                <div class="articles-slider__item-content">
                                    <div class="date-block articles-slider__item-date">{{Carbon\Carbon::parse($n->date_in)->format('d.m.Y')}}</div>
                                    <div class="articles-slider__item-title">{{count($n->translates) ? mb_strimwidth($n->getTranslation('name'), 0, 75, "...") : ''}}</div>
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
@section('js')
    @parent

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
        $('.car-page-login').on('click', function(e)
        {
            e.preventDefault();
            var url = $(this).data('url');
            window.location.href = url;
            window.location.reload();
        })
        $('.comment__reply').on('click', function(){
           var review_id = $(this).data('review_id');
           $('input[name="review_id"]').val(review_id);
           $('input[name="rating"]').removeAttr('required');
           $('.set-rating').hide();
           $('input[name="link"]').parent().hide();
        });

    </script>
@stop
