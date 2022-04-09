<?php
/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 2022/4/8
 * Time: 19:50
 * 付款码
 */

namespace CjsRedis;


class PayAuthCode
{

    const TABLE_PAYCODE_KEY = 'paycode:biz:%s:%s';
    const REDIS_GROUP_NAME = "payauthcode";
    const Len = 18;

    // 格式：时间戳10位 + 当日随机序列（5位） + 校验位3位（ID%999），固定长度18位，生成失败则返回空
    public static function getPayCode($id, $bizType="e") {
        $redisCode = "";
        $step = mt_rand(1, 9);
        try {
            $tmpDate = date('Ymd', time());
            $key = sprintf(self::TABLE_PAYCODE_KEY, $bizType, $tmpDate);
            $redisCode = Redis::INCRBY(self::REDIS_GROUP_NAME, $key,$step);
            if($redisCode && $redisCode%99999 == 0) { //5位, 达到阀值，设置过期
                Redis::expire(self::REDIS_GROUP_NAME, $key, 1);
            }
            $redisCode = 99999 - $redisCode;
            if($redisCode<0) {
                $redisCode = 0;
            }
        } catch (\Exception $e){
            return "";
        }
        $tmpId = intval(preg_replace('/\\D+/', '', $id));
        $modVal = $tmpId % 999;
        $code = sprintf('%s%05s%03s',time(), $redisCode, $modVal);
        return $code;
    }

    public static function checkPayCode($paycode, $id) {
        $paycode = trim($paycode);
        if(mb_strlen($paycode) != self::Len) {
            return false;
        }
        $pid = mb_substr($paycode, -3, 3);
        if($pid == $id) {
            return true;
        }
        return false;
    }

    // 检测Luhn值是否合规，true合规，false不合规
    public static function isLuhn($s) {
        $input = strrev(preg_replace('/\\D+/', '', $s));
        if ($input == '') {
            return false;
        }
        $total = 0;
        for ($i = 0, $n = strlen($input); $i < $n; $i++) {
            $total += $i % 2 ? 2 * $input[$i] - ($input[$i] > 4 ? 9 : 0) : $input[$i];
        }
        return !($total % 10);

    }

    // 获取Luhn算法的校验值，此时$s值中还没有校验值，算法见：https://baike.baidu.com/item/Luhn算法/22799984
    public static function getLuhnCode($s) {
        $input = strrev(preg_replace('/\\D+/', '', $s));
        if ($input == '') {
            return 0;
        }
        $total = 0;
        for ($i = 0, $n = strlen($input); $i < $n; $i++) {
            $total += ($i % 2==0) ? 2 * $input[$i] - ($input[$i] > 4 ? 9 : 0) : $input[$i];
        }
        return 10 - ($total % 10);

    }

}