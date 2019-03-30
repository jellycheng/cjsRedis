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

$uid = 10010;
$seq = \CjsRedis\Sequence::getNextGlobalId('t_order', $uid);
echo $seq . PHP_EOL;

$uid = 50;
$seq = \CjsRedis\Sequence::getNextGlobalId('t_cart', $uid);
echo $seq . PHP_EOL;



