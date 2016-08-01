<?php
namespace CjsRedis;
/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 2016/8/1
 * Time: 11:24
 * 设置redis配置文件
 */
class ConfigFile {

    protected static $configFile = array();

    public static function setFile($file) {
        if(!$file) {
            return '';
        } else if(is_array($file)) {
            $fileAry = $file;
        } else {
            $fileAry = [$file];
        }
        static::$configFile = array_unique(array_merge(static::$configFile, $fileAry));
    }

    public static function getFile() {
        return static::$configFile;
    }
    
    
    public static function loadConfig() {
        $redisCfg = [];
        foreach (static::$configFile as $k=>$file) {
            if($file && file_exists($file)) {
                $tmp = include $file;
                if($tmp && is_array($tmp)) {
                    $redisCfg = array_merge($redisCfg, $tmp);
                }
            }
        }
        return $redisCfg;
    }
    
}