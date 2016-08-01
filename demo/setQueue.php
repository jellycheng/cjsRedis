<?php

header("Content-type: text/html; charset=utf-8");
require dirname(__DIR__) . '/vendor/autoload.php';
require 'common.php';
putenv("REDIS_DEFAULT_HOST=127.0.0.1");

//放入队列
$userinfo = array('userid' => 88,
                    'phone'=>'13712345678',
                    'nickname'=>'jelly' );

//json_encode($userinfo)
$iIndex = \CjsRedis\RedisQueue::setQueue("house_queue", "house", '第1次放入：abc ==sdfad');
echo $iIndex . PHP_EOL;


$iIndex = \CjsRedis\RedisQueue::setQueue("house_queue", "house", '第2次放入：de 212 212');
echo $iIndex . PHP_EOL;

$iIndex = \CjsRedis\RedisQueue::setQueue("house_queue", "house", '第3次放入：ghi');
echo $iIndex . PHP_EOL;

$iIndex = \CjsRedis\RedisQueue::setQueue("house_queue", "house", 98765);
echo $iIndex . PHP_EOL;

$iIndex = \CjsRedis\RedisQueue::setQueue("house_queue", "house", 0);
echo $iIndex . PHP_EOL;

$iIndex = \CjsRedis\RedisQueue::setQueue("house_queue", "house", '');
echo $iIndex . PHP_EOL;

$iIndex = \CjsRedis\RedisQueue::setQueue("house_queue", "house", '第7次放入：ghi');
echo $iIndex . PHP_EOL;


echo "队列长度： " . \CjsRedis\RedisQueue::getQueueLen("house_queue", "house") . PHP_EOL;

echo "队列长度： " . \CjsRedis\RedisQueue::getQueueLen("house_queue", "nonono") . PHP_EOL;