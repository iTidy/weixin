<?php

namespace Itidying\Weixin;

use GuzzleHttp\Client;

class Weixin
{
    protected $appid;
    protected $appsecret;
    protected $guzzleOptions = [];

    public function __construct(string $appid, string $appsecret)
    {
        $this->appid = $appid;
        $this->appsecret = $appsecret;
    }

    public function getAccessToken(string $format = 'json')
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $this->appid . '&secret=' . $this->appsecret;

        $res = $this->getClient()->get($url)->getBody()->getContents();

        switch($format)
        {
            case 'json':
                $response = $res;
                break;
            case 'array':
                $response = json_decode($res, true);
                break;
            case 'object':
                $response = (object)json_decode($res, true);
                break;
        }

        return $response;
    }

    public function getClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }
}
