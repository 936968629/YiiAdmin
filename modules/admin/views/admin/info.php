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

    </div>

    <div class="builder builder-form-box">
        <div class="builder-container builder-form-container">
            <div class="row" style="margin-right: 21px;margin-left: 4px;">
                <div class="col-xs-12">
                    <form action="/index.php?s=/admin/user/edit.html" method="post" class="form builder-form">
                        <div class="form-group item_id ">
                            <div class="controls">
                                <input type="hidden" class="form-control input" name="id" value="<?= $adminInfo['id'] ?>">
                            </div>
                        </div>
                        <div class="form-group item_username ">
                            <label class="item-label">用户名<span class="check-tips">（<span class="small">用户名</span>）</span></label>
                            <div class="controls"><?= $adminInfo['username'] ?></div>
                        </div>
                        <div class="form-group item_group ">
                            <label class="item-label">部门<span class="check-tips">（<span class="small">所属部门</span>）</span></label>
                            <div class="controls">
                                <select name="group" class="form-control select">
                                    <option value="">请选择：</option>
                                    <option value="0" selected="">默认部门</option>
                                    <option value="1">管理员</option>
                                    <option value="2">&nbsp;&nbsp;&nbsp;&nbsp;┝ 研发部</option>
                                </select>                            </div>
                        </div>
                        <div class="form-group item_email ">
                            <label class="item-label">邮箱<span class="check-tips">（<span class="small">邮箱</span>）</span></label>
                            <div class="controls">

                                <input type="text" class="form-control input text" name="email" value="UzEzfIvkAy@defaultEmail.com">                            </div>
                        </div>
                        <div class="form-group item_mobile ">
                            <label class="item-label">手机号码<span class="check-tips">（<span class="small">手机号码</span>）</span></label>
                            <div class="controls">

                                <input type="text" class="form-control input text" name="mobile" value="" autocomplete="off">                            </div>
                        </div>
                        <div class="form-group item_password ">
                            <label class="item-label">密码<span class="check-tips">（<span class="small">密码</span>）</span></label>
                            <div class="controls">

                                <input type="password" class="form-control input password" name="password" value="61a5d9dee804d06458354f07fe9a9795" autocomplete="off">                            </div>
                        </div>
                        <div class="form-group item_type ">
                            <label class="item-label">第三方登录<span class="check-tips">（<span class="small">第三方登录</span>）</span></label>
                            <div class="controls">

                                <div style="border:5px white solid;padding-bottom:5px;">
                                    <label>
                <span data-id="26627" class="span_del" style="cursor: pointer;margin-right: 10px">
                    wechat
                </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block submit ajax-post visible-xs visible-sm" type="submit" target-form="builder-form">确定</button>
                            <button class="btn btn-primary submit ajax-post visible-md-inline visible-lg-inline" type="submit" target-form="builder-form">确定</button>
                            <button class="btn btn-default return visible-md-inline visible-lg-inline" onclick="javascript:history.back(-1);return false;">返回</button>
                        </div>
                    </form>
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