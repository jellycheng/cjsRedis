<?php
/**
 * 生成唯一值
 */
namespace CjsRedis;

class Sequence
{
    const TABLE_SEQ_KEY = 'seq:table:%s:%s';
    protected static $tblConfig = [];
    protected static $dbConfig = [
                                'host'=>'127.0.0.1',
                                'database' => '',
                                'tbl_name'=>'t_sequence',
                                'username' => '',
                                'password' => '',
                                'port'     => '3306',
                            ];

    /**
     * @param $tablename 表名前缀（即不带表号的表名），决定seq的前缀
     * @param $uid 含字母字符串或者int
     * @param bool $isUseUid 是否强制使用uid作为后缀，false自动计算，true强制且不计算
     * @return string
     */
    public static function getNextGlobalId($tablename, $uid, $isUseUid = false){
        $seq = '';
        $prefix = isset(self::$tblConfig[$tablename])?self::$tblConfig[$tablename]:'so';
        if(!isset($prefix)){
            return $seq;
        }
        try {
            #从redis 转换4位数字
            $tmpDate = date('Ymd', time());
            $key = sprintf(self::TABLE_SEQ_KEY, $tablename,$tmpDate);
            $seq = Redis::incr('sequence', $key);
            if($seq && $seq%864000 == 0) { //达到阀值，设置过期
                Redis::expire('sequence', $key, 1);
            }

        } catch (\Exception $e){

        }
        if(empty($seq) || !is_numeric($seq)){
            //从数据库中取
            $seq = self::dbSeq($tablename, $uid, $isUseUid);
        }
        if($isUseUid) {
            $id = self::getTimestampSeq()*10000000 + $seq*1000 + $uid;
        } else {
            $id = self::getTimestampSeq()*10000000 + $seq*1000 + self::getStrIndex($uid);
        }

        return $prefix.$id;
    }

    /**
     * 通过序列号生成序列号，确保后三位一样
     * @param $tablename
     * @param $seq 已经存在的序列号
     * @return string
     */
    public static function getNextGlobalSeq($tablename, $seq)
    {
        $index = mb_substr($seq, -3, 3); //取seq后三位，因为seq后三位也是用户id与128取模的三位
        if(!is_numeric($index)){//非数值，通过$seq重新计算索引
            $index = self::getUserStrIndex($seq);
        }
        return self::getNextGlobalId($tablename, $index, true);
    }

    public static function setTblPrifix($tblName, $prefix = '') {
        if(is_array($tblName)) {
            self::$tblConfig = array_merge(self::$tblConfig, $tblName);
        } else {
            self::$tblConfig[$tblName] = $prefix;
        }
    }

    public static function setDbConfig($config) {
        if(is_array($config)) {
            self::$dbConfig = array_merge(self::$dbConfig, $config);
        }
    }

    protected static function dbSeq($tablename, $uid, $isUseUid) {
        $dbConfig = self::$dbConfig;
        $time = time();
        $dsn = sprintf("mysql:dbname=%s;host=%s;port=%s",
                            $dbConfig['database'],
                            $dbConfig['host'],
                            $dbConfig['port']);
        $pdo = new \PDO($dsn,
                        $dbConfig['username'],
                        $dbConfig['password'],
                        [
                            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
                            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                        ]
                        );
        //$pdo->query('set names utf8');
        $sql = "INSERT INTO `{$dbConfig['tbl_name']}`(`tbl_name`, `create_time`) VALUES ('{$tablename}', {$time});";
        $pdo->query($sql);
        $retId = $pdo->lastInsertId();
        return $retId;
    }

    /**
     * @return string
     * return:获取唯一健 时间搓部分 6+5
     */
    protected static function getTimestampSeq(){
        $time = time();
        $data = date('Ymd', $time);
        $second = $time - strtotime($data);
        $short_date = date('ymd', $time);

        $id = $short_date*100000 + $second;
        return $id;
    }

    /**
     * @param $str
     * @return int
     * 根据userId 转换3位数字
     */
    protected static function getStrIndex($str){
        $n=0;
        if(is_numeric($str)) { //是数值型，则后面直接取模
            $n = intval($str);
        } else {
            $str = trim($str . '');
            $len = mb_strlen($str);
            for($i=0;$i<$len;$i++){
                $n+=ord($str[$i]);
            }
        }
        $res = $n%128;
        return $res;
    }

}