<?php
require_once '../../control/config.php';
$template = new template();
try {
    if (isset($_POST)) {
        $user_id = $_POST['user_id'];
        $order_id = $_POST['order_id'];
        $drug_ids = $_POST['drug_id'];
        foreach ($drug_ids as $key => $drug_id) {
            $sql = "SELECT drug_id, order_qty FROM `tbl_order` WHERE order_id =:order_id AND user_id = :user_id AND drug_id= :drug_id LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                'order_id' => $order_id,
                'user_id' => $user_id,
                'drug_id' => $drug_id
            ));

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $qty = $row['order_qty'];
            
            // $sql = "UPDATE tbl_order SET order_status =:value WHERE order_id =:order_id AND user_id =:user_id AND drug_id =:drug_id";
            // $stmt = $conn->prepare($sql);
            // $stmt->execute(array(
            //     'order_id' => $order_id,
            //     'user_id' => $user_id,
            //     'drug_id' => $drug_id,
            //     'value' => 'Shipped'
            // ));

            // $sql = "UPDATE tbl_drug SET drug_stock = (SELECT drug_stock FROM tbl_drug WHERE drug_id = :drug_id) - :stock WHERE drug_id =:drug_id";
            // $stmt = $conn->prepare($sql);
            // $stmt->execute(array(
            //     'stock' => $qty,
            //     'drug_id' => $drug_id
            // ));



           
                // sales table eka updarte wenne na
            
                          
            $sql = "INSERT INTO tbl_sales(sales_drugId, sales_customerId, sales_quantity, sales_price) "
                    ."VALUES (:drug_id, :user_id, :quantity, :quantity * (SELECT drug_price FROM tbl_drug WHERE drug_id =:durg_id LIMIT 1))";
            $stmt = $conn->prepare($sql);
            
            $stmt->execute(array(
                'drug_id' => $drug_id,
                'user_id' => $user_id,
                'quantity' => $qty
            ));
            
            
        }
        $conn = null;
    }
} catch (Exception $ex) {
    $_SESSION['error'][] = $ex->getMessage();
    echo $ex->getMessage();
}
