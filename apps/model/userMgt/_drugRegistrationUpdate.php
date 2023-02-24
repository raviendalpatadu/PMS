<?php
require_once '../../control/config.php';
$template = new template();

try {
        $drug_id = $_POST['drug_id'];
        $drug_name = $_POST['drug_name'];
        $drug_brand = $_POST['drug_brand'];
        $drug_description = $_POST['drug_description'];
        $drug_stock = $_POST['drug_stock'];
        $drug_price = $_POST['drug_price'];
        $drug_expDate = $_POST['drug_expDate'];

    if (isset($_POST['drug_id'])) {

        if (empty($_SESSION['ERROR'])) {
            $sql = 'UPDATE tbl_drug '
                .'SET drug_name=:drug_name, drug_brand=:drug_brand, drug_description=:drug_description, drug_stock=:drug_stock, drug_price=:drug_price, drug_expDate=:drug_expDate WHERE drug_id=:drug_id';
                
        
            $stmt = $conn->prepare($sql);
            $stmt->execute(array('drug_id' => $drug_id,
            'drug_name' => $drug_name,
            'drug_brand' => $drug_brand,
            'drug_description' => $drug_description,
            'drug_stock' => $drug_stock,
            'drug_price' => $drug_price,
            'drug_expDate' => $drug_expDate));
            $conn = null;//disconnect the DB
            echo true;
            $_SESSION['info'][] = 'Updated class:' . $drug_name;
            
        } else{
            echo false;
        }
    }

} catch (Exception $ex){
    $_SESSION['ERROR'][] = $ex->getMessage();
    echo $ex->getMessage();
}

?>


