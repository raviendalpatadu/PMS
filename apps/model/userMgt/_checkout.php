<?php
require_once '../../control/config.php';
$template = new template();
try {
    
    $order_id = $template->random_string(59);
    $user_id = $_SESSION['login_id'];
    $cart = $_SESSION['User']['Cart_' . $user_id];
    if (isset($_POST)) {
        // $name = $_POST['user_name'];
        $address = $_POST['user_address'];
        $mobile = $_POST['user_mobile'];
        foreach ($cart as $drug_id => $qty) {
            $sql = "INSERT INTO tbl_order(order_id, user_id, drug_id, order_qty, order_address, order_mobile, order_status, paid)"
                . " VALUES(:order_id, :user_id, :drug_id, :order_qty, :order_address, :order_mobile, :order_status, :paid)";

            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                'order_id' => $order_id,
                'user_id' => $user_id,
                'drug_id' => $drug_id,
                'order_qty' => $qty,
                'order_address' => $address,
                'order_mobile' => $mobile,
                'order_status' => 'preparing',
                'paid' => 1,
            ));
        }
        
        $conn = null;
        unset($_SESSION['User']['Cart_' . $user_id]);
        echo true;
    }
} catch (Exception $ex) {
    $_SESSION['error'][] = $ex->getMessage();
    echo $ex->getMessage();
}

