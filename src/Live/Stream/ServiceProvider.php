<?php

namespace Jason\Live\Stream;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $app): void
    {
        $app['stream'] = static function ($app) {
            return new Client($app);
        };
    }

}
