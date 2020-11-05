<?php /*a:2:{s:65:"F:\phpstudy_pro\WWW\www.kuangjia.com\app\admin\view\user\add.html";i:1604473328;s:70:"F:\phpstudy_pro\WWW\www.kuangjia.com\app\admin\view\public\header.html";i:1604456926;}*/ ?>
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
                            <span class="x-red">*</span>账号
                        </label>
                        <div class="layui-input-inline">
                        <input type="text" id="name"  autocomplete="off" class="layui-input" placeholder="请输入账号">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label"></label>
                        <a class="layui-btn" onclick="sbt()" href="#">确认</a>
                    </div>
            </form>
        </div>
    </div>
</body>
</html>
<script>
layui.use(['laydate','form','jquery', 'upload'], function(){
    var laydate = layui.laydate;
    var form = layui.form;
    var upload = layui.upload;
    var uploadInst = upload.render({
        elem: '#upload_img_icon' //绑定元素
        ,url: '<?php echo url("Admin/imgupload"); ?>' //上传接口
        ,done: function(res){
            console.log(res.filename);
            $("#img").html(' ');
            $('#img').append('<img src="/'+res.filename+'" style="width:200px;height:200px;"/>');
            $("#imagepath").val("/"+res.filename);
        }
        ,error: function(){
            //请求异常回调
        }
    });
}); 
//全删
function sbt()
{
  var name = $("#name").val();
  if(name=='')
  {
      layer.msg('请把信息填写完整！', {
          icon: 2,
          time: 1000 //2秒关闭（如果不配置，默认是3秒）
      });
      return false;
  }
  $.ajax({
       type: "POST",
       url: "<?php echo url('User/add'); ?>",
       data: {name:name},
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
                layer.msg('账号已经存在！', {
                    icon: 2,
                    time: 1000 //2秒关闭（如果不配置，默认是3秒）
                });
                return false;
            }
       }
   }); 
}
</script>