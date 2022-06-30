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
                    @include('_partials._client_navigation')
                    <div class="user-block__content">
                        <div class="payment-methods">
                            <div class="payment-method"><img src="/img/payments/balance/visa.svg" alt=""></div>
                            <div class="payment-method"><img src="/img/payments/balance/mastercard.svg" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
