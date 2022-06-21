<?php
require_once __DIR__ . '/common.php';
$redisGroup = "misc";
$type = isset($argv[1])?$argv[1]:'pub';
$key1 = "hello01";
if($type == "pub") { // 发布
    $val1 = "goods_" . mt_rand(100, 999);
    $res = \CjsRedis\Redis::PUBLISH($redisGroup, $key1, $val1);
    var_export($res);
    echo PHP_EOL;
} else { // 订阅
    while (true) {
        try{
            $prefix = \CjsRedis\Redis::getKeyPrefix($redisGroup);
            $res = \CjsRedis\Redis::SUBSCRIBE($redisGroup, [$prefix.$key1], function($r, $chan, $msg)use($redisGroup,$key1) {
                var_export($r);
                echo $chan . PHP_EOL;
                $prefix = \CjsRedis\Redis::getKeyPrefix($redisGroup);
                if($chan == $prefix.$key1) {// 匹配的消费者 chan
                    echo $msg . PHP_EOL;
                }

            });
            var_export($res);
            echo PHP_EOL;
        }catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
            \CjsRedis\Redis::unsetInstance($redisGroup);
        }
    }

}

