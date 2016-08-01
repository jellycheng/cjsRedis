<?php
header("Content-type: text/html; charset=utf-8");
require dirname(__DIR__) . '/vendor/autoload.php';
require 'common.php';
putenv("REDIS_DEFAULT_HOST=127.0.0.1");

//从队列中取数据
$data = \CjsRedis\RedisQueue::getQueue("house_queue", "house");
echo $data .PHP_EOL;


$data = \CjsRedis\RedisQueue::getQueue("house_queue", "house");
echo $data .PHP_EOL;

//不存在的队列 demo
$data = \CjsRedis\RedisQueue::getQueue("no_house_queue", "no_housess");
var_dump($data);
echo PHP_EOL;

$data = \CjsRedis\RedisQueue::getQueue("house_queue", "no_housess");
var_dump($data);
echo PHP_EOL;
