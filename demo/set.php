<?php
/**
 * Author: jellycheng <42282367@qq.com>
 * Date: 2016/08/01
 * Desc: 
 */
header("Content-type: text/html; charset=utf-8");
require __DIR__ . '/common.php';
//设置用户信息
$userinfo = array('userid' => 88,
                    'phone'=>'13712345678',
                    'nickname'=>'大道至简'
                );
$bool = \CjsRedis\Redis::set("user",  "userinfo:".$userinfo['userid'],  json_encode($userinfo));
var_export($bool);
echo "<br>" . PHP_EOL;

echo "aaz:user:userinfo:".$userinfo['userid']."的有效期（-1表永久,-2key不存在，单位秒）： ".\CjsRedis\Redis::ttl('user', 'userinfo:' . $userinfo['userid']);
echo "<br>" . PHP_EOL;


echo "aaz:user:abc的有效期（-1表永久,-2key不存在，单位秒）： ".\CjsRedis\Redis::ttl('user', 'abc');
echo "<br>" . PHP_EOL;

$i = mt_rand(1000, 9999);
//设置有效期 EXPIRE key seconds
\CjsRedis\Redis::set('user', 'jelly' . $i, "jelly nickname");
\CjsRedis\Redis::EXPIRE('user', 'jelly' . $i, 90);
echo "jelly" . $i . "的有效期（-1表永久,-2key不存在，单位秒）： ".\CjsRedis\Redis::ttl('user', 'jelly' . $i);
echo "<br>" . PHP_EOL;


echo "dbsize: " . \CjsRedis\Redis::dbsize('user');
echo "<br>" . PHP_EOL;

$obj = \CjsRedis\Redis::getInstance('user');
$keys = $obj->keys('*');
echo "<pre>user组服务器，所有key：";
var_export($keys);
echo PHP_EOL;
