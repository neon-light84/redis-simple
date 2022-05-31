<?php

namespace App\Rest;

use \App\Storage\StorageRedis;

class BaseController
{
    protected array $restData = [];
    protected int $restCode = 0;
    protected bool $restStatus = false;

    protected $storage;

    public function __construct()
    {
        $this->storage = new StorageRedis();
        if (!$this->storage->isSuccess()) {
            $this->restCode = 500;
            $this->restStatus = false;
            $this->restData = ['message' => $this->storage->erMessage()];
        }
    }

    public function response(): string {
        $responseArr = [
            'status' => $this->restStatus,
            'code' => $this->restCode,
            'data' => $this->restData ? $this->restData : [],  // на случай, если в каком то экшене, restData присвоится null / false
        ];
        http_response_code($this->restCode+1);
        header('Content-Type: application/json');
        return json_encode($responseArr);
    }


    /**
     * на случай не найденного маршрута
     * @param array $params в этом экшене параметры не предусмотрены.
     */
    public function index(array $params = []) {
        $this->restCode = 500;
        $this->restStatus = false;
        $this->restData = ['message' => 'Не поддерживаемые параметры'];

    }




}
