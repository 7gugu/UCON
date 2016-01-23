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
	//header("Location: http://localhost/ace/uphp/index.html");
	echo "验证失败";
}
}else{
	echo "验证失败";
	//header("Location: http://localhost/ace/uphp/index.html");

	}
	$query= "SELECT map,sport,sename FROM op WHERE username='{$name}'";
        $result = mysql_query($query) or die("Query failed : " . mysql_error());
        $line = mysql_fetch_array($result, MYSQL_ASSOC);
        $arr=array(
            $line
        );
	extract($arr);
    $sename= $arr[0]["sename"];	
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<META HTTP-EQUIV=REFRESH CONTENT="12">
		<title>Unturned控制台</title>
		<meta name="viewport" content="width=device-width">
		<style>
		
		body{
			position: absolute;	
			background-color: #000;
			
		}
			#output{
				top:0px;
				left: 0px;
				width: 100%;
				margin: 0px;
			}
			#order{
				position: absolute;
				bottom:0px;
				left: 0px;
				width: 100%;
				height: 30px;
				line-height: 30px;
				font-size: 17px;
				color: #fff;
				background-color: #000;
			}
			table{
				color: #fff;
				text-align: left;
				word-break: initial;
			}
			.w{
				color: #fff;
			}
			
     

			
		</style>
		
	</head>
	<body>
	<pre id="output">
	<?php
	

//请更改fopen()后的地址，并按照范例修改,$name需要保留
$file = fopen($g_path."\\Servers\\$sename\\Rocket\\Logs\\Rocket.log", "r") or exit("Unable to open file!");
while(!feof($file))
{

 echo "<span class='w'>";
 $rs=fgets($file);
 $rs = str_replace ( "[Exception] Rocket.CoreException in Rocket.Core: System.IO.IOException: Write failure ---> System.Net.Sockets.SocketException: 您的主机中的软件中止了一个已建立的连接。", "Error!", $rs ); 
 $rs=str_replace ("at System.Net.Sockets.Socket.Send (System.Byte[] buf, Int32 offset, Int32 size, SocketFlags flags) [0x00000] in <filename unknown>:0","",$rs);
 $rs=str_replace ("at System.Net.Sockets.NetworkStream.Write (System.Byte[] buffer, Int32 offset, Int32 size) [0x00000] in <filename unknown>:0 ","",$rs);
 $rs=str_replace ("  --- End of inner exception stack trace ---","",$rs);
 $rs=str_replace (" at System.Net.Sockets.NetworkStream.Write (System.Byte[] buffer, Int32 offset, Int32 size) [0x00000] in <filename unknown>:0 ","",$rs);
 $rs=str_replace ("at Rocket.Core.RCON.RCONServer.Send (System.Net.Sockets.TcpClient client, System.String text) [0x00000] in <filename unknown>:0","",$rs);
 $rs=str_replace (" at Rocket.Core.RCON.RCONConnection.Send (System.String command, Boolean nonewline) [0x00000] in <filename unknown>:0 ","",$rs);
 $rs=str_replace ("  at Rocket.Core.RCON.RCONServer.handleConnection (System.Object obj) [0x00000] in <filename unknown>:0 ","",$rs);
 $rs=trim($rs);
 //输出结果
 echo $rs. "<br />";

 echo "</span>";

}
fclose($file);
?>
</pre>
<script type="text/javascript">
console.log ("Powered by 7gugu");
</script>
	</body>
	</html>