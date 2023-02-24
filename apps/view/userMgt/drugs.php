<?php
require_once '../../control/config.php';
$template = new template();
?>

<!DOCTYPE html>
<html lang="en">

<style>
    .datepicker {
        z-index: 1000000 !important;
    }
</style>
<!--<head>-->
<?php $template->getHead(); ?>


<body>



    <div class="loader"></div>

    <span id="contentt">
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
                <h3>DRUGS</h3>
                <div class="row-fluid">
                    <div class="span12">
                        <span id="msg_err">
                            <?php $template->showMessage(); ?>
                        </span>
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                                <h5>Drugs</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <table class="table table-bordered data-table" id="dataTable">
                                    <thead>
                                        <tr>

                                            <th>Drug Name </th>
                                            <th>Drug Brand</th>
                                            <th>Drug Discription</th>
                                            <th>Durg Stock</th>
                                            <th>Exp Date</th>
                                            <th>Price</th>
                                            <th>Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = 'SELECT * from tbl_drug';
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute(array());
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $currentDate = date_create(date('Y-m-d'));
                                            $expDate = date_create($row['drug_expDate']);
                                            $diff = date_diff($currentDate, $expDate);
                                            $diffrence = $diff->format("%R%a");
                                            if ($diffrence <= 0) {
                                                $style = 'style = "background-color: #ffbaba;"';
                                            } else {
                                                $style = null;
                                            }
                                        ?>
                                            <tr class="gradeX" id="<?php echo $row['drug_id'] . "\" " . $style; ?>>

                                                <td data-target="drug_name"><?php echo $row['drug_name']; ?></td>
                                                <td data-target="drug_brand"><?php echo $row['drug_brand']; ?></td>
                                                <td data-target="drug_description"><?php echo $row['drug_description']; ?></td>
                                                <td data-target="drug_stock"><?php echo trim($row['drug_stock']); ?> </td>
                                                <td data-target="drug_expDate"><?php echo $row['drug_expDate']; ?></td>
                                                <td data-target="drug_price">Rs.<?php echo $row['drug_price']; ?></td>
                                                <td><a href="#" data-role="update" data-id="<?php echo $row['drug_id']; ?>" class="btn btn-success" data-toggle="modal" data-target="#myModal">Update</a></td>

                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>

                                </table>


                                <!-- Modal -->
                                <form class="form-horizontal" method="post" name="basic_validate" id="drug_validate" novalidate="novalidate">
                                    <div id="myModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-sm">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="submit" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Update</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row-fluid">
                                                        <div class="span12">
                                                            <?php $template->showMessage(); ?>
                                                            <div class="widget-box">
                                                                <div class="widget-content nopadding">
                                                                    <!-- input fileds -->
                                                                    <div class="span12">
                                                                        <div class="control-group">
                                                                            <label class="control-label">Drug Name</label>
                                                                            <div class="controls">
                                                                                <input type="text" id="drug_name" name="drug_name" pattern="[a-zA-Z]+" autofocus="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label class="control-label">Drug Brand</label>
                                                                            <div class="controls">
                                                                                <input type="text" id="drug_brand" name="drug_brand">
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label class="control-label">Drug Description</label>
                                                                            <div class="controls">
                                                                                <textarea id="drug_description" name="drug_description"> </textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label class="control-label">Stock</label>
                                                                            <div class="controls">
                                                                                <input type="text" id="drug_stock" name="drug_stock">
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label class="control-label">Drug Price</label>
                                                                            <div class="controls">
                                                                                <input type="number" id="drug_price" name="drug_price">
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label class="control-label">EXP Date</label>
                                                                            <div class="controls">
                                                                                <input type="date" name="drug_expDate" id="drug_expDate">
                                                                            </div>
                                                                            <input type="hidden" name="drug_id" id="drug_Id" value="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="control-group span12">
                                                        <input type="submit" value="Update" class="btn btn-success" id="btn_1" name="update">
                                                        <input type="submit" value="Delete" class="btn btn-success" id="btn_2">
                                                        <input type="submit" value="Close" class="btn btn-default" id="close" data-dismiss="modal">
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

                // adds data to the modal
                $(document).on('click', 'a[data-role=update]', function() {
                    var id = $(this).data('id');
                    var name = $("#" + id).children('td[data-target=drug_name]').text();
                    var brand = $("#" + id).children('td[data-target=drug_brand]').text();
                    var description = $("#" + id).children('td[data-target=drug_description]').text();
                    var stock = $("#" + id).children('td[data-target=drug_stock]').text();
                    var expDate = $("#" + id).children('td[data-target=drug_expDate]').text();
                    var unsplitPrice = $("#" + id).children('td[data-target=drug_price]').text();
                    var price = unsplitPrice.split('Rs.');

                    $('#drug_name').val(name.trim());
                    $('#drug_brand').val(brand.trim());
                    $('#drug_description').val(description.trim());
                    $('#drug_stock').val(stock.trim());
                    $('#drug_expDate').val(expDate.trim());
                    $('#drug_price').val(price[1].trim());
                    $('#drug_Id').val(id);
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
                    });
                });

                // btn classes
                var btn = {

                    // update button
                    btn_1: function() {
                        var formData = $('#drug_validate').serialize();
                        console.log(formData);
                        $.post(
                            "../../model/userMgt/_drugRegistrationUpdate.php",
                            formData,
                            function(data, status) {
                                console.log("data" + data);
                                console.log("status" + status);
                                if (data == true) {
                                    $('#myModal').modal('toggle');
                                    var id = $('#drug_Id').val()
                                    console.log('iddd' + id)
                                    $("#" + id).children('td[data-target=drug_name]').text($('#drug_name').val());
                                    $("#" + id).children('td[data-target=drug_brand]').text($('#drug_brand').val());
                                    $("#" + id).children('td[data-target=drug_description]').text($('#drug_description').val());
                                    $("#" + id).children('td[data-target=drug_stock]').text($('#drug_stock').val());
                                    $("#" + id).children('td[data-target=drug_price]').text($('#drug_price').val());
                                    $("#" + id).children('td[data-target=drug_expDate]').text($('#drug_expDate').val());
                                    // red background is removing
                                    if($('tr[id="'+id+'"]').attr('style') == 'background-color: #ffbaba;'){
                                        $('tr[id="'+id+'"]').attr({'style':''});
                                    }
                                } else if (data == false && status == "success") {
                                    alert("failed");
                                }
                            }
                        );
                    },

                    // delete button
                    btn_2: function() {
                        // console.log('delete');
                        var formData = $('#drug_validate').serialize()
                        console.log(formData)
                        if (confirm('Are you sure?')) {
                            $.post(
                                "../../model/userMgt/_drugRegistrationDelete.php",
                                formData,
                                function(data, status) {
                                    console.log("data: " + data);
                                    console.log("status: " + status);
                                    if (data == true) {
                                        $('#myModal').modal('toggle');
                                        // $.ajax({
                                        //     type: "POST",
                                        //     url: "../../model/userMgt/_drugList.php",
                                        //     success: function(data) {
                                        //         $('#table_data').html(data)
                                        //     }
                                        // });

                                    } else if (data == false && status == "success") {
                                        // $('#content').load('drugRegistration.php');
                                        alert("failed");
                                    }
                                }
                            );
                        }

                    },
                };

                // validation of the form
                jQuery.validator.addMethod("minDate", function(value, element) {
                    var day = moment().format('YYYY-MM-DD');
                    return moment(day).isBefore(value)
                }, "Please enter a future date.");

                $("#drug_validate").validate({
                    rules: {
                        drug_name: {
                            required: true,
                        },
                        drug_brand: {
                            required: true,
                        },
                        drug_description: {
                            required: true,
                        },
                        drug_stock: {
                            required: true,
                            digits: true
                        },
                        drug_price: {
                            required: true,
                            digits: true
                        },
                        drug_expDate: {
                            required: true,
                            date: true,
                            minDate:true
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
                                $(this).children(".controls").find('span[class="help-inline"]').remove();
                            }
                        });

                    },
                    
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
                }, 12000);
            });
        </script>

    </span>
    <?php $template->alertDate($_SESSION['login_type']); ?>


</body>

</html>