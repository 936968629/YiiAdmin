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
                            <label class="item-label">订单号</label>
                            <div class="controls">
                                <input type="text" value="<?php echo $info['order_no'] ?>" name="order_no" readonly>
                            </div>
                        </div>
                        <div class="form-group item_title ">
                            <label class="item-label">详细信息</label>
                            <div class="controls">
                                <input type="hidden" name="id" value="<?php if(!empty($info) ) echo $info['id']; ?>">
                                <textarea rows="4" cols="100" name="addressInfo"><?php echo $addressInfo ?></textarea>
                            </div>
                        </div>
                        <div class="form-group item_title ">
                            <label class="item-label">购买用户id</label>
                            <div class="controls">
                                <input type="text" name="user_id" value="<?php echo $info['user_id'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group item_title ">
                            <label class="item-label">总价格</label>
                            <div class="controls">
                                <input type="text" name="total_price" value="<?php echo $info['total_price'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group item_title ">
                            <label class="item-label">商品信息</label>
                            <div class="controls">
                                <input type="text" name="snap_name" value="<?php echo $info['snap_name'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group item_title ">
                            <label class="item-label">订单状态</label>
                            <div class="controls">
                                <label>
                                    <?php
                                        if($info['status'] == 1){
                                            echo "未支付";
                                        }else if($info['status'] == 2){
                                            echo "已支付";
                                        }else if($info['status'] == 3){
                                            echo "已发货";
                                        }else if($info['status'] == 4){
                                            echo "已支付，但库存不足";
                                        }else if($info['status'] == 5){
                                            echo "已收货";
                                        }else if($info['status'] == 6){
                                            echo "申请退货";
                                        }
                                    ?>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary submit ajax-post visible-md-inline visible-lg-inline" type="button" id="sub_but">确定</button>
                            <button class="btn btn-default return visible-md-inline visible-lg-inline" onclick="javascript:history.back(-1);return false;">返回</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endBody(); ?>
        <script type="application/javascript">

        </script>
    </body>
    </html>
<?php $this->endPage(); ?>