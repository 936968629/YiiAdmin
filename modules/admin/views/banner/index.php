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
                    <a title="新增" class="btn btn-primary" href="<?= UrlService::buildAdminUrl('/banner/add') ?>">新增</a>&nbsp;
                    <a title="启用" target-form="ids" class="btn btn-success ajax-post confirm" data-model="User" href="/index.php?s=/admin/banner/setstatus/status/resume/model/BannerItem.html" autocomplete="off">启用</a>&nbsp;
                    <a title="禁用" target-form="ids" class="btn btn-warning ajax-post confirm" data-model="User" href="/index.php?s=/admin/banner/setstatus/status/forbid/model/BannerItem.html">禁用</a>
                </div>
            </div>
        </div>
        <div class="table-margin">
            <table class="table table-hover table-header" id="list-table">
                <thead>
                <tr>
                    <td width="40px"><input class="check-all" type="checkbox"></td>
                    <td>id</td>
                    <td>图片</td>
                    <td>状态</td>
                    <td class="w15">操作</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($datalist as $item): ?>
                    <tr>
                        <td><input class="check-all" type="checkbox"></td>
                        <td><?= $item['id'] ?></td>
                        <td><img src="<?= Yii::$app->params['apiUrl'].$item['img'] ?>"></td>
                        <td>
                            <?php if ($item['status'] == 0): ?>
                                <i class="fa fa-ban text-danger"></i>
                            <?php elseif ($item['status'] == 1): ?>
                                <i class="fa fa-check text-success"></i>
                            <?php endif;?>
                        </td>
                        <td data-id="<?= $item['id'] ?>">
                            <a title="编辑" class="label label-primary" href="<?= UrlService::buildAdminUrl('/banner/edit',['id'=>$item['id']]) ?>">编辑</a>
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
                $.get(common_ops.buildAdminUrl('/banner/edit_status',{'id':id,'status':status}),function (data) {
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