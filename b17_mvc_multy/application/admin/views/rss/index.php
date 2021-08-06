<?php
if ($_SESSION['flagPermission'] != true) {
    URL::redirect(URL::createLink('default', 'index', 'index'));
}
$module = $_GET['module'];
$controller = $_GET['controller'];
$search = $_GET['search'] ?? '';
$xhtml = '';
$xhtmlSuccess = '';
if (isset($_SESSION['form'])) $xhtmlSuccess = '<div class="alert alert-success" role="alert">' . $_SESSION['form'] . ' thành công</div>';
foreach ($this->items as $item) {
    $id = $item['id'];
    $link = Helper::highLight($search, $item['link']);
    $ordering = $item['ordering'];
    $status = Helper::showStatus($module, $controller, $id, $item['status']);
    $linkEdit = URL::createLink($module, $controller, 'form', "&id=$id");
    $linkDelete = URL::createLink($module, $controller, 'delete', "&id=$id");

    $xhtml .= '
     <tr>
        <td>' . $id . '</td>
        <td>' . $link . '</td>
        <td>' . $status . '</td>
        <td>' . $ordering . '</td>
        <td>
            <a href="' . $linkEdit . '" class="btn btn-sm btn-warning">Edit</a>
            <a href="' . $linkDelete . '" class="btn btn-sm btn-danger btn-delete">Delete</a>
        </td>
    </tr>';
}
?>
<div class="container pt-5">
    <div class="card mb-4">
        <div class="card-body d-flex justify-content-between">
            <a href="<?= URL::createLink('default', 'index', 'index') ?>" class="btn btn-primary m-0">Back to website</a>
            <a href="<?= URL::createLink('admin', 'rss', 'logout') ?>" class="btn btn-info m-0">Logout</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <form action="" method="get">
                <div class="input-group mb-3">
                    <?= Form::createInput('hidden', 'module', 'admin') ?>
                    <?= Form::createInput('hidden', 'controller', 'rss') ?>
                    <?= Form::createInput('hidden', 'action', 'index') ?>
                    <?= Form::createInput('text', 'search', $search) ?>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-md btn-outline-primary m-0 px-3 py-2 z-depth-0 waves-effect" type="button">Search</button>
                        <a href="<?= URL::createLink('admin', 'rss', 'index') ?>" class="btn btn-md btn-outline-danger m-0 px-3 py-2 z-depth-0 waves-effect" type="button">Clear</a>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="m-0">RSS List</h4>
            <a href="<?= URL::createLink('admin', 'rss', 'form') ?>" class="btn btn-success m-0">Add</a>
        </div>
        <div class="card-body">
            <table class="table table-striped btn-table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Link</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ordering</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $xhtmlSuccess; ?>
                    <?= $xhtml; ?>
                    <?php Session::del('form'); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>