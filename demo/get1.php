<?php
/**
 * Author: jellycheng <42282367@qq.com>
 * Date: 2016/08/01
 * Desc: 
 */
header("Content-type: text/html; charset=utf-8");
require __DIR__ . '/common.php';

$res = \CjsRedis\Redis::get("pcauth", "key1");
var_dump($res);
echo PHP_EOL;
