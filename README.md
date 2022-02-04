# think-session

## 安装
```bash
composer require reaway/think-session
```

## 用法
```php
use Think\Component\Session\Facade\Session;

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

Session::init();

Session::set('key', 'value');
Session::set('key1', 'value1');

Session::save();

var_dump(Session::get('key'));
var_dump(Session::all());
```

## 文档

详细参考 [Session处理](https://www.kancloud.cn/manual/thinkphp6_0/1037635)