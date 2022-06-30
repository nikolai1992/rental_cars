<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{
    //
    public function partnership_request(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'site' => 'required',
            'state' => 'required',
            'message' => 'required',
        ]);
        $name  = $request->name;
        $phone  = $request->phone;
        $state = $request->state;
        $message = $request->message;
        $email = $request->email;
        $site = $request->site;
        switch ($state) {
            case "1":
                $state = "Эр-Рияд";
                break;
            case "2":
                $state = "Мекка";
                break;
            case "3":
                $state = "Медина";
                break;
            case "4":
                $state = "Эль-Касим";
                break;
            case "5":
                $state = "Эш-Шаркия";
                break;
            case "6":
                $state = "Асир";
                break;
            case "7":
                $state = "Табук";
                break;
            case "8":
                $state = "Хаиль";
                break;
            case "9":
                $state = "Эль-Худуд-эш-Шамалия";
                break;
            case "10":
                $state = "Джизан";
                break;
            case "11":
                $state = "Наджран";
                break;
            case "12":
                $state = "Эль-Баха";
                break;
            case "13":
                $state = "Эль-Джауф";
                break;
        }
        $title = 'Заявка на вступление в партнерство'; // заголовок письма
        $body = "<table style='width:100%' cellspacing='0' border='1' cellpadding='10'>";
        if (!empty($name)) {
            $body .= "<tr>";
            $body .= "<td width='300'><b>Имя:</b></td> <td>{$name}</td>";
            $body .= "</tr>";
        } if(!empty($phone)) {
        $body .= "<tr>";
        $body .= "<td width='300'><b>Телефон:</b></td> <td>{$phone}</td>";
        $body .= "</tr>";
    } if(!empty($email)) {
        $body .= "<tr>";
        $body .= "<td width='300'><b>Email:</b></td> <td>{$email}</td>";
        $body .= "</tr>";
    }if(!empty($state)) {
        $body .= "<tr>";
        $body .= "<td width='300'><b>Штат:</b></td> <td>{$state}</td>";
        $body .= "</tr>";
    } if(!empty($site)) {
        $body .= "<tr>";
        $body .= "<td width='300'><b>Сайт:</b></td> <td>{$site}</td>";
        $body .= "</tr>";
    }if(!empty($message)) {
        $body .= "<tr>";
        $body .= "<td width='300'><b>Текст клиента:</b></td> <td>{$message}</td>";
        $body .= "</tr>";
    }
        $body .= "</table>";

        $to    = '19nikolai92@gmail.com';
        $headers = "MIME-Version: 1.0 \r\n";
        $headers .= "Content-Transfer-Encoding: 8bit \r\n";
        $headers .= "Content-type:text/html;charset=utf-8 \r\n"; //кодировка и тип контента
        $headers .= "From: " .'Заявка на вступление в партнерство' . "<admin@michy.dx.am/> \r\n"; // откуда письмо
        $headers .= "Reply-To: no-replay@michy.dx.am \r\n"; // отвечать на адрес
        $headers .= 'X-Mailer: PHP/' . phpversion();

        // отправка письма
        if (mail($to, $title, $body, $headers)) {
            echo "Отправлено!";
        } else {
            echo "Возникла ошибка, попробуйте ещй раз!";
        };
        return redirect()->back();
    }
}
