<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/5 0005
 * Time: 13:47
 */
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
                </div>
                <!-- 搜索框 -->
                <div class="col-xs-12 col-sm-2">
                    <div class="input-group search-form">
                        <input class="search-input form-control" type="text" name="keyword" placeholder="UID" value="<?= $keyword ?>">
                        <span class="input-group-btn">
                            <a style="padding: 10px 12px;" class="btn btn-default" href="javascript:;" id="search" url="/admin/message/index"><i class="fa fa-search"></i></a>
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
                    <td>uid</td>
                    <td>内容</td>
                    <td>状态</td>
                    <td>创建时间</td>
                    <td>更新时间</td>
                    <td class="w15">操作</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($datalist as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><a href=""><?= $item['user_id'] ?></a></td>
                        <td><?= $item['content'] ?></td>
                        <td>
                            <?php if($item['status'] == 0): ?>未读
                            <?php elseif($item['status'] == 2): ?>已读
                            <?php endif; ?>
                        </td>
                        <td><?= $item['create_time'] ?></td>
                        <td><?= $item['update_time'] ?></td>
                        <td>
                            <a href="<?= UrlService::buildAdminUrl('/message/info',['id'=>$item['id'] ])?>" class="look_cla" >查看</a>
                        </td>
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

        $("#search").click(function () {
            let url = $(this).attr('url');
            let keyword = $('input[name=keyword]').val();
            window.location.href = url+"?keyword="+keyword;
        });
    </script>
    </body>
    </html>
<?php $this->endPage(); ?>