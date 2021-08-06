<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'html/head.php' ?>
</head>
<body>
    <?php  require_once 'libs/my-func.php';
    $arrJob = ['Developer','Teacher','Student'];
    $arrSex = ['Other','Male','Female'];
    ?>
    <div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Registration Info</h2>
                    <form method="POST">
                        <?php 
                        echo $result = createSelecBox("sex","Sex",$arrSex);
                        echo $result = createInput("text","Fullname","name");
                        echo $result = createInput("mail","Email","mail");
                        echo $result = createInput("text","Age","age");
                        echo $result = createSelecBox("job","Job",$arrJob);
                        ?>
                        <div class="p-t-30">
                            <button class="btn btn--radius btn--green" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   <?php require_once 'html/script.php' ?>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->