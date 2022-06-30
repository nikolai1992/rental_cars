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
                        <div class="user-block__top-btn"><a class="sm:min-w-0 btn btn--theme-accent3 min-w-340" href="{{route('client_ticket.create')}}"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "create_ticket2")}}</span></a></div>
                        <div class="user-block__table user-block__table--first-checkbox grouped-checkboxes mb-90 md:mb-40">
                            <table>
                                <tr>
                                    <th>
                                        <div class="checkbox-group">
                                            <input id="checkbox-table-all" type="checkbox">
                                            <label for="checkbox-table-all"></label>
                                        </div>
                                    </th>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "delete")}}</th>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "id_request")}}</th>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "theme")}}</th>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "ticket")}}</th>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "message")}}</th>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date")}}</th>
                                </tr>
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td>
                                            <div class="checkbox-group">
                                                <input id="checkbox-table-1" type="checkbox">
                                                <label for="checkbox-table-1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            {{Form::open(['route'=>['client_ticket.destroy',$ticket->id], 'method'=>'delete'])}}
                                            <button class="trash-btn"></button>
                                            {{Form::close()}}

                                        </td>
                                        <td><a href="booking.html">#{{$ticket->id}}</a></td>
                                        <td>
                                            @if($ticket->status)
                                                {{count($ticket->status->translates) ? $ticket->status->getTranslation('name') : ''}}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="max-w-435">{{$ticket->dialogs->last() ? $ticket->dialogs->last()->text : ""}}</div>
                                        </td>
                                        <td>
                                            <a class="message-btn" href="{{route('client_ticket.edit', $ticket->id)}}">
                                                @if($ticket->getUnreadDialogs()>0)
                                                    <span>{{$ticket->getUnreadDialogs()}}</span>
                                                @endif
                                            </a>
                                        </td>
                                        <td>{{$ticket->dialogs->last() ? Carbon\Carbon::parse($ticket->dialogs->last()->created_at)->format('Y-m-d H:m') : ''}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="mt-40">
                            <div class="pagination">
                                <ul>
                                    @if($tickets->previousPageUrl())
                                        <li class="prev"><a href="{{$tickets->previousPageUrl()}}">&lsaquo;</a></li>
                                    @endif
                                    @for($i=1; $i<=(int)($tickets->lastPage()); $i++)
                                        @if($tickets->currentPage()==$i)
                                            <li class="active"><a href="#">{{$i}}</a></li>
                                        @else

                                            @if($i==1)
                                                <li><a href="{{route('client_ticket.index')}}">{{$i}}</a></li>
                                            @else
                                                <li><a href="{{route('client_ticket.index').'\?page='.$i}}">{{$i}}</a></li>
                                            @endif
                                        @endif

                                    @endfor
                                    @if($tickets->nextPageUrl())
                                        <li class="next"><a href="{{$tickets->nextPageUrl()}}">&rsaquo;</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="display-n" style="display: none">
                            {{ $tickets->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
