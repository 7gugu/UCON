<?php
require 'pz.php';
if (isset($_COOKIE["username"])){
$name=$_COOKIE["username"];
$password=$_COOKIE["password"];
///连接数据库
$dblink=mysql_connect($db_ip,$db_username,$db_password) or die("数据库连接失败");
//设置字符串编码
mysql_query("set names utf8");
//选择数据库
mysql_select_db($db_name);
//$password=md5($password); 
$sql="select * from admin where username='{$name}' and password='{$password}'";  
$rs=mysql_query($sql); //执行sql查询
$num=mysql_num_rows($rs); //获取记录数
$rom=mysql_fetch_array($rs);
	if ($password===$rom['password']){}else{
	header("Location: index.html");
	echo "验证失败";
}
}else{
	echo "验证失败";
	header("Location: index.html");

	}
	if(isset($_GET['dels'])){
	$dels=$_GET['dels'];
	mysql_query("DELETE FROM op WHERE sename='{$dels}'");
	header("Location: ad_main.php");
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
	<head>
	
		<meta charset="utf-8">
		<title>Ucon - 7gugu</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="css/site.css" rel="stylesheet">
		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	</head>
	<body>
		<div class="container">
			<div class="navbar">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="#">维护模式</a>
						<div class="nav-collapse">
							<ul class="nav">
								<li class="">
								
									<a href="ad_admin.php">首页</a>
								</li>
								<li>
									<a href="ad_main.php">服务器列表</a>
								</li>
						
										<li>

			
							</li>
										
									</ul>
								
							
							<ul class="nav pull-right">
								<li>
									<a >@Root</a>
								</li>
								<li>
									<a href="out.php">登出</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
		
			<h3 class="text-center ">
				删除服务器
			</h3> 
			 <a href="ad_delserver.php?dels=<?php if(isset($_GET['del'])){$del=$_GET['del'];echo $del;} ?>" class="btn btn-block btn-danger <?php if(isset($_GET['del'])){$del=$_GET['del'];}else{echo "disabled";} ?>" type="button">删除主机</a>
			<ul>
				<li>
					删除服务器后将无法恢复
				</li>
				<li>
					删除后服务器将立马下机
				</li>
				<li>
					请谨慎操作
				</li>
			</ul>
		</div>
		<div class="col-md-4">
		</div>
	</div>
</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/site.js"></script>
	</body>
</html>