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
                margin-top: 8px;
                max-width: 150px;
                max-height: 90px;
                margin-right: 8px;
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
        <div class="builder builder-form-box">
            <div class="builder-container builder-form-container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group item_title ">
                            <label class="item-label">详细</label>
                            <input id="select_btn" class="selectbtn" style="display:none;" type="file" name="file2" accept="image/gif,image/jpeg,image/png">
                            <?php foreach ($info as $item): ?>
                                <div class="controls">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <input type="text" name="name" value="<?= $item['name'] ?>">
                                    <input type="text" name="detail" value="<?= $item['detail'] ?>">
                                    <button data-id="<?= $item['id']?>" class="but_edit">修改</button>
                                    <button data-id="<?= $item['id']?>" class="but_remove">删除</button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <script type="application/javascript">
                            $(function () {
                                $('.but_edit').click(function () {
                                    let id = $(this).parent().find('input[name=id]').val();
                                    let order = $(this).parent().find('input[name=order]').val();
                                    $.post(common_ops.buildAdminUrl('/product/infoimg'),{id:id,order:order,type:'edit'},function (data) {
                                        let status = data.status;
                                        if(status.code != 1){
                                            alert(status.msg);
                                            return;
                                        }else{
                                            alert(status.msg);
                                            location.reload();
                                            return;
                                        }
                                    },'json');
                                });
                            });
                        </script>
                        <form action="<?= Yii::$app->params['apiUrl']."/api/"; ?>" method="post" class="form builder-form" enctype="multipart/form-data" name="theme_form">
                            <div class="form-group item_img ">
                                <label class="item-label">商品图片</label>
                                <div class="controls">
                                    <div id="_upload_7">
                                        <input id="select_btn_1" class="selectbtn" style="display:none;" type="file" name="file" accept="image/gif,image/jpeg,image/png">
                                        <a id="file_upload_1-button" href="javascript:void(0)" class="uploadify-button btn btn-primary">上传图片</a>
                                        <div id="file_upload_1-queue" class="uploadify-queue"></div>
                                    </div>
                                    <div id="_preview_7">
                                        <input type="hidden" name="id" value="0">
                                        <input type="hidden" name="type" value="add">
                                        <input type="hidden" name="product_id" value="<?= $product_id ?>">
                                    </div>

                                </div>
                            </div>
                        </form>
                        <div class="form-group">
<!--                            <button class="btn btn-primary submit ajax-post visible-md-inline visible-lg-inline" type="button" id="sub_but">确定</button>-->
                            <button class="btn btn-default return visible-md-inline visible-lg-inline" onclick="javascript:history.back(-1);return false;">返回</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endBody(); ?>
        <script type="application/javascript">
            $('.uploadify-button').click(function () {
                $(this).prev().trigger('click');
            });
        </script>
    </body>
    </html>
<?php $this->endPage(); ?>