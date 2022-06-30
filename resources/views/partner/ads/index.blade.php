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
                <div class="user-block__title">{{App\Models\Translation::getTranslWord($words, $sel_lang, "advertising_placement")}}</div>
                  {!!  App\Models\Translation::getTranslWord($words, $sel_lang, "advertising_placement_text")!!}
              </div>
            </div>
          </div>
        </div>
      </main>
@endsection