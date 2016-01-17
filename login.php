
<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
	<head>
		<meta charset="utf-8">
		<title>Login - Ucon</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="css/site.css" rel="stylesheet">
		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	</head>
	<body>
		<div id="login-page" class="container">
			<h1>Ucon Login</h1>
			<form id="login-form" class="well" action="logincheck.php" method="post">
			<input type="text" class="span2" name="username" id="username" placeholder="Username" /><br />
			<input type="password" class="span2" name="password" id="password" placeholder="Password" /><br />
			<a href="re_password.php"></i>忘记密码?</a> &nbsp;<a href="ad_login.php"></i>管理员登陆</a>&nbsp;<a href="inserre.php?add"></i>注册</a><br />
			
			<button type="submit" class="btn btn-primary">Sign in</button>
		</form>	
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/site.js"></script>
	</body>
</html>