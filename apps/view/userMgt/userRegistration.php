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

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"></div>
        </div>
        <div class="container-fluid">
            <hr>
            <h3>User Registration</h3>
            <div class="row-fluid">
                <div class="span12">
                    <?php $template->showMessage(); ?>
                    <div class="widget-box">
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" name="user_validate" id="user_validate">
                                <div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">User Type</label>
                                        <div class="controls">
                                            <select name="user_type" id="user_type" required>
                                                <?php if ($_SESSION['login_type'] == ucfirst('admin')) : ?>
                                                    <option value="Admin">Admin</option>
                                                <?php endif; ?>
                                                <option value="User">Client</option>
                                                <option value="Staff">Staff</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">First Name</label>
                                        <div class="controls">
                                            <input type="text" id="user_fname" name="user_fname" autofocus="">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Last Name</label>
                                        <div class="controls">
                                            <input type="text" id="user_lname" name="user_lname">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Address</label>
                                        <div class="controls">
                                            <input type="text" id="user_address" name="user_address">
                                        </div>
                                    </div>
                                </div>
                                <div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">Moblie</label>
                                        <div class="controls">
                                            <input type="text" id="user_mobile" name="user_mobile">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Email</label>
                                        <div class="controls">
                                            <input type="email" name="user_email" id="user_email">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Password</label>
                                        <div class="controls">
                                            <input type="password" name="user_password" id="user_password">
                                        </div>
                                    </div>

                                    <div class="control-group span8">
                                        <input type="submit" value="Insert" class="btn btn-success" id="btn_3">
                                        <input type="reset" value="Clear" class="btn btn-warning">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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

<script>
    $(document).ready(function() {

        // btn classes
        var btn = {

            // insert button
            btn_3: function() {
                // when insert btn is clicked
                event.preventDefault();
                // console.log("helo")
                var formData = $('form').serialize();
                console.log(formData);
                $.post(
                    "../../model/userMgt/_userRegistration.php",
                    formData,
                    function(data, status) {
                        console.log("data" + data);
                        console.log("status" + status);
                        if (data == 1) {
                            alert("New user Added SuccessFully");
                        } else if (data == false && status == "success") {
                            alert("failed");
                        }
                    }
                );
            }

        };
        
        // validation part
        var validator = $("#user_validate").validate({
            rules: {
                user_type: {
                    required: true
                },
                user_fname: {
                    required: true
                },
                user_lname: {
                    required: true
                },
                user_address: {
                    required: true
                },

                user_mobile: {
                    required: true,
                    digits: true
                },
                user_email: {
                    required: true,
                    email: true
                },
                user_password: {
                    required: true
                }
                

            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
                $(element).parents('.control-group').removeClass('success');

            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            },
            submitHandler: function(form, e) {
                btn['btn_' + btnId]();
                validator.resetForm();

                $('.control-group').each(function() {
                    if ($(this).hasClass('success') || $(this).hasClass('error')) {
                        $(this).attr({
                            "class": "control-group"
                        });
                        $(this).children(".controls").find('span[class="help-inline"]').remove();
                        $(this).children(".controls").find("input[id^='user_']").val("");
                    }
                });
            }
        });


        // select which submit btn is clicked
        $('*[id^=btn_]').on('click', function() {
            btnId = $(this).attr('id').slice(-1);
            console.log(btnId);

        });




    });
</script>