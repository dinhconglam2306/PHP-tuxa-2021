<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Process</title>
</head>

<body>
	<div id="wrapper">
		<div class="title">PROCESS</div>
		<div id="form">
			<?php
			require_once 'functions.php';
			require_once 'define.php';
			session_start();

			//Time out
			$xml = simplexml_load_file(DIR_DATA.'timeout.xml');
			$time = $xml->timeout;

			//check Time Out
			if ($_SESSION['flagPermission'] == true) {
				if ($_SESSION['timeout'] + $time > time()) {
					if ($_SESSION['role'] == 'member') {
						redirect('members.php');
					} else 	if ($_SESSION['role'] == 'admin') {
						redirect('admin.php');
					}
				} else {
					session_unset();
					redirect('login.php');
				}
			} else {
				if (!checkEmpty($_POST['username']) && !checkEmpty($_POST['password'])) {
					$username 	= $_POST['username'];
					$password 	= md5($_POST['password']);
					// Lấy dự liệu từ file json
					$data = file_get_contents(DIR_DATA.'users.json');
					$data = json_decode($data, true);

					$userInfo = [];
					foreach ($data as $valueArr) {
						if ($valueArr['username'] == $username && $valueArr['password'] == $password) {
							$userInfo = $valueArr;
						}
					}
					if ($userInfo['username'] == $username && $userInfo['password'] == $password) {
						$_SESSION['fullName'] 		= $userInfo['fullname'];
						$_SESSION['role'] 		= $userInfo['role'];
						$_SESSION['flagPermission'] = true;
						$_SESSION['timeout'] 		= time();
						if ($userInfo['role'] == 'member') redirect('members.php');
						if ($userInfo['role'] == 'admin')  redirect('admin.php');
					} else {
						redirect('login.php');
					}
				} else {
					redirect('login.php');
				}
			}
			?>
		</div>

	</div>
</body>

</html>