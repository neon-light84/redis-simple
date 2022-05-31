<?php

namespace App;

/**
 * SingleTone реализация. Собраны коннекшены ко всем БД.
 * Вызывать так: Connections::getInstance()->getRedis();
 */
final class Connections
{
    private static $instance = null;

    /**
     * @var \Redis
     */
    private static $connectionRedis = null;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function getRedis () {
        if (static::$connectionRedis === null) {
            $db = MainConfig::$dbRedis;
            try {
                $redis = new \Redis();
                $redis->connect($db['host'], $db['port']);
                $redis->auth($db['password']);
                $redis->select($db['num_db']);
                static::$connectionRedis = $redis;
            } catch (\Exception $e) {
//                print "Error!: " . $e->getMessage() . "<br/>";   // Если бы это было на бою, то залогировать
                static::$connectionRedis = null;
            }
        }
        return static::$connectionRedis;
    }


    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }
}
