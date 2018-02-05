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
                    <div class="col-xs-12">
                        <form class="form builder-form" name="menuForm">
                            <div class="form-group item_id ">
                                <div class="controls">
                                    <input type="hidden" class="form-control input" name="id" value="<?= $currentMenu['id'] ?? '' ?>">
                                </div>
                            </div>
                            <div class="form-group item_pid ">
                                <label class="item-label">上级菜单<span class="check-tips">（<span class="small">所属的上级菜单</span>）</span></label>
                                <div class="controls">
                                    <select name="parent_id" class="form-control select">
                                        <option value="<?= $parentMenu['id'] ?? ''?>" selected><?= $parentMenu['name'] ?? '' ?></option>
                                        <option value="">请选择：</option>
                                        <option value="0">顶级菜单</option>
                                        <?= $selectDom ?>
                                    </select>
                                </div>
                            </div><div class="form-group item_title ">
                                <label class="item-label">标题<span class="check-tips">（<span class="small">菜单标题</span>）</span></label>
                                <div class="controls">

                                    <input type="text" class="form-control input text" name="name" value="<?= $currentMenu['name'] ?? '' ?>">                            </div>
                            </div><div class="form-group item_url ">
                                <label class="item-label">链接(顶级菜单可不填)</label>
                                <div class="controls">
                                    <input type="text" class="form-control input text" name="url" value="<?= $currentMenu['url'] ?? '' ?>">                            </div>
                            </div>
                            <div class="form-group item_sort ">
                                <label class="item-label">排序<span class="check-tips">（<span class="small">用于显示的顺序</span>）</span></label>
                                <div class="controls">
                                    <input type="text" class="form-control input num" name="list" value="<?= $currentMenu['list'] ?? '' ?>">                            </div>
                            </div>                                        <div class="form-group">
<!--                                <button class="btn btn-primary btn-block submit ajax-post visible-xs visible-sm" type="submit" target-form="builder-form">确定</button>-->
                                <button type="button" class="btn btn-primary submit ajax-post visible-md-inline visible-lg-inline" onclick="Sub('menuForm','<?php if(isset($type)) echo UrlService::buildAdminUrl('/system/menu_add');else echo UrlService::buildAdminUrl('/system/menu_edit') ?>')">确定</button>
                                <button class="btn btn-default return visible-md-inline visible-lg-inline" onclick="javascript:history.back(-1);return false;">返回</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->endBody(); ?>
    <script>

    </script>
    </body>
    </html>
<?php $this->endPage(); ?>