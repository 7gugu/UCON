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
	if (isset($_COOKIE["passwsord"])){
	}else{$password=md5(time());
		mysql_query("UPDATE admin SET   password ='{$password}' WHERE email = '{$eamil}' ");}

	}
	$sename=$_GET['se'];
		$query= "SELECT map,sport,sename,max,stime FROM op WHERE username='{$sename}'";
        $result = mysql_query($query) or die("Query failed : " . mysql_error());
        $line = mysql_fetch_array($result, MYSQL_ASSOC);
        $arr=array(
            $line
        );
	extract($arr);
	$stime=$arr[0]["stime"];
	$max= $arr[0]["max"];
    $sename=$arr[0]["sename"];
	$sport= $arr[0]["sport"];
	$map= $arr[0]["map"];
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
								<li>
								
									<a href="ad_admin.php">首页</a>
								</li>
								<li>
									<a href="ad_main.php">服务器列表</a>
								</li>
						
										<li>

			
							</li>
										
									</ul>
								</li>
							</ul>
							<ul class="nav pull-right">
								<li>
									<a >@Root</a>
								</li>
								<li>
									<a href="out.php?out">登出</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
		
				<div class="span12">
					<h1>
						Ucon - <?php echo $sename; ?>
					</h1>
					<div class="hero-unit">
						<address>
				 <strong>服务器控制</strong><br />状态:
				 <?php
                 if($stime=="1"){$sgame="Running";}else{$sgame="Stopping";}				 
				 echo $sgame;
				 ?> 
				 <br /> 
				 服主:<?php echo $name;?></br>
				 人数:<?php echo $max;?><br>
				 端口:<?php echo $sport;?><br>
				 地图:<?php echo $map;?><br>
			</address>
			<div class="col-md-6">
			 
			<button type="button" onClick="location.href='ad_start.php?se=<?php echo $sename;?>'" class="btn btn-success btn-block <?php if($stime=="1"){echo "disabled";}?>">
				Start
			</button> <br>
			<form method="post" action="ad_socket.php?se=<?php echo $sename;?>">
			<button type="button" value="shutdown" class="btn btn-danger btn-block <?php if($stime=="0"){echo "disabled";}?>">
				Stop
			</button>
			</form>
			<?php
			if(isset($_get['e'])){
	$error=$_GET["e"];
			if($error=="501"){
		echo "<div class=\"alert alert-dismissable alert-danger\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">
					×
				</button>
				<h4>
					Waring - ".$error."
				</h4> <strong>错误:</strong>服务器未开启.
			</div>";
	}
			}
	?>
							<style>
			#order{
				bottom:0px;
				left: 0px;
				width: 100%;
				height: 30px;
				line-height: 30px;
				font-size: 17px;
				color: #fff;
				background-color: #000;
			}	
		</style>
  <script type="text/javascript">
function aaa()
{

var x=document.getElementById("cmd").contentWindow.document
x.body.scrollTop= x.body.offsetHeight;
}
</script>
<iframe id="cmd"src="ad_cmd.php?se=<?php echo $sename;?>" width="100%" height="350"
 frameborder="0" border="0" marginwidth="0" marginheight="0" scrolling="0" allowtransparency="0" onload="aaa()" ></iframe>
<form  method="post" action="ad_socket.php?se=<?php echo $sename;?>">
<input id="order" name="order" style="width:100%;" placeholder="在此输入命令"/>
<input type="submit"  class="btn btn-success btn-block" value="发送" />
</form>
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