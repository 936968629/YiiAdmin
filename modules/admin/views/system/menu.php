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
        <div class="builder-toolbar builder-list-toolbar">
            <div class="row">
                <!-- 工具栏按钮 -->
                <div class="col-xs-12 col-sm-9 button-list">
                    <a title="新增" class="btn btn-primary" href="/index.php?s=/admin/user/add.html">新增</a>&nbsp;<a title="启用" target-form="ids" class="btn btn-success ajax-post confirm" data-model="User" href="/index.php?s=/admin/user/setstatus/status/resume/model/User.html" autocomplete="off">启用</a>&nbsp;<a title="禁用" target-form="ids" class="btn btn-warning ajax-post confirm" data-model="User" href="/index.php?s=/admin/user/setstatus/status/forbid/model/User.html">禁用</a>&nbsp;                    </div>
                <!-- 搜索框 -->
                <div class="col-xs-12 col-sm-3">
                    <div class="input-group search-form">
                        <input type="text" name="keyword" class="search-input form-control" value="" placeholder="请输入ID/用户名/邮箱/手机号">
                        <span class="input-group-btn"><a class="btn btn-default" href="javascript:;" id="search" url="/index.php?s=/admin/user/index.html"><i class="fa fa-search"></i></a></span>
                    </div>
                </div>            </div>
        </div>
        <div class="table-margin">
            <table class="table table-hover table-header" id="list-table">
                <thead>
                <tr>
                    <td width="40px"><input class="check-all" type="checkbox"></td>
                    <td>id</td>
                    <td>标题</td>
                    <td>链接</td>
                    <td>排序</td>
                    <td>状态</td>
                    <td class="w15">操作</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($modelInfo as $item): ?>
                    <tr>
                        <td><input class="check-all" type="checkbox"></td>
                        <td><?= $item['id'] ?></td>
                        <td>
                            <?= $item['name'] ?>
                        </td>
                        <td>
                            <?= $item['url'] ?>
                        </td>
                        <td><?= $item['list'] ?></td>
                        <td>
                            <?php if ($item['status'] == 0): ?>
                                未使用
                            <?php elseif ($item['status'] == 1): ?>
                                <i class="fa fa-check text-success"></i>
                            <?php endif;?>
                        </td>
                        <td>
                            <a title="编辑" class="label label-primary" href="<?= UrlService::buildAdminUrl('/admin/info',['id'=>$item['id']]) ?>">编辑</a>
                            <a title="禁用" class="label label-warning ajax-get confirm" href="javascript:if(confirm('确定禁用？'))location=''">禁用</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php $this->endBody(); ?>
    <script>
        function add(){
            $("input[name='title']").val('');
            $('#bjy-add').modal('show');
        }
        function edit(obj){
            var ruleId=$(obj).attr('ruleId');
            var ruletitle=$(obj).attr('ruletitle');
            var info = $(obj).attr('info');
            info = htmldecode(info);
            $("span.project-id").text(ruleId);
            $("span.project-name").text(ruletitle);
            $("span.project-comment").text(info);
            $('#bjy-edit').modal('show');
        }
        function htmldecode(s){
            var div = document.createElement('div');
            div.innerHTML = s;
            return div.innerText || div.textContent;
        }
        $('#bjy-form input[type=button]').click(function () {
            var id = $("span.project-id").text();
            var status = $('#bjy-form select[name=status]').val();
            $.ajax({
                url:common_ops.buildAdminUrl('/source/edit'),
                type:'POST',
                dataType:'JSON',
                data:{
                    id:id,
                    status:status
                },
                success:function (data) {
                    if(data.code == 200){
                        var callback = function () {
                            window.location.href = common_ops.buildAdminUrl('/source/index');
                        };
                        common_ops.alert(data.msg,callback());
                    }else{
                        common_ops.alert(data.msg);
                    }
                }
            });
        });

    </script>
    </body>
    </html>
<?php $this->endPage(); ?>