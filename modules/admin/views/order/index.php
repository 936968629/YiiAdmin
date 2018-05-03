<?php
use app\common\service\UrlService;
\app\assets\AdminAsset::register($this);
?>
<?php $this->beginPage(); ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php $this->head(); ?>
        <style type="text/css">
            img{
                max-width: 200px;
                max-height: 40px;
            }
        </style>
    </head>
    <body>
    <?php $this->beginBody(); ?>
    <div class="info-center">
        <ul class="breadcrumb" style="margin-top: 20px;">
            <li><i class="fa fa-map-marker"></i></li>
            <?php foreach ($this->params['breadCrumbs'] as $item): ?>
                <li><?= $item ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="builder-toolbar builder-list-toolbar">
            <div class="row">
                <!-- 工具栏按钮 -->
                <div class="col-xs-12 col-sm-9 button-list">
                    <a title="新增" class="btn btn-primary" href="<?= UrlService::buildAdminUrl('/product/add') ?>">新增</a>&nbsp;

                </div>
            </div>
        </div>
        <div class="table-margin">
            <table class="table table-hover table-header" id="list-table">
                <thead>
                <tr>
                    <td>id</td>
                    <td>订单号</td>
                    <td>uid</td>
                    <td>价格</td>
                    <td>名称</td>
                    <td>状态</td>
                    <td class="w15">操作</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($datalist as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['order_no'] ?></td>
                        <td><?= $item['user_id'] ?></td>
                        <td><?= $item['total_price'] ?></td>
                        <td>
                            <?php if($item['status'] == 1): ?>

                            <?php endif; ?>
                        </td>
                        <td data-id="<?= $item['id'] ?>">
                            <!--                            <a title="编辑" class="label label-primary" href="--><?php //UrlService::buildAdminUrl('/product/edit',['id'=>$item['id']]) ?><!--">编辑</a>-->
                            <?php if ($item['status'] == 0): ?>
                                <a title="启用" class="label label-success ajax-get confirm" href="javascript:void(0)" onclick="editStatus(<?= $item["id"] ?>,1)">启用</a>
                            <?php elseif ($item['status'] == 1): ?>
                                <a title="禁用" class="label label-warning ajax-get confirm" href="javascript:void(0)" onclick="editStatus(<?= $item["id"] ?>,0)">禁用</a>
                            <?php endif;?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php $this->endBody(); ?>
    <script>
        function editStatus(id,status=1) {
            if(parseInt(id) ){
                $.get(common_ops.buildAdminUrl('/user/edit_status',{'id':id,'status':status}),function (data) {
                    let status = data.status;
                    if(status.code != 1){
                        common_ops.alert(status.msg);
                    }else{
                        let callback = {'ok':function () {
                                window.location.reload();
                            },'cancel':function () {
                                window.location.reload();
                            }};
                        common_ops.confirm(status.msg,callback);
                    }
                },'json');
            }
        }

    </script>
    </body>
    </html>
<?php $this->endPage(); ?>