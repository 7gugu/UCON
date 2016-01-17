<?php
require'pz.php';
require_once "email.class.php";

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
	<head>
		<meta charset="utf-8">
		<title>Find the Password - Ucon</title>
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
			if($_POST){
	
$name=$_POST["username"];
///连接数据库
$dblink=mysql_connect("localhost","root","root") or die("数据库连接失败");
//设置字符串编码
mysql_query("set names utf8");
//选择数据库
mysql_select_db($db_name); 
$sql="select * from op where username='{$name}'";  
$rs=mysql_query($sql); //执行sql查询
$num=mysql_num_rows($rs); //获取记录数
		if ($num){
			$query= "SELECT password,email FROM op WHERE username='{$name}'";
$result = mysql_query($query) or die("Query failed : " . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$arr=array(
	$line
);
extract($arr);
$password= $arr[0]["password"];
$email= $arr[0]["email"];
$smtpemailto = $email;//发送给谁
	$mailtitle = "Find out rhe password - Ucon";//邮件主题
	$mailcontent = "<h1>Hello ".$_POST['username'].",你的密码为:".$password."</h1>";//邮件内容
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
					Faild!
				</h4> <strong>Warning!</strong> 重置邮件发送失败,请稍后再试
			</div>";
	}else{
		echo "<div class=\"alert alert-dismissable alert-success\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">
					×
				</button>
				<h4>
					Success
				</h4> <strong>成功</strong> 请前往邮箱获取密码
			</div>";
	}
}else{
	echo "<div class=\"alert alert-dismissable alert-danger\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">
					×
				</button>
				<h4>
					Waring
				</h4> <strong>错误</strong>无法查询到你的用户名
			</div>";
	

	}
			}
			?>
				
			<form id="login-form" class="well" action="re_password.php" method="post">
			<h4>请输入用户名</h4>
			<input type="text" class="span2" name="username" id="username" placeholder="username" /><br />
			
			<button type="submit" class="btn btn-primary">Find!</button>&nbsp;<a href="login.php"></i>返回</a>
		</form>	
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/site.js"></script>
	</body>
</html>