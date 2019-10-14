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
            $res = array_merge($res, $arrA, $arrB);
            break;
        }

        if ($arrA[0] > $arrB[0]) {
            $val = array_shift($arrB);
        } else {
            $val = array_shift($arrA);
        }

        array_push($res, $val);
    }

    return $res;
}

$res = mergeSort(getArr(100000));

dd($res);
