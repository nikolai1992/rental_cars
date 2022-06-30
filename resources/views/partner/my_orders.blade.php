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
                                                <select data-order_id="{{$order->id}}" class="order-status-sellector {{$order->status=='approved' ? 'user-table-status--confirmed' : ''}} {{$order->status=='in_process' ? 'user-table-status--processing' : ''}} {{$order->status=='rejected' ? 'user-table-status--rejected' : ''}}" data-model="Order">
                                                    <option value="rejected" {{$order->status=="rejected" ? "selected" : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "rejected")}}</option>
                                                    <option value="in_process" {{$order->status=="in_process" ? "selected" : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "in_processing")}}</option>
                                                    <option value="approved" {{$order->status=="approved" ? "selected" : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "confirmed")}}</option>
                                                </select>
                                            </td>
                                            <td>
                                               
                                                    <a href="{{route('partner.my_orders.booking', $order->id)}}">#{{$order->order_number}}</a>
                                                
                                            </td>
                                            <td>
                                                <div class="user-table-link-with-img"><img src="{{$order->car->images->sortBy('order_id')->first()->url}}" style="width:91px" alt="">
													
														<a href="{{route('partner.my_orders.booking', $order->id)}}">{{$order->car->carBrand->name}} {{$order->car->model}}</a>
													
												</div>
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
                                                <select data-order_id="{{$order->id}}" class="order-status-sellector  {{$order->status=='approved' ? 'user-table-status--confirmed' : ''}} {{$order->status=='in_process' ? 'user-table-status--processing' : ''}} {{$order->status=='rejected' ? 'user-table-status--rejected' : ''}}" data-model="OrderDriver">
                                                    <option value="rejected" {{$order->status=="rejected" ? "selected" : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "rejected")}}</option>
                                                    <option value="in_process" {{$order->status=="in_process" ? "selected" : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "in_processing")}}</option>
                                                    <option value="approved" {{$order->status=="approved" ? "selected" : ''}}>{{App\Models\Translation::getTranslWord($words, $sel_lang, "confirmed")}}</option>
                                                </select>
                                            </td>
                                            <td><a href="{{route('partner.my_orders.booking', ["id"=>$order->id, 'with_driver'=>true])}}">#{{$order->order_number}}</a></td>
                                            <td>
                                                <div class="user-table-link-with-img"><img src="{{$order->car->images->sortBy('order_id')->first()->url}}" style="width:91px" alt=""><a href="{{route('partner.my_orders.booking', ["id"=>$order->id, "with_driver"=>1])}}">{{$order->car->carBrand->name}} {{$order->car->model}}</a></div>
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

        $('body').on('change', '.order-status-sellector', function (e) {
            var order_id = $(this).data('order_id');
            var model = $(this).data('model');
            var status = $(this).val();
            $.ajax({
                type: 'post',
                url: '{{route("partner.my_orders.change_status")}}',
                data: {
                    order_id: order_id,
                    model: model,
                    status: status,
                    _token: '@csrf'
                },
                success: function (res) {
                    window.location.reload();
                }
            });
        });

    </script>
@stop