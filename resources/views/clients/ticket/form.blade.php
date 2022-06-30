@extends('layouts.app')
@section('content')
    <!--Main content-->
    <main class="main">
        <div class="mt-35 mb-200 md:mb-100">
            <div class="container">
                <div class="breadcrumbs mb-40">
                    <ul>
                        <li><a href="{{route('main.page')}}">{{$pages->where('alias', 'main')->first()->getTranslation('name')}}</a></li>
                        <li>{{App\Models\Translation::getTranslWord($words, $sel_lang, "personal_cabinet")}}</li>
                    </ul>
                </div>
                <div class="user-block">
                    <div class="user-block__top">
                        <div class="user-block__profile">
                            <div>
                                <input id="user-block-img" type="file" accept="image/*">
                                <label for="user-block-img"></label><span>JS</span><!--<img src="img/user/avatar.jpg" alt="">-->
                                <img src="{{asset(auth()->user()->image)}}" style="{{!auth()->user()->image ? 'display:none' : ''}}" alt="">
                            </div>
                            <div><span>{{auth()->user()->first_name}}</span></div>
                        </div><a class="user-block__logout" href="#">{{App\Models\Translation::getTranslWord($words, $sel_lang, "exit")}}</a>
                    </div>
                    <div class="user-block__content pt-0">
                        <div class="user-block__back"><a class="arrow-link arrow-link--reverse" href="{{route('client_ticket.index')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "back")}}</a></div>
                        <form class="user-block__new-ticket" action="{{route('client_ticket.store')}}" method="post">
                            @csrf
                            <div class="mb-35">
                                <div class="input-group input-group--with-label mb-0">
                                    <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "ticket_subject")}}</label>
                                    <div class="custom-select-wrapper">
                                        <select class="custom-select custom-select--bold custom-select--uppercase" name="theme" data-dropdown-css-class="custom-select-dropdown custom-select-dropdown--bold custom-select-dropdown--uppercase">
                                            <option label="Выберите из списка"></option>
                                            @foreach($themes as $theme)
                                            <option value="{{$theme->id}}">{{count($theme->translates) ? $theme->getTranslation('name') : ''}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-55">
                                <div class="input-group">
                                    <textarea class="min-h-160" name="text" required></textarea>
                                </div>
                                <div class="attach-file">
                                    <input id="create-ticket-atachment" type="file" name="file" accept="image/*" data-uploaded-text="{{App\Models\Translation::getTranslWord($words, $sel_lang, "file_attached")}}">
                                    <label for="create-ticket-atachment" tabindex="0">{{App\Models\Translation::getTranslWord($words, $sel_lang, "attach_file")}}</label>
                                </div>
                            </div>
                            <div class="flex flex-row-reverse">
                                <button class="btn-outlined btn-outlined--theme-accent2 sm:w-full">{{App\Models\Translation::getTranslWord($words, $sel_lang, "send_message")}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
