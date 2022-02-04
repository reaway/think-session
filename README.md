# think-session

## 安装
```bash
composer require reaway/think-session
```

## 用法
```php
use Think\Component\Session\Facade\Session;

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

Session::setConfig([
    // session name
    'name' => 'PHPSESSID',
    // SESSION_ID的提交变量,解决flash上传跨域
    'var_session_id' => '',
    // 驱动方式 支持file cache
    'type' => 'cache',
    // 存储连接标识 当type使用cache的时候有效
    'store' => null,
    // 过期时间
    'expire' => 1440,
    // 前缀
    'prefix' => '',

    // SESSION保存目录
    'path' => __DIR__ . DIRECTORY_SEPARATOR . 'session'
]);
Session::init();

Session::set('key', 'value');
Session::set('key1', 'value1');

Session::save();

var_dump(Session::get('key'));
var_dump(Session::all());
```

## 文档

详细参考 [Session处理](https://www.kancloud.cn/manual/thinkphp6_0/1037635)