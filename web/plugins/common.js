var common_ops = {
    init:function(){
        this.eventBind();
        //this.setMenuIconHighLight();
    },
    eventBind:function(){
        $('.navbar-minimalize').click(function () {
            $("body").toggleClass("mini-navbar");
            SmoothlyMenu();
        });

        $(window).bind("load resize scroll", function () {
            if (!$("body").hasClass('body-small')) {
                fix_height();
            }
        });
    },
    setMenuIconHighLight:function(){
        if( $("#side-menu li").size() < 1 ){
            return;
        }
        var pathname = window.location.pathname;
        var nav_name = null;

        if(  pathname.indexOf("/web/dashboard") > -1 || pathname == "/web" || pathname == "/web/" ){
            nav_name = "dashboard";
        }

        if(  pathname.indexOf("/web/account") > -1  ){
            nav_name = "account";
        }

        if(  pathname.indexOf("/web/brand") > -1  ){
            nav_name = "brand";
        }

        if(  pathname.indexOf("/web/book") > -1  ){
            nav_name = "book";
        }

        if(  pathname.indexOf("/web/member") > -1  ){
            nav_name = "member";
        }

        if(  pathname.indexOf("/web/market") > -1  ){
            nav_name = "market";
        }

        if(  pathname.indexOf("/web/finance") > -1  ){
            nav_name = "finance";
        }

        if(  pathname.indexOf("/web/qrcode") > -1  ){
            nav_name = "market";
        }

        if(  pathname.indexOf("/web/stat") > -1  ){
            nav_name = "stat";
        }

        if( nav_name == null ){
            return;
        }

        $("#side-menu li."+nav_name).addClass("active");
    },
    buildWebUrl:function( path ,params){
        var url =   "/web" + path;
        var _paramUrl = '';
        if( params ){
            _paramUrl = Object.keys(params).map(function(k) {
                return [encodeURIComponent(k), encodeURIComponent(params[k])].join("=");
            }).join('&');
            _paramUrl = "?"+_paramUrl;
        }
        //域名
        return url + _paramUrl
        //本地
        // url = url.substr(1,url.length);
        // return Rooturl+url+_paramUrl;
    },
    buildAdminUrl:function( path ,params){//admin url
        var url =   "/admin" + path;
        var _paramUrl = '';
        if( params ){
            _paramUrl = Object.keys(params).map(function(k) {
                return [encodeURIComponent(k), encodeURIComponent(params[k])].join("=");
            }).join('&');
            _paramUrl = "?"+_paramUrl;
        }
        //域名
        return url + _paramUrl

    },
    buildPicUrl:function( bucket,img_key ){
        var upload_config = eval( '(' + $(".hidden_layout_warp input[name=upload_config]").val() +')' );
        var domain = "http://" + window.location.hostname;
        //有域名
        return domain + upload_config[ bucket ] + "/" + img_key;

        //无域名
        //return Rooturl.substr(0,Rooturl.length-1)+upload_config[bucket] + "/" + img_key;
    },
    alert:function( msg ,cb ){
        layer.alert( msg,{
            yes:function( index ){
                if( typeof cb == "function" ){
                    cb();
                }
                layer.close( index );
            }
        });
    },
    confirm:function( msg,callback){
        callback = ( callback != undefined )?callback: { 'ok':null, 'cancel':null };
        layer.confirm( msg , {
            btn: ['确定','取消'] //按钮
        }, function( index ){
            //确定ok事件
            if( typeof callback.ok == "function" ){
                callback.ok();
            }
            layer.close( index );
        }, function( index ){
            //取消事件
            if( typeof callback.cancel == "function" ){
                callback.cancel();
            }
            layer.close( index );
        });
    },
    tip:function( msg,target ){
        layer.tips( msg, target, {
            tips: [ 3, '#e5004f']
        });
        $('html, body').animate({
            scrollTop: target.offset().top - 10
        }, 100);
    },
    msg:function (msg,params) {
        layer.msg(msg,params);
    }
};
function SmoothlyMenu() {
    if (!$('body').hasClass('mini-navbar') || $('body').hasClass('body-small')) {
        // Hide menu in order to smoothly turn on when maximize menu
        $('#side-menu').hide();
        // For smoothly turn on menu
        setTimeout(
            function () {
                $('#side-menu').fadeIn(400);
            }, 200);
    } else if ($('body').hasClass('fixed-sidebar')) {
        $('#side-menu').hide();
        setTimeout(
            function () {
                $('#side-menu').fadeIn(400);
            }, 100);
    } else {
        // Remove all inline style from jquery fadeIn function to reset menu state
        $('#side-menu').removeAttr('style');
    }
}
//将表单数据转换为object对象
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
// Full height of sidebar
function fix_height() {
    var heightWithoutNavbar = $("body > #wrapper").height() - 61;
    $(".sidebard-panel").css("min-height", heightWithoutNavbar + "px");

    var navbarHeigh = $('nav.navbar-default').height();
    var wrapperHeigh = $('#page-wrapper').height();

    if (navbarHeigh > wrapperHeigh) {
        $('#page-wrapper').css("min-height", navbarHeigh + "px");
    }

    if (navbarHeigh < wrapperHeigh) {
        $('#page-wrapper').css("min-height", $(window).height() + "px");
    }

    if ($('body').hasClass('fixed-nav')) {
        if (navbarHeigh > wrapperHeigh) {
            $('#page-wrapper').css("min-height", navbarHeigh - 60 + "px");
        } else {
            $('#page-wrapper').css("min-height", $(window).height() - 60 + "px");
        }
    }
}
/* ajax 快速提交表单 */
function Sub(form,url){
    var formName = form.split(",");
    var serialize = "";
    var a = "";
    for(var i=0;i<formName.length;i++){
        if(serialize == ""){
            a = "";
        }else{
            a = "&";
        }
        serialize += a + $("[name="+formName[i]+"]").serialize();
    }

    $.post(url,serialize,function(data){
        let status = data.status;
        if(status.code == 1){
            if(data.url){
                window.location.href = data.url;
            }else{
                window.location.reload();
            }
        }else{
            common_ops.alert(status.msg);
        }
    },"json");
}

