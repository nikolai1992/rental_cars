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
            <td><a href="{{route('partner.my_orders.booking', $order->id)}}">#{{$order->order_number}}</a></td>
            <td>
                <div class="user-table-link-with-img"><img src="{{$order->car->images->sortBy('order_id')->first()->url}}" style="width:91px" alt=""><a href="{{route('partner.my_orders.booking', $order->id)}}">{{$order->car->carBrand->name}} {{$order->car->model}}</a></div>
            </td>
            <td>
                <div>От: {{$order->from_date ? Carbon\Carbon::parse($order->from_date)->format('d/m/Y') : ''}} - {{$order->time}}:00</div>
                <div>До: {{$order->to_date ? Carbon\Carbon::parse($order->to_date)->format('d/m/Y') : ''}} - 14:00</div>
            </td>
            <td>
                @if($order->city=="1")
                    Дубай
                @elseif($order->city=="2")
                    Абу-даби
                @elseif($order->city=="3")
                    Шарджа
                @elseif($order->city=="4")
                    Рас-эль-хайм
                @elseif($order->city=="5")
                    Все ОАЭ
                @endif
            </td>
            <td>Рас-эль-хайм</td>
            <td>$ {{$order->total_price}}</td>
            <td>
                @if($order->payment_status=="upon_receipt")
                    <div>При получении</div>
                @elseif($order->payment_status=="payed")
                    <div>Оплачено 15%</div>
                    <div><a class="underline" href="#">Квитанция</a></div>
                @endif
            </td>
        </tr>
    @else
        <tr>
            <td>
                @if($order->status=="in_process")
                    <div class="user-table-status user-table-status--processing">В обработке</div>
                @elseif($order->status=="rejected")
                    <div class="user-table-status user-table-status--rejected">Отклонено</div>
                @elseif($order->status=="approved")
                    <div class="user-table-status user-table-status--confirmed">Подтверждено</div>
                @endif
            </td>
            <td><a href="user-booking-result-1.html">#{{$order->order_number}}</a></td>
            <td>
                <div class="user-table-link-with-img"><img src="{{$order->car->images->sortBy('order_id')->first()->url}}" style="width:91px" alt=""><a href="user-booking-result-1.html">{{$order->car->carBrand->name}} {{$order->car->model}}</a></div>
            </td>
            <td>
                <div>Дата: {{$order->date ? Carbon\Carbon::parse($order->date)->format('d/m/Y') : ''}} - {{$order->time}}:00</div>
            </td>
            <td>
                @if($order->location=="1")
                    Дубай
                @elseif($order->location=="2")
                    Абу-даби
                @elseif($order->location=="3")
                    Шарджа
                @elseif($order->location=="4")
                    Рас-эль-хайм
                @elseif($order->location=="5")
                    Все ОАЭ
                @endif
            </td>
            <td>Рас-эль-хайм</td>
            <td>{{$car_currency->symbol}} {{App\Models\Currency::CurrencyConverter($order->price,$car_currency->dollar_rate)}}</td>
            <td>
                @if($order->payment_status=="upon_receipt")
                    <div>При получении</div>
                @elseif($order->payment_status=="payed")
                    <div>Оплачено 15%</div>
                    <div><a class="underline" href="#">Квитанция</a></div>
                @endif
            </td>
        </tr>
    @endif
@endforeach
