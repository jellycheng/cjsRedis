<?php
/**
 * Author: jellycheng <42282367@qq.com>
 * Date: 2016/08/01
 * Desc: 配置参考demo
 * array(
 *      '业务模块名'=>array(
 *                      'host'=>'redis服务host，默认127.0.0.1',
 *                      'port'=>'redis端口,默认6379',
 *                      'database'=>redis数据库号默认0,
 *                      'prefix'=>'该组业务redis-key前缀，注意业务前缀不要跟其它模块的prefix前缀同名，默认无',
 *                      'desc'=>'业务描述，可填项',
 *                  ),
 *      'pay'=>array(
 *              'host'=>'10.59.72.31',
 *              'port'=>'6379',
 *              'database'=>0,
 *              'prefix'=>'cjs:pay:',
 *      ),
 * );
 */
return array(
    'pay'          => array(
        'host'     => env('REDIS_DEFAULT_HOST', '127.0.0.1'),
        'port'     => env('REDIS_DEFAULT_PORT', '6379'),
        'database' => 1,
        'prefix'   => 'cjs:pay:',
        'desc'     => '支付模块业务'
    ),
    'pcauth'       => array(
        'host'     => env('REDIS_USER_AUTH_HOST', '127.0.0.1'),
        'port'     => env('REDIS_USER_AUTH_PORT', '6379'),
        'database' => 1,
        'prefix'   => 'cjs:auth:',
        'desc'     => 'pc登录认证模块'
    ),
    'wirelessauth' => array(
        'host'     => env('REDIS_USER_AUTH_HOST', '127.0.0.1'),
        'port'     => env('REDIS_USER_AUTH_PORT', '6379'),
        'database' => 2,
        'prefix'   => 'cjs:auth:',
        'desc'     => '无线app及h5登录认证模块'
    ),
    'user'         => array(
        'host'     => env('REDIS_DEFAULT_HOST', '127.0.0.1'),
        'port'     => env('REDIS_DEFAULT_PORT', '6379'),
        'database' => 2,
        'prefix'   => 'cjs:user:',
        'desc'     => '用户信息模块'
    ),
    'house'        => array(
        'host'     => env('REDIS_DEFAULT_HOST', '127.0.0.1'),
        'port'     => env('REDIS_DEFAULT_PORT', '6379'),
        'database' => 3,
        'prefix'   => 'cjs:house:',
        'desc'     => '房源模块'
    ),
    'global'       => array(
        'host'     => env('REDIS_DEFAULT_HOST', '127.0.0.1'),
        'port'     => env('REDIS_DEFAULT_PORT', '6379'),
        'database' => 4,
        'prefix'   => 'cjs:global:',
        'desc'     => '全局通用配置模块，各个仓库共用'
    ),
    'misc'         => array(
        'host'     => env('REDIS_DEFAULT_HOST', '127.0.0.1'),
        'port'     => env('REDIS_DEFAULT_PORT', '6379'),
        'database' => 5,
        'prefix'   => 'cjs:misc:',
        'desc'     => '不好归类通通放这个模块'
    ),
    'weixin'       => array(
        'host'     => env('REDIS_DEFAULT_HOST', '127.0.0.1'),
        'port'     => env('REDIS_DEFAULT_PORT', '6379'),
        'database' => 6,
        'prefix'   => 'cjs:wx:',
        'desc'     => '微信业务模块'
    ),
    'admin'        => array(
        'host'     => env('REDIS_DEFAULT_HOST', '127.0.0.1'),
        'port'     => env('REDIS_DEFAULT_PORT', '6379'),
        'database' => 7,
        'prefix'   => 'cjs:admin:',
        'desc'     => '后台业务模块'
    ),
    'api'          => array(
        'host'     => env('REDIS_DEFAULT_HOST', '127.0.0.1'),
        'port'     => env('REDIS_DEFAULT_PORT', '6379'),
        'database' => 8,
        'prefix'   => 'cjs:api:',
        'desc'     => 'api仓库独有业务模块'
    ),
    'pc'           => array(
        'host'     => env('REDIS_DEFAULT_HOST', '127.0.0.1'),
        'port'     => env('REDIS_DEFAULT_PORT', '6379'),
        'database' => 1,
        'prefix'   => 'cjs:pc:',
        'desc'     => 'pc网站独有业务模块'
    ),
    'h5'           => array(
        'host'     => env('REDIS_DEFAULT_HOST', '127.0.0.1'),
        'port'     => env('REDIS_DEFAULT_PORT', '6379'),
        'database' => 2,
        'prefix'   => 'cjs:h5:',
        'desc'     => 'h5触屏网站独有业务模块'
    ),
    'event'        => array(
        'host'     => env('REDIS_DEFAULT_HOST', '127.0.0.1'),
        'port'     => env('REDIS_DEFAULT_PORT', '6379'),
        'database' => 3,
        'prefix'   => 'cjs:event:',
        'desc'     => '活动业务缓存'
    ),
    'misc_queue'         => array(
        'host'     => env('REDIS_DEFAULT_HOST', '127.0.0.1'),
        'port'     => env('REDIS_DEFAULT_PORT', '6379'),
        'database' => 4,
        'prefix'   => 'cjs:queue:misc:',
        'desc'     => '不好归类通通放这个模块,队列业务'
    ),
    'house_queue'        => array(
        'host'     => env('REDIS_DEFAULT_HOST', '127.0.0.1'),
        'port'     => env('REDIS_DEFAULT_PORT', '6379'),
        'database' => 5,
        'prefix'   => 'cjs:queue:house:',
        'desc'     => '房源模块,队列业务'
    ),
    'email_queue'        => array(
        'host'     => env('REDIS_DEFAULT_HOST', '127.0.0.1'),
        'port'     => env('REDIS_DEFAULT_PORT', '6379'),
        'database' => 6,
        'prefix'   => 'cjs:queue:email:',
        'desc'     => '邮件队列业务'
    ),
    'sequence'        => array(
        'host'     => env('REDIS_DEFAULT_HOST', '127.0.0.1'),
        'port'     => env('REDIS_DEFAULT_PORT', '6379'),
        'database' => 2,
        'prefix'   => 'cjs:sequence:service:',
        'desc'     => '生成唯一值'
    )

);