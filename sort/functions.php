<?php

function dd(...$data)
{
    foreach ($data as $item) {
        var_dump($item);
    }

    die();
}

function getArr(int $length)
{
    $res = [];

    for ($i = $length; $i > 0; $i--) {
       array_push($res, $i);
    }

    shuffle($res);

    return $res;
}
