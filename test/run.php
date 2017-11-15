<?php
/**
 * Примитивный тест
 */

require_once __DIR__ . '/../Sum2Str.php';

use adamasantares\Sum2Str;

echo "=== Test of 'sum2str' ===\n";

$t1 = Sum2Str::toStr(2546.34);
echo $t1 . ($t1 == 'две тысячи пятьсот сорок шесть рублей 34 коп.' ? " - OK\n" : " - FAIL\n");

$t2 = Sum2Str::toStr(1500210.50);
echo $t2 . ($t2 == 'один миллион пятьсот тысяч двести десять рублей 50 коп.' ? " - OK\n" : " - FAIL\n");

$t3 = Sum2Str::toStr(150, false); // => "сто пятьдесят"
echo $t3 . ($t3 == 'сто пятьдесят' ? " - OK\n" : " - FAIL\n");

echo "=== Done ===\n";