<?php

namespace App\Services;

class SendEmail
{
    public static function sendMail($to, $title, $body)
    {
        $headers = "MIME-Version: 1.0 \r\n";
        $headers .= "Content-Transfer-Encoding: 8bit \r\n";
        $headers .= "Content-type:text/html;charset=utf-8 \r\n"; //кодировка и тип контента
        $headers .= "From: " .'Rental Cars'. " \r\n"; // откуда письмо
        $headers .= "Reply-To: support@rentalcars.one/ \r\n"; // отвечать на адрес
        $headers .= 'X-Mailer: PHP/' . phpversion();
        // отправка письма
        if (!mail($to, $title, $body, $headers)) {
            return false;
        } else {
            return true;
        }

    }
}