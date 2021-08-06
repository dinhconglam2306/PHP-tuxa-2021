<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once 'libs/Form.class.php';
require_once 'libs/functions.php';
require_once 'define.php';
require_once 'connectLogin.php';
session_start();
//Lấy dữ liệu từ xml
if ($_SESSION['flagPermission'] == true) {
    if ($_SESSION['timeout'] + $time > time()) {
        redirect('admin/list.php');
    } else {
        session_unset();
        redirect('login.php');
    }
} else {
    if (!checkEmpty($_POST['username']) && !checkEmpty($_POST['password'])) {
        $username     = $_POST['username'];
        $password     = md5($_POST['password']);

        $query = "SELECT `id`, `username`, `password` FROM `user` WHERE `username` = '$username' AND `password` = '$password'";
        $userInfo = $database->singleRecord($query);
        $mess = '';
        if (!empty($userInfo)) {
            $_SESSION['flagPermission'] = true;
            $_SESSION['timeout']         = time();
            redirect('admin/list.php');
        } else {
            $mess = '<div class="alert alert-danger" role="alert">Tài khoản hoặc mật khẩu không đúng.</div>';
        }
    }
}


//Name
$labelName = Form::label('username', 'Username', false);
$InputName = Form::input('text', 'username', 'username', $_POST['username']);
$rowName = Form::groupFormCol12($labelName, $InputName);

//Password
$labelPass = Form::label('password', 'Password', false);
$InputPass = Form::input('password', 'password', 'password', $_POST['password']);
$rowPass = Form::groupFormCol12($labelPass, $InputPass);

$button = Form::createButton('submit', 'Đăng nhập');
$elmA = Form::createA('index.php', 'Quay về');
$rowColtrol = Form::groupFormCol12($button, $elmA, true);
?>

<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <?php require_once 'html/head.php'; ?>
</head>

<body class="stretched">

    <!-- Document Wrapper
	============================================= -->
    <div id="wrapper" class="clearfix">

        <!-- Content
		============================================= -->
        <section id="content" class="w-100">
            <div class="content-wrap py-0">

                <div class="section p-0 m-0 h-100 position-absolute" style="background: url('images/login-bg.jpg') center center no-repeat; background-size: cover;">
                </div>

                <div class="section bg-transparent min-vh-100 p-0 m-0">
                    <div class="vertical-middle">
                        <div class="container-fluid py-5 mx-auto">
                            <div class="center">
                                <h2 class="text-white">ZendVN</h2>
                            </div>

                            <div class="card mx-auto rounded-0 border-0" style="max-width: 400px; background-color: rgba(255,255,255,0.93);">
                                <div class="card-body" style="padding: 40px;">
                                    <form id="login-form" name="login-form" class="mb-0" action="" method="post">
                                        <h3 class="text-center">Đăng nhập trang quản trị</h3>
                                        <?= $mess ?>
                                        <div class="row">
                                            <?= $rowName; ?>
                                            <?= $rowPass; ?>
                                            <?= $rowColtrol; ?>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="text-center dark mt-3"><small>Copyrights &copy; All Rights Reserved by ZendVN
                                    Inc.</small></div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- #content end -->

    </div><!-- #wrapper end -->
    <?php require_once 'html/script.php'; ?>
</body>

</html>