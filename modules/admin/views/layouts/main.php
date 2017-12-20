<?php
    use app\common\service\StaticService;
    use app\common\service\UrlService;
    \app\assets\AdminAsset::register($this);
    StaticService::includeAppJsStatic(UrlService::buildWwwUrl('/admin/js/common.js'),app\assets\AdminAsset::className());
?>
<?php $this->beginPage();  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <?php $this->head(); ?>
    <title>管理控制台</title>
</head>
<body>
<?php $this->beginBody(); ?>
<nav class="nav navbar-default navbar-mystyle navbar-fixed-top">
    <div class="navbar-header">
        <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand mystyle-brand" href="<?= UrlService::buildAdminUrl('user/edit') ?>"><span class="glyphicon glyphicon-home"></span></a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="li-border"><a class="mystyle-color" href="{:U('index/index')}">管理控制台</a></li>
        </ul>
        <ul class="nav navbar-nav pull-right">
            <li class="li-border">
                <a href="#" class="mystyle-color">
                    <span class="glyphicon glyphicon-bell"></span>
                    <span class="topbar-num">0</span>
                </a>
            </li>
            <li class="li-border dropdown"><a href="#" class="mystyle-color" data-toggle="dropdown">
                <span class="glyphicon glyphicon-search"></span> 搜索</a>
                <div class="dropdown-menu search-dropdown">
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default">搜索</button>
                        </span>
                    </div>
                </div>
            </li>
            <li class="dropdown li-border"><a href="#" class="dropdown-toggle mystyle-color" data-toggle="dropdown">帮助与文档<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">帮助与文档</a></li>
                    <li class="divider"></li>
                    <li><a href="#">论坛</a></li>
                    <li class="divider"></li>
                    <li><a href="#">博客</a></li>
                </ul>
            </li>
            <li class="dropdown li-border"><a href="#" class="dropdown-toggle mystyle-color" data-toggle="dropdown">您好，<?= $this->params['admin_name']; ?><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?= UrlService::buildWwwUrl('user/logout') ?>" onclick="return confirm('确定退出系统？')">退出</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<div class="down-main">
    <div class="left-main left-full">
        <div class="sidebar-fold"><span class="glyphicon glyphicon-menu-hamburger"></span></div>
        <div class="subNavBox">

            <div class="sBox">
                <div class="subNav sublist-down">
                    <span class="title-icon glyphicon glyphicon-chevron-right"></span>
                    <span class="sublist-title">资源管理</span>
                </div>
                <ul class="navContent" style="display:none">
                    <li class="nav-li">
                        <div class="showtitle" style="width:100px;">
                            <img src="__ADMIN_IMAGES__/leftimg.png" />
                        </div>
                        <a href="<?= UrlService::buildWwwUrl('source/index'); ?>" target="right_content">
                            <span class="sublist-icon glyphicon glyphicon-record"></span>
                            <span class="sub-title">资源列表</span>
                        </a>
                    </li>
                </ul>

                <div class="subNav sublist-down">
                    <span class="title-icon glyphicon glyphicon-chevron-right"></span>
                    <span class="sublist-title">用户管理</span>
                </div>
                <ul class="navContent" style="display:none">
                    <li class="nav-li">
                        <div class="showtitle" style="width:100px;">
                            <img src="__ADMIN_IMAGES__/leftimg.png" />
                        </div>
                        <a href="<?= UrlService::buildWwwUrl('identity/geren'); ?>" target="right_content">
                            <span class="sublist-icon glyphicon glyphicon-record"></span>
                            <span class="sub-title">个人认证</span>
                        </a>
                    </li>
                    <li class="nav-li">
                        <div class="showtitle" style="width:100px;">
                            <img src="__ADMIN_IMAGES__/leftimg.png" />
                        </div>
                        <a href="<?= UrlService::buildWwwUrl('identity/qiye'); ?>" target="right_content">
                            <span class="sublist-icon glyphicon glyphicon-record"></span>
                            <span class="sub-title">企业认证</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <div class="right-product right-full">
        <div class="main-content">
            <iframe id="content-iframe" src="<?= UrlService::buildWwwUrl('user/welcome') ?>" frameborder="0" width="100%" height="100%" name="right_content" scrolling="auto" frameborder="0" scrolling="no"></iframe>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= UrlService::buildWwwUrl('/admin/js/jquery-1.10.2.js') ?>"></script>
<script type="text/javascript">

$(function(){
    // 动态调整iframe的高度以适应不同高度的显示器
    $('.main-content').height($(window).height()-50);

});
</script>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>


