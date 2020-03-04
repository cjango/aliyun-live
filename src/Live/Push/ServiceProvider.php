<?php

namespace Jason\Live\Push;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $app): void
    {
        $app['push'] = static function ($app) {
            return new Client($app);
        };
    }

}
