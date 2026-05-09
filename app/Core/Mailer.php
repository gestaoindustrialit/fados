<?php

namespace App\Core;

class Mailer
{
    public function send(string $to, string $subject, string $body): bool
    {
        $headers = 'From: ' . config('smtp.from_name') . ' <' . config('smtp.from_email') . '>';
        return mail($to, $subject, $body, $headers);
    }
}
