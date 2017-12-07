<?php

function real_strip_tags($str, $allowable_tags = "")
{
    $str = html_entity_decode($str, ENT_QUOTES, 'UTF-8');
    return strip_tags($str, $allowable_tags);
}

/**
 * 清除传递参数中的html代码
 * @param $text
 * @return string
 * @author wjl
 */
function op_t($text){
    $text = nl2br($text);
    $text = real_strip_tags($text);
    $text = addslashes($text);
    $text = trim($text);
    return $text;
}

