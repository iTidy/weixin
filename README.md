<h1 align="center">Weixin</h1>
<p align="center">微信SDK（Composer扩展包开发学习）</p>

## 用法
### 安装
```
composer require itidying/weixin
```

### 使用
```
<?php

require __DIR__ . '/vendor/autoload.php';

use Itidying\Weixin\Weixin;

$appid = 'xxxxxxxxxx';
$appsecret = 'xxxxxxxxxx';

$wx = new Weixin($appid, $appsecret);

// $res = $wx->getAccessToken();
// $res = $wx->getAccessToken('array');
$res = $wx->getAccessToken('object');

echo '<pre>';
var_dump($res);
```

### 在Laravel中使用
#### 配置
在 app/config/services.php 中添加
```
.
.
.

'weixin' => [
    'appid' => env('APPID'),
    'appsecret' => env('APPSECRET')
]
```

在 .env 中添加
```
APPID=xxxxxxxxxx
APPSECRET=xxxxxxxxxx
```

### 使用
```
<?php

namespace App\Http\Controllers;

use Itidying\Weixin\Weixin;
use Illuminate\Http\Request;

class WeixinController extends Controller
{
    public function getAccessToken(Weixin $wx)
    {
        $response = $wx->getAccessToken();
        return $response;
    }
}
```
或
```
<?php

namespace App\Http\Controllers;

use Itidying\Weixin\Weixin;
use Illuminate\Http\Request;

class WeixinController extends Controller
{
    public function getAccessToken()
    {
        $response = app('weixin')->getAccessToken();
        return $response;
    }
}
```

## 参考
> https://learnku.com/courses/creating-package

## License
MIT
