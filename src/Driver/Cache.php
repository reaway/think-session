<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2021 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------
namespace Think\Component\Session\Driver;

use Psr\SimpleCache\CacheInterface;
use Think\Component\Session\Contract\SessionHandlerInterface;
use think\helper\Arr;

class Cache implements SessionHandlerInterface
{
    /** @var CacheInterface */
    protected $handler;

    /** @var integer */
    protected $expire;

    /** @var string */
    protected $prefix;

    public function __construct(CacheInterface $cache, array $config = [])
    {
        $this->handler = $cache;
        $this->expire  = Arr::get($config, 'expire', 1440);
        $this->prefix  = Arr::get($config, 'prefix', '');
    }

    public function read(string $sessionId): string
    {
        return (string) $this->handler->get($this->prefix . $sessionId);
    }

    public function delete(string $sessionId): bool
    {
        return $this->handler->delete($this->prefix . $sessionId);
    }

    public function write(string $sessionId, string $data): bool
    {
        return $this->handler->set($this->prefix . $sessionId, $data, $this->expire);
    }
}
