<?php
require_once '../../control/config.php';
$template = new template();
?>

<!DOCTYPE html>
<html lang="en">

<!--<head>-->
<?php $template->getHead(); ?>
<!--</head>-->

<body>
    <div class="loader"></div>

    <!--<header>-->
    <?php $template->getHeader(); ?>
    <!--</header>-->

    <!--<Sidebar menu>-->
    <?php $template->getSidebar(); ?>
    <!--</Sidebar>-->
    <!-- <div id="gritter-notice-wrapper">
        <div id="gritter-item-1" class="gritter-item-wrapper" style="">
            <div class="gritter-top"></div>
            <div class="gritter-item">
                <div class="gritter-close" style="display: none;"></div><img src="../../../lib/img/demo/envelope.png" class="gritter-image">
                <div class="gritter-with-image"><span class="gritter-title">Important Unread messages</span>
                    <p>You have 12 unread messages.</p>
                </div>
                <div style="clear:both"></div>
            </div>
            <div class="gritter-bottom"></div>
        </div>
    </div> -->



    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"></div>
        </div>
        <div class="container-fluid">
            <hr>main
            <div class="row-fluid">
                <div class="span12">
                    
                    <h1>main</h1>
                    
                   
                    
                </div>
            </div>
        </div>
        
        <!--Footer-part-->
        <?php $template->getFooter(); ?>
        <!--Script-part-->
        <?php $template->getScript(); ?>
        <?php $template->getDataTables(); ?>
        <?php $template->alertDate($_SESSION['login_type']); ?>
        
        

</body>

</html>