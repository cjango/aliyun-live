<?php

namespace Jason\Live\Record;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $app): void
    {
        $app['record'] = static function ($app) {
            return new Client($app);
        };
    }

}
