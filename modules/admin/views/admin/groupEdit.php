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
                <form action="<?= UrlService::buildAdminUrl('/admin/group_edit') ?>" method="post" class="form builder-form">
                    <ul class="nav-tabs nav" style="margin-bottom: 20px;">
                        <li class="active"><a href="#tab1" data-toggle="tab">分组信息</a></li>
                        <?php if($info['id'] != 1):?>
                        <li><a href="#tab2" data-toggle="tab">系统权限</a></li>
                        <?php endif;?>
                    </ul>
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane active">
                            <?php if($info['id'] != 1): ?>
                                <div class="form-group">
                                    <label class="item-label">分组名称<span class="check-tips">（分组名称）</span></label>
                                    <div class="controls">
                                        <input type="text" class="form-control input" name="title" value="<?=$info['group_name']?>">
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-success">该分组拥有后台所有权限</div>
                            <?php endif; ?>
                        </div>
                        <?php if($info['id'] != 1):?>
                            <div id="tab2" class="tab-pane">
                                <div class="container">
                                    <div class="col-xs-12">
                                        <div class="form-group auth">
                                            <?php foreach ($__ALL_MENU_LIST__ as $vo1): ?>
                                                <div>
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="menu_auth[]" <?php if(in_array($vo1['id'], $info['menu_auth'])) echo "checked";?> value="<?= $vo1['id'] ?>"><?= $vo1['name'] ?>
                                                    </label>
                                                    <div class="auth<?= $vo1['id'] ?>" style="padding-left: 25px;">
                                                        <?php
                                                        if(isset($vo1['_child'])):
                                                            foreach ($vo1['_child'] as $vo2): ?>
                                                            <label class="checkbox">
                                                                <input type="checkbox" name="menu_auth[]" <?php if(in_array($vo2['id'], $info['menu_auth'])) echo "checked";?> value="<?= $vo2['id'] ?>"><?= $vo2['name'] ?>
                                                            </label>
                                                            <div class="auth<?= $vo2['id'] ?>" style="padding-left: 25px;">
                                                            <?php
                                                                if(isset($vo2['_child'])):
                                                                    foreach ($vo2['_child'] as $vo3): ?>
                                                                        <label class="checkbox">
                                                                            <input type="checkbox" name="menu_auth[]" <?php if(in_array($vo3['id'], $info['menu_auth'])) echo "checked";?> value="<?= $vo3['id'] ?>"><?= $vo3['name'] ?>
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
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?=$info['id']?>">
                        <?php if($info['id'] != 1): ?>
                        <button class="btn btn-primary submit ajax-post" type="submit">确定</button>
                        <?php endif; ?>
                        <button class="btn btn- retudefaultrn" onclick="javascript:history.back(-1);return false;">返回</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $this->endBody(); ?>
    <script>
        $('.auth input[type="checkbox"]').on('change',function(){
            //将子类的checkbox状态全部设为一致
            var checked = $(this).prop("checked"),
                container = $(this).parent().parent(),
                parentDom = $(this).parent();
                siblings = container.siblings();

            //判断是否有子节点 勾选所有子节点
            if($(this).parent().next('div').length != 0){
                $(this).parent().next('div').find('input[type="checkbox"]').prop('checked',checked);
            }
            //所有兄弟节点状态一致，则修改父节点
            let childLabelLength = container.children('label').length;
            let i = 0;
            container.children('label').each(function () {
                if($(this).children('input[type=checkbox]').prop('checked') == checked){
                    i++;
                }
                // $(this).children('input[type=checkbox]').prop('checked');
            });
            if(container.children('label').length == i){
                container.prev().children('input[type=checkbox]').prop('checked',checked);
            }

        });
    </script>
    </body>
    </html>
<?php $this->endPage(); ?>