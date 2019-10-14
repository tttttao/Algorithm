<?php
require_once 'functions.php';

function quickSort(array $arr): array
{

    $len = count($arr);

    if ($len <= 0) return $arr;

    $middleIndex = (int)floor($len / 2);

    $middle = $arr[$middleIndex];

    $smaller = $same = $larger = [];

    foreach ($arr as $item) {

        if ($item > $middle) {
            array_push($larger, $item);
        } else if ($item < $middle) {
            array_push($smaller, $item);
        } else {
            array_push($same, $item);
        }
    }

    $smaller = quickSort($smaller);

    $larger = quickSort($larger);

    return array_merge($smaller, $same, $larger);
}

$arr = getArr(100000);

$res = quickSort($arr);

dd($res);
