<?php
/**
 * Author: jellycheng <42282367@qq.com>
 * Date: 2016/08/01
 * Desc: 
 */
header("Content-type: text/html; charset=utf-8");
require dirname(__DIR__) . '/vendor/autoload.php';
require 'common.php';
//设置用户信息
$userinfo = array('userid' => 123456,
                    'phone'=>'13712345678',
                    'nickname'=>'jelly'
                );
$bool = \CjsRedis\Redis::set("user", "userinfo:123456", json_encode($userinfo));

//获取缓存用户组信息
$res = \CjsRedis\Redis::get("user", "userinfo:123456");
var_dump($res);
echo "<br>" . PHP_EOL;
