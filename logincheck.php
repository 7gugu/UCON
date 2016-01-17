<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>控制面板登陆</title>
<link href="css/style.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1"charset="utf-8">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
</head>
<body>
	<div class="main">
	<div class="header" >
			<h1>控制面板登陆</h1>
			<div class="clear"> </div>
			<div class="clear"> </div>
		</div>
<?php
require 'pz.php';
header("content-type:text/html;charset=utf-8");
//连接数据库

$dblink=mysql_connect($db_ip,$db_username,$db_password) or die("数据库连接失败");

//设置字符串编码

mysql_query("set names utf8");

//选择数据库

mysql_select_db($db_name);

//获取表单数据。

$name=$_POST['username'];

$password=$_POST['password'];
//MD5加密
//$password=md5($password); 

$sql="select * from op where username='{$name}' and password='{$password}'";  

$rs=mysql_query($sql); //执行sql查询
 $num=mysql_num_rows($rs); //获取记录数

if($num){ // 用户存在；

   $row=mysql_fetch_array($rs);

   if($password===$row['password']){ //对密码进行判断。

    echo "登陆成功，正在为你跳转至后台页面";

    header("location:index.php");
setcookie("username", $name, time()+3600);
setcookie("password", $password, time()+3600);
    }else{

echo "密码不正确";

echo "<a href='index.html'>返回登陆页面</a>";

} 

}else{

 echo "用户不存在";
 

 echo "<a href='index.html'>返回登陆页面</a>";

}

?>
</body>
</html>