<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public static function getToken($email)
    {
        //Application Key
        $key = 'key_chavosa';
        //Header Token
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];
        //Payload - Content
        $payload = [
            'exp' => 1000 * 60 * 60 * 24,
            'uid' => 1,
            'email' => $email,
        ];
        //JSON
        $header = json_encode($header);
        $payload = json_encode($payload);
        //Base 64
        $header = base64_encode($header);
        $payload = base64_encode($payload);
        //Sign
        $sign = hash_hmac('sha256', $header . "." . $payload, $key, true);
        $sign = base64_encode($sign);
        //Token
        $token = $header . '.' . $payload . '.' . $sign;
        return $token;
    }
}
