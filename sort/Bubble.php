<?php

require_once 'functions.php';

function bubble(array $arr): array
{
    $len = count($arr);

    for ($i = 0; $i < $len; $i++) {
        for ($j = 0; $j < $len - $i - 1; $j++) {
            if ($arr[$j] > $arr[$j + 1]) {
                list($arr[$j], $arr[$j + 1]) = [$arr[$j + 1], $arr[$j]];
            }
        }
    }

    return $arr;
}

$res = bubble(getArr(100));

dd($res);
