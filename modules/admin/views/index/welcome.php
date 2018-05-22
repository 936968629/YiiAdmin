<?php
use app\common\service\UrlService;
\app\assets\AdminAsset::register($this);
\app\common\service\StaticService::includeAppJsStatic(UrlService::buildWwwUrl('/admin/js/echarts/echarts.js'),app\assets\AdminAsset::className());
?>
<?php $this->beginPage(); ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php $this->head(); ?>
    </head>
    <body>
    <?php $this->beginBody(); ?>
    <div class="info-center">
        <ul class="breadcrumb" style="margin-top: 20px;">

        </ul>
        <div class="builder builder-form-box">
            <div class="builder-container builder-form-container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-12 col-sm-3">
                            <div class="input-group search-form">
                                <input type="text" name="timeOne" id="datetimepicker" class="search-input form-control" value="<?= $date1 ?>" placeholder="日期一">
                                <input type="text" name="timeTwo" id="datetimepicker2" class="search-input form-control" value="<?= $date2 ?>" placeholder="日期二">
                                <span class="input-group-btn"><a class="btn btn-default" href="javascript:;" id="search" ><i class="fa fa-search"></i>按天</a></span>
                            </div>
                        </div>
<!--                        <div class="form-group item_title ">-->
<!--                            <label class="item-label">描述<span class="check-tips"></span></label>-->
<!--                            <div class="controls">-->
<!--                                <input type="text" class="form-control input text" name="description">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <button class="btn btn-primary submit ajax-post visible-md-inline visible-lg-inline" type="button" id="sub_but">确定</button>-->
<!--                            <button class="btn btn-default return visible-md-inline visible-lg-inline" onclick="javascript:history.back(-1);return false;">返回</button>-->
<!--                        </div>-->

                        <div id="data-table" style="width: 1400px;height: 500px;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <link href="/Admin/js/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
        <link href="/Admin/js/datetimepicker/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="/Admin/js/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="/Admin/js/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
        <?php $this->endBody(); ?>
        <script type="application/javascript">
            $(function() {
                // 基于准备好的dom，初始化echarts实例
                var myChart = echarts.init(document.getElementById('data-table'));

                var option = {
                    title: {
                        text: '支付订单数',
                        left:'center'
                    },
                    xAxis: {
                        type: 'category',
                        data: [
                            <?php foreach ($list1 as $item): ?>
                                    <?= "'".$item."'," ?>
                            <?php endforeach; ?>
                            ]
                    },
                    yAxis: {
                        type: 'value'
                    },
                    series: [{
                        data: [
                            <?php foreach ($list2 as $item): ?>
                            <?= "'".$item."'," ?>
                            <?php endforeach; ?>
                        ],
                        type: 'line'
                    }]
                };

                // 使用刚指定的配置项和数据显示图表。
                myChart.setOption(option);

                $('#datetimepicker').datetimepicker({
                    format: 'yy-mm-dd',
                    language:"zh-CN",
                    minView:2,
                    autoclose:true,
                    pickerPosition:'bottom-right'
                });

                $('#datetimepicker2').datetimepicker({
                    format: 'yy-mm-dd',
                    language:"zh-CN",
                    minView:2,
                    autoclose:true,
                    pickerPosition:'bottom-right'
                });

                $("#search").click(function () {
                    var url = common_ops.buildAdminUrl('/index/welcome');
                    var datepicker1 = $('#datetimepicker').val();
                    var datepicker2 = $('#datetimepicker2').val();
                    var newurl = url+ "&timeOne=" +datepicker1+"&timeTwo="+datepicker2;
                    console.log(newurl)
                    // window.location.href = url+"&timeOne="+datepicker1+"&timeTwo="+datepicker2;
                });
            });
        </script>
    </body>
    </html>
<?php $this->endPage(); ?>