$(document).ready( function() {
    common_ops.init();
});


// 对Date的扩展，将 Date 转化为指定格式的String
// 月(M)、日(d)、小时(h)、分(m)、秒(s)、季度(q) 可以用 1-2 个占位符，
// 年(y)可以用 1-4 个占位符，毫秒(S)只能用 1 个占位符(是 1-3 位的数字)
// 例子：
// (new Date()).Format("yyyy-MM-dd hh:mm:ss.S") ==> 2006-07-02 08:09:04.423
// (new Date()).Format("yyyy-M-d h:m:s.S")      ==> 2006-7-2 8:9:4.18
Date.prototype.Format = function(fmt)
{ //author: meizz
    var o = {
        "M+" : this.getMonth()+1,                 //月份
        "d+" : this.getDate(),                    //日
        "h+" : this.getHours(),                   //小时
        "m+" : this.getMinutes(),                 //分
        "s+" : this.getSeconds(),                 //秒
        "q+" : Math.floor((this.getMonth()+3)/3), //季度
        "S"  : this.getMilliseconds()             //毫秒
    };
    if(/(y+)/.test(fmt))
        fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));
    for(var k in o)
        if(new RegExp("("+ k +")").test(fmt))
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
    return fmt;
};
//判断访问方式
function interviewType() {
    var browser = {
        versions: function() {
            var u = navigator.userAgent,
                app = navigator.appVersion;
            return { //移动终端浏览器版本信息
                trident: u.indexOf('Trident') > -1, //IE内核
                presto: u.indexOf('Presto') > -1, //opera内核
                webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
                gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
                mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
                ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器
                iPhone: u.indexOf('iPhone') > -1, //是否为iPhone或者QQHD浏览器
                iPad: u.indexOf('iPad') > -1, //是否iPad
                webApp: u.indexOf('Safari') == -1, //是否web应该程序，没有头部与底部
                wechat: u.indexOf('MicroMessenger') > -1 //是否微笑浏览器
            };
        }(),
        language: (navigator.browserLanguage || navigator.language).toLowerCase()
    }
    return browser;
}
