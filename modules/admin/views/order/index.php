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
                <!-- 搜索框 -->
                <div class="col-xs-12 col-sm-2">
                    <div class="input-group search-form">
                        <input class="search-input form-control" type="text" name="keyword" placeholder="订单号" value="<?= $keyword ?>">
                        <span class="input-group-btn">
                            <a style="padding: 10px 12px;" class="btn btn-default" href="javascript:;" id="search" url="/admin/order/index"><i class="fa fa-search"></i></a>
                        </span>
                    </div>
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
                    <td>商品名称</td>
                    <td>状态</td>
                    <td>创建时间</td>
<!--                    <td class="w15">操作</td>-->
                </tr>
                </thead>
                <tbody>
                <?php foreach ($datalist as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['order_no'] ?></td>
                        <td><a href=""><?= $item['user_id'] ?></a></td>
                        <td><?= $item['total_price'] ?></td>
                        <td><?= $item['snap_name'] ?></td>
                        <td>
                            <?php if($item['status'] == 1): ?>未支付
                            <?php elseif($item['status'] == 2): ?>已支付
                            <?php elseif($item['status'] == 3): ?>已发货
                            <?php elseif($item['status'] == 4): ?>已支付但库存不足
                            <?php elseif($item['status'] == 5): ?>已收货
                            <?php endif; ?>
                        </td>
                        <td><?= $item['create_time'] ?></td>
<!--                        <td data-id="--><?//= $item['id'] ?><!--">-->
                            <!--                            <a title="编辑" class="label label-primary" href="--><?php //UrlService::buildAdminUrl('/product/edit',['id'=>$item['id']]) ?><!--">编辑</a>-->
<!--                        </td>-->
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
            echo \yii\widgets\LinkPager::widget([
                'pagination' => $pages
            ])
        ?>
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
        $("#search").click(function () {
            let url = $(this).attr('url');
            let keyword = $('input[name=keyword]').val();
            window.location.href = url+"?keyword="+keyword;
        });
    </script>
    </body>
    </html>
<?php $this->endPage(); ?>