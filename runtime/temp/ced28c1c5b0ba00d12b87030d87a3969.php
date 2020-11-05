<?php /*a:1:{s:68:"F:\phpstudy_pro\WWW\www.kuangjia.com\app\admin\view\login\login.html";i:1604454014;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
	
	<head>
		<!-- 公用头文件 START -->
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title></title>
		<script src=/static/layui/layui.js></script>
		<script src=/static/admin/js/jquery.min.js></script>
		<script type="text/jscript" src="/static/kaoping/js/jquery-1.9.1.min.js"></script>
		<link rel="stylesheet" href="/static/kaoping/css/index.css" />
		<link rel="stylesheet" href="/static/kaoping/css/reset.css"> <!-- CSS reset -->
	</head>
	<style>
		.ztit{
			width: 100%;
			height: 130px;
			text-align: center;
			line-height: 130px;
			font-size: 26px;
			color: #80919;
			
		}
		.box{
			position: fixed;
			width: 488px;
			height:445px;
			background: #FFF;
			top: 50%;
			left: 50%;
			margin-top: -244px;
			margin-left: -222px;
		}
		.inpbox{
			width: 424px;
			height: 53px;
			background: #ECEEF0;
			border-radius: 0.25rem;
			margin: 0 auto;
			margin-bottom: 36px;
		}
		.inpbox>img{
			width: 20px;
			height: 20px;
			float: left;
			margin-left: 16px;
			margin-top: 16px;
		}
		.inpbox>input{
			width: 80%;
			height: 40px;
			float: left;
			margin-top: 6px;
			border: none;
			outline: none;
			margin-left: 10px;
			background: #ECEEF0;
			line-height: 40px;
		}
		
		.button{
			width: 424px;
			height: 53px;
			background: #3277FC;
			border-radius: 0.25rem;
			margin: 0 auto;
			margin-bottom: 36px;
			color: #fff;
			font-size: 16px;
			text-align: center;
			line-height: 53px;
			font-weight: bold;
		}
	</style>
	<body>
		<img src="/static/kaoping/img/bg.png" class="bg">
		<div class="box">
				<div class="ztit">登录</div>
				
				<div class="inpbox">
					<img src="/static/kaoping/img/cd-icon-username.png" />
					<input type="text" placeholder="请输入账号" id="username"/>
				</div>
				<div class="inpbox">
					<img src="/static/kaoping/img/cd-icon-password.png" />
					<input type="password" placeholder="请输入密码" id="password"/>
				</div>
				<div class="button" id="login">登录</div>
		</div>
			
	</body>
	<script>
		layui.use(['laydate','form','jquery'], function(){
			var laydate = layui.laydate;
			var form = layui.form;
		});
		$(function(){
			$('#login').click(function(){
				var username = $("#username").val();
				var password = $("#password").val();
				if(username==''||password=='')
				{
					layer.msg('用户名、密码不能为空！', {
						icon: 2,
						time: 1000 //2秒关闭（如果不配置，默认是3秒）
					});
					return false;
				}
				$.ajax({
					type: "POST",
					url: "<?php echo url('Login/login_chack'); ?>",
					data: {name:username,password:password},
					dataType: "json",
					success: function(data){
						if(data.code==1)
						{
							window.location.href = "<?php echo url('admin/index'); ?>";
						}
						if(data.code==2)
						{
							layer.msg(data.msg, {
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
</html>
