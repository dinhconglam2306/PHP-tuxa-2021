<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>PHP FILE - ADD</title>
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#cancel-button').click(function() {
                window.location = 'index.php';
            });
        });
    </script>
    <style>
        img {
            width: 300px;
        }
    </style>
</head>

<body>
    <?php
    error_reporting(E_ALL & ~E_NOTICE);
    require_once 'functions.php';
    $configs    = parse_ini_file('config.ini');

    $id    = $_GET['id'];
    $content    = file_get_contents("./files/$id.txt");
    $content    = explode('||', $content);
    $title                = $content[0];
    $description        = $content[1];
    $imageOriginal  = $content[2];
    $linkImg = "./images/$content[2]";
    $flag    = false;
    if (isset($_POST['title']) && isset($_POST['description']) && isset($_FILES['file-upload'])) {
        $title            = $_POST['title'];
        $description    = $_POST['description'];
        $fileUpload = $_FILES['file-upload'];

        // Error Title
        $errorTitle = '';
        if (checkEmpty($title))             $errorTitle = '<p class="error">Dữ liệu không được rỗng</p>';
        if (checkLength($title, 5, 100)) $errorTitle .= '<p class="error">Tiêu đề dài từ 5 đến 100 ký tự</p>';

        // Error Description
        $errorDescription = '';
        if (checkEmpty($description))             $errorDescription = '<p class="error">Dữ liệu không được rỗng</p>';
        if (checkLength($description, 10, 5000)) $errorDescription .= '<p class="error">Nội dung dài từ 10 đến 5000 ký tự</p>';

        //check file
        $errorFileUpload = '';
        $flagImageChange = false;
        if ($fileUpload['name'] != null) {
            $flagImageChange = true;
            $configs    = parse_ini_file('config.ini');
            $flagExtension       = checkExtension($fileUpload['name'], explode('|', $configs['extension']));
            $flagSize            = checkSize($fileUpload['size'], $configs['min_size'], $configs['max_size']);
            if (!$flagExtension)   $errorFileUpload .=  '<p class="error">Phần mở rộng file không hợp lệ! Phần mở rộng phải có đuôi jpg|png</p>';
            if (!$flagSize)        $errorFileUpload .=  '<p class="error">Hoặc dung lượng file không phù hợp</p>';
        }

        if ($errorTitle == '' && $errorDescription == '' &&  $errorFileUpload == '') {
            $data    = $title . '||' . $description . '||';
            if ($flagImageChange) {
                $fileNameImg         = randomStringImg($fileUpload['name'], 7);
                $data .=  $fileNameImg;
            } else {
                $data .= $imageOriginal;
            }
            $filename    = './files/' . $id . '.txt';
            if (file_put_contents($filename, $data)) {
                if ($flagImageChange) {
                    @unlink($linkImg);
                    @move_uploaded_file($fileUpload['tmp_name'],   './images/' . $fileNameImg);
                }
                $title            = '';
                $description    = '';
                $flag            = true;
                header('location:index.php');
            }
        }
    }

    ?>
    <div id="wrapper">
        <div class="title">PHP FILE - ADD</div>
        <div id="form">
            <form action="#" method="post" name="add-form" enctype="multipart/form-data">
                <div class="row">
                    <p>Title</p>
                    <input type="text" name="title" value="<?= $title; ?>">
                    <?= $errorTitle; ?>
                </div>

                <div class="row">
                    <p>Description</p>
                    <textarea name="description" rows="5" cols="100"><?= $description; ?></textarea>
                    <?= $errorDescription ?>
                </div>

                <div class="row">
                    <p>Image</p>
                    <img src="./images/<?= $imageOriginal; ?>" alt="">
                </div>

                <div class="row">
                    <p>File</p>
                    <input type="file" name="file-upload" />
                    <?= $errorFileUpload; ?>
                </div>

                <div class="row">
                    <input type="submit" value="Save" name="submit">
                    <input type="button" value="Cancel" name="cancel" id="cancel-button">
                </div>

            </form>
        </div>

    </div>
</body>

</html>