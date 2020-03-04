<?php

namespace Jason\Live\Caster;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $app): void
    {
        $app['caster'] = static function ($app) {
            return new Client($app);
        };
    }

}
