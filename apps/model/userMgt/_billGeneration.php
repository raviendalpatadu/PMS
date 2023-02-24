<?php
require_once '../../control/config.php';
$template = new template();

try {
    $drug_id = $_POST['drug_id'];
    $drug_qty = $_POST['drug_qty'];
    $drug_tot = $_POST['drug_tot'];
    $drug_split = explode('Rs.', $drug_tot);
    
    if (isset($_POST['drug_qty'])) {
        
        if (empty($_SESSION['ERROR'])) {
            // echo $drug_qty;
            $select_sql = 'SELECT drug_name,drug_stock FROM tbl_drug WHERE drug_id=:drug_id LIMIT 1';
            $select_stmt = $conn->prepare($select_sql);
            $select_stmt->execute(array('drug_id' => $drug_id));
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            $drug_stock = $row['drug_stock'];
            $drug_name = $row['drug_name'];
            if ($drug_stock > $drug_qty) {
                
                $drug_Remainingstock = $drug_stock - $drug_qty;

                // update drug table( deducts drug qty)
                $sql = 'UPDATE tbl_drug SET drug_stock=:drug_stock WHERE drug_id=:drug_id';
                $stmt = $conn->prepare($sql);
                $stmt->execute(array('drug_id' => $drug_id,
                'drug_stock' => $drug_Remainingstock,
                ));


                // insert data into sales table
                $sales_sql = 'INSERT INTO tbl_sales(sales_drugId, sales_quantity, sales_price) VALUES(:drug_id, :drug_qty, :drug_tot) LIMIT 1';
                $sales_stmt = $conn->prepare($sales_sql);
                $sales_stmt->execute(array('drug_id' => $drug_id,
                'drug_qty' => $drug_qty, 'drug_tot' => $drug_split[1]
                ));


                $conn = null;//disconnect the DB
                echo true;
                $_SESSION['info'][] = 'successfull';
            }
            else{
                echo false;
                $_SESSION['ERROR'][] = $drug_name.' not available. Only '.$drug_stock.' remains.';
            }

        } else {
            echo false;
        }
    }
} catch (Exception $ex) {
    $_SESSION['error'][] = $ex->getMessage();
    echo $ex->getMessage();
}
