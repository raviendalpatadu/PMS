<?php
require_once '../../control/config.php';
$template = new template();

try {
    $user_id = $_POST['user_id'];

    $sql =' DELETE FROM tbl_login WHERE user_fk= :user_id LIMIT 1;'
        .'DELETE FROM tbl_user WHERE user_id = :user_id LIMIT 1;';

    $stmt = $conn->prepare($sql);

    $stmt->execute([':user_id' => $user_id]);

    $conn = null; //disconnect the DB
    echo true;
    $_SESSION['info'][] = 'User Deleted';

} catch (Exception $ex) {
    $_SESSION['ERROR'][] = $ex->getMessage();
    echo $ex->getMessage();
}
