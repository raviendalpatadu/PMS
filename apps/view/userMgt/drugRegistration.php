<?php
require_once '../../control/config.php';
$template = new template();

if (isset($_GET['drug_id'])) {
    $drug_id = $_GET['drug_id'];
    $sql = 'SELECT * from tbl_drug where drug_id=' . $drug_id;
    $stmt = $conn->prepare($sql);
    $stmt->execute(array());
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $drug_name = $row['drug_name'];
        $drug_brand = $row['drug_brand'];
        $drug_description = $row['drug_description'];
        $drug_stock = $row['drug_stock'];
        $drug_expDate = $row['drug_expDate'];
        $drug_price = $row['drug_price'];
    }
}
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
            <h3>Drug Registration</h3>
            <div class="row-fluid">
                <div class="span12">
                    <?php $template->showMessage(); ?>
                    <div class="widget-box">
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" name="drug_validate" id="drug_validate">
                                <div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">Drug Name</label>
                                        <div class="controls">
                                            <input type="text" id="drug_name" name="drug_name" autofocus="" value=<?php
                                                                                                                    if (isset($_GET['drug_id'])) {
                                                                                                                        echo $drug_name;
                                                                                                                    }
                                                                                                                    ?>>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Drug Brand</label>
                                        <div class="controls">
                                            <input type="text" id="drug_brand" name="drug_brand" value="<?php
                                                                                                        if (isset($_GET['drug_id'])) {
                                                                                                            echo $drug_brand;
                                                                                                        }
                                                                                                        ?>">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Description</label>
                                        <div class="controls">
                                            <textarea id="drug_description" name="drug_description" value="<?php
                                                                                                        if (isset($_GET['drug_id'])) {
                                                                                                            echo $drug_description;
                                                                                                        }
                                                                                                        ?>"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">Stock</label>
                                        <div class="controls">
                                            <input type="text" id="drug_stock" name="drug_stock" value="<?php
                                                                                                        if (isset($_GET['drug_id'])) {
                                                                                                            echo $drug_stock;
                                                                                                        }
                                                                                                        ?>">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Drug Price</label>
                                        <div class="controls">
                                            <input type="text" id="drug_price" name="drug_price" value="<?php
                                                                                                        if (isset($_GET['drug_id'])) {
                                                                                                            echo $drug_price;
                                                                                                        }
                                                                                                        ?>">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">EXP Date</label>
                                        <div class="controls">
                                            <input type="date" name="drug_expDate" id="drug_expDate" value="<?php
                                                                                                            if (isset($_GET['drug_id'])) {
                                                                                                                echo $drug_expDate;
                                                                                                            }
                                                                                                            ?>">
                                            <input type="hidden" name="drug_id" value="<?php
                                                                                        if (isset($_GET['drug_id'])) {
                                                                                            echo $_GET['drug_id'];
                                                                                        } else {
                                                                                            echo null;
                                                                                        }
                                                                                        ?>">
                                        </div>
                                    </div>
                                    <div class="control-group span12">
                                        <?php
                                        if (isset($_GET['drug_id'])) {
                                            echo '
                                                        <input type="submit" value="Update" class="btn btn-success" id="btn_1" name="update">
                                                        <input type="submit" value="Delete" class="btn btn-success" id="btn_2" data-drugid="' . $_GET['drug_id'] . '">
                                                    ';
                                        } else {
                                            echo '
                                                        <input type="submit" value="Insert" class="btn btn-success" id="btn_3">
                                                    ';
                                        }
                                        ?>
                                        <input type="reset" value="Clear" class="btn btn-success">

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
            // update button
            btn_1: function(event) {
                // when update is clicked
                event.preventDefault();
                var formData = $('form').serialize();
                console.log(formData);
                $.post(
                    "../../model/userMgt/_drugRegistrationUpdate.php",
                    formData,
                    function(data, status) {
                        console.log("data" + data);
                        console.log("status" + status);
                        if (data == true) {
                            $('#content').load('drugs.php');
                            // alert("ok");
                        } else if (data == false && status == "success") {
                            $('#content').load('drugRegistration.php');
                            // alert("failed");
                        }
                    }
                );
            },

            // delete button
            btn_2: function(event) {
                // when delete btn is clicked

                event.preventDefault();
                if (confirm("are sure you want to delete?")) {
                    var id = $('#btn_2').data('drugid');
                    $.ajax({
                        type: "POST",
                        url: "../../model/userMgt/_drugRegistrationDelete.php",
                        data: {
                            id: id
                        },
                        success: function(data, status) {
                            if (data == true) {
                                $('#content').load('drugs.php');
                                // alert("ok");
                            } else if (data == false && status == "success") {
                                $('#content').load('drugRegistration.php');
                                // alert("failed");
                            }
                        }
                    });
                }

            },

            // insert button
            btn_3: function() {
                // when insert btn is clicked
                event.preventDefault();
                console.log("helo")
                var formData = $('form').serialize();
                console.log(formData);
                $.post(
                    "../../model/userMgt/_drugRegistrationInsert.php",
                    formData,
                    function(data, status) {
                        console.log("data" + data);
                        console.log("status" + status);
                        if (data == 1) {
                            alert("New Drug Added SuccessFully");
                        } else if (data == false && status == "success") {
                            alert("failed");
                        }
                    }
                );
            }

        };

        // validation part
        // validation of the form
        jQuery.validator.addMethod("minDate", function(value, element) {
            var day = moment().format('YYYY-MM-DD');
            return moment(day).isBefore(value)
        }, "Please enter a future date.");
        var validator = $("#drug_validate").validate({
            rules: {
                drug_name: {
                    required: true
                },
                drug_brand: {
                    required: true
                },
                drug_description: {
                    required: true
                },
                drug_stock: {
                    required: true,
                    digits: true
                },
                drug_price: {
                    required: true,
                    number: true
                },
                drug_expDate: {
                    required: true,
                    date: true,
                    minDate: true
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
                        $(this).children(".controls").find("input[id^='drug_']").val("");
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