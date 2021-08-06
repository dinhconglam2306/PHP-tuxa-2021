<?php
require_once 'libs/Validate.class.php';
require_once 'libs/Mail.php';
require_once 'libs/Form.php';

error_reporting(E_ALL & ~E_NOTICE);
$errors = '';
$result = [];
$message = '';
if (!empty($_POST)) {
    $source = $_POST;
    require_once 'libs/Validate.class.php';
    $validate = new Validate($source);

    //Rule
    $validate->addRule('name', 'string', 5, 100)
        ->addRule('email', 'email')
        ->addRule('title', 'string', 5, 100)
        ->addRule('message', 'string', 5, 100);

    $validate->run();
    $errors = $validate->showErrors();
    $result = $validate->getResult();
    if (empty($errors)) {
        $adminInfo = $validate->getFileJson('./data/configEmail.json');
        $mail = new Mail($adminInfo);
        $check = $mail->sendMail($adminInfo, $result);
        if ($check) {
            $message = '<p style="color:blue;">Bạn đã gửi thành công</p>';
        } else {
            $message = '<p style="color:red;">Bạn đã gửi không thành công</p>';
        }
    }
}
//Name
$labelName = Form::label('name','Họ và Tên',true);
$InputName = Form::input('text','name','name',$result['name']);
$rowName = Form::groupFormCol12($labelName,$InputName);

//Mail
$labelEmail = Form::label('email','Email',true);
$InputEmail = Form::input('email','email','email',$result['email']);
$rowEmail = Form::groupFormCol12($labelEmail,$InputEmail);

//Title
$labelTitle = Form::label('title','Tiêu đề',true);
$InputTitle = Form::input('text','title','title',$result['title']);
$rowTitle = Form::groupFormCol12($labelTitle,$InputTitle);

//Textarea
$labelTextarea = Form::label('message','Nội dung',true);
$InputTextarea = Form::textarea('message','message',$result['message']);
$rowTextarea = Form::groupFormCol12($labelTextarea,$InputTextarea);

//Button
$button = Form::button('submit','Gửi tin
nhắn');
$rowButton = Form::groupFormCol12($button,false);

//col-sm-6 col-lg-4
//Địa chỉ
$address = Form::groupFormColSm6ColLg4('icon-map-marker2','Địa chỉ','Tầng 5, Tòa nhà Songdo, 62A Phạm Ngọc Thạch,
Phường 6, Quận 3, HCM');
//Hotline
$hotline = Form::groupFormColSm6ColLg4('icon-phone3','Hotline','090 5744 470 <br /> 0383 308 983');
//Email
$email = Form::groupFormColSm6ColLg4('icon-email','Email','training@zend.vn');
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <?php require_once 'html/head.php'; ?>
</head>

<body class="stretched">
    <div id="wrapper" class="clearfix">
        <!-- PAGE HEADER -->
        <?php require_once 'html/header.php'; ?>
        <!-- PAGE TITLE -->
        <?php require_once 'html/page-title.php'; ?>
        <!-- Content
		============================================= -->
        <section id="content">
            <div class="content-wrap">
                <div class="container clearfix">
                    <div class="row align-items-stretch col-mb-50 mb-0">
                        <!-- Contact Form -->
                        <div class="col-lg-6">
                            <div class="fancy-title title-border">
                                <h3>Gửi tin nhắn cho chúng tôi</h3>
                            </div>
                            <div class="">

                                <form class="mb-0" action="#" method="post">
                                    <?php
                                    echo $errors;
                                    echo $message;
                                    ?>
                                    <div class="row">
                                        <?= $rowName?>
                                        <?= $rowEmail?>
                                        <?= $rowTitle?>
                                        <?= $rowTextarea?>
                                        <?= $rowButton?>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Contact Form End -->

                        <!-- Google Map -->
                        <div class="col-lg-6 min-vh-50 mb-10">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3240.2865634611403!2d139.69337521433746!3d35.6945651801912!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188d2a08f27e85%3A0x7be009474b99dd89!2s7-ch%C5%8Dme-20-11%20Nishishinjuku%2C%20Shinjuku%20City%2C%20Tokyo%20160-0023!5e0!3m2!1svi!2sjp!4v1622895163740!5m2!1svi!2sjp" width="600" height="450" style="border:0; margin-top:105px;" allowfullscreen="" loading="lazy"></iframe>
                        </div><!-- Google Map End -->
                    </div>

                    <!-- Contact Info -->
                    <div class="row col-mb-50">
                        <?= $address; ?>
                        <?= $hotline; ?>
                        <?= $email; ?>
                    </div>
                    <!-- Contact Info End -->

                </div>
            </div>
        </section>
        <!-- #content end -->

        <!-- PAGE-FOOTER -->
        <?php require_once 'html/footer.php'; ?>

    </div>
    <!-- Go To Top
	============================================= -->
    <div id="gotoTop" class="icon-angle-up"></div>
    <?php require_once 'html/script.php'; ?>
</body>

</html>