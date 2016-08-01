<?php
/**
 * Author: jellycheng <42282367@qq.com>
 * Date: 2016/08/01
 * Desc: 
 */
header("Content-type: text/html; charset=utf-8");
require dirname(__DIR__) . '/vendor/autoload.php';
require 'common.php';
$i = mt_rand(100, 999);
//开启事物
$multi = \CjsRedis\Redis::multi('user');
//获取组的key前缀
$prefix =\CjsRedis\Redis::getKeyPrefix('user');
$multi->set($prefix.'abc', '123-' . $i);
$multi->set($prefix.'xyz', '1234xyz-' . $i);
$multi->exec();

echo "事物演示完毕";
