<?php
use app\common\service\UrlService;
\app\assets\AdminAsset::register($this);
?>
<?php $this->beginPage(); ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php $this->head(); ?>
        <style>
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
<!--                    <a title="新增" class="btn btn-primary" href="--><?//= UrlService::buildAdminUrl('/system/menu_add') ?><!--">新增</a>&nbsp;-->
<!--                    <a title="启用" target-form="ids" class="btn btn-success ajax-post confirm" data-model="User" href="/index.php?s=/admin/user/setstatus/status/resume/model/User.html" autocomplete="off">启用</a>&nbsp;-->
<!--                    <a title="禁用" target-form="ids" class="btn btn-warning ajax-post confirm" data-model="User" href="/index.php?s=/admin/user/setstatus/status/forbid/model/User.html">禁用</a>-->
                </div>
            </div>
        </div>
        <div class="table-margin">
            <table class="table table-hover table-header" id="list-table">
                <thead>
                <tr>
                    <td width="40px"><input class="check-all" type="checkbox"></td>
                    <td>id</td>
                    <td>标题</td>
                    <td>头部图片</td>
                    <td>图片</td>
                    <td>创建时间<br>修改时间</td>
<!--                    <td>状态</td>-->
                    <td class="w15">操作</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($datalist as $item): ?>
                    <tr>
                        <td><input class="check-all" type="checkbox"></td>
                        <td><?= $item['id'] ?></td>
                        <td>
                            <?= $item['name'] ?>
                        </td>
                        <td>
<!--                            --><?//= $item['head_img'] ?>
                            <a href="http://wwjcdn.teizhe.com/Uploads/2018-01-31/5a71630e8496e.jpg" target="_blank">
                                <img src="http://wwjcdn.teizhe.com/Uploads/2018-01-31/5a71630e8496e.jpg">
                            </a>
                        </td>
                        <td><?= $item['img'] ?></td>
                        <td>
                           <?= $item['create_time']."\n".$item['update_time'] ?>
                        </td>
                        <td data-id="<?= $item['id'] ?>">
                            <a title="编辑" class="label label-primary" href="<?= UrlService::buildAdminUrl('/theme/edit',['id'=>$item['id']]) ?>">编辑</a>
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
            if(parseInt(id)){
                $.get(common_ops.buildAdminUrl('/system/edit_status',{'id':id,'status':status}),function (data) {
                    let status = data.status;
                    if(status.code != 1){
                        common_ops.alert(status.msg);
                    }else{
                        let callback = {'ok':function () {
                                window.location.reload();
                                // parent.location.reload();
                                // $('#content-iframe',window.parent.document).prop('src','admin/system/menu');
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