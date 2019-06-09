<?php
/**
 * redis锁封装示例
 */
date_default_timezone_set("Asia/Shanghai");
header("Content-type: text/html; charset=utf-8");
require __DIR__ . '/common.php';
$i = 0;
\CjsRedis\RedisLock::lock('h5', "test:lock01");//永久锁

$i = \CjsRedis\RedisLock::lock('h5', "test:lock02");//永久锁
if($i) {
    //加锁成功
    echo "加锁成功,说明可以后续动作" . $i . PHP_EOL;
} else {
    echo "加锁失败，请勿重复提交，不能处理后续动作" . $i . PHP_EOL;
}


$i = \CjsRedis\RedisLock::lock('h5', "test:lock03", 60);//60秒锁
if($i) {
    //加锁成功
    echo "加锁成功,说明可以后续动作" . $i . PHP_EOL;
} else {
    echo "加锁失败，请勿重复提交，不能处理后续动作" . $i . PHP_EOL;
}


$i = \CjsRedis\RedisLock::unlock('h5', "test:lock02");//释放锁
if($i) {
    //释放成功
    echo "释放成功" . $i . PHP_EOL;
} else {
    echo "释放失败" . $i . PHP_EOL;
}

echo "demo finish" . PHP_EOL;
