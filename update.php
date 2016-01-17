
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
	$sename=$_POST['sename'];
if($sename==""){}else{
	$rs=mysql_query("UPDATE op SET   sename ='{$sename}' WHERE username = '{$name}'");
	
}
	$sport=$_POST['sport'];
	if($sport==""){}else{
	mysql_query("UPDATE op SET   sport= '{$sport}' WHERE username = '{$name}'");
}
	$map=$_POST['map'];
if($map==""){}else{
	mysql_query("UPDATE op SET   map= '{$map}' WHERE username = '{$name}'");
}
	$max=$_POST['max'];
if($max==""){}else{
	mysql_query("UPDATE op SET   max= '{$max}' WHERE username = '{$name}'");
}
	$pw=$_POST['pw'];
	if($pw=="null"){
		$pw="";
	}
if($pw==""){}else{
	mysql_query("UPDATE op SET   pw= '{$pw}' WHERE username = '{$name}'");
}
$mode=$_POST['mode'];
if($mode==""){}else{
	$rs=mysql_query("UPDATE op SET   mode ='{$mode}' WHERE username = '{$name}'");
	
}
$Perspective=$_POST['Perspective'];
if($Perspective==""){}else{
	$rs=mysql_query("UPDATE op SET   Perspective ='{$Perspective}' WHERE username = '{$name}'");
	
}
$pvpe=$_POST['pvpe'];
if($pvpe==""){}elseelse{
	$rs=mysql_query("UPDATE op SET   pvpe ='{$pvpe}' WHERE username = '{$name}'");
	
}
$welcome=$_POST['welcome'];
if($welcome==""){}else{
	$rs=mysql_query("UPDATE op SET   welcome ='{$welcome}' WHERE username = '{$name}'");
	
}
header("Location: urg.php");
	?>