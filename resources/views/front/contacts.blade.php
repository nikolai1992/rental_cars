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
                        <form class="contact-form" action="{{route('send_email')}}" method="post">
                            @csrf
                            <div class="contact-form__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "write_to_us")}}</div>
                            <div class="contact-form__subtitle">{{App\Models\Translation::getTranslWord($words, $sel_lang, "specialists_of_services_consult")}}</div>
                            <div class="contact-form__inputs">
                                <div class="input-group input-group--with-label mb-30">
                                    <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "theme")}} <span class="text-red">*</span></label>
                                    <input type="text" name="subject" required>
                                </div>
                                <div class="input-group input-group--with-label mb-30">
                                    <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "name")}} <span class="text-red">*</span></label>
                                    <input type="text" name="name" required>
                                </div>
                                <div class="input-group input-group--with-label mb-30">
                                    <label>E-mail <span class="text-red">*</span></label>
                                    <input type="email" name="email" required>
                                </div>
                                <div class="input-group input-group--with-label mb-30">
                                    <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "booking_number")}}</label>
                                    <input type="text" name="booking_number">
                                </div>
                                <div class="input-group input-group--with-label input-group--with-label-white mb-30">
                                    <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "description")}} <span class="text-red">*</span></label>
                                    <textarea name="description" required></textarea>
                                </div>
                                <div class="captcha-placeholder mb-40"><div class="g-recaptcha" data-sitekey="6LfzSzAaAAAAAIxMPCfTNBb4zrUbRkXyU9yE3CAM"></div></div>
                                <div class="contact-form__2col">
                      <button class="btn-outlined btn-outlined--theme-accent" {{!auth()->user() ? "disabled" : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "send")}}</button>
                                    {{--<a class="btn-outlined btn-outlined--theme-accent" href="contact-sent.html">Отправить</a>--}}
                                    <button class="btn-outlined" type="reset">{{App\Models\Translation::getTranslWord($words, $sel_lang, "cancel")}}</button>
                                </div>
                            </div>
                        </form>
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

@stop