<?php
/**
 * 批量获取redis key
 */
header("Content-type: text/html; charset=utf-8");
require __DIR__ . '/common.php';

$prefix = \CjsRedis\Redis::getKeyPrefix('pcauth');
echo 'key前缀： ' . $prefix . PHP_EOL . PHP_EOL;

//自己优先配置redis key前缀用法
$res = \CjsRedis\Redis::mget("pcauth", [$prefix."key1",
                                        $prefix."key2",
                                        $prefix.'user:info',
                                        $prefix.'abc:xyz',
                                        $prefix.'c']
                                );
var_export($res);
echo PHP_EOL;
/**
array (
    0 => 'goods',
    1 => 'jelly',
    2 => '{"userid":123,"nickname":"\\u5f20\\u4e09"}',
    3 => 'abc',
    4 => false,
)
 */


//不需要自己拼redis key前缀用法
$res = \CjsRedis\Redis::mget2("pcauth", ["key1",
                                                    "key2",
                                                    'user:info',
                                                    'abc:xyz',
                                                    'c']
                                            );
var_export($res);
echo PHP_EOL;
