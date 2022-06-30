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
                    <div class="user-block__content pt-20">
                        <div class="user-block__back"><a class="arrow-link arrow-link--reverse" href="{{route('partner_ticket.index')}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "back")}}</a></div>
                        <form class="user-block__new-ticket" action="{{route('partner_ticket.add_answer')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{auth()->user()->id}}" name="user_id">
                            <input type="hidden" value="{{$model->id}}" name="ticket_id">
                            <div class="mb-20">
                                <div class="input-group">
                                    <textarea class="min-h-160" name="text" required></textarea>
                                </div>
                                <div class="attach-file">
                                    <input id="create-ticket-atachment" type="file" name="file" accept="image/*" data-uploaded-text="{{App\Models\Translation::getTranslWord($words, $sel_lang, "file_attached")}}">
                                    <label for="create-ticket-atachment" tabindex="0">{{App\Models\Translation::getTranslWord($words, $sel_lang, "attach_file")}}</label>
                                </div>
                            </div>
                            <div class="flex flex-row-reverse mb-55">
                                <button class="btn-outlined btn-outlined--theme-accent2 sm:w-full">{{App\Models\Translation::getTranslWord($words, $sel_lang, "send_message")}}</button>
                            </div>
                            <div class="comments comments--colorful">
                                @foreach($model->dialogs->sortBy('created_at') as $dialog)
                                    <div class=" {{$dialog->user->role->alias=="admin" ? 'comments mb-30' : 'comment'}}">
                                        @if($dialog->user->role->alias=="admin")
                                            <div class="comment">
                                        @endif
                                                <div class="comment__top">
                                                    <div class="comment__name comment__name--no-icon">{{$dialog->user->role->alias=="admin" ? "RENTAL CARS" : App\Models\Translation::getTranslWord($words, $sel_lang, "your_message")}}</div>your_message
                                                    <div class="comment__top-right-side">
                                                        <div class="date-block comment__date">{{Carbon\Carbon::parse($dialog->created_at)->format('Y-m-d H:i:s')}}</div>
                                                        @if($dialog->file)
                                                            <a class="comment__attached-link" href="{{asset($dialog->file)}}" title="{{App\Models\Translation::getTranslWord($words, $sel_lang, "view_this_car")}}"></a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="comment__text">{{$dialog->text}}</div>
                                        @if($dialog->user->role->alias=="admin")
                                            </div>
                                        @endif

                                    </div>
                                @endforeach

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
