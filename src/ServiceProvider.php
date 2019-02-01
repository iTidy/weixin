<?php

namespace Itidying\Weixin;

use Itidying\Weixin\Weixin;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Weixin::class, function(){
            return new Weixin(config('services.weixin.appid'), config('services.weixin.appsecret'));
        });

        $this->app->alias(Weixin::class, 'weixin');
    }

    public function provides()
    {
        return [Weixin::class, 'weixin'];
    }
}
