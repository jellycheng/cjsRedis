<?php
/**
 * 与get1.php示例配合使用
 */
header("Content-type: text/html; charset=utf-8");
require __DIR__ . '/common.php';

$res = \CjsRedis\Redis::set("pcauth", "key1", "hello world!" . mt_rand(100, 999));
var_dump($res);
echo PHP_EOL;
