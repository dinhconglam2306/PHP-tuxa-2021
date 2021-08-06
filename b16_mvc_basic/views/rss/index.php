<?php
Session::destroy();
$controller = $_GET['controller'];
$xhtml = '';
$search = $_GET['search'] ?? '';
$xhtmlSuccess='';
if(isset($_SESSION['form'])) $xhtmlSuccess ='<div class="alert alert-success" role="alert">'.$_SESSION['form'].' thành công</div>';
foreach ($this->items as $item) {
    $id = $item['id'];
    $link = Helper::highLight($search, $item['link']);
    $ordering = $item['ordering'];
    $status = Helper::showStatus($controller, $id, $item['status']);
    $linkEdit = URL::createLink($controller,'form',"&id=$id");
    $linkDelete = URL::createLink($controller,'delete',"&id=$id");

    $xhtml .= '
     <tr>
        <td>' . $id . '</td>
        <td>' . $link . '</td>
        <td>' . $status . '</td>
        <td>' . $ordering . '</td>
        <td>
            <a href="'.$linkEdit.'" class="btn btn-sm btn-warning">Edit</a>
            <a href="'.$linkDelete.'" class="btn btn-sm btn-danger btn-delete">Delete</a>
        </td>
    </tr>';
}


?>
<div class="card mb-4">
    <div class="card-body d-flex justify-content-between">
        <a href="../index.php" class="btn btn-primary m-0">Back to website</a>
        <a href="logout.php" class="btn btn-info m-0">Logout</a>
    </div>
</div>
<div class="card mb-4">
    <div class="card-body">
        <form action="" method="get">
            <div class="input-group mb-3">
                <input type="hidden" class="form-control" name="controller" placeholder="Enter search keyword...." value="rss">
                <input type="hidden" class="form-control" name="action" placeholder="Enter search keyword...." value="index">
                <input type="text" class="form-control" name="search" placeholder="Enter search keyword...." value="<?= $search ?>">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-md btn-outline-primary m-0 px-3 py-2 z-depth-0 waves-effect" type="button">Search</button>
                    <a href="<?= URL::createLink('rss','index'); ?>" class="btn btn-md btn-outline-danger m-0 px-3 py-2 z-depth-0 waves-effect" type="button">Clear</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="m-0">RSS List</h4>
        <a href="<?= URL::createLink('rss','form'); ?>" class="btn btn-success m-0">Add</a>
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
                <?= $xhtmlSuccess;?>
                <?= $xhtml; ?>
            </tbody>
        </table>
    </div>
</div>