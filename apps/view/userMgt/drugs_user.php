<?php
require_once '../../control/config.php';
$template = new template();

if (isset($_POST['add_to_cart']) && $_SESSION['login_type'] == 'User') {
    
    $id = $_POST['drug_id'];
    $qty = $_POST['qty'];
    
    $_SESSION[$_SESSION['login_type']]['Cart_'.$_SESSION['login_id']][$id] = $qty;
    
    
    
        // foreach ($_SESSION[$_SESSION['login_type']]['Cart_'.$_SESSION['login_id'] as $data => $value) {
        //     echo "key:" . $data . " value:" . $value. "<br>";
        // }
    

}

// unset($_SESSION['User']['Cart']);
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
                                <?php
                                $sql = 'SELECT * from tbl_drug';
                                $stmt = $conn->prepare($sql);
                                $stmt->execute(array());
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <div class="card span3" style="width: 18rem; margin:10px;" id="drug_<?= $row['drug_id'] ?>">
                                        <div class="card-body">
                                            <h4 class="card-title"><?= ucfirst($row['drug_name']) ?></h4>
                                            <h5 class="card-subtitle mb-2 text-muted">Rs.<?= $row['drug_price'] ?></h5>
                                            <p class="card-text"><?= $row['drug_description'] ?><br><span id="err"></span></p>
                                            <form action="drugs_user.php" method="post" id="cart">
                                                <input type="submit" class="btn btn-success" name="add_to_cart" id="<?php echo $row['drug_id']; ?>_add_to_cart" value="Add to Cart" style="float: right">
                                                <input type="number" id="<?= $row['drug_id'] ?>_drug_qty" data-role="qty" data-id="<?php echo $row['drug_id']; ?>" name="qty" placeholder="Qty" data-target="qty" value="<?php 
                                                if (isset($_SESSION[$_SESSION['login_type']]['Cart_'.$_SESSION['login_id']][$row['drug_id']])) {
                                                    echo $_SESSION[$_SESSION['login_type']]['Cart_'.$_SESSION['login_id']][$row['drug_id']];
                                                } else{
                                                    echo "0";
                                                }
                                                ?>" style="width: 50px;">
                                                <input type="hidden" value="<?= $row['drug_id'] ?>" name="drug_id" id="drug_id">
                                                <input type="hidden" value="<?= $row['drug_stock'] ?>" name="drug_stock" id="<?= $row['drug_id'] ?>_drug_stock">
                                            </form>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
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
                $('input[name=add_to_cart]').attr({
                    'disabled': 'true'
                });

                // disable the remove button when qty < 0 
                $(document).on('change click', 'input[data-role=qty]', function(event) {
                    var id = $(this).data('id');
                    var qty = parseInt($('#' + id + '_drug_qty').val());
                    var stock = parseInt($('#' + id + '_drug_stock').val());

                    if (qty >= 0 && stock > qty) {

                        $('div#drug_' + id + ' > div.card-body > p > span#err').text("Only " + (stock - qty) + " remains");
                        $('#' + id + '_add_to_cart').removeAttr('disabled');

                    } else {

                        $('#' + id + '_add_to_cart').attr({
                            'disabled': 'true'
                        });
                    }
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



            });
        </script>

    </span>
    <?php $template->alertDate($_SESSION['login_type']); ?>


</body>

</html>