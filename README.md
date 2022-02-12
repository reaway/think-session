# think-session

## 安装
```bash
composer require reaway/think-session
```

## 用法
file驱动方式
```php
use Think\Component\Session\Facade\Session;

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

Session::setConfig([
    // session name
    'name' => 'PHPSESSID',
    // SESSION_ID的提交变量,解决flash上传跨域
    'var_session_id' => '',
    // 驱动方式 支持file cache
    'type' => 'file',
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

cache驱动方式
```php
use Think\Component\Session\Facade\Session;
use Think\Component\Cache\Facade\Cache;

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

Cache::setConfig([
    'default' => 'file',
    'stores' => [
        'file' => [
            'type' => 'File',
            // 缓存保存目录
            'path' => __DIR__ . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR,
            // 缓存前缀
            'prefix' => '',
            // 缓存有效期 0表示永久缓存
            'expire' => 0,
        ],
        'redis' => [
            'type' => 'redis',
            'host' => '127.0.0.1',
            'port' => 6379,
            'prefix' => '',
            'expire' => 0,
        ],
    ],
]);
bind('Psr\SimpleCache\CacheInterface', 'Think\Component\Cache\Cache');

Session::setConfig([
    // session name
    'name' => 'PHPSESSID',
    // SESSION_ID的提交变量,解决flash上传跨域
    'var_session_id' => '',
    // 驱动方式 支持file cache
    'type' => 'cache',
    // 过期时间
    'expire' => 1440,
    // 前缀
    'prefix' => ''
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