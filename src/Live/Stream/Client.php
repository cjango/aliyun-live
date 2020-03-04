<?php

namespace Jason\Live\Stream;

use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use AlibabaCloud\Live\Live;
use Carbon\Carbon;
use DateTime;
use Jason\Live\Kernel\BaseClient;

class Client extends BaseClient
{

    /**
     * Notes: 获取域名下直播流播放的黑名单。
     * @Author: <C.Jason>
     * @Date: 2020/2/27 3:32 下午
     * @param int $page
     * @return array
     * @throws ClientException
     * @throws ServerException
     */
    public function blocks(int $page = 1): ?array
    {
        return Live::v20161101()
                   ->describeLiveStreamsBlockList()
                   ->withDomainName($this->config['PUSH_BASE_URL'])
                   ->withPageNum($page)
                   ->request()
                   ->toArray();
    }

    /**
     * Notes: 所有正在推的流的信息
     * @Author: <C.Jason>
     * @Date: 2020/2/27 3:35 下午
     * @param int $page
     * @return array|null
     * @throws ClientException
     * @throws ServerException
     */
    public function onlines(int $page = 1): ?array
    {
        return Live::v20161101()
                   ->describeLiveStreamsOnlineList()
                   ->withDomainName($this->config['PUSH_BASE_URL'])
                   ->withPageNum($page)
                   ->request()
                   ->toArray();
    }

    /**
     * Notes: 禁止推流
     * @Author: <C.Jason>
     * @Date: 2020/2/27 4:00 下午
     * @param string $name
     * @param bool $block
     * @param DateTime|null $resumeTime
     * @return array
     * @throws ClientException
     * @throws ServerException
     */
    public function forbid(string $name, bool $block = true, DateTime $resumeTime = null): array
    {
        $request = Live::v20161101()
                       ->forbidLiveStream()
                       ->withDomainName($this->config['PUSH_BASE_URL'])
                       ->withAppName($this->config['APP_NAME'])
                       ->withLiveStreamType('publisher')
                       ->withStreamName($name);

        if ($block) {
            $request = $request->withOneshot('no');
        }

        if ($resumeTime) {
            $request = $request->withResumeTime(Carbon::parse($resumeTime)->format('Y-m-d\TH:i:s\Z'));
        }

        return $request->request()->toArray();
    }

    /**
     * Notes: 恢复推流
     * @Author: <C.Jason>
     * @Date: 2020/2/27 4:15 下午
     * @param string $name
     * @return array
     * @throws ClientException
     * @throws ServerException
     */
    public function resume(string $name): array
    {
        return Live::v20161101()
                   ->resumeLiveStream()
                   ->withDomainName($this->config['PUSH_BASE_URL'])
                   ->withAppName($this->config['APP_NAME'])
                   ->withLiveStreamType('publisher')
                   ->withStreamName($name)
                   ->request()
                   ->toArray();
    }

    /**
     * Notes: 所有流某分钟的在线人数信息
     * @Author: <C.Jason>
     * @Date: 2020/2/27 4:22 下午
     * @param DateTime $queryTime
     * @return array
     * @throws ClientException
     * @throws ServerException
     */
    public function users(DateTime $queryTime): array
    {
        return Live::v20161101()
                   ->describeLiveDomainOnlineUserNum()
                   ->withDomainName($this->config['PUSH_BASE_URL'])
                   ->withQueryTime(Carbon::parse($queryTime)->format('Y-m-d\TH:i:s\Z'))
                   ->request()
                   ->toArray();
    }

}
