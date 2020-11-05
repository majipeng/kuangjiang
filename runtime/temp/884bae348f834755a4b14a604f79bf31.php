<?php /*a:1:{s:68:"F:\phpstudy_pro\WWW\www.kuangjia.com\app\admin\view\admin\index.html";i:1604542688;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<link href="/static/kaoping/layui/css/layui.css" rel="stylesheet" type="text/css" />
	</head>
	<style>
		*{
			margin: 0;
			padding: 0;
		}
		.top{
			width: 100%;
			height: 70px;
			/* background: red; */
		}
		.t_left{
			width: 220px;
			height: 68px;
			background-color: #35495D;
			float: left;
			text-align: center;
			line-height: 70px;
			color: #fff;
			font-size: 24px;
			border-bottom: 2px solid #5FA5ED;
		}
		.tit{
			height: 22px;
			padding-left: 20px;
			border-left: 4px solid #5FA5ED;
			float: left;
			margin-top: 22px;
			margin-left: 20px;
			font-size: 16px;
		}
		.t_right{
			height: 70px;
			line-height: 70px;
			padding: 0 30px;
			float: right;
			cursor:pointer;
			position: relative;
			right: 30px;
			/* background: blue; */
		}
		.t_right span:hover{
			color: #5FA5ED;
		}
		.gout{
				width: 80px;
				height: 40px;
				position: absolute;
				top: 60px;
				left: 20px;
				background: #fff;
				text-align: center;
				line-height: 40px;
				border: 1px solid #ccc;
				display: none;
		}
		.gout:hover{
			color: #5FA5ED;
			
		}
		.box{
			width: 100%;
			height: auto;
		}
		.nav{
			width: 220px;
			float: left;
			background-color: #35495D;
			padding-top: 20px;
		}

		.silg{
			padding: 10px 15px;
			border-left: 4px solid #35495D;
			color: #fff;
		}
		.silg:hover{
			padding: 10px 15px;
			border-left: 4px solid #5FA5ED;
			color: #5FA5ED;
		}
		.silg a:hover{
			color: #5FA5ED;
		}
		
		.active{
			color: #5FA5ED !important;
			border-left: 4px solid #5FA5ED;
		}
		
		.active>i{
			color: #5FA5ED !important;
		}
		.zlayui-icon{
			font-size: 19px;
		}
		ul{
			padding-top: 10px;
		}
		li{
			color: #fff;
			padding: 10px 26px;
			border-left: 4px solid #35495D;
			cursor: pointer;
		}
		li:hover{
			color: #5FA5ED !important;
			border-left: 4px solid #5FA5ED;
		}
		
		.item ul{
			display:none;
		}
		.ifr{
			float: right;
			padding-right: 20px;
			/* width:82.5% */
			width: calc(100vw - 280px);
			min-width: 1150px;
		}
		
	</style>
	<body>
		<div class="top">
			<div class="t_left">后台管理系统</div>
			<div class="tit">后台管理系统</div>
			<div class="t_right">
				<span><?php echo htmlentities($username); ?> ▼</span>
				<div class="gout"><a href="<?php echo url('admin/login/login'); ?>">退出</a></div>
			</div>
			<div style="clear: both;"></div>
		</div>
		
		<div class="box" style="min-width: 1400px;">
			<div class="nav">
				<?php if(in_array('admin/admin/user',$newArr) or in_array('admin/auth/authgroup',$newArr) or in_array('admin/auth/user',$newArr)): ?>
				<div class="item">
					<div class="silg">
						<i class="layui-icon zlayui-icon" style="margin-right: 10px;">&#xe612;</i>
						<span>权限管理</span>
						<i class="layui-icon zlayui-icon" style="float: right;">&#xe603;</i>
					</div>
					<ul>
						<?php if(in_array('admin/admin/user',$newArr)): ?>
						<li class="zli" href="<?php echo url('admin/user'); ?>">
							<i class="layui-icon" style="margin-right: 6px;">&#xe602;</i>
							<span class="title">管理员用户</span>
						</li>
						<?php endif; if(in_array('admin/auth/authgroup',$newArr)): ?>
						<li class="zli" href="<?php echo url('auth/authgroup'); ?>">
							<i class="layui-icon" style="margin-right: 6px;">&#xe602;</i>
							<span class="title">角色组</span>
						</li>
						<?php endif; if(in_array('admin/auth/authindex',$newArr)): ?>
						<li class="zli" href="<?php echo url('auth/authindex'); ?>">
							<i class="layui-icon" style="margin-right: 6px;">&#xe602;</i>
							<span class="title">权限规则</span>
						</li>
						<?php endif; ?>
						
					</ul>
				</div>
				<?php endif; if(in_array('admin/user/index',$newArr)): ?>
				<div class="item">

					<div class="silg">
						<i class="layui-icon zlayui-icon" style="margin-right: 10px;">&#xe612;</i>
						<span>用户管理</span>
						<i class="layui-icon zlayui-icon" style="float: right;">&#xe603;</i>
					</div>
					<?php if(in_array('admin/user/index',$newArr)): ?>
					<ul>
						<li class="zli" href="<?php echo url('user/index'); ?>">
							<i class="layui-icon" style="margin-right: 6px;">&#xe602;</i>
							<span class="title">用户管理</span>
						</li>
					</ul>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
			
			<iframe class="ifr" src="<?php echo url('admin/welcome'); ?>" runat="server" height="100%"  frameborder="no" border="0" marginwidth="0" marginheight="0" allowtransparency="yes"></iframe>
			
		</div>
	</body>
	<script src="/static/kaoping/js/jquery-1.9.1.min.js"></script>
	<script>



		
						
		var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
		var isOpera = userAgent.indexOf("Opera") > -1;
		
		console.log(isOpera)
		
		window.onresize = function(){
			var docWidth = document.body.clientWidth;
				//动态设置教师风采样式
				$('.ifr').css({
					'width':docWidth-260,
					'height':oheight
				});
		};
	
		if (userAgent.indexOf("Chrome") > -1) {
			var oheight =  window.screen .availHeight-193+"px"
			// var owidth =  window.screen .availWidth-260+"px"
			$(".nav").css("height",oheight)
			// $(".ifr").css("width",owidth).css("height",oheight)
			// $(".ifr").css("height",height)
			$(".ifr").css("height",oheight)
		}else{
			if (document.all && !document.addEventListener){
				var oheight =  window.screen.availHeight-172+"px"
				// var owidth =  window.screen .availWidth-260+"px"
				$(".nav").css("height",oheight)
				
				var docWidth = document.body.clientWidth-260+"px";
				
				$(".ifr").css("width",docWidth).css("height",oheight)
				// $(".ifr").css("height",oheight)
				
				//监听浏览器宽度的改变
				
				
				// alert("ie8")
			}else if (document.all && !window.atob){
				var oheight =  window.screen.availHeight-168+"px"
				// var owidth =  window.screen .availWidth-260+"px"
				$(".nav").css("height",oheight)
				$(".ifr").css("width",owidth).css("height",oheight)
				$(".ifr").css("height",oheight)
			}else if (document.all && document.addEventListener && window.atob){
				var oheight =  window.screen.availHeight-168+"px"
				// var owidth =  window.screen .availWidth-260+"px"
				$(".nav").css("height",oheight)
				// $(".ifr").css("width",owidth).css("height",oheight)
				$(".ifr").css("height",oheight)
			}else{
				var oheight =  window.screen.availHeight-168+"px"
				// var owidth =  window.screen .availWidth-260+"px"
				$(".nav").css("height",oheight)
				// $(".ifr").css("width",owidth).css("height",oheight)
				$(".ifr").css("height",oheight)
			}
			
			
		}

			
			$(".silg").click(function(){
				$(this).siblings("ul").slideToggle("slow");
			})
			
			$(".t_right").hover(function(){
				
			})
			$(".t_right").hover(function(){
			    $(".gout").css("display","block");
			},function(){
			     $(".gout").css("display","none");
			});

		$(".zli").click(function () {
			var href = $(this).attr("href")
			$(".ifr").attr("src",href)
		})
	</script>
</html>
