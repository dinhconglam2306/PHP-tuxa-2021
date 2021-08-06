<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Process</title>
</head>

<body>
	<div id="wrapper">
		<div class="title">ADMIN</div>
		<div id="form">
			<?php
			require_once 'functions.php';
			require_once 'define.php';
			session_start();

			// Lấy dự liệu time out từ xml
			$xml = simplexml_load_file(DIR_DATA.'timeout.xml');
			$time = $xml->timeout;
			if (isset($_POST['timeout'])) {
				$timeout = $_POST['timeout'];
				$xml->timeout = $timeout;
				file_put_contents(DIR_DATA.'.timeout.xml', $xml->asXML());
			}

			//Check time out
			if ($_SESSION['flagPermission'] == true) {
				if ($_SESSION['timeout'] + $time > time()) {
					if ($_SESSION['role'] != 'admin') {
						redirect('members.php');
					} else {
			?>
						<form action="" method="post" name="add-form">
							<h3>Xin chào: <?= $_SESSION['fullName'] ?> </h3>
							<div class="row">
								<h5>Time Out hiện tại : <?= $time ?>s</h5>
							</div>
							<div class="row">
								Set Time Out <input type="text" name="timeout" value="<?= $time?>"/>
								<input  name="submit" type="submit" value="Save" />
							</div>
						</form>
						<a href="logout.php">Đăng xuất</a>'
					<?php
					}
					?>
			<?php

				} else {
					session_unset();
					redirect('login.php');
				}
			} else {
				redirect('login.php');
			}
			?>
		</div>

	</div>
</body>

</html>