<?php
set_time_limit (0);
 error_reporting(0); 
require_once "email.class.php";
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
		<title>Root Login - Ucon</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="css/site.css" rel="stylesheet">
		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	</head>
	<body>
		<div id="login-page" class="container">
			<h1>Ucon Login</h1>
			<?php
			if ($_POST){
$name=$_POST["username"];
$password=$_POST["password"];
//$password=md5($password); 
$sql="select * from admin where username='{$name}' and password='{$password}'";  
$rs=mysql_query($sql); //执行sql查询
$num=mysql_num_rows($rs); //获取记录数
$rom=mysql_fetch_array($rs);
			if ($password===$rom['password']){
		header("Location: ad_admin.php");
		setcookie("username", $name, time()+3600);
setcookie("password", $password, time()+3600);
	}else{
	echo "<div class=\"alert alert-dismissable alert-danger\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">
					×
				</button>
				<h4>
					Waring
				</h4> <strong>错误:</strong>无法查询到你的用户名
			</div>";
}
			}
	if (isset($_GET["gp"])){
		function getRandChar($length){
   $str = null;
   $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
   $max = strlen($strPol)-1;

   for($i=0;$i<$length;$i++){
    $str.=$strPol[rand(0,$max)];
   }

   return $str;
  }
		$password=md5(getRandChar("10"));
		$query= "SELECT email FROM admin ";
        $result = mysql_query($query) or die("Query failed : " . mysql_error());
        $line = mysql_fetch_array($result, MYSQL_ASSOC);
        $arr=array(
            $line
        );
	extract($arr);
	$email=$arr[0]["email"];
		mysql_query("UPDATE admin SET   password ='{$password}' WHERE email ='{$email}' ");
					$smtpemailto = $email;//发送给谁
					
	$mailtitle = "Root Password - Ucon";//邮件主题
	$mailcontent = "<link href=\"cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.css\" rel=\"stylesheet\"><h1>Hello 超级管理员 ,你的密码为:".$password."</h1><br><br><footer>---Power By CTOS</footer>";//邮件内容
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
						if($state==""){
		echo "<div class=\"alert alert-dismissable alert-danger\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">
					×
				</button>
				<h4>
					Waring
				</h4> <strong>错误:</strong>发送失败,请联系管理员
			</div>";
	}else{
		echo "<div class=\"alert alert-dismissable alert-success\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">
					×
				</button>
				<h4>
					Success
				</h4> <strong>成功:</strong>邮件发送成功,注意查收
			</div>";
	}
						}
			
			?>
			<form id="login-form" class="well" action="ad_login.php" method="post">
			<input type="text" class="span2" name="username" id="username" placeholder="Username" /><br />
			<input type="password" class="span2" name="password" id="password" placeholder="Password" /><br />
			<a href="ad_login.php?gp"></i>Get Password</a><br />
			<a href="login.php"></i>返回</a><br>
			
			<button type="submit" class="btn btn-primary">Sign in</button>
		</form>	
		
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/site.js"></script>
	</body>
</html>