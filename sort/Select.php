<?php
require_once 'functions.php';

function select(array $arr): array
{
    $len = count($arr);

    for ($i = 0; $i < $len; $i++) {

        $min = $i;

        for ($j = $i; $j < $len; $j++) {

            if ($arr[$j] < $arr[$min]) {

                $min = $j;
            }
        }

        if ($min != $i) {
            list($arr[$i], $arr[$min]) = [$arr[$min], $arr[$i]];
        }
    }

    return $arr;
}

$res = select(getArr(100000));

dd($res);
