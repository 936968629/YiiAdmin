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
                        <form action="/index.php?s=/admin/wawa/edit/id/2.html" method="post" class="form builder-form">
                            <div class="form-group item_title ">
                                <label class="item-label">标题<span class="check-tips">（<span class="small">标题名称</span>）</span></label>
                                <div class="controls">
                                    <input type="text" class="form-control input text" name="title" value="布朗熊">
                                </div>
                            </div>
                            <div class="form-group item_title ">
                                <label class="item-label">描述<span class="check-tips"></span></label>
                                <div class="controls">
                                    <input type="text" class="form-control input text" name="title" value="布朗熊">
                                </div>
                            </div>
                            <div class="form-group item_img ">
                                <label class="item-label">封面图片</label>
                                <div class="controls">
                                    <div id="_upload_7"><input id="select_btn_1" class="selectbtn" style="display:none;" type="file" name="fileselect[]" accept="image/gif,image/jpeg,image/png"><a id="file_upload_1-button" href="javascript:void(0)" class="uploadify-button btn btn-primary">上传图片</a><div id="file_upload_1-queue" class="uploadify-queue"></div></div>
                                    <div id="_preview_7">
                                        <input type="hidden" name="img" value="http://oss.aliyuncs.com/wawajiji/Uploads/2017-11-02/59fad44179b3d.png">
                                        <span class="img-box">
                                           <!--  <img class="img" src="" data-id="http://oss.aliyuncs.com/wawajiji/Uploads/2017-11-02/59fad44179b3d.png"> -->
                                            <img class="img" src="http://oss.aliyuncs.com/wawajiji/Uploads/2017-11-02/59fad44179b3d.png" data-id="http://oss.aliyuncs.com/wawajiji/Uploads/2017-11-02/59fad44179b3d.png">
                                            <i class="fa fa-times-circle remove-picture"></i>
                                        </span>
                                    </div>
                                    <script type="text/javascript">
                                        $(function(){
                                            $('#_upload_7').Huploadify({
                                                uploader:'/index.php?s=/admin/public_upload/upload.html',
                                                fileTypeExts:'*.gif;*.jpg;*.jpeg;*.png;*.bmp',
                                                fileSizeLimit:5*1024,
                                                buttonText:'上传图片',
                                                onUploadComplete:function(file, data){
                                                    var data = $.parseJSON(data);
                                                    if(data.error == 1){
                                                        $.alertMessager(data.message, 'danger');
                                                    }else{
                                                        var new_img = '<span class="img-box"><img class="img" src="' + data.url + '" data-id="'+data.id+'"><i class="fa fa-times-circle remove-picture"></i></span>';
                                                        $('#_preview_7').append(new_img);
                                                        $('#_preview_7 input').attr('value', data.id);
                                                    }
                                                }
                                            });
                                        });
                                        //删除图片
                                        $('#_preview_7 .remove-picture').click(function(){
                                            var ready_for_remove_id = $(this).closest('.img-box').find('img').attr('data-id'); //获取待删除的图片ID
                                            if(!ready_for_remove_id){
                                                $.alertMessager('错误', 'danger');
                                            }
                                            $('#_preview_7 input').val('') //删除后覆盖原input的值为空
                                            $(this).closest('.img-box').remove(); //删除图片预览图
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="form-group item_descs ">
                                <label class="item-label">娃娃详图</label>
                                <div class="controls">
                                    <div id="_upload_8"><input id="select_btn_1" class="selectbtn" style="display:none;" type="file" name="fileselect[]" accept="image/gif,image/jpeg,image/png"><a id="file_upload_1-button" href="javascript:void(0)" class="uploadify-button btn btn-primary">上传图片</a><div id="file_upload_1-queue" class="uploadify-queue"></div></div>
                                    <div id="_preview_8">
                                        <input type="hidden" name="descs" value="http://wwjcdn.teizhe.com/Uploads/2017-11-02/59fad44179b3d.png">
                                        <span class="img-box">
                                           <!--  <img class="img" src="" data-id="http://wwjcdn.teizhe.com/Uploads/2017-11-02/59fad44179b3d.png"> -->
                                            <img class="img" src="http://wwjcdn.teizhe.com/Uploads/2017-11-02/59fad44179b3d.png" data-id="http://wwjcdn.teizhe.com/Uploads/2017-11-02/59fad44179b3d.png">
                                            <i class="fa fa-times-circle remove-picture"></i>
                                        </span>
                                    </div>
                                    <script type="text/javascript">
                                        $(function(){
                                            $('#_upload_8').Huploadify({
                                                uploader:'/index.php?s=/admin/public_upload/upload.html',
                                                fileTypeExts:'*.gif;*.jpg;*.jpeg;*.png;*.bmp',
                                                fileSizeLimit:5*1024,
                                                buttonText:'上传图片',
                                                onUploadComplete:function(file, data){
                                                    var data = $.parseJSON(data);
                                                    if(data.error == 1){
                                                        $.alertMessager(data.message, 'danger');
                                                    }else{
                                                        var new_img = '<span class="img-box"><img class="img" src="' + data.url + '" data-id="'+data.id+'"><i class="fa fa-times-circle remove-picture"></i></span>';
                                                        $('#_preview_8').append(new_img);
                                                        $('#_preview_8 input').attr('value', data.id);
                                                    }
                                                }
                                            });
                                        });
                                        //删除图片
                                        $('#_preview_8 .remove-picture').click(function(){
                                            var ready_for_remove_id = $(this).closest('.img-box').find('img').attr('data-id'); //获取待删除的图片ID
                                            if(!ready_for_remove_id){
                                                $.alertMessager('错误', 'danger');
                                            }
                                            $('#_preview_8 input').val('') //删除后覆盖原input的值为空
                                            $(this).closest('.img-box').remove(); //删除图片预览图
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary submit ajax-post visible-md-inline visible-lg-inline" type="submit" target-form="builder-form">确定</button>
                                <button class="btn btn-default return visible-md-inline visible-lg-inline" onclick="javascript:history.back(-1);return false;">返回</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    </div>

    <?php $this->endBody(); ?>

    </body>
    </html>
<?php $this->endPage(); ?>