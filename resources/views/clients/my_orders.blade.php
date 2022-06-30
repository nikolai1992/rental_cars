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
                        <div class="user-block__table mb-90 md:mb-40">
                            <table>
                                <tr>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "status")}}</th>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "id_request")}}</th>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "car")}}</th>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date_and_time_booking")}}</th>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "city_and_place_pickup")}}</th>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "city_place_return")}}</th>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "price")}}</th>
                                    <th>{{App\Models\Translation::getTranslWord($words, $sel_lang, "payment")}}</th>
                                </tr>
                                <?php $j=0;?>
                                @foreach($mergedOrders as $order)
                                    @if($order->table=="orders")
                                        <tr>
                                            <td>
                                                @if($order->status=="in_process")
                                                    <div class="user-table-status user-table-status--processing">{{App\Models\Translation::getTranslWord($words, $sel_lang, "in_processing")}}</div>
                                                @elseif($order->status=="rejected")
                                                    <div class="user-table-status user-table-status--rejected">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rejected")}}</div>
                                                @elseif($order->status=="approved")
                                                    <div class="user-table-status user-table-status--confirmed">{{App\Models\Translation::getTranslWord($words, $sel_lang, "confirmed")}}</div>
                                                @endif
                                            </td>
                                            <td><a href="{{route('client.my_orders.booking', $order->id)}}">#{{$order->order_number}}</a></td>
                                            <td>
                                                <div class="user-table-link-with-img"><img src="{{$order->car->images->sortBy('order_id')->first()->url}}" style="width:91px" alt=""><a href="{{route('client.my_orders.booking', $order->id)}}">{{$order->car->carBrand->name}} {{$order->car->model}}</a></div>
                                            </td>
                                            <td>
                                                <div>{{App\Models\Translation::getTranslWord($words, $sel_lang, "from")}}: {{$order->from_date ? Carbon\Carbon::parse($order->from_date)->format('d/m/Y') : ''}} - {{$order->time}}:00</div>
                                                <div>{{App\Models\Translation::getTranslWord($words, $sel_lang, "to")}}: {{$order->to_date ? Carbon\Carbon::parse($order->to_date)->format('d/m/Y') : ''}} - 14:00</div>
                                            </td>
                                            <td>
                                                @if($order->city=="1")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "dubai")}}
                                                @elseif($order->city=="2")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "abu_dhabi")}}
                                                @elseif($order->city=="3")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "sharjah")}}
                                                @elseif($order->city=="4")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "ras-al-Khaim")}}
                                                @elseif($order->city=="5")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "all_uae")}}
                                                @endif
                                            </td>
                                            <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "ras-al-Khaim")}}</td>
                                            <td>{{$car_currency->symbol}} {{App\Models\Currency::CurrencyConverter($order->total_price,$car_currency->dollar_rate)}}</td>
                                            <td>
                                                @if($order->payment_status=="upon_receipt")
                                                    <div>{{App\Models\Translation::getTranslWord($words, $sel_lang, "upon_receipt")}}</div>
                                                @elseif($order->payment_status=="payed")
                                                    <div>{{App\Models\Translation::getTranslWord($words, $sel_lang, "paid_15")}}</div>
                                                    <div><a class="underline" href="#">{{App\Models\Translation::getTranslWord($words, $sel_lang, "receipt")}}</a></div>
                                                @endif
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>
                                                @if($order->status=="in_process")
                                                    <div class="user-table-status user-table-status--processing">{{App\Models\Translation::getTranslWord($words, $sel_lang, "in_processing")}}</div>
                                                @elseif($order->status=="rejected")
                                                    <div class="user-table-status user-table-status--rejected">{{App\Models\Translation::getTranslWord($words, $sel_lang, "rejected")}}</div>
                                                @elseif($order->status=="approved")
                                                    <div class="user-table-status user-table-status--confirmed">{{App\Models\Translation::getTranslWord($words, $sel_lang, "confirmed")}}</div>
                                                @endif
                                            </td>
                                            <td><a href="{{route('client.my_orders.booking', ["id"=>$order->id, 'with_driver'=>true])}}">#{{$order->order_number}}</a></td>
                                            <td>
                                                <div class="user-table-link-with-img"><img src="{{$order->car->images->sortBy('order_id')->first()->url}}" style="width:91px" alt=""><a href="{{route('client.my_orders.booking', ["id"=>$order->id, 'with_driver'=>true])}}">{{$order->car->carBrand->name}} {{$order->car->model}}</a></div>
                                            </td>
                                            <td>
                                                <div>{{App\Models\Translation::getTranslWord($words, $sel_lang, "date")}}: {{$order->date ? Carbon\Carbon::parse($order->date)->format('d/m/Y') : ''}} - {{$order->time}}:00</div>
                                            </td>
                                            <td>
                                                @if($order->location=="1")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "dubai")}}
                                                @elseif($order->location=="2")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "abu_dhabi")}}
                                                @elseif($order->location=="3")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "sharjah")}}
                                                @elseif($order->location=="4")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "ras-al-Khaim")}}
                                                @elseif($order->location=="5")
                                                    {{App\Models\Translation::getTranslWord($words, $sel_lang, "all_uae")}}
                                                @endif
                                            </td>
                                            <td>{{App\Models\Translation::getTranslWord($words, $sel_lang, "ras-al-Khaim")}}</td>
                                            <td>{{$car_currency->symbol}} {{App\Models\Currency::CurrencyConverter($order->price,$car_currency->dollar_rate)}}</td>
                                            <td>
                                                @if($order->payment_status=="upon_receipt")
                                                    <div>{{App\Models\Translation::getTranslWord($words, $sel_lang, "upon_receipt")}}</div>
                                                @elseif($order->payment_status=="payed")
                                                    <div>{{App\Models\Translation::getTranslWord($words, $sel_lang, "paid_15")}}</div>
                                                    <div><a class="underline" href="#">{{App\Models\Translation::getTranslWord($words, $sel_lang, "receipt")}}</a></div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                    <?php $j++;?>
                                @endforeach

                                {{--<tr>--}}
                                    {{--<td>--}}
                                        {{--<div class="user-table-status user-table-status--processing">В обработке</div>--}}
                                    {{--</td>--}}
                                    {{--<td><a href="user-booking-result-1.html">#12577</a></td>--}}
                                    {{--<td>--}}
                                        {{--<div class="user-table-link-with-img"><img src="img/user/booking/1.jpg" alt=""><a href="user-booking-result-1.html">BMW 740LI</a></div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div>От: 22/05/2020 - 14:00</div>--}}
                                        {{--<div>До: 24/05/2020 - 14:00</div>--}}
                                    {{--</td>--}}
                                    {{--<td>Дубай</td>--}}
                                    {{--<td>Рас-эль-хайм</td>--}}
                                    {{--<td>$ 1,700</td>--}}
                                    {{--<td>При получении</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td>--}}
                                        {{--<div class="user-table-status user-table-status--confirmed">Подтверждено</div>--}}
                                    {{--</td>--}}
                                    {{--<td><a href="user-booking-result-1.html">#12577</a></td>--}}
                                    {{--<td>--}}
                                        {{--<div class="user-table-link-with-img"><img src="img/user/booking/1.jpg" alt=""><a href="user-booking-result-1.html">BMW 740LI</a></div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div>От: 22/05/2020 - 14:00</div>--}}
                                        {{--<div>До: 24/05/2020 - 14:00</div>--}}
                                    {{--</td>--}}
                                    {{--<td>Дубай</td>--}}
                                    {{--<td>Рас-эль-хайм</td>--}}
                                    {{--<td>$ 1,700</td>--}}
                                    {{--<td>--}}
                                        {{--<div>Оплачено 15%</div>--}}
                                        {{--<div><a class="underline" href="#">Квитанция</a></div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                            </table>
                        </div>
                        @if($pagination_count)

                            <div class="mt-40">
                                <div class="pagination">
                                    <ul>
                                        @for($i=1; $i<=$pagination_count; $i++)
                                            @if($current_page_n == $i)
                                                <li class="active"><a href="#" data-page="{{$i}}">{{$i}}</a></li>
                                            @else
                                                <li><a href="?page={{$i}}" data-page="{{$i}}">{{$i}}</a></li>
                                            @endif
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('js')
    @parent
    <script>
        var count = {{$current_count}};
        var total_orders_count = {{$total_orders_count}};

        $('body').on('click', '.pagination li a', function(event) {
            event.preventDefault();
            $('.pagination li').removeClass('active')
            $(this).parent().addClass('active')
            $page = $(this).attr('data-page')

            $.ajax({
                url: '{{route('client.my_orders.getMore')}}?count='+$page,
                type: "GET",
                success: function (data) {
                   $('.user-block__table table').empty()
                   $('.user-block__table table').append(data.html);
                    // count = count + data.count;
                    // if(count>=total_orders_count)
                    // {
                    //     $('.load-more-btn').hide();
                    // }
                }
            });

        })

    </script>
@stop