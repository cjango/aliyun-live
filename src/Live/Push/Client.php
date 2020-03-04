<?php

namespace Jason\Live\Push;

use Exception;

class Client
{

    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Notes: 推流地址
     * @Author: <C.Jason>
     * @Date: 2020/2/27 7:04 下午
     * @param string $room
     * @return string
     * @throws Exception
     */
    public function url(string $room): string
    {
        $config = $this->app->config;

        $timestamp = time() + $config['AUTH_PUSH_TTL'] * 60;
        $rand      = random_int(10000, 99999);
        $uri       = '/' . $config['APP_NAME'] . '/' . $room;

        $url = 'rtmp://';
        $url .= rtrim($config['PUSH_BASE_URL'], '/');
        $url .= $uri;
        $url .= '?auth_key=';
        $url .= $timestamp;
        $url .= '-' . $rand . '-0-';
        $url .= md5($uri . '-' . $timestamp . '-' . $rand . '-0-' . $config['AUTH_PUSH_KEY']);

        return $url;
    }

}
