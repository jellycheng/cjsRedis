<?php
namespace CjsRedis;

/**
 * Author: jellycheng <42282367@qq.com>
 * Date: 2016/8/1
 * Desc: 配置参考demo
 * 依赖redis.so
 */

class RedisStore
{
	protected $config;
	//redis对象
	protected $redis;

	protected $lastDatabase = 0;

	/**
	 * @param $config = array(
	 *                      'host'=>'10.59.72.31',
	 * 						'port'=>'6379',
     *                      'password'=>'密码，可选',
	 * 						)
	 */
	function __construct($config)
	{
		$this->config = $config;
		$host = (isset($config['host']) && $config['host'])?$config['host']:'127.0.0.1';
		$port = (isset($config['port']) && $config['port'])?$config['port']:'6379';
		$this->redis  = new \Redis();
		$connect = 'connect';
		if(isset($config['is_pconnect']) && $config['is_pconnect'] && method_exists($this->redis, "pconnect")) {
			$connect = 'pconnect';
		}
        if (!is_object($this->redis) || !$this->redis->$connect($host, $port)) {
        	//上报监控并写log，但绝对不能跑异常，否则其它业务无法进行 todo
        	//产生空对象，保证业务正常,并注意空对像的所有方法全是返回空,表示redis中没有存数据
        	$this->redis = new EmptyObj();
        } else if(isset($config['password']) && $config['password']) {
           $res = $this->auth($config['password']);
        }

	}

	public function setLastDatabase($db) {
		$this->lastDatabase = $db;
	}

	public function getLastDatabase() {
		return $this->lastDatabase;
	}

	public function auth($pwd) {
	    return $this->redis->auth($pwd);
    }
	
	//切换db
	public function select($db) {
		return $this->redis->select($db);
	}


	public function __call($method, $args) {
		switch (count($args)) {
			case 0:
				return $this->redis->$method();
			case 1:
				return $this->redis->$method($args[0]);
			case 2:
				return $this->redis->$method($args[0], $args[1]);
			case 3:
				return $this->redis->$method($args[0], $args[1], $args[2]);
			case 4:
				return $this->redis->$method($args[0], $args[1], $args[2], $args[3]);
			default:
				return call_user_func_array(array($this->redis, $method), $args);
		}
	}


}

