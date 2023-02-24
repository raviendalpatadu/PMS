<?php
require_once '../../control/config.php';
$template = new template();

try {
    $drug_id = $_POST['drug_id'];

    $sql = 'DELETE FROM tbl_drug WHERE drug_id = :drug_id LIMIT 1';

    $stmt = $conn->prepare($sql);

    $stmt->execute([':drug_id' => $drug_id]);

    $conn = null; //disconnect the DB
    echo true;
    $_SESSION['info'][] = 'Medicine Deleted';

} catch (Exception $ex) {
    $_SESSION['ERROR'][] = $ex->getMessage();
    echo $ex->getMessage();
}
