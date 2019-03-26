# cjsRedis
cjs,redis,cjs redis, jelly redis

## 依赖说明并安装
```
当前仓库代码依赖php的redis.so扩展
https://github.com/phpredis/phpredis

安装redis.so
    git clone https://github.com/phpredis/phpredis.git
    cd phpredis
    phpize
    ./configure --with-php-config=/usr/bin/php-config
    make
    sudo make install
    
配置php.ini
php --ini
vi /etc/php.ini
 	extension_dir=/usr/lib/php/extensions/no-debug-non-zts-20160303/
	extension=redis.so

查看模块： php -m | grep redis


```
