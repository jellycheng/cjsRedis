<?php
/**
 * Author: jellycheng <42282367@qq.com>
 * Date: 2016/08/01
 * Desc: 
 */
header("Content-type: text/html; charset=utf-8");
require __DIR__ . '/common.php';

$res = \CjsRedis\Redis::set("pay", "key1", "val1");
var_dump($res);

$res = \CjsRedis\Redis::get("pay", "key1");
var_dump($res); //val1

$res = \CjsRedis\Redis::set("pcauth", "key1", "你好auth db1");
var_dump($res); 

$res = \CjsRedis\Redis::get("pcauth", "key1");
var_dump($res); 
