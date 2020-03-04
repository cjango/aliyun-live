<?php

namespace Jason\Live\Kernel;

use AlibabaCloud\Client\AlibabaCloud;

class BaseClient
{

    protected $app;

    protected $config;

    public function __construct($app)
    {
        $this->app    = $app;
        $this->config = $app->config;

        AlibabaCloud::accessKeyClient($app->config['ACCESS_KEY'], $app->config['ACCESS_SECRET'])
                    ->regionId('cn-hangzhou')
                    ->asDefaultClient();
    }

}
