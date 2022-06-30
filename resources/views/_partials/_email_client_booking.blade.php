<table style='width:100%' cellspacing='0' border='1' cellpadding='10'>
    <tr>
        <td width='300'><b>Имя формы </b></td> <td>{{$title}}</td>
    </tr>
    @if(!empty($name))
        <tr>
            <td width='300'><b>Имя клиента:</b></td> <td>{{$name}}</td>
        </tr>
    @endif
    @if(!empty($subject))
        <tr>
            <td width='300'><b>Тема сообщения клиента:</b></td> <td>{{$subject}}</td>
        </tr>
    @endif
    @if(!empty($email))
        <tr>
            <td width='300'><b>Email:</b></td> <td>{{$email}}</td>
        </tr>
    @endif
    @if(!empty($booking_number))
    <tr>
        <td width='300'><b>Номер бронирования:</b></td> <td>{{$booking_number}}</td>
    </tr>
    @endif
    @if(!empty($description))
        <tr>
            <td width='300'><b>Текст:</b></td> <td>{{$description}}</td>
        </tr>
    @endif
</table>