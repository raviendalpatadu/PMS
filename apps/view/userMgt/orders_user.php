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
            <div class="row-fluid">
                <div class="span12">
                    
                    <h1>Your Orders</h1>
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

                                            <th>Order ID </th>
                                            <th>Drug Name </th>
                                            <th>Drug Brand</th>
                                            <th>Drug Discription</th>
                                            <th>Quantity</th>
                                            <th>Ordered Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = 'SELECT * FROM tbl_order AS o, tbl_drug AS d WHERE d.drug_id = o.drug_id AND o.user_id = :user_id;';
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute(array(
                                            'user_id' => $_SESSION['login_id'],
                                        ));
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <tr class="gradeX" id="<?php echo $row['drug_id']; ?>">

                                                <td><?php echo $row['order_id']; ?></td>
                                                <td><?php echo $row['drug_name']; ?></td>
                                                <td><?php echo $row['drug_brand']; ?></td>
                                                <td><?php echo $row['drug_description']; ?></td>
                                                <td><?php echo trim($row['order_qty']); ?> </td>
                                                <td><?php echo $row['order_date']; ?></td>
                                                <td><b><?php echo ucfirst($row['order_status']); ?></b></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
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