<?php

namespace Jason\Live\Trans;

use AlibabaCloud\Live\Live;
use Jason\Live\Kernel\BaseClient;

class Client extends BaseClient
{

    public function all(): array
    {
        return Live::v20161101()
                   ->describeLiveStreamTranscodeInfo()
                   ->withDomainTranscodeName($this->config['PULL_BASE_URL'])
                   ->request()
                   ->toArray();
    }

    public function add(string $appName, string $template): array
    {
        return Live::v20161101()
                   ->addLiveStreamTranscode()
                   ->withApp($appName)
                   ->withTemplate($template)
                   ->withDomain($this->config['PULL_BASE_URL'])
                   ->request()
                   ->toArray();
    }

    public function delete(string $appName, string $template): array
    {
        return Live::v20161101()
                   ->deleteLiveStreamTranscode()
                   ->withApp($appName)
                   ->withTemplate($template)
                   ->withDomain($this->config['PULL_BASE_URL'])
                   ->request()
                   ->toArray();
    }

}
