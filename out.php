<?php
if($_GET){
	require 'pz.php';
	$dblink=mysql_connect($db_ip,$db_username,$db_password) or die("数据库连接失败");
//设置字符串编码
mysql_query("set names utf8");
//选择数据库
mysql_select_db($db_name);
$password=md5(time());
		mysql_query("UPDATE admin SET   password ='{$password}' WHERE email = '{$email}' ");
}
setcookie("username", "", time()-3600);
setcookie("password", "", time()-3600);
header("Location: login.php");
?>