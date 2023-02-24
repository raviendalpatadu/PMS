<!DOCTYPE html>
<html lang="en">
    <?php
    require_once 'apps/control/config.php';
    $template = new template();
    ?>

    <head>
        <title>Matrix Admin</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="lib/css/bootstrap.min.css" />
        <link rel="stylesheet" href="lib/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="lib/css/matrix-login.css" />
        <link rel="stylesheet" href="lib/css/messages.css" />
        <link href="lib/css/font-awesome/css/font-awesome.css" rel="stylesheet"/>
        <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'> -->

    </head>
    <body>
<div class="loader"></div>

        <div id="loginbox">            
            <form id="loginform" class="form-vertical" action="apps/model/userMgt/_login.php" method="post">
                <div class="control-group normal_text"> <h1>PMS</h1></div>
                <?php
                $template->showMessage();
                ?>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" name="login_username" placeholder="Username" required/>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" name="login_password" placeholder="Password" required />
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>
                    <span class="pull-right"><button type="submit" name="login" class="btn btn-success" /> Login</button></span>
                </div>
            </form>
            <form id="recoverform" action="#" class="form-vertical">
                <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>

                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text"  placeholder="E-mail address" />
                    </div>
                </div>

                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right"><a class="btn btn-info"/>Recover</a></span>
                </div>
            </form>
        </div>

        <script src="lib/js/jquery.min.js"></script>  
        <script src="lib/js/matrix.login.js"></script> 
        <script src="lib/js/matrix.form_validation.js"></script> 
        <script src="lib/js/jquery.validate.js"></script> 
    
        

</body>

</html>
