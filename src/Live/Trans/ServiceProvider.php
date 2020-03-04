<?php

namespace Jason\Live\Trans;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $app): void
    {
        $app['trans'] = static function ($app) {
            return new Client($app);
        };
    }

}
