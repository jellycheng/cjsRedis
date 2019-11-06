<?php
/**
 * 生成唯一值示例
 */
require_once __DIR__ . '/common.php';

\CjsRedis\Sequence::setDbConfig(['host'=>'127.0.0.1',
                                'database' => 'db_jellytest',
                                'username' => 'root',
                                'password' => '88888888',]);
\CjsRedis\Sequence::setTblPrifix('t_order', 'so');
\CjsRedis\Sequence::setTblPrifix(['t_cart'=>'cart', 't_wallet'=>'m']);
\CjsRedis\Sequence::setTblPrifix(['t_user'=>'user', 't_wallet'=>'u']);

$uid = 10020;
$seq = \CjsRedis\Sequence::getNextGlobalId('t_order', $uid);//订单号
echo $seq . PHP_EOL;//so190529099680001026
$seq  = \CjsRedis\Sequence::getNextGlobalSeq('t_order', $seq);
echo $seq . PHP_EOL;

$seq  = \CjsRedis\Sequence::getNextGlobalSeq('t_order', "so190529099680001026");
echo $seq . PHP_EOL;


$uid = 50;
$seq = \CjsRedis\Sequence::getNextGlobalId('t_cart', $uid);
echo $seq . PHP_EOL;//cart190529099680001050

$uid = "50";
$seq = \CjsRedis\Sequence::getNextGlobalId('t_user', $uid);
echo $seq . PHP_EOL;//user190529103340001050




