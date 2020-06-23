<?php
/**
 * redis锁封装示例
 */
date_default_timezone_set("Asia/Shanghai");
header("Content-type: text/html; charset=utf-8");
require __DIR__ . '/common.php';

\CjsRedis\RedisLock::lock('h5', "test:lock01");//永久锁

$isLocked2 = \CjsRedis\RedisLock::lock('h5', "test:lock02");//永久锁
if($isLocked2) {//加锁成功
    echo "test:lock02加锁成功,说明可以后续动作" . $isLocked2 . PHP_EOL;
} else {
    echo "test:lock02加锁失败，说明已被加锁，请勿重复提交，不能处理后续动作" . $isLocked2 . PHP_EOL;
}


$isLocked3 = \CjsRedis\RedisLock::lock('h5', "test:lock03", 60);//60秒锁
if($isLocked3) {//加锁成功
    echo "test:lock03加锁成功,说明可以后续动作" . $isLocked3 . PHP_EOL;
} else {
    echo "test:lock03加锁失败，说明已被加锁，请勿重复提交，不能处理后续动作" . $isLocked3 . PHP_EOL;
}


$isLocked2 = \CjsRedis\RedisLock::unlock('h5', "test:lock02");//释放锁
if($isLocked2) {//释放成功
    echo "释放test:lock02锁成功" . $isLocked2 . PHP_EOL;
} else {
    echo "释放test:lock02锁失败" . $isLocked2 . PHP_EOL;
}

$tmp = \CjsRedis\Redis::GET('h5', "test:lock02:no");
echo "获取不存在的key：test:lock02:no，值为："; var_dump($tmp);
if(!$tmp) {
    $tmp = 0;
}
echo $tmp . PHP_EOL;

$isLockedNo = \CjsRedis\RedisLock::unlock('h5', "test:lock02:nono"); //0
var_dump($isLockedNo);

echo "demo finish" . PHP_EOL;
