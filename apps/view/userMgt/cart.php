<?php
require_once '../../control/config.php';
$template = new template();

// unset($_SESSION[$_SESSION['login_type']]['Cart_'.$_SESSION['login_id']);
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

    <?php
    // echo "<pre>";
    // print_r($_SESSION['User']);
    // echo "</pre>";
    ?>

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
                <h3>Cart</h3>
                <div class="row-fluid">
                    <div class="span12">
                        <span id="msg_err">
                            <?php $template->showMessage(); ?>
                        </span>
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                                <h5>Cart</h5>
                                <button class="btn btn-success" name="checkout" id="checkout" style="float: right" data-toggle="modal" data-target="#checkoutModel"><i class="icon-shopping-cart"></i> Check Out</button>
                            </div>
                            <!-- cart items -->
                            <div class="widget-content nopadding">
                                <?php
                                if (isset($_SESSION[$_SESSION['login_type']]['Cart_' . $_SESSION['login_id']])) :

                                    foreach ($_SESSION[$_SESSION['login_type']]['Cart_' . $_SESSION['login_id']] as $id => $qty) :
                                        $sql = 'SELECT * from tbl_drug where drug_id = :id limit 1';
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute(array(
                                            'id' => $id
                                        ));
                                        $row = $stmt->fetch(PDO::FETCH_ASSOC); ?>
                                        <div class="card span3" style="width: 18rem; margin:10px;" id="drug_<?= $row['drug_id'] ?>">
                                            <div class="card-body">
                                                <h4 class="card-title"><?= ucfirst($row['drug_name']) ?></h4>
                                                <h5 class="card-subtitle mb-2 text-muted" id="<?= $row['drug_id'] ?>_price">Total : Rs.<?= $row['drug_price'] * $qty ?></h5>
                                                <p class="card-text"><?= $row['drug_description'] ?> <br><span id="err"></span></p>
                                                <span id="<?= $row['drug_id'] ?>_php"></span>
                                                <form method="post" id="cart">
                                                    <input type="submit" class="btn btn-danger" data-role="remove" data-id="<?php echo $row['drug_id']; ?>" name="remove" id="<?php echo $row['drug_id']; ?>_remove" value="Remove Item" style="float: right">
                                                    <input type="number" id="<?= $row['drug_id'] ?>_drug_qty" data-role="qty" data-id="<?php echo $row['drug_id']; ?>" name="qty" placeholder="Qty" data-target="qty" value="<?= $_SESSION[$_SESSION['login_type']]['Cart_' . $_SESSION['login_id']][$row['drug_id']]; ?>" style="width: 50px;">
                                                    <input type="hidden" value="<?= $row['drug_id'] ?>" name="drug_id" id="drug_id">
                                                    <input type="hidden" value="<?= $row['drug_stock'] ?>" name="drug_stock" id="<?= $row['drug_id'] ?>_drug_stock">
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>



                    <!-- Modal-->
                    <form class="form-horizontal" method="post" name="basic_validate" id="checkout_validate" novalidate="novalidate">
                        <div id="checkoutModel" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <!-- Modal content -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="submit" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">checkout</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <?php $template->showMessage(); ?>
                                                <div class="widget-box">
                                                    <div class="widget-content nopadding">
                                                        <!-- input fileds  -->
                                                        <div class="span12">
                                                            <!-- user name  -->
                                                            <div class="control-group">
                                                                <label class="control-label">Name</label>
                                                                <div class="controls">
                                                                    <input type="text" id="user_name" value="<?= $_SESSION['user_fname'] ?>" name="user_name" pattern="[a-zA-Z]+" autofocus="">
                                                                </div>
                                                            </div>
                                                            <!-- user address  -->
                                                            <div class="control-group">
                                                                <label class="control-label">Address</label>
                                                                <div class="controls">
                                                                    <textarea type="text" id="user_address" name="user_address"></textarea>
                                                                </div>
                                                            </div>
                                                            <!-- user mobile  -->
                                                            <div class="control-group">
                                                                <label class="control-label">Mobile</label>
                                                                <div class="controls">
                                                                    <input type="number" name="user_mobile" id="user_mobile">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span12">
                                                            <table class="table table-bordered table-invoice-full">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="head0">Drug Name</th>
                                                                        <th class="head1">Description</th>
                                                                        <th class="head0 right">Qty</th>
                                                                        <th class="head1 right">Price</th>
                                                                        <th class="head0 right">Amount</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <!-- displayed by an AJAX call -->
                                                                </tbody>
                                                                <tfoot>
                                                                    <!-- displayed by an AJAX call -->
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group span12">
                                            <input type="submit" value="CheckOut" class="btn btn-success" id="checkoutBtnModel" name="checkout">
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
        <!--Footer-part-->
        <?php $template->getFooter(); ?>
        <!--Script-part-->
        <?php $template->getScript(); ?>
        <?php $template->getDataTables(); ?>

        <script>
            $(document).ready(function() {

                // disable the remove button when qty < 0 
                $(document).on('change click', 'input[data-role=qty]', function(event) {
                    var id = $(this).data('id');
                    var qty = parseInt($('#' + id + '_drug_qty').val());
                    var stock = parseInt($('#' + id + '_drug_stock').val());

                    if (qty >= 0 && stock >= qty) {

                        $('div#drug_' + id + ' > div.card-body > p > span#err').text("Only " + (stock - qty) + " remains");
                        $('#' + id + '_remove').removeAttr('disabled');

                    } else {

                        $('#' + id + '_remove').attr({
                            'disabled': 'true'
                        });
                    }
                });


                // when th remove button is clicked
                $(document).on('click', 'input[data-role=remove]', function(event) {
                    event.preventDefault();
                    var id = $(this).data('id');
                    $.ajax({
                        type: "POST",
                        url: "../../model/userMgt/_cart.php",
                        data: ({
                            'act': 'remove',
                            'drug_id': id
                        }),
                        success: function(data) {

                            $('#drug_' + id).hide();

                            // count in the nav bar is changed
                            $('div#user-nav > ul[class=nav] > li[id=cart] > a > span#cart_qty').text(data);
                        }
                    });
                });


                // if qty is changed in the checkout
                $(document).on('focusout', 'input[data-role=qty]', function() {
                    var id = $(this).data('id');
                    var qty = parseInt($('#' + id + '_drug_qty').val());
                    var stock = parseInt($('#' + id + '_drug_stock').val());
                    if (qty >= 0 && stock >= qty) {
                        $('div#drug_' + id + ' > div.card-body > p > span#err').text("Only " + (stock - qty) + " remains");
                        $.ajax({
                            type: "POST",
                            url: "../../model/userMgt/_cart.php",
                            data: ({
                                'act': 'focusout',
                                'drug_id': id,
                                'qty': qty
                            }),
                            success: function(data) {

                                $('#' + id + '_drug_qty').val(data);
                                $('#' + id + '_price').text('Total: Rs.' + data);
                            }
                        });
                    } else {
                        $('#' + id + '_remove').attr({
                            'disabled': 'true'
                        });
                    }
                });


                // when the modal is loaded
                $('#checkoutModel').on('shown.bs.modal', function(event) {
                    $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: "../../model/userMgt/_cart.php",
                        data: ({
                            'act': 'loadToCheckout',

                        }),
                        success: function(data, status) {
                            $('tbody').html(data.tr)
                            $('tfoot').html(data.tfoot)
                        }
                    });


                    $('#checkoutBtnModel').on('click', function(event) {
                        event.preventDefault();
                        var formdata = $('#checkout_validate').serialize();
                        console.log(formdata)
                        $.post(
                            "../../model/userMgt/_checkout.php",
                            formdata,
                            function(data, status) {
                                console.log(data)
                                if (data) {
                                    window.location.href = "orders_user.php";
                                }
                            }
                        );
                    })
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
                    $('#checkoutModel');

                }, 2000);



            });
        </script>

    </span>
    <?php $template->alertDate($_SESSION['login_type']); ?>


</body>

</html>