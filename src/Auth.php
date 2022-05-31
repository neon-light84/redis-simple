<?php

namespace App;

class Auth
{
    public static function isAuth() {
        $headers = getallheaders();
        $headerToken = $headers['Authorization'] ?? '';
        $clientToken = explode(' ', $headerToken)[1] ?? '';
        return MainConfig::$rest['token'] === $clientToken;

    }
}
