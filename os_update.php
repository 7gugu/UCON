﻿

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
$sql="select * from op where username='{$name}' and password='{$password}'";  
$rs=mysql_query($sql); //执行sql查询
$rom=mysql_fetch_array($rs);
	if ($password===$rom['password']){}else{
	header("Location: login.php");
	echo "验证失败";
}
}else{
	echo "验证失败";
	header("Location: login.php");

	}
	$query= "SELECT map,sport,sename,max FROM op WHERE username='{$name}'";
        $result = mysql_query($query) or die("Query failed : " . mysql_error());
        $line = mysql_fetch_array($result, MYSQL_ASSOC);
        $arr=array(
            $line
        );
	extract($arr);
    $sename= $arr[0]["sename"];	
	$sport= $arr[0]["sport"];
	$map= $arr[0]["map"];
	$max= $arr[0]["max"];
	if($sename==""){
		header("Location: login.php?sename");
	}
	//mapi part
				$file = fopen($g_path."\\servers\\".$sename."\\Rocket\\Logs\\Rocket.log", "r") or exit("Unable to open file!");
				$p="0";
				while(!feof($file))
				{
					$rs=fgets($file);
					$p=$p+ substr_count( $rs, "Connecting" );
					if(substr_count( $rs, "Disconnecting" )){
						$p=$p- substr_count( $rs, "Disconnecting" );
					}
				}
               $api= $p;
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
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="#">UCON</a>
						<div class="nav-collapse">
							<ul class="nav">
								<li>
								
									<a href="index.php">首页</a>
								</li>
								<li>
									<a href="main.php">基础操作</a>
								</li>
								<li>
									<a href="command.php">控制台</a>
								</li>
								<li>
							<a href="people.php">在线人数</a>
						</li>
						<li class="dropdown">
									<a href="" class="dropdown-toggle" data-toggle="dropdown">设置<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li>
											<a href="urg.php">参数设置</a>
										</li>
											<li>
								<a href="ch_password.php"><i class=""></i>更改密码</a>
							</li>
										<li>

			
							</li>
										
									</ul>
								</li>
							</ul>
							<ul class="nav pull-right">
								<li>
									<a >@<?php echo $name	;?></a>
								</li>
								<li>
									<a href="out.php">登出</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span3">
					<div class="well" style="padding: 8px 0;">
						<ul class="nav nav-list">
							<li class="nav-header">
								基础
							</li>
							<li>
							
								<a href="index.php"><i class=" icon-home"></i> 首页</a>
							</li>
							<li>
								<a href="main.php"><i class="icon-folder-open"></i> 基础控制</a>
							</li>
							<li>
								<a href="command.php"><i class="icon-check"></i> 控制台</a>
							</li>
							<li class="nav-header">
								杂项
							</li>
							<li>
								<a href="people.php"><i class=""></i> 在线人数</a>
							</li>
							<li>
								<a href="workspace/editor.php"><i class=""></i>在线编辑器</a> 
							</li>
							<li class="nav-header">
								设置
							</li>
							<li>
								<a href="urg.php"><i class=""></i>参数设置</a>
							</li>
							<li>
								<a href="ch_password.php"><i class=""></i>更改密码</a>
							</li>
										
						</ul>
					</div>
				</div>
				<div class="span9">
					<h1>
						版本检测
					</h1>
					<div class="hero-unit">
						<p>
							<?php
$api = file_get_contents('http://www.7gugu.com/ace/ucon/json.php');
$api=json_decode($api,true);
if($api !=$version){
	echo "有新版更新[".$api."]<br>";
	echo "<button class=\"btn btn-small btn-primary btn-warning\" onclick=\"window.location='http://www.7gugu.com'\" type=\"button\">更新版本</button>";
}else{
	echo "暂无更新";
}
?>
						</p>
						<p>
			
						</p>
						<div class="input-append">
</div>
					</div>
					<div class="well summary">
						<ul>
							<li>
								<span class="count"><?php echo $sename;?></span> Server</a>
							</li>
							<li>
								<span class="count"><?php echo $api;?>/<?php echo $max;?></span> People</a>
							</li>
							<li>
								<span class="count"><?php echo $map;?></span> Map</a>
							</li>
							<li class="last">
								<span class="count"><?php echo $sport;?></span> Port</a>
							</li>
						</ul>
					</div>
					
                    <ul class="pager">
						<li class="next">
							Powered by  7gugu 
						</li>
					</ul>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/site.js"></script>
	</body>
</html>