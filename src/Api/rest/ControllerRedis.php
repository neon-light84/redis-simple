<?php

namespace App\Api\Rest;

class ControllerRedis extends BaseController
{
    /**
     * @param array $params в этом экшене параметры не предусмотрены.
     */
    public function readAll(array $params = [])
    {
        $this->restData = $this->storage->readAll();
        $this->restCode = 200;
        $this->restStatus = true;
    }

    /**
     * @param array $params ['key' => 'any_key_42534634756']
     */
    public function delete(array $params = [])
    {
        if (isset($params['key']) && strlen($params['key']) > 0) {
            if ($this->storage->delete($params['key'])) {
                $this->restCode = 200;
                $this->restStatus = true;
            } else {
                $this->restCode = 500;
                $this->restStatus = false;
                $this->restData = ['message' => 'Ошибка удаления'];
            }
        } else {
            $this->restCode = 500;
            $this->restStatus = false;
            $this->restData = ['message' => 'Не задан ключ для удаления'];
        }
    }
}
