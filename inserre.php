
<?php
require 'pz.php';
///连接数据库
$dblink=mysql_connect($db_ip,$db_username,$db_password) or die("数据库连接失败");
//设置字符串编码
mysql_query("set names utf8");
//选择数据库
mysql_select_db($db_name);
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
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="#">虚无之地</a>
						<div class="nav-collapse">
							<ul class="nav">
								<li>
								
									<a href=""></a>
								</li>
								
						
							</ul>
							<ul class="nav pull-right">
								<li>
									
								</li>
								<li>
									
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
							
								<a href="login.php"> 回家</a>
							</li>
							<li>
								<a href=""> 服务器菌</a>
							</li>
							<li>
								<a href=""> 都会在此</a>
							</li>
							<li>
								<a href=""> 降临的Yo!</a>
							</li>
										
						</ul>
					</div>
				</div>
				<div class="span9">
					<h1>
						Ucon
					</h1>
					<div class="hero-unit">					
						<h2>Get Server</h2>
						<?php
									if(isset($_GET['error'])){
				$error=$_GET['error'];
				echo "<div class=\"alert alert-dismissable alert-danger\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">
					×
				</button>
				<h4>
					Waring
				</h4> <strong>错误:".$error."</strong>!
			</div>";
						}
						?>
						<p class="text-error"><abbr title="购买服务器配额后的问题,一切按服务商的标准解决">这里貌似有点问题</abbr></p>
						
						
	<ul class="left-form">
					
					<?php
					
					if(isset($_GET['add']))//认证码认证S1
	{
		
					$html="
					<form action=\"inserre.php?add1\" method=\"post\">
					<li>
						<input type=\"text\" class=\"span3\" id=\"inser\" name=\"inser\"  placeholder=\"认领码\" />
                        					<input type=\"submit\"  class=\"btn btn-success btn-block\" value=\"下一步\" />
						<div class=\"clear\"> </div>
					</li></form>
					";
					echo $html;
	}
	if(isset($_GET['add1']))//用户设定
	{

		if(isset($_POST['inser'])){
		$inser=$_POST['inser'];
$sql="select * from inser ";  
$rs=mysql_query($sql); //执行sql查询
$rom=mysql_fetch_array($rs);
	if ($inser===$rom['inser']){
		setcookie("inser", $inser, time()+3600);
	}else{
	header("Location: inserre.php?add&error=认证码失效或出错");
					
	}
		}
		$html="
					<form action=\"inserre.php?add2\" method=\"post\">
					<li>
						<input type=\"text\" class=\"span3\" id=\"username\" name=\"username\"  placeholder=\"用户名\" />
						<input type=\"text\" class=\"span3\" id=\"pw\" name=\"pw\"  placeholder=\"用户密码\" />
                        					<input type=\"submit\"  class=\"btn btn-success btn-block\" value=\"下一步\" />
						<div class=\"clear\"> </div>
					</li></form>";
					echo $html;
	}
	if(isset($_GET['add2']))//参数设定
	{
		if(isset($_COOKIE['inser'])){}else{header("Location: inserre.php?add&error=认证码失效或出错");}
		if(isset($_POST['username'])){
				$username=$_POST['username'];
				$us=strlen($username);
				$password=$_POST['pw'];
				$pe=strlen($password);
				if($pe==0){
				header("Location: inserre.php?add1&error=密码为空");	
				}
				if($pe<8){
					header("Location: inserre.php?add1&error=密码长度至少8位");
				}
				if($us==0){
				header("Location: inserre.php?add1&error=用户名为空");	
				}
				
$sql="select * from op ";  
$rs=mysql_query($sql); //执行sql查询
$rom=mysql_fetch_array($rs);
if ($username===$rom['username']){
header("Location: inserre.php?add1&error=用户名已存在");
}else{
	$inser=$_COOKIE['inser'];
		$query= "SELECT dtime,port,sport,max FROM inser WHERE inser='{$inser}'";
        $result = mysql_query($query) or die("Query failed : " . mysql_error());
        $line = mysql_fetch_array($result, MYSQL_ASSOC);
        $arr=array(
            $line
        );
	extract($arr);
	$max= $arr[0]["max"];
    $port= $arr[0]["port"];	
	$sport= $arr[0]["sport"];
	$dtime= $arr[0]["dtime"];
	setcookie("max", $max, time()+3600);
    setcookie("port", $port, time()+3600);
	setcookie("sport", $sport, time()+3600);
    setcookie("dtime", $dtime, time()+3600);
}
	}
	setcookie("username", $username, time()+3600);
    setcookie("password", $password, time()+3600);
	$html="
					<form action=\"inserre.php?add3\" method=\"post\">
					<li>
						<input type=\"text\" class=\"span3\" id=\"sename\" name=\"sename\" placeholder=\"服务器菌的名字\" />	
						<input type=\"text\" class=\"span3\" id=\"pw\" name=\"pw\"  placeholder=\"服务器密码(可不填)\" />
						<div class=\"clear\"> </div>
					</li> 
					<li>
						<input class=\"input-xlarge span3\"  type=\"text\" placeholder=\"地图名字:PEI\" disabled>
					    <input class=\"\" type=\"hidden\" id=\"map\" name=\"map\" value=\"PEI\">
                        <input type=\"text\" class=\"span3\" id=\"Perspective\" name=\"Perspective\"  placeholder=\"游戏视角(默认BOTH)\" />						
						<div class=\"clear\"> </div>
					</li> 
					<li>
						<input type=\"text\" class=\"span3\" id=\"mode\" name=\"mode\"  placeholder=\"游戏难度(默认简单)\" />
						<input type=\"text\" class=\"span3\" id=\"welcome\" name=\"welcome\"  placeholder=\"欢迎语句\" />
						<div class=\"clear\"> </div>
					</li> 
					<li>
					    <input class=\"input-xlarge span3\"  type=\"text\" placeholder=\"服务器后台端口(RCON):{$port}\" disabled>
                        <input class=\"\" type=\"hidden\" id=\"port\" name=\"port\" value=\" {$port}\">
                        <input class=\"input-xlarge span3\"  type=\"text\" placeholder=\"服务器端口:{$sport}\" disabled>
					    <input class=\"\" type=\"hidden\" id=\"sport\" name=\"sport\" value=\"{$sport}\">	
						<div class=\"clear\"> </div>
					</li> 
                    <li>					
                        <input type=\"text\" class=\"span3\" id=\"pvpe\" name=\"pvpe\"  placeholder=\"游戏模式(默认是PVP)\" />
						<input class=\"input-xlarge span3\"  type=\"text\" placeholder=\"服务器人数:{$max}\" disabled>
					    <input class=\"\" type=\"hidden\" id=\"max\" name=\"max\" value=\"{$max}\">
						<div class=\"clear\"> </div>
				</li>
				<li>
				       <input class=\"input-xlarge span3\"  type=\"text\" placeholder=\"服务器使用时间:{$dtime}天\" disabled>
					    <input class=\"\" type=\"hidden\" id=\"dtime\" name=\"dtime\" value=\"{$dtime}\">
						<input type=\"text\" class=\"span3\" id=\"email\" name=\"email\"  placeholder=\"邮箱\" />
						<input type=\"submit\"  class=\"btn btn-success btn-block\" value=\"下一步\" />
				</li>
					</form>";
					echo $html;
	
	}
	if(isset($_GET['add3']))
	{
		$inser=$_COOKIE['inser'];
		$username=$_COOKIE['username'];
		$password=$_COOKIE['password'];
		$sport=$_COOKIE['sport'];
		$max=$_COOKIE['max'];
		$port=$_COOKIE['port'];
		$dtime=$_COOKIE['dtime'];
		$map=$_POST['map'];
		//==============
		$email=$_POST['email'];
		$em=strlen($email);
        if($em==0){
				header("Location: inserre.php?add2&error=邮箱为空");	
				}
		$sename=$_POST['sename'];
		$se=strlen($sename);
        if($se==0){
				header("Location: inserre.php?add2&error=服务器名为空");	
				}
		$pw=$_POST['pw'];
		$mode=$_POST['mode'];
		$mo=strlen($mode);
        if($mo==0){
				$mode="easy";	
				}
		$Perspective=$_POST['Perspective'];
		$pe=strlen($Perspective);
		if($pe==0){
				$Perspective="both";
				}
		$pvpe=$_POST['pvpe'];
		$pv=strlen($pvpe);
		if($pv==0){
				$pvpe="pvp";
				}
		$welcome=$_POST['welcome'];
//====================================
$sql="insert into op(username,password,sport,max,port,dtime,map,sename,pw,mode,Perspective,pvpe,welcome,rtime,email)values('$username','$password','$sport','$max','$port','$dtime','$map','$sename','$pw','$mode','$Perspective','$pvpe','$welcome','0','$email')";
mysql_query($sql);
$row=mysql_affected_rows();
echo $row;
if($row>0)
{
	mysql_query("DELETE FROM inser WHERE inser='{$inser}'");
}else{
   header("Location: inserre.php?add&error=添加失败");
}
//====================================					
					
					$html="
					<h4>添加完成<a href=\"login.php\">开始使用</a></h4>
					";
					echo $html;
	}
	
?>				
              
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