<?php
function bigger($number){
    return ['value' => $number, 'operator' => '>'];
}

function letter($number){
    return ['value' => $number, 'operator' => '<'];
}

function equals($value){
    return ['value' => $value, 'operator' => '='];
}