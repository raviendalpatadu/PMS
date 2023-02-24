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
            <h3>USERS</h3>
            <div class="row-fluid">
                <div class="span12">
                    <span id="msg_err">
                        <?php $template->showMessage(); ?>
                    </span>
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>Users</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table" id="dataTable">
                                <thead>
                                    <tr>

                                        <!-- <th>ID</th> -->
                                        <th>First Name </th>
                                        <th>Last Name </th>
                                        <th>Address</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = 'SELECT * from tbl_user ';
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute(array());
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <tr class="gradeX" id="<?php echo $row['user_id']; ?>">
                                        <!-- <td data-target="user_id"><?php //echo $row['user_id']; 
                                                                            ?></td> -->
                                        <td data-target="user_fname"><?php echo ucfirst($row['user_fname']); ?></td>
                                        <td data-target="user_lname"><?php echo ucfirst($row['user_lname']); ?></td>
                                        <td data-target="user_address"><?php echo $row['user_address']; ?></td>
                                        <td data-target="user_mobile"><?php echo $row['user_mobile']; ?></td>
                                        <td data-target="user_email"><?php echo $row['user_email']; ?></td>
                                        <td><a href="#" data-role="update" data-id="<?php echo $row['user_id']; ?>"
                                                class="btn btn-success" data-toggle="modal"
                                                data-target="#myModal">Edit</a></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Modal -->
                        <form class="form-horizontal" method="post" name="basic_validate" id="user_validate"
                            novalidate="novalidate">
                            <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-sm">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="submit" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Update</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <?php //$template->showMessage(); 
                                                    ?>
                                                    <div class="widget-box">
                                                        <div class="widget-content nopadding">
                                                            <!-- input fileds -->
                                                            <div class="span12" id="nameData">
                                                                <div class="control-group">
                                                                    <label class="control-label">First Name</label>
                                                                    <div class="controls">
                                                                        <input type="text" id="user_fname"
                                                                            name="user_fname" pattern="[a-zA-Z]+"
                                                                            autofocus="">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label class="control-label">Last Name</label>
                                                                    <div class="controls">
                                                                        <input type="text" id="user_lname"
                                                                            name="user_lname">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label class="control-label">Address</label>
                                                                    <div class="controls">
                                                                        <input type="text" id="user_address"
                                                                            name="user_address">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label class="control-label">Mobile</label>
                                                                    <div class="controls">
                                                                        <input type="text" id="user_mobile"
                                                                            name="user_mobile">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label class="control-label">Email</label>
                                                                    <div class="controls">
                                                                        <input type="text" name="user_email"
                                                                            id="user_email">
                                                                    </div>
                                                                    <input type="hidden" name="user_id" id="user_Id"
                                                                        value="">
                                                                </div>
                                                            </div>
                                                            <div class="span12" id="changePassword">
                                                                <div class="control-group">
                                                                    <label class="control-label">New Password</label>
                                                                    <div class="controls">
                                                                        <input type="password" id="new_password"
                                                                            name="new_password" autofocus="">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label class="control-label">Confirm
                                                                        Password</label>
                                                                    <div class="controls">
                                                                        <input type="password" id="confirm_password"
                                                                            name="confirm_password">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">

                                            <div class="control-group span4">
                                                <a href="#" class="btn btn-success" id="btn_3">Change Password</a>
                                                <a href="#" class="btn btn-success" id="btn_4">Back</a>
                                            </div>
                                            <div class="control-group span8">
                                                <input type="submit" value="Update" class="btn btn-success" id="btn_1"
                                                    name="update">
                                                <input type="submit" value="Delete" class="btn btn-success" id="btn_2">
                                                <input type="submit" value="Close" class="btn btn-default" id="close"
                                                    data-dismiss="modal">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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

    <script>
    $(document).ready(function() {
        $('#myModal').css({
            'display': 'none'
        });
        $('#btn_4, #changePassword').hide()
        // adds data to the modal
        $(document).on('click', 'a[data-role=update]', function() {
            $('#nameData, #btn_3').show();
            $('#btn_4, #changePassword').hide();
            var id = $(this).data('id');
            var firstName = $("#" + id).children('td[data-target=user_fname]').text();
            var lastName = $("#" + id).children('td[data-target=user_lname]').text();
            var address = $("#" + id).children('td[data-target=user_address]').text();
            var mobile = $("#" + id).children('td[data-target=user_mobile]').text();
            var email = $("#" + id).children('td[data-target=user_email]').text();

            // console.log(email);

            $('#user_fname').val(firstName.trim());
            $('#user_lname').val(lastName.trim());
            $('#user_address').val(address.trim());
            $('#user_mobile').val(mobile.trim());
            $('#user_email').val(email);
            $('#user_Id').val(id);
            $('#new_password').val('');
            $('#confirm_password').val('');
            // $('#myModal').modal('toggle');
        });

        // close btn
        $('.close, #close').click(function() {
            $('.control-group').each(function() {
                if ($(this).hasClass('success') || $(this).hasClass('error')) {
                    $(this).attr({
                        "class": "control-group"
                    });
                    $(this).children(".controls").find('span[class="help-inline"]').remove();
                }
                $(this).find('input[type!="submit"]').val("");
            });
        });

        // change password btn
        $('#btn_3').click(function(event) {
            event.preventDefault()
            // console.log('change password')

            // hide values(name,address and etc) and change password btn
            $('#nameData, #btn_3').hide()
            // show new password and confirm password abd also back btn
            $('#btn_4, #changePassword').show()
            // ajax call for update password

        });

        // back btn
        $('#btn_4').click(function() {
            // console.log('back')

            // hide back btn and change password btn
            $('#btn_4, #changePassword').hide()
            // show name details  and change password btn
            $('#nameData, #btn_3').show()

            // ajax call for update password
        });


        // btn classes
        var btn = {
            // update button
            btn_1: function() {
                var formData = $('#user_validate').serialize();
                console.log(formData);
                $.post(
                    "../../model/userMgt/_userRegistrationUpdate.php",
                    formData,
                    function(data, status) {
                        console.log("data" + data);
                        console.log("status" + status);
                        if (data == true || data == 11) {
                            var id = $('#user_Id').val()
                            console.log('iddd' + id)
                            $("#" + id).children('td[data-target=user_fname]').text($('#user_fname')
                                .val());
                            $("#" + id).children('td[data-target=user_lname]').text($('#user_lname')
                                .val());
                            $("#" + id).children('td[data-target=user_address]').text($(
                                '#user_address').val());
                            $("#" + id).children('td[data-target=user_mobile]').text($(
                                '#user_mobile').val());
                            $("#" + id).children('td[data-target=user_email]').text($('#user_email')
                                .val());
                            $('#myModal').modal('toggle');
                        } else if (data == false && status == "success") {
                            alert("failed");
                        }
                    }
                );
            },
            // delete button
            btn_2: function() {
                // console.log('delete');
                var formData = $('#user_validate').serialize()
                if (confirm('Are you sure?')) {
                    $.post(
                        "../../model/userMgt/_userRegistrationDelete.php",
                        formData,
                        function(data, status) {
                            // console.log("data: " + data);
                            // console.log("status: " + status);
                            if (data == true) {
                                var rID = $('#user_Id').val();
                                $('tr[id=' + rID + ']').remove()
                                $('#myModal').modal('toggle');
                            } else if (data == false && status == "success") {
                                // $('#content').load('userRegistration.php');
                                alert("failed");
                            }
                        }
                    );
                }

            },

        };


        // validation of the form
        $("#user_validate").validate({
            rules: {
                user_fname: {
                    required: true,
                },
                user_lname: {
                    required: true,
                },
                user_address: {
                    required: true,
                },
                user_mobile: {
                    required: true,
                    digits: true
                },
                user_email: {
                    required: true,
                    email: true
                },
                new_password: {
                    required: false
                },
                confirm_password: {
                    required: false,
                    equalTo: '#new_password'
                },

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

            submitHandler: function(form, event) {
                btn['btn_' + btnId]();
                console.log(event)

                $('.control-group').each(function() {
                    if ($(this).hasClass('success') || $(this).hasClass('error')) {
                        $(this).attr({
                            "class": "control-group"
                        });
                        $(this).children(".controls").find('span[class="help-inline"]')
                            .remove();
                    }
                });

            }
        });


        // select which submit btn is clicked
        $('*[id^=btn_]').on('click', function() {
            btnId = $(this).attr('id').slice(-1);
            console.log(btnId);

        });



        // repeat the given process eveery 2 seconds
        // shows update and other messages
        setInterval(function() {
            $.ajax({
                type: "POST",
                url: "../../model/changes/showMsg.php",

                success: function(data) {
                    $('#msg_err').html(data);
                }
            });

        }, 2000);
    })
    </script>
<?php $template->alertDate($_SESSION['login_type']); ?>
        

</body>

</html>