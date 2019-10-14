<?php

require_once 'functions.php';

function insert(array $arr): array
{
    $len = count($arr);

    for ($i = 0; $i < $len; $i++) {

        for ($j = $i; $j > 0; $j--) {

            if ($arr[$j] < $arr[$j - 1]) {
                list($arr[$j], $arr[$j - 1]) = [$arr[$j - 1], $arr[$j]];
            } else {
                break;
            }
        }
    }

    return $arr;
}

$res = insert(getArr(100000));

dd($res);


