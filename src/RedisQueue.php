<?php
namespace CjsRedis;

/**
 * Author: jellycheng <42282367@qq.com>
 * Date: 2016/8/1
 * Desc: 使用redis队列，左进右出，配置参考demo
 */
class RedisQueue {
	/**
	 * 放入队列,空数据不能放入队列
	 * @param $group redis配置组
	 * @param $subKey  队列后缀
	 * @param $val  放入队列值，字符串或者数值型
	 * @return mixed
	 */
	public static function setQueue($group, $subKey, $val) {
		if(!$val && strlen($val)==0) {
			return '';
		}
		return \CjsRedis\Redis::LPUSH($group, $subKey, $val);
	}

	/**
	 * 从队列中获取值
	 * @param $group redis配置组
	 * @param $subKey 队列后缀
	 * @return mixed
	 */
	public static function getQueue($group, $subKey) {
		return \CjsRedis\Redis::RPOP($group, $subKey);
	
	}

	/**
	 * 获取队列长度
	 * @param $group redis配置组
	 * @param $subKey 队列后缀
	 * @return mixed
	 */
	public static function getQueueLen($group, $subKey) {
		return \CjsRedis\Redis::LLEN($group, $subKey);
	}
}