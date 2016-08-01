<?php
/**
 * Author: jellycheng <42282367@qq.com>
 * Date: 2016/08/01
 * Desc: 
 */
header("Content-type: text/html; charset=utf-8");
require dirname(__DIR__) . '/vendor/autoload.php';
require 'common.php';
$config = array(
				'host'=>'10.59.74.27',
				'port'=>'6379',
			);
$obj = new \CjsRedis\RedisStore($config);

var_dump($obj->set('abc', "hello aaz"));

echo $obj->get('abc');