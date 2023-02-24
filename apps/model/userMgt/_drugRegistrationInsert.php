<?php
require_once '../../control/config.php';
$template = new template();

try {

    $drug_name = $_POST['drug_name'];
    $drug_brand = $_POST['drug_brand'];
    $drug_description = $_POST['drug_description'];
    $drug_stock = $_POST['drug_stock'];
    $drug_price = $_POST['drug_price'];
    $drug_expDate = $_POST['drug_expDate'];
    
//used to handel eerors
    if (isset($_POST['drug_name'])) {
        $reqFeilds = array('drug_name','drug_brand', 'drug_description' ,'drug_stock','drug_price','drug_expDate');
        if (empty($_SESSION['ERROR'])) {
            
            $sql = 'INSERT INTO tbl_drug(drug_name, drug_brand, drug_description, drug_stock, drug_price, drug_expDate)'
                    .'VALUES(:drug_name, :drug_brand, :drug_description, :drug_stock, :drug_price, :drug_expDate)';
            
            $stmt = $conn->prepare($sql);
            $stmt->execute(array('drug_name' => $drug_name,
                'drug_brand' => $drug_brand,
                'drug_description' => $drug_description,
                'drug_stock' => $drug_stock,
                'drug_price' => $drug_price,
                'drug_expDate' => $drug_expDate));    
            echo true;  
        } else{
            echo false;
        }
    }
    
} catch (Exception $ex){
    $_SESSION['ERROR'][] = $ex->getMessage();
    echo $ex->getMessage();
}

?>


