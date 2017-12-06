<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/2 0002
 * Time: 8:59
 */
use app\common\service\UrlService;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>管理后台</title>
    <link href="<?=UrlService::buildWwwUrl('/css/web/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?=UrlService::buildWwwUrl('/font-awesome/css/font-awesome.css');?>" rel="stylesheet">
    <link href="<?=UrlService::buildWwwUrl('/css/web/style.css?ver=20170326180701');?>" rel="stylesheet">
    <link href="<?=UrlService::buildWwwUrl('/css/web/my.css');?>" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="loginColumns animated fadeInDown">
    <div class="row admin-title">
        <div class="admin-tit">
            <h2>后台管理系统</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="ibox-content">
                <form class="m-t" role="form" action="<?= UrlService::buildWwwUrl('login-act');?>" method="post">
                    <div class="form-group text-center">
                        <h2 class="font-bold">登录</h2>
                    </div>
                    <div class="form-group">
                        <input type="text" name="login_name" class="form-control" placeholder="请输入登录用户名">
                    </div>
                    <div class="form-group">
                        <input type="password" name="login_pwd" class="form-control" placeholder="请输入登录密码">
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">登录</button>

                </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            管理系统 <a href="http://www.54php.cn/" target="_blank"> 技术支持 </a>
        </div>
        <div class="col-md-6 text-right">
            <small>© 2017</small>
        </div>
    </div>
</div>
</body>
</html>
