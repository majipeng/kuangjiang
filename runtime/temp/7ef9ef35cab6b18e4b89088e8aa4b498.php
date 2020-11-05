<?php /*a:2:{s:70:"F:\phpstudy_pro\WWW\www.kuangjia.com\app\admin\view\auth\groupadd.html";i:1604466940;s:70:"F:\phpstudy_pro\WWW\www.kuangjia.com\app\admin\view\public\header.html";i:1604456926;}*/ ?>
<!doctype html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="renderer" content="webkit|ie-comp|ie-stand">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <!-- <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" /> -->
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <link rel="stylesheet" href="/static/admin/css/font.css">
        <link rel="stylesheet" href="/static/admin/css/xadmin.css">
        <link rel="stylesheet" href="/static/admin/lib/layui/css/layui.css">
        <!-- <link rel="stylesheet" href="/static/css/theme5.css"> -->
		 <script type="text/javascript" src="/static/admin/js/jquery.min.js"></script>
        <script src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="/static/admin/js/xadmin.js"></script>
       
        <script>
            // 是否开启刷新记忆tab功能
            // var is_remember = false;
            var platform = 'index';
            $(function(){
                xadmin.close_all();
            });
        </script>
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="index">

<style type="text/css">
.layui-form-item .layui-input-inline { width: 400px;}
.layui-btn{
	  background: #35495D;
	  border:1px solid #35495D;
  }
  .layui-btn:hover{
  	  background: #35495D;
  	  border:1px solid #35495D;
  }
</style>
    <div class="layui-fluid">
        <div class="layui-row">
            <form class="layui-form">
                    <div class="layui-form-item">
                        <label for="name" class="layui-form-label">
                            <span class="x-red">*</span>标题
                        </label>
                        <div class="layui-input-inline">
                        <input type="text" id="title"  autocomplete="off" class="layui-input" placeholder="请输入标题">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="name" class="layui-form-label">
                            <span class="x-red">*</span>选择规则
                        </label>
                        <div class="layui-input-inline">
                             <div class="eletree"></div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label"></label>
                        <a class="layui-btn" id="sbt" href="#">确认</a>
                    </div>
            </form>
        </div>
    </div>
    <input type="hidden" id="jsonstr" value="<?php echo htmlentities($datajson); ?>">
</body>
</html>
<script type="text/javascript" src="/static/admin/js/jquery.min.js"></script>
<script src="/static/admin/lib/layui/lay/mymodules/eleTree.js" charset="utf-8"></script>
<link rel="stylesheet" href="/static/admin/lib/layui/lay/mymodules/eleTree.css">
<script>
layui.config({
    base: '/static/admin/lib/layui/lay/mymodules/'
}).use(['jquery','laydate','form','eleTree'], function(){
    var $ = layui.jquery;
    var laydate = layui.laydate;
    var form = layui.form;
    var eleTree = layui.eleTree;
    var data = JSON.parse($("#jsonstr").val());
    var el =  eleTree.render({
        elem: '.eletree',
        data: data,
        showCheckbox: true,
        highlightCurrent: true,
        showRadio: true,
        defaultExpandAll: true,
        icon: {
          fold: "fold.png",
          leaf: "leaf.png",
          checkFull: ".eletree_icon-check_full",
          checkHalf: ".eletree_icon-check_half",
          checkNone: ".eletree_icon-check_none",
          dropdownOff: ".eletree_icon-dropdown_right",
          dropdownOn: ".eletree_icon-dropdown_bottom",
          loading: ".eleTree-animate-rotate.eletree_icon-loading1",
          radioCheck: "radioCheck.png",
          radioCheckNone: "radioCheckNone.png",
        }
    })

    $(".layui-btn").on("click",function() {
      var strArr = el.getChecked(".eletree");
      var strid = '';
      $.each(strArr,function(i,v){
        strid += v.id+','; 
      });
      //获取所有选中的节点
      strid=strid.substring(0,strid.length-1);
      var title = $("#title").val();
      if(title==''||strid=='')
      {
        layer.msg('请把信息填写完整！', {
            icon: 2,
            time: 1000 //2秒关闭（如果不配置，默认是3秒）
        });
        return false;
      }
      $.ajax({
           type: "POST",
           url: "<?php echo url('Auth/groupadd'); ?>",
           data: {title:title,strid:strid},
           dataType: "json",
           success: function(data){
                if(data==1)
                {
                  layer.msg('操作成功', {
                    icon: 1,
                    time: 1000 //2秒关闭（如果不配置，默认是3秒）
                  }, function(){
                    var index = parent.layer.getFrameIndex(window.name);
                    parent.layer.close(index);
                    parent.location.reload();
                  });    
                }
                if(data==2)
                {
                    layer.msg('操作失败！', {
                        icon: 2,
                        time: 1000 //2秒关闭（如果不配置，默认是3秒）
                    });
                    return false;
                }
                if(data==3)
                {
                    layer.msg('标题和已存在！', {
                        icon: 2,
                        time: 1000 //2秒关闭（如果不配置，默认是3秒）
                    });
                    return false;
                }
           }
       }); 
    });
});
</script>