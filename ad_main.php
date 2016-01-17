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
	$query= "SELECT map,sport,sename,max FROM op WHERE username='{$name}'";
        $result = mysql_query($query) or die("Query failed : " . mysql_error());
        $line = mysql_fetch_array($result, MYSQL_ASSOC);
        $arr=array(
            $line
        );
	extract($arr);
	$max= $arr[0]["max"];
    $sename= $arr[0]["sename"];	
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
								<li class="active">
									<a href="ad_main.php">服务器列表</a>
								</li>
						
										<li>
                                    <a href="ad_inser.php">认证码列表</a>
			
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
				<div class="span3">
					<div class="well" style="padding: 8px 0;">
						<ul class="nav nav-list">
							<li class="nav-header">
								基础
							</li>
							<li>
							
								<a href="ad_admin.php"><i class=" icon-home"></i> 首页</a>
							</li>
							<li class="active">
								<a href="ad_main.php"><i class="icon-th"></i> 服务器列表</a>
							</li>
							<li>
								<a href="ad_inser.php"><i class="icon-shopping-cart  "></i>认证码列表</a>
							</li>
							
										
						</ul>
					</div>
				</div>
				<div class="span9">
				
					<h1>
						Server List
					</h1>
					<?php
					if(isset($_GET['ok'])){
						echo "<div class=\"alert alert-dismissable alert-success \">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">
					×
				</button>
				<h4>
					Waring
				</h4> <strong>完成:</strong>添加完毕!
			</div>";
					}
					if(isset($_GET['error'])){
						echo "<div class=\"alert alert-dismissable alert-danger\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">
					×
				</button>
				<h4>
					Waring
				</h4> <strong>错误:</strong>未知错误,建议进入数据库调试
			</div>";
					}
					?>
					<ul class="files zebra-list">
						
						 <?php
                            $exec="select * from op";
                            $result=mysql_query($exec);
                            while($rs=mysql_fetch_object($result)){
                                $username=$rs->username;
                                $sename=$rs->sename;                   
                        ?>
                    
                    <li>
						<i class="icon-file"></i>
                
						 <a class="title" href="ad_command.php?se=<?php echo $username; ?>"><?php echo $sename; ?></a><a class="close" href="ad_delserver.php?del=<?php echo $sename; ?>">&times;</a> <span class="meta">服主:<em><?php echo $username; ?></em> </span>
						
						</li>
						<?php
                    }
                    
                ?>
					</ul>
					<a class="toggle-link" href="#new-file"><i class="icon-plus"></i> New File</a>
					<form id="new-file" action="ad_addserver.php" class="form-horizontal hidden" method="post">
						<fieldset>
							<legend>New Server</legend>
							<div class="control-group">
								<label class="control-label" for="textarea">使用时间</label>
								<div class="controls">
									<input type="text" class="input-xlarge" id="dtime" name="dtime"/>
								</div>
							</div>
							
							
							<div class="control-group">
								<label class="control-label" for="textarea">Maxplayer</label>
								<div class="controls">
									<input type="text" class="input-xlarge" id="max" name="max"/>
								</div>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Create</button> <button class="btn">Cancel</button>
							</div>
						</fieldset>
					</form>
					
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