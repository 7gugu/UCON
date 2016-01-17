<?php
require 'pz.php';
if (isset($_COOKIE["username"])){
$name=$_COOKIE["username"];
$password=$_COOKIE["password"];
//连接数据库
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

	if ($password===$rom['password']){
		$sename= $_GET['se'];
	$query= "SELECT port,username FROM op WHERE sename='{$sename}'";
        $result = mysql_query($query) or die("Query failed : " . mysql_error());
        $line = mysql_fetch_array($result, MYSQL_ASSOC);
        $arr=array(
            $line
        );
	extract($arr);
    $port= $arr[0]["port"];		
    $name= $arr[0]["username"];	
	//socket part
@set_time_limit(0);
$sock = fsockopen("localhost", $port, $errno, $error, 10);//localhost可随意更改为服务端ip
if (!$sock) exit("fail to connect($error).".header("Location:ad_command.php?se=".$name."&e=501"));
socket_set_timeout($sock, 1); 
$buf = "";
       $buf = fgets($sock, 4096);
	    $buf = preg_replace("/\033\[[0-9;]+H/is", "\n", $buf);         
				fputs($sock,"login 123456\n"); 
				$order=$_POST['order'];
				if($order==shutdown){
				$s="0";
mysql_query("UPDATE op SET   stime= '{$s}' WHERE username = '{$name}'");
				}
sleep(1);
fputs($sock,"$order\n"); 
@fclose($sock);
header("Location: ad_command.php?se=".$name."");
    }else {
        header("Location:index.php");
        echo "验证失败";
    }
}
?>