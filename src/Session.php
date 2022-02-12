<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2021 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace Think\Component\Session;

use think\helper\Arr;
use Think\Component\Session\Store;
use Think\Component\Manager\Manager;

/**
 * Session管理类
 * @package think
 * @mixin Store
 */
class Session extends Manager
{
    protected $namespace = '\\Think\\Component\\Session\\Driver\\';

    /**
     * 配置参数
     * @var array
     */
    protected $config = [
        // session name
        'name'           => 'PHPSESSID',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // 驱动方式 支持file cache
        'type'           => 'file',
        // 过期时间
        'expire'         => 1440,
        // 前缀
        'prefix'         => '',
    ];

    /**
     * 设置配置
     * @access public
     * @param array $config 配置参数
     * @return void
     */
    public function setConfig(array $config): void
    {
        $this->config = array_merge($this->config, $config);
    }

    protected function createDriver(string $name)
    {
        $handler = parent::createDriver($name);

        return new Store($this->getConfig('name') ?: 'PHPSESSID', $handler, $this->getConfig('serialize'));
    }

    /**
     * 获取Session配置
     * @access public
     * @param null|string $name    名称
     * @param mixed       $default 默认值
     * @return mixed
     */
    public function getConfig(string $name = null, $default = null)
    {
        if (!is_null($name)) {
            return $this->config[$name] ?? $default;
        }

        return $this->config;
    }

    protected function resolveConfig(string $name)
    {
        $config = $this->getConfig();
        Arr::forget($config, 'type');
        return $config;
    }

    /**
     * 默认驱动
     * @return string|null
     */
    public function getDefaultDriver()
    {
        return $this->getConfig('type', 'file');
    }
}
