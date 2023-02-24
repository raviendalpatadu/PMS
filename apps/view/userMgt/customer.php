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
            <h3>Customers</h3>
            <div class="row-fluid">
                <div class="span12">

                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>Users</h5>



                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>Customer Id </th>
                                        <th>Customer Name</th>
                                        <th>Customer Type</th>
                                        <th>Customer Address</th>
                                        <th>Customer Telephone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = 'SELECT * from tbl_customer';
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute(array());
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr class="gradeX">
                                            <td><?php echo $row['customer_id']; ?></td>
                                            <td><?php echo $row['customer_name']; ?></td>
                                            <td><?php echo $row['customer_type']; ?></td>
                                            <td><?php echo $row['customer_address']; ?></td>
                                            <td><?php echo $row['customer_telephone']; ?> </td>
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
    <!--Footer-part-->
    <?php $template->getFooter(); ?>
    <!--Script-part-->
    <?php $template->getScript(); ?>
    <?php $template->getDataTables(); ?>
<?php $template->alertDate($_SESSION['login_type']); ?>
        

</body>

</html>