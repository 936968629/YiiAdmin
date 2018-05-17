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

function array_map_recursive($filter, $data) {
    $result = array();
    foreach ($data as $key => $val) {
        $result[$key] = is_array($val)
            ? array_map_recursive($filter, $val)
            : call_user_func($filter, $val);
    }
    return $result;
}

//post访问数据
function curl_post($url,$data ){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//有返回值
    curl_setopt($ch,CURLOPT_HEADER,0);//取消head头
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            'Content-Type: application/json; charset=utf-8'
//        )
//    );
    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.2) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.2.149.27 Safari/525.13");
    curl_setopt($ch,CURLOPT_TIMEOUT,15);

    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);//规避https
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);

    curl_setopt($ch,CURLOPT_POST,1);//设置post提交
    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);//post参数

    $output = curl_exec($ch);
    if($output == false){
        curl_close($ch);
        return "error:".curl_error($ch);
    }
    curl_close($ch);
    return $output;
}
//get访问数据
function curl_get($url){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//有返回值
    curl_setopt($ch,CURLOPT_HEADER,0);//取消head头
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            'Content-Type: application/json; charset=utf-8'
//        )
//    );
    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.2) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.2.149.27 Safari/525.13");
    curl_setopt($ch,CURLOPT_TIMEOUT,15);

    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);//规避https
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);

    $output = curl_exec($ch);
    if($output == false){
        curl_close($ch);
        return "error:".curl_error($ch);
    }
    curl_close($ch);
    return $output;
}

//插入消息列表
function insertMsg($uid,$title,$content){
    $messageModel = new \app\models\MessageModel();
    $messageModel->user_id = $uid;
    $messageModel->title = $title;
    $messageModel->content = $content;
    $messageModel->create_time = date('Y-m-d H:i:s');
    $messageModel->status = 0;
    $ret = $messageModel->save(0);
    return $ret;
}