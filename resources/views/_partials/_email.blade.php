<table style='width:100%' cellspacing='0' border='1' cellpadding='10'>

    <tr>
        <td width='300'><b>Имя формы </b></td> <td>Клиент оставляет онлайн заявку на аренду автомобиля {{$car->carBrand->name}} {{$car->model}}</td>
    </tr>
    @if(!empty($name))
        <tr>
            <td width='300'><b>Имя клиента:</b></td> <td>{{$name}}</td>
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
    @if(!empty($location))
        <tr>
            <td width='300'><b>Локация:</b></td> <td>{{$location}}</td>
        </tr>
    @endif
    @if(!empty($date))
        <tr>
            <td width='300'><b>На когда:</b></td> <td>{{Carbon\Carbon::parse($date)->format('D, d/m/Y')}} {{$time}}</td>
        </tr>
    @endif

    <tr>
        <td width='300'><b>На сколько часов:</b></td> <td>{{$duration}}</td>";
    </tr>
    <tr>
        <td width='300'><b>Сумма за услугу:</b></td> <td>{{$price}}</td>
    </tr>
    <tr>
        <td width='300'><b>Создана заявка пользователем:</b></td> <td>{{route('users.edit', $user->id)}}</td>
    </tr>
    <tr>
        <td width='300'><b>Дата заполнения:</b></td> <td>{{date('Y.m.d H:i:s')}}</td>
    </tr>
</table>