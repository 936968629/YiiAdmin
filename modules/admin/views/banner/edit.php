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
                        <form action="<?= Yii::$app->params['apiUrl']."/api/v2/upload/6"; ?>" method="post" class="form builder-form" enctype="multipart/form-data" target="upload_file" name="theme_form">
                        <div class="form-group item_img ">
                            <label class="item-label">幻灯片图片</label>
                            <div class="controls">
                                <div id="_upload_7">
                                    <input id="select_btn_1" class="selectbtn" style="display:none;" type="file" name="file" accept="image/gif,image/jpeg,image/png">
                                    <a id="file_upload_1-button" href="javascript:void(0)" class="uploadify-button btn btn-primary">上传图片</a>
                                    <div id="file_upload_1-queue" class="uploadify-queue"></div>
                                </div>
                                <div id="_preview_7">
                                    <input id="id" type="hidden" name="id" value="<?= $info['id']?>">
                                    <span class="img-box">
                                         <img class="img" src="<?= Yii::$app->params['apiUrl'].$info['img'] ?>">
<!--                                            <img class="img" src="http://oss.aliyuncs.com/wawajiji/Uploads/2017-11-02/59fad44179b3d.png" >-->
<!--                                            <i class="fa fa-times-circle remove-picture"></i>-->
                                    </span>
                                </div>
                                <script type="text/javascript">
                                    $(function(){
                                        $('input[name=file]').change(function () {
                                            $('[name=theme_form]').submit();
                                        });
                                    });
                                    //删除图片
                                    $('#_preview_7 .remove-picture').click(function(){
                                        var ready_for_remove_id = $(this).closest('.img-box').find('img').attr('data-id'); //获取待删除的图片ID
                                        if(!ready_for_remove_id){
                                            $.alertMessager('错误', 'danger');
                                        }
                                        $('#_preview_7 input').val(''); //删除后覆盖原input的值为空
                                        $(this).closest('.img-box').remove(); //删除图片预览图
                                    });
                                </script>
                            </div>
                        </div>
                        </form>
                        <div class="form-group">
                            <label class="item-label">类型</label>
                            <select name="type">
                                <option value="0">无导向</option>
                                <option value="1">导向商品</option>
                                <option value="2">导向主题</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="item-label">导向id</label>
                            <input type="text" name="keyword" class="">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary submit ajax-post visible-md-inline visible-lg-inline" type="button" id="sub_but">确定</button>
                            <button class="btn btn-default return visible-md-inline visible-lg-inline" onclick="javascript:history.back(-1);return false;">返回</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <iframe class="hide" name="upload_file"></iframe>
    <?php $this->endBody(); ?>
    <script type="application/javascript">
        $('.uploadify-button').click(function () {
            $(this).prev().trigger('click');
        });
        $('#sub_but').click(function () {
            let id = $('#id').val();
            let type = $('select[name=type]').val();
            let keyword = $('input[name=keyword]').val();
            $.post(common_ops.buildAdminUrl('/banner/edit'),{id:id,type:type,keyword:keyword},(data)=>{
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