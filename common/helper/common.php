<?php
define('NOW_TIME',date('Y-m-d H:i:s'));

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


/**
 * 将整形转换为字符串
 * @param  [type] $integer [description]
 * @return [type]          [description]
 */
function intToString($integer = null)
{
    if(is_array($integer)){
        foreach ($integer as $key => $value) {
            $integer[$key] = intToString($value);
        }
    }else{
        if(is_integer($integer)){
            $integer = (string)$integer;
        }else if(is_float($integer)){
            $integer = (string)$integer;
        }else if(is_bool($integer)){
            $integer = $integer ? 'true' : 'false';
        }else if(is_null($integer)){
            $integer = '';
        }
    }
    return $integer;
}
