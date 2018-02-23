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
                        <div class="form-group item_title ">

                            <label class="item-label">商品详细图片</label>
                            <input id="select_btn" class="selectbtn" style="display:none;" type="file" name="file2" accept="image/gif,image/jpeg,image/png">
                            <?php foreach ($imgInfo as $item): ?>
                            <form data-id="<?= $item['id'] ?>" action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="product_id" value="<?= $product_id ?>">
                            <div class="controls">
                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                <img data-id="<?= $item['id'] ?>" class="infoimg" src="<?= Yii::$app->params['apiUrl'].$item['img']; ?>" alt="">
                                <input type="text" name="order" value="<?= $item['order'] ?>">
                                <button data-id="<?= $item['id']?>" class="but_edit">修改</button><button data-id="<?= $item['id']?>" class="but_remove">删除</button>
                            </div>
                            </form>
                            <?php endforeach; ?>
                        </div>
                        <script type="application/javascript">
                            $(function () {
                                var sign = 1;
                                $('.infoimg').click(function () {
                                    $('#select_btn').trigger('click');
                                    sign = $(this).attr('data-id');
                                });
                                $('input[name=file2]').change(function () {
                                    let apiUrl = "<?= Yii::$app->params['apiUrl']; ?>";
                                    let formsEle = $('form');
                                    let formEle;
                                    for(let i=0;i<formsEle.length;i++){
                                        if($(formsEle[i]).attr('data-id') == sign){
                                            formEle = formsEle[i];
                                        }
                                    }
                                    console.log(formEle);
                                    var formData = new FormData(formEle);
                                    formData.append('file',$(':file')[0].files[0]);
                                    console.log(formData);
                                    $.ajax({
                                        url:'<?= Yii::$app->params['apiUrl']."/api/v2/upload/5"; ?>',
                                        method:'post',
                                        data: formData,
                                        //这两个设置项必填
                                        contentType: false,
                                        processData: false,
                                        success:function (data) {
                                            console.log(data);
                                            // $('#file_img').attr('src',apiUrl+data);
                                            // $('#img_hidden').val(data);
                                        }
                                    })
                                });
                                $('.but_edit').click(function () {
                                    let id = $(this).parent().find('input[name=id]').val();
                                    let order = $(this).parent().find('input[name=order]').val();
                                    $.post(common_ops.buildAdminUrl('/product/infoimg'),{id:id,order:order,type:'edit'},function (data) {
                                        let status = data.status;
                                        if(status.code != 1){
                                            alert(status.msg);
                                            return;
                                        }else{
                                            alert(status.msg);
                                            location.reload();
                                            return;
                                        }
                                    },'json');
                                });
                            });
                        </script>
                        <form action="<?= Yii::$app->params['apiUrl']."/api/"; ?>" method="post" class="form builder-form" enctype="multipart/form-data" name="theme_form">
                            <div class="form-group item_img ">
                                <label class="item-label">商品图片</label>
                                <div class="controls">
                                    <div id="_upload_7">
                                        <input id="select_btn_1" class="selectbtn" style="display:none;" type="file" name="file" accept="image/gif,image/jpeg,image/png">
                                        <a id="file_upload_1-button" href="javascript:void(0)" class="uploadify-button btn btn-primary">上传图片</a>
                                        <div id="file_upload_1-queue" class="uploadify-queue"></div>
                                    </div>
                                    <div id="_preview_7">
                                        <input type="hidden" name="id" value="0">
                                        <input type="hidden" name="type" value="add">
                                        <input type="hidden" name="product_id" value="<?= $product_id ?>">
                                        <span class="img-box">
                                            <img class="img" src="" id="file_img">
                                            <input type="hidden" id="img_hidden" value="">
                                        </span>
                                    </div>
                                    <script type="text/javascript">
                                        $(function(){
                                            $('input[name=file]').change(function () {
                                                let apiUrl = "<?= Yii::$app->params['apiUrl']; ?>";
                                                let len = $('form').length;
                                                var formData = new FormData($('form')[len-1]);
                                                formData.append('file',$(':file')[1].files[0]);
                                                $.ajax({
                                                    url:'<?= Yii::$app->params['apiUrl']."/api/v2/upload/5"; ?>',
                                                    method:'post',
                                                    data: formData,
                                                    //这两个设置项必填
                                                    contentType: false,
                                                    processData: false,
                                                    success:function (data) {
                                                        console.log(data);
                                                        $('#file_img').attr('src',apiUrl+data);
                                                        $('#img_hidden').val(data);
                                                    }
                                                })
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
<!--                            <button class="btn btn-primary submit ajax-post visible-md-inline visible-lg-inline" type="button" id="sub_but">确定</button>-->
                            <button class="btn btn-default return visible-md-inline visible-lg-inline" onclick="javascript:history.back(-1);return false;">返回</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--        <iframe class="hide" name="upload_file" id="upload_file"></iframe>-->
        <?php $this->endBody(); ?>
        <script type="application/javascript">
            $('.uploadify-button').click(function () {
                $(this).prev().trigger('click');
            });
        </script>
    </body>
    </html>
<?php $this->endPage(); ?>