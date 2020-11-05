<?php /*a:2:{s:71:"F:\phpstudy_pro\WWW\www.kuangjia.com\app\admin\view\auth\authindex.html";i:1604480431;s:70:"F:\phpstudy_pro\WWW\www.kuangjia.com\app\admin\view\public\header.html";i:1604456926;}*/ ?>
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

<style>
.layui-btn+.layui-btn {
    margin-left: 3px;
  }
  .layui-nav-bar{
    display: none;
  }
  .layui-btn{
	  background: #35495D;
	  border:1px solid #35495D;
  }
  .layui-btn:hover{
  	  background: #35495D;
  	  border:1px solid #35495D;
  }
  .layui-btn-danger{
	  background: #f7406b;
	  border:1px solid #f7406b;
  }
  .layui-btn-danger:hover{
  	  background: #f7406b;
  	  border:1px solid #f7406b;
  }
  
  .zlayui-btn{
  	  background: #5FA5ED;
  	  border:1px solid #5FA5ED;
  }
  .zlayui-btn:hover{
  	  background: #5FA5ED;
  	  border:1px solid #5FA5ED;
  }
  .layui-laypage .layui-laypage-curr .layui-laypage-em{
	  background: #35495D !important;
	  /* border:1px solid #35495D; */
  }
  /* 5FA5ED */
  /* 1px solid #f7406b */
</style>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
              <div class="layui-card-body">
                <form class="layui-form layui-col-space5" action="<?php echo url('Auth/authindex_list'); ?>">
          					<div style="height: 30px;line-height: 30px;float: left;">
          						<span style="float: left;"></span>
          						<div class="layui-inline layui-show-xs-block" style="float: left;">
          						      <input type="text" name="title"  placeholder="请输入父级规则名称" autocomplete="off" class="layui-input">
          						</div>
          					</div>
                    <div class="layui-inline layui-show-xs-block">
                        <button class="layui-btn"  lay-filter="search" id="serch" lay-submit><i class="layui-icon">&#xe615;</i></button>
                    </div>
<!--                      <div class="layui-inline layui-show-xs-block">-->
<!--                        <a class="layui-btn layui-btn-small" onclick="window.location.reload();" title="刷新">-->
<!--                        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>-->
<!--                        </a>-->
<!--                      </div>-->
                </form>
                </div>
                <div class="layui-card-body ">
                    <script type="text/html" id="toolbarDemo">
                        <div class="layui-btn-container">
                            <button class="layui-btn layui-btn-sm" onclick="xadmin.open('添加规则','authadd',700,600)">添加规则</button>
                        </div>
                    </script>

                    <table class="layui-hide" id="demo" lay-filter="test"></table>
                    <script type="text/html" id="barDemo">
<!--                        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>-->
                        <a class="zlayui-btn layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
layui.use(['laydate','form','jquery', 'upload','table'], function(){
    var laydate = layui.laydate;
    var form = layui.form;
    var upload = layui.upload;
    var table = layui.table;

    table.render({
        elem: '#demo'
        ,id:'table'
        ,url: '<?php echo url("auth/authindex_list"); ?>' //数据接口
        ,title: '规则表'
        ,page: false //开启分页
        ,toolbar: '#toolbarDemo' //开启工具栏，此处显示默认图标，可以自定义模板，详见文档
        ,defaultToolbar: false//关闭工具栏右侧
        ,cols: [[ //表头
             {field: 'id', title: 'ID', sort: true, fixed: 'left'}
            ,{field: 'title', title: '标题'}
            ,{field: 'name', title: '规则',  sort: true}
            ,{fixed: 'right', title: '操作',align:'center', toolbar: '#barDemo'}
        ]]
    });
    form.on('submit(search)', function (data) {
        table.reload('table', {
            where: data.field,
            page: {
                curr: 1
            }
        });
        return false; // 阻止表单提交
    });
    //监听行工具事件
    table.on('tool(test)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
        var data = obj.data //获得当前行数据
            ,layEvent = obj.event; //获得 lay-event 对应的值
        // console.log(data.id);
        // console.log(layEvent);
        if(layEvent === 'edit'){
            layer.open({
                type: 2,
                title: '编辑',
                shadeClose: true,
                shade: 0.8,
                area: ['700px', '600px'],
                content:['<?php echo url("Auth/authedit"); ?>?id='+data.id, 'no']
            });
        }
        if(layEvent === 'del'){
            layer.confirm('真的删除行么', function(index){
                $.ajax({
                    type: "POST",
                    url: "<?php echo url('Auth/authdel'); ?>",
                    data: {id:data.id},
                    dataType: "json",
                    success: function(data){
                        if(data.code==0)
                        {
                            layer.msg('没有操作权限', {
                                icon: 2,
                                time: 1000 //2秒关闭（如果不配置，默认是3秒）
                            });
                            return false;
                        }
                        if(data.code==1)
                        {
                            layer.msg('操作成功', {
                              icon: 1,
                              time: 1000 //2秒关闭（如果不配置，默认是3秒）
                            }, function(){
                             window.location.reload();
                            });   
                        }
                        if(data.code==2)
                        {
                            layer.msg('删除失败！', {
                                icon: 2,
                                time: 1000 //2秒关闭（如果不配置，默认是3秒）
                            });
                            return false;
                        }
                    }
                });
            });
        }
    });
});
</script>