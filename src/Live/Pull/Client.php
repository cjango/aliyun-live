<?php

namespace Jason\Live\Pull;

use Exception;

class Client
{

    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Notes: 获取拉流地址
     * @Author: <C.Jason>
     * @Date: 2020/2/27 7:03 下午
     * @param string $room 直播间名称
     * @param string|null $trans 转码模板
     * @param string $type 拉流类型
     * @return string
     * @throws Exception
     */
    public function url(string $room, string $trans = null, string $type = 'RTMP'): string
    {
        $config = $this->app->config;

        $timestamp = time() + $config['AUTH_PUSH_TTL'] * 60;
        $rand      = random_int(10000, 99999);
        $scheme    = 'rtmp://';
        $uri       = '/' . $config['APP_NAME'] . '/' . $room;
        if ($trans) {
            $uri .= '_' . $trans;
        }
        switch ($type) {
            case 'FLV':
                $scheme = $config['ENABLE_SSL'] ? 'https://' : 'http://';
                $uri .= '.flv';
                break;
            case 'M3U8':
                $scheme = $config['ENABLE_SSL'] ? 'https://' : 'http://';
                $uri .= '.m3u8';
                break;
        }

        $url = $scheme;
        $url .= rtrim($config['PULL_BASE_URL'], '/');
        $url .= $uri;
        $url .= '?auth_key=';
        $url .= $timestamp;
        $url .= '-' . $rand . '-0-';
        $url .= md5($uri . '-' . $timestamp . '-' . $rand . '-0-' . $config['AUTH_PULL_KEY']);

        return $url;
    }

}
