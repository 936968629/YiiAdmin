<?php

namespace app\common\components;

use yii\web\Controller;

class BasePublicController extends Controller
{
    public function get($key,$default="",$filter=null){
        $data = \Yii::$app->request->get($key,$default);
        if(!is_null($data)){
            $data = $this->paramsFilter($data,$filter,$default);
//            if(is_string($data)){
//                if(is_string($filter)){
//                    $filters    =   explode(',',$filter);
//                }elseif(is_int($filter)){
//                    $filters    =   array($filter);
//                }
//                foreach($filters as $filter){
//                    if(function_exists($filter)) {
//                        $data   =   is_array($data) ? array_map_recursive($filter,$data) : $filter($data); // 参数过滤
//                    }elseif(0===strpos($filter,'/')){
//                        // 支持正则验证
//                        if(1 !== preg_match($filter,(string)$data)){
//                            return isset($default) ? $default : NULL;
//                        }
//                    }else{
//                        $data   =   filter_var($data,is_int($filter) ? $filter : filter_id($filter));
//                        if(false === $data) {
//                            return isset($default) ? $default : NULL;
//                        }
//                    }
//                }
//            }
        }
        return $data;
    }

    public function post($key,$default_value="",$filter = null){
        $data = \Yii::$app->request->post($key,$default_value);
        if(!is_null($filter)){

        }
        return $data;
    }

    public function setCookie($name,$value="",$expire=0){
        $cookie = \Yii::$app->response->cookies;
        $cookie->add(new \yii\web\Cookie([
            'name' => $name,
            'value' => $value,
            'expire'=>$expire,
        ]));
    }

    public function getCookie($name,$default_value=""){
        $cookie = \Yii::$app->request->cookies;
        return $cookie->getValue($name,$default_value);
    }

    /**
     * 返回json
     */
    public function renderJson($data=[],$msg="ok",$code=200){
        header("Content-type:application/json");
        echo json_encode([
            "code"  => $code,
            "msg"   => $msg,
            "data"  => $data,
            "req_id"=> uniqid(),
        ]);
    }

    /**
     * 过滤参数
     * @param $filter 过滤函数
     * @param string $default 默认值
     * @author wjl
     */
    private function paramsFilter($data,$filter,$default=""){
        if(is_string($filter)){
            $filters    =   explode(',',$filter);
        }elseif(is_int($filter)){
            $filters    =   array($filter);
        }
        foreach($filters as $filter){
            if(function_exists($filter)) {
                $data   =   is_array($data) ? array_map_recursive($filter,$data) : $filter($data); // 参数过滤
            }elseif(0===strpos($filter,'/')){
                // 支持正则验证
                if(1 !== preg_match($filter,(string)$data)){
                    return isset($default) ? $default : NULL;
                }
            }else{
                $data   =   filter_var($data,is_int($filter) ? $filter : filter_id($filter));
                if(false === $data) {
                    return isset($default) ? $default : NULL;
                }
            }
        }
        return $data;
    }
}