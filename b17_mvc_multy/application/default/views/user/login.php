<?php
  $mess = $this->error ?? '';
//Name
$labelName = Form::labelLogin('username', 'Username', false);
$InputName = Form::inputLogin('text', 'username', 'username', $_POST['username']);
$rowName = Form::groupFormCol12Login($labelName, $InputName);

//Password
$labelPass = Form::labelLogin('password', 'Password', false);
$InputPass = Form::inputLogin('password', 'password', 'password', $_POST['password']);
$rowPass = Form::groupFormCol12Login($labelPass, $InputPass);

$button = Form::createButtonLogin('submit', 'Đăng nhập');
$elmA = Form::createALogin('index.php', 'Quay về');
$rowColtrol = Form::groupFormCol12Login($button, $elmA, true);

?>
<section id="content" class="w-100">
  <div class="content-wrap py-0">

    <div class="section p-0 m-0 h-100 position-absolute" style="background: url('<?= $this->_dirImg ?>login-bg.jpg') center center no-repeat; background-size: cover;">
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
</section>