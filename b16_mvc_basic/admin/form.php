<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once 'libs/Validate.class.php';
require_once 'libs/Form.php';
require_once 'connect.php';
require_once '../libs/functions.php';
session_start();

if ($_SESSION['flagPermission'] != true) {
    redirect('../index.php');
}
$error = '';
$id = $_GET['id'];
$action = $_GET['action'];
$titlePage = '';

if ($action == 'edit') {
    // $id = mysqli_real_escape_string($id);
    $query = "SELECT `link`, `status`,`ordering` FROM `rss` WHERE `id` = '" . $id . "'";
    $outputValidate = $database->singleRecord($query);
    $linkForm = 'form.php?action=edit&id=' . $id;
    $titlePage = 'EDIT RSS';
    if (empty($outputValidate)) {
        redirect('error.php');
    }
} else if ($action == 'add') {
    $linkForm = 'form.php?action=add';
    $titlePage = 'ADD RSS';
} else {
    redirect('error.php');
}

if (!empty($_POST)) {
    if ($_SESSION['token'] == $_POST['token']) {
        unset($_SESSION['token']);
        header('location:' . $linkForm);
        exit();
    } else {
        $_SESSION['token'] = $_POST['token'];
    }
    unset($_POST['token']);
    $validate   = new Validate($_POST);
    $validate->addRule('link', 'url')
        ->addRule('ordering', 'int', ["min" => 1, "max" => 10])
        ->addRule('status', 'status');

    $validate->run();
    $outputValidate = $validate->getResult();
    echo '<pre>';
    print_r ($outputValidate);
    echo '</pre>';

    if (!$validate->isValid()) {
        $xhtmlError      = $validate->showErrors();
    } else {
        if ($action == 'edit') {
            $where      = [['id', $id]];
            $database->update($outputValidate, $where);
            redirect('list.php');
        } else if ($action == 'add') {
            $database->insert($outputValidate);
            $outputValidate = [];
            $mess           = 'Bạn đã thêm thành công! Bấm vào <a href ="list.php" >đây</a> để quay lại trang chủ.';
        }
        $success = '<div class="alert alert-success" role="alert">' . $mess . '</div>';
    }
}
//link-form
$inputLink = Form::createInput('text', 'link', $outputValidate['link']);
$labelLink = Form::createLabel('Link', 'font-weight-bold');
$groupLink = Form::createFormGroup($labelLink, $inputLink);

//Ordering-form
$inputOrdering = Form::createInput('text', 'ordering', $outputValidate['ordering']);
$labelOrdering = Form::createLabel('Ordering', 'font-weight-bold');
$groupOrdering = Form::createFormGroup($labelOrdering, $inputOrdering);

//Status-form
$arrStatus   = ['default' => 'Select status', 'inactive' => 'Inactive', 'active' => 'Active'];
$status      = Form::createSelectbox($arrStatus, 'status', $outputValidate['status'], 'custom-select');
$labelStatus = Form::createLabel('Status', 'font-weight-bold');
$groupStatus = Form::createFormGroup($labelStatus, $status);

$form        = $groupLink . $groupOrdering . $groupStatus;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'html/head.php' ?>
</head>

<body style="background-color: #eee;">
    <div class="container pt-5">
        <form action="<?= $linkForm; ?>" method="post">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="m-0"><?= $titlePage; ?></h4>
                </div>
                <div class="card-body">
                    <?= $xhtmlError; ?>
                    <?= $success; ?>
                    <?= $form; ?>
                </div>
                <div class="card-footer">
                    <input class="form-control" type="hidden" name="token" value="<?= time(); ?>">
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="list.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <?php require_once 'html/script.php'; ?>
</body>

</html>