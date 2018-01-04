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
            <?php var_dump($this->params['breadCrumbs']);
            foreach ($this->params['breadCrumbs'] as $item): ?>
                <li><?= $item ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="builder builder-form-box">

            <div class="builder-container builder-form-container">
                <div class="row">
                    <div class="col-xs-12">
                        <form action="/index.php?s=/admin/system_menu/edit.html" method="post" class="form builder-form">
                            <div class="form-group item_id ">
                                <div class="controls">
                                    <input type="hidden" class="form-control input" name="id" value="118">
                                </div>
                            </div>
                            <div class="form-group item_pid ">
                                <label class="item-label">上级菜单<span class="check-tips">（<span class="small">所属的上级菜单</span>）</span></label>
                                <div class="controls">
                                    <select name="pid" class="form-control select">
                                        <option value="<?= $parentMenu['parent_id'] ?>"><?= $parentMenu['name'] ?></option>
                                        <option value="">请选择：</option>
<!--                                        --><?php
//
//                                        foreach ($this->params['breadCrumbs'] as $item): ?>
<!--                                            <option value="">--><?//= $item ?><!--</option>-->
<!--                                        --><?php //endforeach; ?>
                                        <?= $selectDom ?>
                                    </select>
                                </div>
                            </div><div class="form-group item_title ">
                                <label class="item-label">标题<span class="check-tips">（<span class="small">菜单标题</span>）</span></label>
                                <div class="controls">

                                    <input type="text" class="form-control input text" name="title" value="报表">                            </div>
                            </div><div class="form-group item_url ">
                                <label class="item-label">链接<span class="check-tips">（<span class="small">U函数解析的URL或者外链</span>）</span></label>
                                <div class="controls">

                                    <input type="text" class="form-control input text" name="url" value="Admin/Baobiao/userregsiter">                            </div>
                            </div>
                            <div class="form-group item_sort ">
                                <label class="item-label">排序<span class="check-tips">（<span class="small">用于显示的顺序</span>）</span></label>
                                <div class="controls">

                                    <input type="text" class="form-control input num" name="sort" value="">                            </div>
                            </div>                                        <div class="form-group">
                                <button class="btn btn-primary btn-block submit ajax-post visible-xs visible-sm" type="submit" target-form="builder-form">确定</button>
                                <button class="btn btn-primary submit ajax-post visible-md-inline visible-lg-inline" type="submit" target-form="builder-form">确定</button>
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