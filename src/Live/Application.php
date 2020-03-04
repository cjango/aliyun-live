<?php

namespace Jason\Live;

use Pimple\Container;

class Application extends Container
{

    /**
     * 要注册的服务类
     * @var array
     */
    protected $providers = [
        Push\ServiceProvider::class,
        Pull\ServiceProvider::class,
        Stream\ServiceProvider::class,
        Trans\ServiceProvider::class,
    ];

    /**
     * Application constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this['config'] = static function () {
            return config('live');
        };
        $this->registerProviders();
    }

    /**
     * Register providers.
     */
    protected function registerProviders(): void
    {
        foreach ($this->providers as $provider) {
            $this->register(new $provider());
        }
    }

    /**
     * 获取服务
     * @param $id
     * @return mixed
     */
    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    /**
     * Notes: 获取服务
     * @Author: <C.Jason>
     * @Date: 2020/2/27 12:44 下午
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->offsetGet($name);
    }

}
