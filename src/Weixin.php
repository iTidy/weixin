<?php

namespace Itidying\Weixin;

use GuzzleHttp\Client;
use Itidying\Weixin\Exceptions\InvalidArgumentException;

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

    public function verify(array $req, string $token)
    {
        $param['timestamp'] = $req['timestamp'];
        $param['nonce'] = $req['nonce'];
        $param['token'] = $token;

        sort($param);

        $signature = sha1(implode('', $param));

        // 存在echostr的情况，说明是一次接入
        if (isset($req['echostr']) && $signature == $req['signature']) {
            return $req['echostr'];
        }

        return 'success';
    }

    public function responseText(string $content)
    {
        $toUser = $obj->FromUserName;
        $fromUser = $obj->ToUserName;
        $time = time();
        $msgType = 'text';
        $template = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[%s]]></MsgType><Content><![CDATA[%s]]></Content></xml>";
        $info = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
        echo $info;
    }

    public function getAccessToken(string $format = 'json')
    {
        if (!in_array($format, ['json', 'array', 'object'])) {
            throw new InvalidArgumentException('Invalid response format: ' . $format);
        }

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
            $response = json_decode($res);
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
