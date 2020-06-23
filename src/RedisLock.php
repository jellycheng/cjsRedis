<?php
/**
 * redis锁封装
 * User: jelly
 * Date: 2019/6/9
 * Time: 14:19
 */
namespace CjsRedis;


class RedisLock
{

    /**
     * 加锁
     * @param $group 配置组
     * @param $key   锁key
     * @param int $second 锁多长时间，0一直锁，3表锁三秒，单位秒
     * @return mixed  锁成功返回1，锁失败返回0
     */
    public static function lock($group, $key, $second = 0) {
        $time = time();
        $int = \CjsRedis\Redis::SETNX($group, $key, $time);//锁成功返回1，失败返回0或false
        if($int) {//锁成功
            if($second) {//锁成功且设置有效期
                \CjsRedis\Redis::expire($group, $key, $second);
            }
        } else if($second) { //锁失败（$int=0或false），判断释放死锁
            $lockContent = \CjsRedis\Redis::GET($group, $key);
            if(!$lockContent) {
                $lockContent = 0;
            }
            $ex = $lockContent + $second;
            if($time>$ex) {//非正常锁
                self::unlock($group, $key); //主动释放锁
            }
        }
        return $int;
    }


    /**
     * 强制释放锁，删除key
     * @param $group 配置组
     * @param $key 锁key
     * @return mixed
     */
    public static function unlock($group, $key) {
        $i = \CjsRedis\Redis::DEL($group, $key); //删除key
        return $i;
    }

    /**
     * 独立设置过期时间
     * @param $group 配置组
     * @param $key 锁key
     * @param $second 过期时间，单位秒
     */
    public static function expire($group, $key, $second) {
        return \CjsRedis\Redis::expire($group, $key, $second);
    }

}