<?php
namespace app\modules\admin\controllers;

use app\modules\admin\controllers\common\BaseController;

class IndexController extends BaseController {

    public function actionIndex(){



        return $this->render('index');
    }

    public function actionWelcome()
    {
        $timeOne = $this->get('get.timeOne', '', 'op_t');
        $timeTwo = $this->get('get.timeTwo', '', 'op_t');

        if (empty($timeOne) || empty($timeTwo)) {
            $timeOneStart = strtotime(date('Y-m-d', strtotime('-1 day')) . " 00:00:00");
            $timeOneEnd = strtotime(date('Y-m-d', strtotime('-1 day')) . " 23:59:59");
            $timeTwoStart = strtotime(date('Y-m-d') . " 00:00:00");
            $timeTwoEnd = strtotime(date('Y-m-d') . " 23:59:59");
        } else {
            $timeOneStart = strtotime($timeOne . " 00:00:00");
            $timeOneEnd = strtotime($timeOne . " 23:59:59");
            $timeTwoStart = strtotime($timeTwo . " 00:00:00");
            $timeTwoEnd = strtotime($timeTwo . " 23:59:59");
        }

//        if($type == 1){
//            $newlistOne = M()->query("
//              select FROM_UNIXTIME(u.`ctime`,'%H') AS cretime,COUNT(u.`id`) AS count
//              from cbz_rechargeablelist u where u.ctime >= ".$timeOneStart." and u.ctime <= ".$timeOneEnd."
//              group by cretime
//            ");
//            $newlistTwo = M()->query("
//              select FROM_UNIXTIME(u.`ctime`,'%H') AS cretime,COUNT(u.`id`) AS count
//              from cbz_rechargeablelist u where u.ctime >= ".$timeTwoStart." and u.ctime <= ".$timeTwoEnd."
//              group by cretime
//            ");
//
//            $redata = arrangeBaobiaoData($newlistOne,1);
//            $redata2 = arrangeBaobiaoData($newlistTwo,1);
//
//            $this->assign('list1',$redata);
//            $this->assign('list2',$redata2);
//            $this->assign('nowHour',date('H') );
//    }

            //以天为单位
            $count_day = ($timeTwoStart - $timeOneStart) / 86400; //查询最近n天

            if($count_day < 0){return $this->error("日期不合法");}
            else{
                $total = 0;
                for($i = 0; $i <= $count_day; $i++){
                    $day = $timeOneStart + $i*86400; //第n天日期
                    $day_after = $timeOneStart + ($i+1)*86400; //第n+1天日期
                    $dates = date('Y-m-d H:i:s',$timeOneStart + $i*86400); //第n天日期
                    $datee = date('Y-m-d H:i:s',$timeOneStart + ($i+1)*86400); //第n+1天日期

                    $recharge_date[] = date('m月d日', $day);
                    $sql = "select COUNT(*) count from bs_order where create_time >= '".$dates."' and create_time<'".$datee."' and status not in (0)";

                    $connection  = \Yii::$app->db;
                    $command = $connection->createCommand($sql);
                    $res     = $command->queryOne();

                    $count = intval( $res['count'] );
                    $total += $count;
                    $recharge_count[] = $count;
                }
                $newlist1 = $recharge_date;
                $newlist2 = $recharge_count;
            }

        return $this->render('welcome',[
            'list1' => $newlist1,
            'list2' => $newlist2,
            'date1' => date('y-m-d',$timeOneStart),
            'date2' => date('y-m-d',$timeTwoStart),
            'total' => $total
        ]);
    }
	
	public function actionTest(){
	
	}
}