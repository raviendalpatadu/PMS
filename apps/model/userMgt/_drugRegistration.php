<?php
require_once '../../control/config.php';
$template = new template();

try {
        $drug_id = $_POST['drug_id'];
        $drug_name = $_POST['drug_name'];
        $drug_brand = $_POST['drug_brand'];
        $drug_stock = $_POST['drug_stock'];
        $drug_price = $_POST['drug_price'];
        $drug_expDate = $_POST['drug_expDate'];
        echo "hello";
//used to handel eerors
    if (isset($_POST['insert'])) {
        
        $sql = 'INSERT INTO tbl_drug(drug_name, drug_brand, drug_stock, drug_price, drug_expDate)'
                .'VALUES(:drug_name, :drug_brand, :drug_stock, :drug_price, :drug_expDate)';
        
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('drug_name' => $drug_name,
            'drug_brand' => $drug_brand,
            'drug_stock' => $drug_stock,
            'drug_price' => $drug_price,
            'drug_expDate' => $drug_expDate));
        
      
        $conn = null;//disconnect the DB
        header("Location:" . BASE_URL . "apps/view/userMgt/drugRegistration.php?drug_created=true");
               
    }
    
    if (isset($_POST['update'])) {
        $sql = 'UPDATE tbl_drug '
                .'SET drug_name=:drug_name, drug_brand=:drug_brand, drug_stock=:drug_stock, drug_price=:drug_price, drug_expDate=:drug_expDate WHERE drug_id=:drug_id';
                
        
        $stmt = $conn->prepare($sql); 
        $stmt->execute(array('drug_id' => $drug_id,
            'drug_name' => $drug_name,
            'drug_brand' => $drug_brand,
            'drug_stock' => $drug_stock, 
            'drug_price' => $drug_price, 
            'drug_expDate' => $drug_expDate));
        $conn = null;//disconnect the DB
        // echo 'Updated class:' . $drug_name;
        $_SESSION['info'][] = 'Updated class:' . $drug_name;
        // header("Location:" . BASE_URL . "apps/view/userMgt/drugs.php?drug_updated=true");
       
    }
     if (isset($_POST['delete'])) {
        
        $sql = 'DELETE FROM tbl_drug '
                .'WHERE drug_id=:drug_id';
                
        
        $stmt = $conn->prepare($sql); 
        $stmt->execute(array('drug_id' => $drug_id));
        
            
        $conn = null;//disconnect the DB
//        echo 'Deleted ';
        $_SESSION['info'][] = 'Removed class:' . $drug_name;
        header("Location:" . BASE_URL . "apps/view/userMgt/drugs.php?drug_deleted=true");
          
    }
} catch (Exception $ex){
    $_SESSION['error'][] = $ex->getMessage();
    echo $ex->getMessage();
}

?>


