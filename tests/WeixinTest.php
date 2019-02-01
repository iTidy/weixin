<?php

namespace Itidying\Weixin\Tests;

use Itidying\Weixin\Weixin;
use PHPUnit\Framework\TestCase;
use Itidying\Weixin\Exceptions\InvalidArgumentException;

class WeixinTest extends TestCase
{
    public function testGetAccessToken()
    {
        $wx = new Weixin('mock_appid', 'mock_appsecret');

        // 断言会抛出此异常类
        $this->expectException(InvalidArgumentException::class);

        // 断言异常消息为 Invalid response format: foo
        $this->expectExceptionMessage('Invalid response format: foo');

        // 因为支持的格式为 json/array/object 所以传入 foo 会抛出异常
        $wx->getAccessToken('foo');

        // 如果未抛出异常，则会执行到这一行，说明测试没有成功
        $this->fail('Test fail!');
    }
}
