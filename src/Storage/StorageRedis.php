<?php
namespace App\Storage;
use \App\Connections;

class StorageRedis extends AbstractStorage
{
    /**
     * @var \Redis
     */
    private $redisConnection;

    protected function init()
    {
        if ($this->redisConnection = Connections::getInstance()->getRedis()) {
            $this->_isSuccess = true;
        }
        else {
            $this->_isSuccess = false;
            $this->_errMessage = 'Ошибка подключения к базе REDIS';
        }
    }

    public function create(string $key, string $value): bool
    {
        if ($this->checkKeyOnAdd) {
            if ($this->redisConnection->get($key) !== false) return false;
        }
        return $this->redisConnection->set($key, $value, $this->cacheTime);
    }

    public function readAll(): array
    {
        $result = [];
        $it = NULL;
        do {
            $arr_keys = $this->redisConnection->scan($it);
            if ($arr_keys !== FALSE) {
                foreach($arr_keys as $str_key) {
                    $result[$str_key] = $this->redisConnection->get($str_key);
                }
            }
        } while ($it > 0);

        return $result;
    }

    public function update(string $key, string $value): bool
    {
        throw new \Exception('Not implemented');
    }

    public function delete(string $key): bool
    {
        return $this->redisConnection->expire($key, 0);

    }

}
