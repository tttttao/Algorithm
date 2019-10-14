<?php
require_once 'functions.php';

function mergeSort(array $arr): array
{
    list($left, $right) = splitArr($arr);

    if (count($left) > 1) $left = mergeSort($left);
    if (count($right) > 1) $right = mergeSort($right);

    return mergeArr($left, $right);
}

function splitArr(array $arr): array
{
    $middle = ceil(count($arr) / 2);

    $left = array_slice($arr, 0, $middle);

    $right = array_slice($arr, $middle);

    return [$left, $right];
}

function mergeArr(array $arrA, array $arrB): array
{
    $res = [];

    while (!empty($arrA) || !empty($arrB)) {

        if (empty($arrA) || empty($arrB)) {

            $res = array_merge($res, array_reverse($arrA), array_reverse($arrB));

            break;
        }

        if (end($arrA) > end($arrB)) {
            $val = array_pop($arrA);
        } else {
            $val = array_pop($arrB);
        }

        array_push($res, $val);
    }

    $res = array_reverse($res);

    return $res;
}

$res = mergeSort(getArr(100000));

dd($res);
