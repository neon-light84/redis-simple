<?php

namespace App\Api;
use \App\Storage\StorageRedis;

class Cli
{
    private const USAGE_TEXT = <<<HERE
Использование:
php redis add {key} {value}  - Добавление нового значения
php redis delete {key} - удаление значения
php redis show - показать все данные
HERE;

    public static function execute($argv)
    {
        if (!isset($argv[1])) { // если нет ни одного аргумента
            exit(static::USAGE_TEXT);
        }

        $redisHandle = new StorageRedis();

        switch (strtolower($argv[1])) {
            case 'add':
                if (!isset($argv[3])) { // недостаточно аргументов
                    exit(static::USAGE_TEXT);
                }
                echo ($redisHandle->create($argv[2], $argv[3])) ? 'Данные добавлены' : 'Что то пошло не так';
                break;
            case 'delete':
                if (!isset($argv[2])) { // недостаточно аргументов
                    exit(static::USAGE_TEXT);
                }
                echo ($redisHandle->delete($argv[2])) ? 'Данные удалены' : 'Что то пошло не так';
                break;
            case 'show':
                if ($data = $redisHandle->readAll()) {
                    print_r($data);
                } else {
                    echo 'Нет данных';
                }
                break;
            default:
                exit(static::USAGE_TEXT);
        }

        echo "\n";
    }
}
