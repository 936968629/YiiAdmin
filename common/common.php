<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/6
 * Time: 16:21
 */

function op_t($text){
    $text = str_ireplace('&NewLine;','',$text);
    $text = str_ireplace('&colon;','',$text);
    $text = nl2br($text);
    $text = real_strip_tags($text);
    $text = addslashes($text);
    $text = trim($text);
    return $text;
}