<?php

function br($rows = 1){
    $res = '';
    for ($i = 0; $i <= $rows; $i++)
        $res .= '<br />';
    return $res;
}

function space($length = 1){
    $res = '';
    for ($i = 0; $i <= $length; $i++)
        $res .= '&nbsp; ';
    return $res;
}