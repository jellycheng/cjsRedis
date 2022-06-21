<?php
/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 2016/08/01
 * Time: 11:49
 */
require __DIR__ . '/fun.php';

$vendorFile = dirname(__DIR__)  .  '/vendor/autoload.php';
if(file_exists($vendorFile)) {
    require $vendorFile;
} else {
    spl_autoload_register(function ($class) {
        $ns = 'CjsRedis';
        $base_dir = dirname(__DIR__) . '/src';
        $prefix_len = strlen($ns);
        if (substr($class, 0, $prefix_len) !== $ns) {
            return;
        }
        $class = substr($class, $prefix_len);
        $file = $base_dir .str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        if (is_readable($file)) {
            require $file;
        }

    });

}
#设置redis配置文件
\CjsRedis\ConfigFile::setFile(__DIR__ . '/config/config.php');
