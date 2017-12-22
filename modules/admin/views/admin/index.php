<?php
//    use yii\grid\GridView;
//    use yii\data\ActiveDataProvider;
//    $dataProvider = new ActiveDataProvider([
//       'query' => \app\models\AdminModel::find(),
//        'pagination' => [
//            'pageSize' => 20,
//        ],
//    ]);
//    echo GridView::widget([
//        'dataProvider' => $dataProvider,
//        'columns' => [
//            ['class'=>''],
//            // 数据提供者中所含数据所定义的简单的列
//            // 使用的是模型的列的数据
//            ['label'=>'编号','value'=>'id'],//id
//            'user_type',['label' => '类别'],
//            'username',
//            // 更复杂的列数据
//            [
//                'class' => 'yii\grid\DataColumn', //由于是默认类型，可以省略
//                'label' => '栏目',
//                'value' => function ($data) {
//                    return $data->username; // 如果是数组数据则为 $data['name'] ，例如，使用 SqlDataProvider 的情形。
//                },
//            ],
//            ['class' => 'yii\grid\ActionColumn', 'header' => '操作'],
//        ],
//    ]);
//?>
<?php
use app\common\service\UrlService;
\app\assets\AdminAsset::register($this);
?>
<?php $this->beginPage(); ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php $this->head(); ?>
    </head>
    <body>
    <?php $this->beginBody(); ?>
    <div class="info-center">
        <div class="page-header">
            <div class="pull-left">
                <h4>资源列表</h4>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="table-margin">
            <table class="table table-hover table-header" id="list-table">
                <thead>
                <tr>
                    <td width="40px"><input class="check-all" type="checkbox"></td>
                    <td>编号</td>
                    <td>类别</td>
                    <td>用户名</td>
                    <td>状态</td>
                    <td>注册时间</td>
                    <td>上次登录时间</td>
                    <td class="w15">操作</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($modelInfo as $item): ?>
                    <tr>
                        <td><input class="check-all" type="checkbox"></td>
                        <td><?= $item['id'] ?></td>
                        <td>
                            <?= $item['nickname'] ?>
                        </td>
                        <td>
                            <?= $item['username'] ?>
                        </td>
                        <td>
                            <?php if ($item['status'] == 0): ?>
                                未使用
                            <?php elseif ($item['status'] == 1): ?>

                            <?php endif;?>
                        </td>
                        <td><?= $item['create_time'] ?></td>
                        <td><?= $item['update_time'] ?></td>
                        <td>
<!--                            <if condition="$vo.id neq 1">-->
<!--                                <a href="javascript:;" info="--><?//= /$item['comment']; ?><!--" ruleid="--><?//= $item['id'] ?><!--" ruletitle="--><?//= $item['sourcename'] ?><!--" onclick="edit(this)">查看</a>-->
<!--                                <span class="text-explode">|</span>-->
<!--                                <a href="javascript:if(confirm('确定删除？'))location='{:U('Admin/Rule/delete_group',array('id'=>$vo['id']))}'">删除</a>-->
<!--                                <span class="text-explode">|</span>-->
<!--                            </if>-->
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="bjy-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel"> 修改项目 </h4>
                </div>
                <div class="modal-body">
                    <form id="bjy-form" class="form-horizontal" >
                        <input type="hidden" name="id">
                        <table class="table table-hover contact-template-form">
                            <tbody>
                            <tr>
                                <td width="20%" align="right">项目名：</td>
                                <td>
                                    <span style="display: none;" class="project-id"></span>
                                    <span class="project-name"></span>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%" align="right">项目需求：</td>
                                <td>
                                    <span class="project-comment"></span>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%" align="right">审核状态：</td>
                                <td>
                                    <select name="status">
                                        <option value="0">审核中</option>
                                        <option value="1">审核通过</option>
                                        <option value="2">审核不通过</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%" align="right">项目需求：</td>
                                <td>
                                    <input class="btn btn-primary" type="button" value="修改">
                                </td>
                            </tr>
                            </tbody></table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php $this->endBody(); ?>
    <script type="text/javascript" src="<?= UrlService::buildAdminUrl('js/common.js') ?>"></script>
    <script type="text/javascript" src="<?= UrlService::buildWwwUrl('/plugins/common.js') ?>"></script>
    <script>
        function add(){
            $("input[name='title']").val('');
            $('#bjy-add').modal('show');
        }
        function edit(obj){
            var ruleId=$(obj).attr('ruleId');
            var ruletitle=$(obj).attr('ruletitle');
            var info = $(obj).attr('info');
            info = htmldecode(info);
            $("span.project-id").text(ruleId);
            $("span.project-name").text(ruletitle);
            $("span.project-comment").text(info);
            $('#bjy-edit').modal('show');
        }
        function htmldecode(s){
            var div = document.createElement('div');
            div.innerHTML = s;
            return div.innerText || div.textContent;
        }
        $('#bjy-form input[type=button]').click(function () {
            var id = $("span.project-id").text();
            var status = $('#bjy-form select[name=status]').val();
            $.ajax({
                url:common_ops.buildAdminUrl('/source/edit'),
                type:'POST',
                dataType:'JSON',
                data:{
                    id:id,
                    status:status
                },
                success:function (data) {
                    if(data.code == 200){
                        var callback = function () {
                            window.location.href = common_ops.buildAdminUrl('/source/index');
                        };
                        common_ops.alert(data.msg,callback());
                    }else{
                        common_ops.alert(data.msg);
                    }
                }
            });
        });

    </script>
    </body>
    </html>
<?php $this->endPage(); ?>