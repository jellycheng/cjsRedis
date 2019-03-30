<?php
/**
 * Author: jellycheng <42282367@qq.com>
 * Date: 2016/08/01
 * Desc: 
 */
header("Content-type: text/html; charset=utf-8");
require __DIR__ . '/common.php';
$config = array(
				'host' => '127.0.0.99'
			);
$obj = new \CjsRedis\RedisStore($config);

var_dump($obj->set());
echo PHP_EOL;
