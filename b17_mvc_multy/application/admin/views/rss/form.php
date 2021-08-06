<?php
$data = $this->item;
$xhtmlError = '';
$error = $this->error;
if (!empty($error)) {
    $xhtmlError = '<div class="alert alert-danger" role="alert">' . $error . '</div>';
}
$url = URL::createLink('admin', 'rss', 'form');
if (isset($_GET['id'])) $url .= "&id={$_GET['id']}";
//link-form
$inputLink = Form::createInput('text', 'link', $data['link']);
$labelLink = Form::createLabel('Link', 'font-weight-bold');
$groupLink = Form::createFormGroup($labelLink, $inputLink);

//Ordering-form
$inputOrdering = Form::createInput('text', 'ordering', $data['ordering']);
$labelOrdering = Form::createLabel('Ordering', 'font-weight-bold');
$groupOrdering = Form::createFormGroup($labelOrdering, $inputOrdering);

//Status-form
$arrStatus   = ['default' => 'Select status', 'inactive' => 'Inactive', 'active' => 'Active'];
$status      = Form::createSelectbox($arrStatus, 'status', $data['status'], 'custom-select');
$labelStatus = Form::createLabel('Status', 'font-weight-bold');
$groupStatus = Form::createFormGroup($labelStatus, $status);
$form        = $groupLink . $groupOrdering . $groupStatus;

?>
<form action="<?= $url; ?>" method="post">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="m-0"><?= $this->title; ?></h4>
        </div>
        <div class="card-body">
            <?= $xhtmlError; ?>
            <?= $form; ?>
        </div>
        <div class="card-footer">
            <?= Form::createInput('hidden', 'token', time()) ?>
            <button type="submit" class="btn btn-success">Save</button>
            <a href="<?= URL::createLink('admin', 'rss', 'index') ?>" class="btn btn-danger">Cancel</a>
        </div>
    </div>
</form>