<?php
namespace App\Storage;
use \App\MainConfig;

abstract class AbstractStorage
{
    protected int $cacheTime;
    protected bool $checkKeyOnAdd;

    protected bool $_isSuccess = false;
    protected string $_errMessage = '';

    public function isSuccess() {
        return $this->_isSuccess;
    }
    public function erMessage() {
        return $this->_errMessage;
    }

    public function __construct() {
        if (!isset(MainConfig::$cache['cache_time']) || !isset(MainConfig::$cache['check_key_on_add'])) {
            $this->_isSuccess = false;
            $this->_errMessage = 'Ошибка в файле конфигурации';
            return;
        }
        $this->cacheTime = MainConfig::$cache['cache_time'];
        $this->checkKeyOnAdd = MainConfig::$cache['check_key_on_add'];
        $this->init();
    }

    /**
     * Здесь произвести инициализацию.
     */
    protected abstract function init();

    public abstract function create(string $key, string $value): bool;
    public abstract function readAll(): array;
    public abstract function update(string $key, string $value): bool;
    public abstract function delete(string $key): bool;

}
