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
                        <div class="user-block__top-btn"><a class="sm:min-w-0 btn min-w-340" href="{{route('partner_car.create')}}"><span>{{App\Models\Translation::getTranslWord($words, $sel_lang, "add_new_car")}}</span></a></div>
                        <div class="user-block__table user-block__table--first-checkbox grouped-checkboxes mb-90 md:mb-40">
                            <table>
                                <tr>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "car")}}</th>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "year_issue")}}</th>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "total_profitability_car")}}</th>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "total_bookings")}}</th>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_added")}}</th>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_last_booking")}}</th>
                                    <th></th>
                                </tr>
                                @foreach($cars->take(10) as $car)
                                    <tr>

                                        <td>
                                            <div class="user-table-link-with-img"><img src="{{$car->images->first() ? $car->images->sortBy('order_id')->first()->url : ''}}" style="width: 91px" alt=""><a href="{{route('one_car.page', $car->alias)}}">{{$car->carBrand ? $car->carBrand->name : ''}} {{$car->model}}</a></div>
                                        </td>
                                        <td>{{$car->year_created}}</td>
                                        <td>{{$car_currency->symbol}} {{App\Models\Currency::CurrencyConverter($car->getTotalBookedPrice(),$car_currency->dollar_rate)}}</td>
                                        <td>{{$car->getTotalRentalCount()}}</td>
                                        <td>{{$car->created_at}}</td>
                                        <td>{{$car->getLastBookingDate()!=null ? Carbon\Carbon::parse($car->getLastBookingDate()->approved_booking)->format("Y-m-d H:i:s") : ''}}</td>
                                        <td><a class="edit-btn" href="{{route('partner_car.edit', $car->id)}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "edit")}}</a></td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>

                            <div class="load-more-btn-container">
                                <div class="mt-40">
                                    <div class="pagination">
                                        <ul>
                                            @if($cars->previousPageUrl())
                                                <li class="prev"><a href="{{$cars->previousPageUrl()}}">&lsaquo;</a></li>
                                            @endif
                                            @for($i=1; $i<=(int)($cars->lastPage()); $i++)
                                                @if($cars->currentPage()==$i)
                                                    <li class="active"><a href="#">{{$i}}</a></li>
                                                @else

                                                    @if($i==1)
                                                        <li><a href="{{route('partner_car.index')}}">{{$i}}</a></li>
                                                    @else
                                                        <li><a href="{{route('partner_car.index').'\?page='.$i}}">{{$i}}</a></li>
                                                    @endif
                                                @endif

                                            @endfor
                                            @if($cars->nextPageUrl())
                                                <li class="next"><a href="{{$cars->nextPageUrl()}}">&rsaquo;</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="display-n" style="display: none">
                                    {{ $cars->links() }}
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection