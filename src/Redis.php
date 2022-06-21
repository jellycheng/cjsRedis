<?php
namespace CjsRedis;
/**
 * Author: jellycheng <42282367@qq.com>
 * Date: 2016/8/1
 * Desc: 配置参考demo
 */
class Redis {

	protected static $redisInstance = array();
	protected static $config = array();

	/**
     * 配置redis
     *
		\CjsRedis\Redis::setRedisConfig(array(
			'local'=>array(
					'host'=>'10.59.72.31',
					'port'=>'6379',
                    'password' =>'密码，可选',
					'database'=>0,
					'prefix'=>'cjs:pay:',
					'desc'=>'支付模块业务'
			)));
	*/
	public static function setRedisConfig($config) {
		if(!$config || !is_array($config)) {
			return false;
		}
		static::$config = array_merge(static::$config, $config);
	}

    /**
     * 获取redis配置
     * @return array
     */
    public static function getRedisConfig() {
		return static::$config;
	}

    public static function loadRedisConfig() {
		return ConfigFile::loadConfig();
    }

	//获取指定组的redis对象
	public static function getInstance($group) {
		if(empty(static::$config)) {
			static::$config = static::loadRedisConfig();
		}
		if(!isset(static::$config[$group])) {
			return new EmptyObj();
		}
		$config = static::$config[$group];
		$host = (isset($config['host']) && $config['host'])?$config['host']:'127.0.0.1';
		$port = (isset($config['port']) && $config['port'])?$config['port']:'6379';
		$database = (isset($config['database']) && $config['database'])?$config['database']:0;
		
		$tmpKey = md5($host.$port);
		if(!isset(static::$redisInstance[$tmpKey]) || !is_object(static::$redisInstance[$tmpKey])) {
			static::$redisInstance[$tmpKey] = new RedisStore(static::$config[$group]);
		}

		if($database != static::$redisInstance[$tmpKey]->getLastDatabase()) {
			$b = static::$redisInstance[$tmpKey]->select($database);
			if($b) {
				static::$redisInstance[$tmpKey]->setLastDatabase($database);
			}
		}
		return static::$redisInstance[$tmpKey];
	}

    public static function unsetInstance($group) {
        if(isset(static::$config[$group])) {
            $config = static::$config[$group];
            $host = (isset($config['host']) && $config['host'])?$config['host']:'127.0.0.1';
            $port = (isset($config['port']) && $config['port'])?$config['port']:'6379';
            $tmpKey = md5($host.$port);
            if(isset(static::$redisInstance[$tmpKey])) {
                unset(static::$redisInstance[$tmpKey]);
            }
        }
    }

    /**
     * 根据业务组名获取配置key前缀
     * @param $group
     * @return string
     */
    public static function getKeyPrefix($group) {
        if(empty(static::$config)) {
            static::$config = static::loadRedisConfig();
        }
        return static::_getKeyPrefix($group);
    }

	protected static function _getKeyPrefix($group) {
		if(!isset(static::$config[$group])) {
			return '';
		}
		$config = static::$config[$group];
		if(isset($config['prefix'])) {
			return $config['prefix'];
		}
		return '';
	}

    /**
     * 批量设置
     * @param $groupName
     * @param array $data
     * @return mixed
     */
	public static function mset($groupName, $data = []) {
        $mset = [];
        $instance = static::getInstance($groupName);
        $prefix = static::_getKeyPrefix($groupName);
        if($prefix) {
            foreach ($data as $tmpK=>$tmpV) {
                $mset[$prefix . $tmpK] = $tmpV;
            }
        } else {
            $mset = $data;
        }
        return $instance->mset($mset);
    }

    public static function mget2($groupName, $data = []) {
        $mget = [];
        $instance = static::getInstance($groupName);
        $prefix = static::_getKeyPrefix($groupName);
        if($prefix) {
            foreach ($data as $tmpK=>$tmpV) {
                $mget[$tmpK] = $prefix . $tmpV;
            }
        } else {
            $mget = $data;
        }
        return $instance->mget($mget);
    }

	/**
     * $res = \CjsRedis\Redis::命令("group组名", "key名", "val值");
     * 只支持带key的命令或者不带参数的命令哦，
     * 不支持的KEYS ,BRPOPLPUSH，smove，zinterstore，echo,auth,PUBLISH 等命令
     */
	public static function __callStatic($method, $args) {
		$res = '';
		if(!count($args)) {
			return $res;
		}
		$groupName = $args[0];
		$instance = static::getInstance($groupName);
		array_shift($args);
		$i = count($args);
		if($i>0) { //有参数
            if(!is_array($args[0])) {
                $args[0] = static::_getKeyPrefix($groupName) . $args[0];
            }
		}
		
		switch ($i) {
			case 0:
				return $instance->$method();
			case 1:
				return $instance->$method($args[0]);
			case 2:
				return $instance->$method($args[0], $args[1]);
			case 3:
				return $instance->$method($args[0], $args[1], $args[2]);
			case 4:
				return $instance->$method($args[0], $args[1], $args[2], $args[3]);
			default:
				return call_user_func_array(array($instance, $method), $args);
		}

	}

}
