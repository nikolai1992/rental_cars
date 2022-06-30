@extends('layouts.app')
@section('content')
    <!--Main content-->
    <main class="main">
        <div class="mt-35 mb-200 md:mb-100">
            <div class="container">
                <div class="breadcrumbs mb-40">
                    <ul>
                        <li><a href="{{route('main.page')}}">{{$pages->where('alias', 'main')->first()->getTranslation('name')}}</a></li>
                        <li>{{App\Models\Translation::getTranslWord($words, $sel_lang, "partners_office")}}</li>
                    </ul>
                </div>
                <div class="user-block">
                    @include('_partials._partner_navigation')
                    <div class="user-block__content">
                        <form class="user-block__balance">
                            <div class="user-block__balance-input-group">
                                <div>{{App\Models\Translation::getTranslWord($words, $sel_lang, "enter_price")}}</div>
                                <div>
                                    <div class="input-group mb-0 w-full">
                                        <input type="text" name="sum" required>
                                    </div>
                                </div>
                            </div>
                            <div class="user-block__balance-input-group">
                                <div>{{App\Models\Translation::getTranslWord($words, $sel_lang, "select_payment_method")}}</div>
                                <div>
                                    <div class="user-block__balance-radio-group">
                                        <div class="radio-group radio-group--horizontal-center">
                                            <input id="partner-balance-1" type="radio" value="visa" name="partner-balance" checked>
                                            <label class="mb-0" for="partner-balance-1"><img src="/img/payments/balance/visa.svg" alt=""></label>
                                        </div>
                                        <div class="radio-group radio-group--horizontal-center">
                                            <input id="partner-balance-2" type="radio" value="mastercard" name="partner-balance">
                                            <label class="mb-0" for="partner-balance-2"><img src="/img/payments/balance/mastercard.svg" alt=""></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="user-block__balance-btn">
                                <button class="btn-outlined btn-outlined--theme-accent2 min-w-330 sm:min-w-0 sm:w-full">{{App\Models\Translation::getTranslWord($words, $sel_lang, "pay")}}</button>
                            </div>
                            <div class="user-block__balance-text">{{App\Models\Translation::getTranslWord($words, $sel_lang, "pay_text")}}</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection