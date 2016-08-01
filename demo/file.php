<?php
/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 2016/08/01
 * Time: 11:34
 */
header("Content-type: text/html; charset=utf-8");
require dirname(__DIR__) . '/vendor/autoload.php';
require 'common.php';
#设置redis配置文件
\CjsRedis\ConfigFile::setFile(__DIR__ . '/config/config.php');
#获取配置文件
$fileList = \CjsRedis\ConfigFile::getFile();
echo "1.=========" . PHP_EOL;
var_export($fileList);


$data = \CjsRedis\ConfigFile::loadConfig();
echo "2.=========" . PHP_EOL;
var_export($data);

