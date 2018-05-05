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
                            <label class="item-label">商品名称<span class="check-tips">（<span class="small">商品名称</span>）</span></label>
                            <div class="controls">
                                <input type="hidden" id="id" name="id" value="<?= $info['id']?>">
                                <input type="text" class="form-control input text" name="name" value="<?= $info['name']?>">
                            </div>
                        </div>
                        <div class="form-group item_title ">
                            <label class="item-label">商品类别<span class="check-tips">（<span class="small">商品类别</span>）</span></label>
                            <div class="controls">
                                <select name="category" class="form-control">
                                    <?php foreach ($categoryInfo as $item): ?>
                                    <option value="<?= $item['id'] ?>" <?php echo $item['id']==$info['c_id']?"selected":"" ?> ><?= $item['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group item_title">
                            <label class="item-label">价格<span class="check-tips"></span></label>
                            <div class="controls">
                                <input type="text" class="form-control input text" name="price" value="<?= $info['price']?>">
                            </div>
                        </div>
                        <div class="form-group item_title">
                            <label class="item-label">库存<span class="check-tips"></span></label>
                            <div class="controls">
                                <input type="text" class="form-control input text" name="stock" value="<?= $info['stock']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="nh_pro" value="new" <?php if($info['is_new'] == '1'):echo "checked"; endif; ?> >最新商品
                            <input type="checkbox" name="nh_pro" value="hot" <?php if($info['is_hot'] == '1'):echo "checked"; endif; ?> >最热商品
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
            let name = $('input[name=name]').val();
            let category = $('select[name=category]').val();
            let price = $('input[name=price]').val();
            let stock = $('input[name=stock]').val();
            let nh_pro = [];
            $('input[name=nh_pro]:checked').each(function () {
                nh_pro.push($(this).val() );
            });
            $.post(common_ops.buildAdminUrl('/product/edit'),{id:id,name:name,price:price,stock:stock,category:category,nh_pro:nh_pro},(data)=>{
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