<?php error_reporting(E_ALL & ~E_NOTICE); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Login</title>
</head>

<body>
	<div id="wrapper">
		<div class="title">LOGIN</div>
		<div id="form">
			<?php
			require_once 'define.php';
			require_once 'functions.php';
			session_start();

			//Lấy dữ liệu từ xml
			$xml = simplexml_load_file(DIR_DATA.'timeout.xml');
			$time = $xml->timeout;

			if ($_SESSION['flagPermission'] == true) {
				if ($_SESSION['timeout'] + $time > time()) {
					if ($_SESSION['role'] == 'member') {
						redirect('members.php');
					}else 	if ($_SESSION['role'] == 'admin') {
						redirect('admin.php');
					}
				} else {
					session_unset();
					redirect('login.php');
				}
			} else {
			?>
				<form action="process.php" method="post" name="add-form">
					<div class="row">
						<p>Username</p>
						<input type="text" name="username" />
					</div>

					<div class="row">
						<p>Password</p>
						<input type="password" name="password" />
					</div>

					<div class="row">
						<input type="submit" value="Đăng nhập" name="submit">
					</div>
				</form>
			<?php
			}
			?>
		</div>

	</div>
</body>

</html>