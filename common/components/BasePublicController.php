<?php

namespace app\common\components;

use yii\web\Controller;

class BasePublicController extends Controller
{
    public function get($key,$default_value="",$filter=null){
        $data = \Yii::$app->request->get($key,$default_value);
        if(!is_null($data)){
            $data = $this->paramsFilter($data,$filter,$default_value);
        }
        return $data;
    }

    public function post($key,$default_value="",$filter = null){
        $data = \Yii::$app->request->post($key,$default_value);
        if(!is_null($filter)){
            $data = $this->paramsFilter($data,$filter,$default_value);
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
    public function renderJson($data=[],$code=200,$login_tips_box=""){
        if(!is_array($data)){
            if(intval($data) >= 0){
                $code = intval($data);
                $data = array();
                $data['data'] = array();
            }
        }
        $result = array();
        $result['status'] = array('code'=>-1,'msg'=>'未知错误');
        if(isset($data['data'])){
            $result = $data;
        }else{
            $result['data'] = $data;
        }
        foreach (\Yii::$app->params['errorMsg'] as $key => $value) {
            if($code == $value['num']){
                unset($value['num']);
                $result['status'] = $value;
                break;
            }
        }
        $result = $this->int2String($result);
        //返回弹框信息
        $result['login_tips_box'] = $login_tips_box;
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($result);
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