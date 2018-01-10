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
        <div class="row builder builder-form-box">
            <div class="col-xs-12 builder-form-container">
                <form action="" method="post" class="form builder-form">
                    <ul class="nav-tabs nav" style="margin-bottom: 20px;">
                        <li class="active"><a href="#tab1" data-toggle="tab">分组信息</a></li>
                        <li><a href="#tab2" data-toggle="tab">系统权限</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane active">
                            <div class="form-group">
                                <label class="item-label">分组名称<span class="check-tips">（分组名称）</span></label>
                                <div class="controls">
                                    <input type="text" class="form-control input" name="title" value="">
                                </div>
                            </div>
                        </div>
                        <div id="tab2" class="tab-pane">
                            <div class="container">
                                <div class="col-xs-12">
                                    <div class="form-group auth">
                                        <?php foreach ($__ALL_MENU_LIST__ as $vo1): ?>
                                            <div>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="menu_auth[]" value="<?= $vo1['id'] ?>"><?= $vo1['name'] ?>
                                                </label>
                                                <div class="auth<?= $vo1['id'] ?>" style="padding-left: 25px;">
                                                    <?php
                                                    if(isset($vo1['_child'])):
                                                        foreach ($vo1['_child'] as $vo2): ?>
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="menu_auth[]" value="<?= $vo2['id'] ?>"><?= $vo2['name'] ?>
                                                        </label>
                                                        <div class="auth<?= $vo2['id'] ?>" style="padding-left: 25px;">
                                                        <?php
                                                            if(isset($vo2['_child'])):
                                                                foreach ($vo2['_child'] as $vo3): ?>
                                                                    <label class="checkbox">
                                                                        <input type="checkbox" name="menu_auth[]" value="<?= $vo3['id'] ?>"><?= $vo3['name'] ?>
                                                                    </label>
                                                                <?php endforeach;
                                                            endif;
                                                        ?>
                                                        </div>
                                                    <?php endforeach;
                                                    endif;?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id" value="{$info.id|default=''}">
                        <button class="btn btn-primary submit ajax-post" type="submit" target-form="form">确定</button>
                        <button class="btn btn- retudefaultrn" onclick="javascript:history.back(-1);return false;">返回</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $this->endBody(); ?>
    <script>

    </script>
    </body>
    </html>
<?php $this->endPage(); ?>