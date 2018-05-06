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
                            <label class="item-label">快递名称<span class="check-tips">（<span class="small">快递名称</span>）</span></label>
                            <div class="controls">
                                <input type="hidden" id="id" name="id" value="<?= $info['id']?>">
                                <select class="form-control" name="name" >
                                    <option value="中通快递">中通快递</option>
                                    <option value="韵达快递">韵达快递</option>
                                    <option value="申通快递">申通快递</option>
                                </select>
                                <!--                                <input type="text" class="form-control input text" name="name" value="--><?//= $info['kuaidi_name']?><!--">-->
                            </div>
                        </div>
                        <div class="form-group item_title">
                            <label class="item-label">快递单号<span class="check-tips"></span></label>
                            <div class="controls">
                                <input type="text" class="form-control input text" name="number" value="<?= $info['kuaidi_order']?>">
                            </div>
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
            $('#sub_but').click(function () {
                let id = $('#id').val();
                let number = $('input[name=number]').val();
                let name = $('select[name=name]').val();
                $.post(common_ops.buildAdminUrl('/order/send'),{id:id,name:name,number:number},(data)=>{
                    let status = data.status;
                    if(status.code == 1){
                        history.go(-1);
                    }else{
                        alert(status.msg);
                    }
                },'json');
            });
        </script>
    </body>
    </html>
<?php $this->endPage(); ?>