<?php
require_once '../../control/config.php';
$template = new template();
try {
        $sql = 'SELECT * from tbl_drug';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array());
        $rows = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $rows[] = $row;
        }
        echo json_encode($rows);
        // echo "<pre>";
        // print_r(json_encode($rows));
        // echo "</pre>";
} catch (\Throwable $th) {
        $_SESSION['error'][] = $ex->getMessage();
        echo $ex->getMessage();
}
