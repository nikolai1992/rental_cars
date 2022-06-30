@extends('layouts.app')
@section('content')
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
                    @include('_partials._client_navigation')
                    <div class="user-block__content">
                        <form class="user-inputs" action="{{route('client.profile.update')}}" method="post">
                            @csrf
                            <h3 class="user-inputs__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "personal_data")}}</h3>

                            <div class="user-inputs__row user-inputs__row--inner-mt-bigger mb-30">
                                <div class="user-inputs__col">
                                    <div class="input-group input-group--with-label mb-0">
                                        <label>Login <span class="text-red">*</span></label>
                                        <input type="text" readonly value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="user-inputs__col">
                                    <div class="input-group input-group--with-label mb-0">
                                        <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "name")}} <span class="text-red">*</span></label>
                                        <input type="text" name="first_name" value="{{$user->first_name}}" required>
                                    </div>
                                </div><span class="user-inputs__hint">{{App\Models\Translation::getTranslWord($words, $sel_lang, "client_name_text")}}</span>
                            </div>
                            <div class="user-inputs__row user-inputs__row--inner-mt-bigger mb-30">
                                <div class="user-inputs__col">
                                    <div class="input-group input-group--with-label mb-0">
                                        <label>E-mail <span class="text-red">*</span></label>
                                        <input type="email" name="email" value="{{$user->email}}" required disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="user-inputs__row user-inputs__row--inner-mt-bigger mb-55">
                                <div class="user-inputs__col">
                                    <div class="input-group input-group--with-label mb-0">
                                        <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "phone")}} <span class="text-red">*</span></label>
                                        <input type="tel" name="phone" value="{{$user->phone}}" required>
                                    </div>
                                </div>
                            </div>
                            <h3 class="user-inputs__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "change_password")}}</h3>
                            <div class="user-inputs__row user-inputs__row--inner-mt-bigger mb-30">
                                <div class="user-inputs__col">
                                    <div class="input-group input-group--with-label mb-0">
                                        <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "enter_old_password")}}</label>
                                        <input type="password" name="old_pass">
                                    </div>
                                </div>
                            </div>
                            <div class="user-inputs__row user-inputs__row--inner-mt-bigger mb-30">
                                <div class="user-inputs__col">
                                    <div class="input-group input-group--with-label mb-0">
                                        <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "enter_new_password")}}</label>
                                        <input type="password" name="password">
                                    </div>
                                </div>
                            </div>
                            <div class="user-inputs__row user-inputs__row--inner-mt-bigger mb-55">
                                <div class="user-inputs__col">
                                    <div class="input-group input-group--with-label mb-0">
                                        <label>{{App\Models\Translation::getTranslWord($words, $sel_lang, "enter_new_password")}}</label>
                                        <input type="password" name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                            <h3 class="user-inputs__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "notifications")}}</h3>
                            <div class="user-inputs__checkboxes mb-70">
                                <div class="checkbox-group-2 mb-20">
                                    <input id="user-profile-checkbox-1" type="checkbox" {{$user->sms_notification ? "checked" : ''}} name="sms_notification">
                                    <label for="user-profile-checkbox-1">{{App\Models\Translation::getTranslWord($words, $sel_lang, "sms_notifications")}}</label>
                                </div>
                                <div class="checkbox-group-2">
                                    <input id="user-profile-checkbox-2" type="checkbox" {{$user->notification ? "checked" : ''}} name="notification">
                                    <label for="user-profile-checkbox-2">{{App\Models\Translation::getTranslWord($words, $sel_lang, "send_me_offers")}}</label>
                                </div>
                            </div>
                            <div class="user-inputs-btn">
                                <button class="btn-outlined btn-outlined--theme-accent2 min-w-330 sm:min-w-0 sm:w-full">{{App\Models\Translation::getTranslWord($words, $sel_lang, "save_changes")}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection