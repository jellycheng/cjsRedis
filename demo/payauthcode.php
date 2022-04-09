<?php
/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 2022/4/8
 * Time: 21:00
 */

header("Content-type: text/html; charset=utf-8");
require __DIR__ . '/common.php';
//echo time() . PHP_EOL;
$dataId = 456168; // 数据ID
$bizType="e"; //业务类型代号
$payAuthCode = \CjsRedis\PayAuthCode::getPayCode($dataId, $bizType);
echo "payauthcode=" . $payAuthCode . PHP_EOL;
if(\CjsRedis\PayAuthCode::checkPayCode($payAuthCode, $dataId)) {
    echo "payauthcode值合规" . PHP_EOL;
} else {
    echo "payauthcode值不合规" . PHP_EOL;
}


exit;
$s1 = "621226100107746554";//"621483214127812";//"7992739871";
$code = \CjsRedis\PayAuthCode::getLuhnCode($s1);
echo $code . PHP_EOL;
$s2 = $s1 . $code;
echo "s1=" . $s1 . PHP_EOL;
echo "s2=" . $s2 . PHP_EOL;
echo var_export(\CjsRedis\PayAuthCode::isLuhn($s2), true) . PHP_EOL;


