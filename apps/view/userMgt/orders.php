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

            <div class="row-fluid">
                <div class="span12">

                    <h1>Orders</h1>
                    <div class="accordion" id="collapse-group">
                        <?php
                        $sql = 'SELECT COUNT(o.user_id) as count, o.user_id, o.order_id, u.user_fname  FROM tbl_order as o, tbl_user as u WHERE o.user_id = u.user_id AND  o.order_status = :order_status GROUP BY o.order_id;';
                        $stmt = $conn->prepare($sql);
                        $stmt->execute(array(
                            'order_status' => 'Preparing'
                        ));
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
                            $count = $row['count'];
                            $user_id = $row['user_id'];
                            $order_id = $row['order_id'];

                        ?>
                            <div class="accordion-group widget-box">
                                <div class="accordion-heading">
                                    <div class="widget-title" id="<?='U'.$user_id.'O'.$order_id;?>" data-user_id="<?= $user_id; ?>" data-order_id="<?=$row['order_id'];?>"> <a data-parent="#collapse-group" href="#order_<?= $order_id; ?>" data-toggle="collapse"> <span class="icon"><i class="icon-magnet"></i></span>
                                            <div class="row">
                                                <h5><?php
                                                    echo "<span style='text-align:left;'>{$row['user_fname']}</span>";
                                                    echo "<span id='order_id' style='float:right;'>{$row['order_id']}</span>";
                                                    ?></h5>
                                                <span style='float:right; background-color: red; padding: 6px; padding-left:10px; padding-right:10px; color: white; margin: 3px;'><?= $row['count'] ?></span>
                                                <a href='#' class='btn btn-primary' style="float:right; margin-top: 4px;">Deliver</a>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="collapse accordion-body" data-orderTable="order" id="order_<?= $order_id ?>">
                                    <div class="widget-content">
                                        <div class="widget-box">
                                            <div class="widget-content nopadding">
                                                <form id="form_<?= $order_id ?>">
                                                    <table class="table table-bordered" id="order_<?= $order_id ?>user_<?= $user_id ?>">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Drug Name</th>
                                                                <th>Brand</th>
                                                                <th>Drug Description</th>
                                                                <th>QTY</th>
                                                                <th>Paid</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $sql_2 = "SELECT * FROM tbl_drug AS d, tbl_order AS o, tbl_user AS u "
                                                                . "WHERE o.order_id = :order_id AND o.drug_id = d.drug_id AND o.user_id = u.user_id AND o.order_status = :order_status";
                                                            $stmt_2 = $conn->prepare($sql_2);
                                                            $stmt_2->execute(array(
                                                                'order_id' => $order_id,
                                                                'order_status' => 'Preparing'
                                                            ));
                                                            while ($rows = $stmt_2->fetch(PDO::FETCH_ASSOC)) : ?>
                                                                <tr id="<?= 'D' . $rows['drug_id'] . 'order_' . $order_id;?>" data-drug_id="<?=$rows['drug_id'];?>">
                                                                    <td><input type="checkbox" value="<?= $rows['drug_id']; ?>" name="drug_id" /></td>
                                                                    <td><?= ucfirst($rows['drug_name']) ?></td>
                                                                    <td><?= ucfirst($rows['drug_brand']) ?></td>
                                                                    <td><?= ucfirst($rows['drug_description']) ?></td>
                                                                    <td><?= ucfirst($rows['order_qty']) ?></td>
                                                                    <td><?= ucfirst(($rows['paid']) ? 'ture' : 'false'); ?></td>
                                                                    <td style="text-align: center;"><?= ucfirst($rows['order_status']) ?></td>
                                                                </tr>

                                                            <?php endwhile; ?>
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
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


        <script>
            $(document).ready(function() {
                $(document).on('click', 'div[class=widget-title] ', function(event) {

                    event.stopImmediatePropagation();
                    var userId = $(this).data('user_id');
                    var orderId = $(this).data('order_id');

                    var tableRow = 'table[id=order_' + orderId + 'user_' + userId + '] > tbody > tr[id*=D]';
                    // when clicked on the drug row of the specific order. the checkbox toggles
                    $(tableRow).on('click', function(event) {
                        event.stopImmediatePropagation();
                        var drugId = $(this).data('drug_id');
                        var thisData = 'tr[id=D' + drugId + 'order_' + orderId + '] > td > div.checker > span';
                        if ($(thisData).hasClass('checked')) {
                            //when checked_not
                            $(thisData).removeAttr('class', 'checked');
                            $(thisData + ' > input').removeAttr('checked');
                            $('tr[id=D' + drugId + 'order_' + orderId + ']').removeAttr('style');
                            $('tr[id=D' + drugId + 'order_' + orderId + '] > td:last-child').text("Preparing");
                        } else {
                            // when checked
                            $(thisData).attr({
                                'class': 'checked'
                            });
                            $(thisData + ' > input').attr({
                                'checked': 'true'
                            });
                            $('tr[id=D' + drugId + 'order_' + orderId + ']').css('background-color', '#3adf3a4d');
                            $('tr[id=D' + drugId + 'order_' + orderId + '] > td:last-child').text("Ready For Delivery");
                        }
                        var count = $(tableRow + " > td > div.checker > span > input[type='checkbox']:checked").length;
                        $('div[id=U'+userId+'O' + orderId + '] > div.row > a.btn').text('Deliver (' + count + ')');
                    });

                    // when clicked on the delivery btn
                    $('div[id=U'+userId+'O' + orderId + '] > div.row > a.btn').on('click', function(event) {
                        event.stopImmediatePropagation();
                        var selectedDrugId = $('#form_' + orderId).serialize();
                        console.log("selected durg id's: " + selectedDrugId);
                        selectedDrugId = selectedDrugId.replaceAll("&",",",selectedDrugId);
                        selectedDrugId = selectedDrugId.replaceAll("drug_id=","",selectedDrugId);
                        // selectedDrugId = selectedDrugId.replaceAll(",order_qty=","&",selectedDrugId);
                        selectedDrugId = selectedDrugId.split(",");
                        console.log("selected durg id's: " + selectedDrugId);
                        
                        // console.log("orderid: " + orderId);
                        // console.log("userid: " + userId);
                        
                        $.ajax({
                                type: "POST",
                                url: "../../model/userMgt/_orders.php",
                                data: ({
                                        'user_id':userId,
                                        'order_id':orderId,
                                        'drug_id':selectedDrugId
                                    }),
                                    success: function(data) {
                                        console.log(data);
                                    
                                    jQuery.each( selectedDrugId, function( i, val ) {
                                        var daa = 'div#collapse-group > div.accordion-group > div#order_'+orderId+' > div.widget-content > div.widget-box > div.widget-content > form#form_'+orderId+' > table#order_'+orderId+'user_'+userId+' > tbody > tr#D'+val+'order_'+orderId;
                                        $(daa).remove();
                                    });
                            }
                        });

                    });

                });
            });
        </script>
</body>

</html>