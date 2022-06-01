<?php
namespace App;

class MainConfig
{
    public static $dbRedis = [
        'host' => 'localhost',
        'port' => '6379',
        'password' => 'test',
        'num_db' => 0,
    ];
    public static $cache = [
        'cache_time' => 60 * 60, //в секундах
        'check_key_on_add' => false,  // Если true, то существующие ключи не будут перезаписаны. Если использовать именно как кеш, то логично false
    ];
    public static $rest = [
        'token' => 'any_token_jkhgfiuyr8ty5pht348u9htp34u5',  // Симуляция токена
    ];

}
