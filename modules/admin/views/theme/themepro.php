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
        <ul class="breadcrumb" style="margin-top: 20px;">
            <li><i class="fa fa-map-marker"></i></li>
            <?php foreach ($this->params['breadCrumbs'] as $item): ?>
                <li><?= $item ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="builder builder-form-box">
            <div class="builder-container builder-form-container">
                <div class="row">
                    <form action="<?= UrlService::buildCurrentUrl() ?>" method="post" name="tp_form">
                    <div class="col-xs-12">
                        <div class="form-group item_title ">
                            <label class="item-label">商品名称<span class="check-tips">（<span class="small">商品名称</span>）</span></label>
                            <div class="controls">
                                <?php foreach ($productInfo as $item): ?>
                                <input type="checkbox" name="products[]" value="<?= $item['id'] ?>" <?php if(in_array($item['id'],$existArr) ): echo 45 ?> checked="checked" <?php endif; ?> >
                                <label><?= $item['name'] ?></label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary submit ajax-post visible-md-inline visible-lg-inline" type="submit">确定</button>
                            <button class="btn btn-default return visible-md-inline visible-lg-inline" onclick="javascript:window.location.href=common_ops.buildAdminUrl('/theme/index');return false;">返回</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php $this->endBody(); ?>
    </body>
</html>
<?php $this->endPage(); ?>