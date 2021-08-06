<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <?php echo $this->_metaHTTP; ?>
    <?php echo $this->_metaName; ?>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700&display=swap" rel="stylesheet" type="text/css" />
    <?php echo $this->_cssFiles; ?>
    <?php echo $this->_title; ?>
</head>

<body class="stretched">

    <!-- Document Wrapper
	============================================= -->
    <div id="wrapper" class="clearfix">

        <!-- Content
		============================================= -->
        <?php
        require_once APPLICATION_PATH . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
        ?>
        <!-- #content end -->
    </div><!-- #wrapper end -->

    <?php echo $this->_jsFiles; ?>
</body>

</html>