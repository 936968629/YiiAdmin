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
                                    <textarea rows="8" cols="110"><?= $item['detail'] ?></textarea>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary submit ajax-post visible-md-inline visible-lg-inline" type="button" id="sub_but">确定</button>
                            <button class="btn btn-default return visible-md-inline visible-lg-inline" onclick="javascript:history.back(-1);return false;">返回</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endBody(); ?>
        <script type="application/javascript">
            var sub_but = document.querySelector("#sub_but");
            var id = document.querySelector('input[name=id]').getAttribute('value');
            sub_but.addEventListener('click',function (e) {
                var textarea = document.querySelector('textarea').value;
                $.post(common_ops.buildAdminUrl('/product/info'),{id:id,ta:textarea},function (data) {
                    let status = data.status;
                    if(status.code == 1){
                        history.go(-1);
                    }else{
                        alert(status.msg);
                    }
                },'json');

            })
        </script>
    </body>
    </html>
<?php $this->endPage(); ?>