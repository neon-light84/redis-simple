<?php
namespace App\Storage;
use \App\MainConfig;

abstract class AbstractStorage
{
    protected int $cacheTime;
    protected bool $checkKeyOnAdd;

    public function __construct() {
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
