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
	header("Location: ad_main.php");
	echo "验证失败";
}
}else{
	echo "验证失败";
	header("Location: ad_main.php");
	if (isset($_COOKIE["passwsord"])){
	}else{$password=md5(time());
		mysql_query("UPDATE admin SET   password ='{$password}' WHERE email = '{$eamil}' ");}

	}
	$max=$_POST["max"];
	$dtime=$_POST["dtime"];
	function getRandChar($length){
   $str = null;
   $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
   $max = strlen($strPol)-1;

   for($i=0;$i<$length;$i++){
    $str.=$strPol[rand(0,$max)];
   }

   return $str;
  }
  $inser=getRandChar("10");
	$arr=range(2000,3000);//端口分配范围,第一个为起始范围,第二个为结束
  shuffle($arr);
foreach($arr as $values)
{
  $query= "SELECT * FROM op WHERE sport='{$values}'";
  $rs=mysql_query($query);
  $num=mysql_num_rows($rs);
  if($num){
  }else{
	  $port=$values;
	  break;
  }
}
$arr=range(4000,5000);//端口分配范围,第一个为起始范围,第二个为结束
  shuffle($arr);
foreach($arr as $values)
{
  $query= "SELECT * FROM op WHERE sport='{$values}'";
  $rs=mysql_query($query);
  $num=mysql_num_rows($rs);
  if($num){
  }else{
	  $sport=$values;
	  break;
  }
}
//=============================
//$sql="insert into op(username,password,sename,map,sport,max,pw,port,email,pvpe,Perspective,welcome)values('$name','$password','$sename','$map','$sport','$max','$pw','$port',$email,$pvpe,$Perspective,$welcome)";
$sql="insert into inser(sport,max,port,dtime,inser)values('$sport','$max','$port','$dtime','$inser')";
mysql_query($sql);
$row=mysql_affected_rows();
if($row>0)
{
 header("Location: ad_main.php?ok");
}else{
   header("Location: ad_main.php?error");
}
?>