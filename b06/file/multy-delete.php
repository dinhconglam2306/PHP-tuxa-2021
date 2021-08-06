<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>PHP FILE</title>
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
</head>

<body>
    <?php
    require_once 'define.php';
    $checkbox = '';
    if (isset($_POST['checkbox'])) {
        $checkbox = $_POST['checkbox'];

        foreach ($checkbox as $key => $value) {
            $content    = file_get_contents("./".DIR_FILES.$value.".txt");
            $content    = explode('||', $content);
            $imageOniginal        = $content[2];
            @unlink(DIR_IMAGES.$imageOniginal);
            @unlink("./".DIR_FILES.$value.".txt");
        }
        echo '<div id="wrapper">
               <div class="title">PHP FILE</div>
               <div id="form">
                   <p>Dữ liệu đã được xóa thành công! Click vào <a href="index.php">đây</a> đê quay về trang chủ.</p>
               </div>
              </div>';
    } else {
        echo '<div id="wrapper">
               <div class="title">PHP FILE</div>
               <div id="form">
                   <p>Dữ liệu chưa được xóa. Cần check ít nhất 1 ô trở lên! Click vào <a href="index.php">đây</a> đê quay về trang chủ.</p>
               </div>
             </div>';
    }
    ?>

</body>

</html>