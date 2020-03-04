<?php

namespace Jason\Live\Pull;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $app): void
    {
        $app['pull'] = function ($app) {
            return new Client($app);
        };
    }

}
