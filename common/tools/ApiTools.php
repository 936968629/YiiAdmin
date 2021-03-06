<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/22
 * Time: 14:54
 */

namespace app\common\tools;

//集成api方法
class ApiTools
{
    /**
     * 修改状态
     * @param $model
     * @param int $status 修改状态(0,1)
     * @param array $where 查询条件
     * @param int $writeSql 1:显示sql
     * @return bool
     * @author wjl
     */
    public static function editStatus($model,$status = 1,$where=[],$writeSql = 0){
        $info = $model->where($where)->one();
        if(empty($info)){
            return false;
        }
        if($writeSql == 1){
            return $info;
        }
        $info['status'] = $status;
        $info->save(0);
        return true;
    }
}