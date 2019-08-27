<?php
/**
 * 批量设置
 */
header("Content-type: text/html; charset=utf-8");
require __DIR__ . '/common.php';

$res = \CjsRedis\Redis::mset("pcauth", ["key1"=>'goods',
                                        "key2"=>'jelly',
                                        'user:info'=>json_encode(['userid'=>123, 'nickname'=>'张三']),
                                        'abc:xyz'=>'abc',
                                        ]);
var_dump($res);//bool(true)
echo PHP_EOL;
