


<?php
require 'pz.php';
if (isset($_GET["pw"])){
$name=$_GET["username"];
$password=$_GET["password"];
$pw=$_GET['pw'];
///连接数据库
$dblink=mysql_connect($db_ip,$db_username,$db_password) or die("数据库连接失败");
//设置字符串编码
mysql_query("set names utf8");
//选择数据库
mysql_select_db($db_name);
//$password=md5($password); 
$sql="select * from op where username='{$name}' and password='{$password}'";  
$rs=mysql_query($sql); //执行sql查询
$num=mysql_num_rows($rs); //获取记录数
$rom=mysql_fetch_array($rs);
	if ($password===$rom['password']){}else{
	
	echo "验证失败";
}
}else{
	echo "传参出错";
	
	}
$s=strlen($pw);
if($s<8){}else{
	mysql_query("UPDATE op SET   password ='{$pw}' WHERE username = '{$name}'");
echo $pw;}
?>