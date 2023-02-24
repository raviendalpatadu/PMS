<?php
require_once '../../control/config.php';
$template = new template();


$user_fname = $_POST['user_fname'];
$user_lname = $_POST['user_lname'];
$user_mobile = $_POST['user_mobile'];
$user_address = $_POST['user_address'];
$user_email = $_POST['user_email'];
$user_type = $_POST['user_type'];
$user_password = $_POST['user_password'];
//used to handel eerors
try {


    $sql = 'INSERT INTO tbl_user(user_fname, user_lname, user_mobile, user_address, user_email)'
        . 'VALUES(:user_fname, :user_lname, :user_mobile, :user_address, :user_email);'
        . 'INSERT INTO tbl_login(user_fk, login_username, login_password, login_type)'
        . 'VALUES((SELECT user_id FROM tbl_user WHERE user_email= :user_email),:login_username, :login_password, :login_type)';

    $stmt = $conn->prepare($sql);
    $stmt->execute(array(
        'user_fname' => $user_fname,
        'user_lname' => $user_lname,
        'user_mobile' => $user_mobile,
        'user_address' => $user_address,
        'user_email' => $user_email,
        'login_username' => $user_email,
        'login_password' => sha1($user_password),
        'login_type' => $user_type
    ));
    $conn = null; //disconnect the DB
    echo true;
} catch (Exception $ex) {
    $_SESSION['error'][] = $ex->getMessage();
    echo $ex->getMessage();
}
