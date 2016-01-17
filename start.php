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

	if ($password===$rom['password']){
	$query= "SELECT sename,map,sport,max,pw,mode,Perspective,pvpe,welcome,port,rtime FROM op WHERE username='{$name}'";
        $result = mysql_query($query) or die("Query failed : " . mysql_error());
        $line = mysql_fetch_array($result, MYSQL_ASSOC);
        $arr=array(
            $line
        );
	extract($arr);
	$sename= $arr[0]["sename"];	
	$map= $arr[0]["map"];	
	$sport= $arr[0]["sport"];	
	$max= $arr[0]["max"];	
    $pw= $arr[0]["pw"];	
	$mode= $arr[0]["mode"];	
	$Perspective= $arr[0]["Perspective"];	
	$pvpe= $arr[0]["pvpe"];	
	$welcome= $arr[0]["welcome"];	
	$port= $arr[0]["port"];	
	$rtime=$arr[0]["rtime"];
$p="$g_path\Servers\\$sename\\server";
echo $p;
//check the list
if (!file_exists($p))
{ 
mkdir ($p,0777,true);
echo "文件夹创建成功";
    }else{
        echo "文件夹已创建";
    }
	if($rtime=="0"){
//create xml
$xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
$xml .= "<RocketSettings xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\">\n";
$xml .= "<RCON Enabled=\"true\" Port=\"{$port}\" Password=\"123456\"/>\n";
$xml .= "<AutomaticShutdown Enabled=\"false\" Interval=\"0\" />\n";
$xml .= "<WebConfigurations Enabled=\"false\" Url=\"\" />\n";
$xml .= "<WebPermissions Enabled=\"false\" Url=\"\" Interval=\"180\" />\n";
$xml .= "<LanguageCode>en</LanguageCode>\n";
$xml .= "</RocketSettings>\n";
echo $xml;
$file="$g_path\Servers\\$sename\Rocket\Rocket.config.xml";
$handle=fopen($file,"w+");
fwrite($handle,$xml);
fclose($handle); 
//create the txt
$file="$p\\Commands.dat";
$handle=fopen($file,"w+");
fwrite($handle,"name ".$sename."\r\n");
fwrite($handle,"map ".$map."\r\n");
fwrite($handle,"port ".$sport."\r\n");
fwrite($handle,"maxplayer ".$max."\r\n");
fwrite($handle,"password ".$pw."\r\n");
fwrite($handle,"mode ".$mode."\r\n");
fwrite($handle,"Perspective ".$Perspective."\r\n");
fwrite($handle,"welcome ".$welcome."\r\n");
fwrite($handle,$pvpe);
fclose($handle); 
//creat hello.txt
$file2=$g_path."\\servers\\".$sename."\\hello.txt";
echo $file2;
$handle=fopen($file2,"w+");
fwrite($handle,"Hello guys\r\n");
fwrite($handle,"welcome to use the Hrun editor\r\n");
fclose($handle); 
//UPDATE TIME
$s="1";
mysql_query("UPDATE op SET   rtime= '{$s}' WHERE username = '{$name}'");
$file1="$g_path\\name.txt";
$handle1=fopen($file1,"w+");
fwrite($handle1,$sename);
mysql_query("UPDATE op SET   rtime= '1' WHERE username = '{$name}'");
fclose($handle1); 
header("Location: main.php");
	}else{
		echo "已开服！";
		header("Location: main.php");
	}
}
}
?> 