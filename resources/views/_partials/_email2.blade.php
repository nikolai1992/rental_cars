<table style='width:100%' cellspacing='0' border='1' cellpadding='10'>
    <tr>
        <td width='300'><b>Имя формы </b></td> <td>Клиент оставляет онлайн заявку на автомобиль {{$car->carBrand->name}} {{$car->model}}</td>
    </tr>
    @if(!empty($fio))
        <tr>
            <td width='300'><b>Имя клиента:</b></td> <td>{{$fio}}</td>
        </tr>
    @endif
    @if(!empty($phone))
        <tr>
            <td width='300'><b>Номер:</b></td> <td>{{$phone}}</td>
        </tr>
    @endif
    @if(!empty($email))
        <tr>
            <td width='300'><b>Email:</b></td> <td>{{$email}}</td>
        </tr>
    @endif
    <tr>
        <td width='300'><b>Город:</b></td> <td>{{$city}}</td>
    </tr>

    <tr>
        @if(isset($international_law))
            <td width='300'><b>Имеет ли международные права:</b></td> <td>Да</td>
        @else
            <td width='300'><b>Имеет ли международные права:</b></td> <td>Нет</td>
        @endif
    </tr>
    @if(!empty($message))
        <tr>
            <td width='300'><b>Сообщение:</b></td> <td>{{$message}}</td>
        </tr>
    @endif
    @if(!empty($from_date)&&!empty($date_to))
        <tr>
            <td width='300'><b>Период:</b></td> <td>{{Carbon\Carbon::parse($from_date)->format('D, d/m/Y')}} {{$time}}:00 - {{Carbon\Carbon::parse($date_to)->format('D, d/m/Y')}} 10:00</td>
        </tr>
    @endif
    <tr>
        <td width='300'><b>Общая сумма за аренду авто за {{$diffDays}} дня:</b></td> <td>{{$total_per_days}}</td>
    </tr>
    <tr>
        <td width='300'><b>VAT Tax ({{$setting->vat_tax}}%):</b></td> <td>{{$vat_tax}}</td>
    </tr>
    <tr>
        <td width='300'><b>Общая сумма к оплате:</b></td> <td>{{$total_price}}</td>
    </tr>
    <tr>
        <td width='300'><b>Создана заявка пользователем:</b></td> <td>{{route('users.edit', $user->id)}}</td>
    </tr>
    <tr>
        <td width='300'><b>Дата заполнения:</b></td> <td>{{date('Y.m.d H:i:s')}}</td>
    </tr>
</table>