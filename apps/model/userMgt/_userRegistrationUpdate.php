<?php
require_once '../../control/config.php';
$template = new template();

try {
    $user_fname = $_POST['user_fname'];
    $user_lname = $_POST['user_lname'];
    $user_id = $_POST['user_id'];
    $user_mobile = $_POST['user_mobile'];
    $user_address = $_POST['user_address'];
    $user_email = $_POST['user_email'];


    if (isset($_POST['user_id'])) {
        $sql = 'UPDATE tbl_user '
            . 'SET user_fname=:user_fname, user_lname=:user_lname, user_mobile=:user_mobile, user_address=:user_address, user_email=:user_email WHERE user_id=:user_id;'
            . 'UPDATE tbl_login SET login_username=:user_email WHERE login_id=:user_id LIMIT 1';


        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            'user_fname' => $user_fname,
            'user_lname' => $user_lname,
            'user_id' => $user_id,
            'user_mobile' => $user_mobile,
            'user_address' => $user_address,
            'user_email' => $user_email
        ));
        // $conn = null; //disconnect the DB
        echo true;
        $_SESSION['info'][] = 'Updated class:' . $user_fname;
        // header("Location:" . BASE_URL . "apps/view/userMgt/userRegistration_V.php?user_updated=true");
    }
    if (!empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
        $password = sha1($_POST['new_password']);
        $id = $_POST['user_id'];
        $user_fname = $_POST['user_fname'];
        // $sql_pass = 'UPDATE tbl_login SET login_password=:new_password WHERE user_fk=:user_id LIMIT 1';
        $sql = 'UPDATE tbl_login '
                .'SET login_password=:password WHERE user_fk=:user_id';
                
        
            $stmt = $conn->prepare($sql);
            $stmt->execute(array('user_id' => $id,
            'password' => $password));
            echo true;
            // echo "jk: ".$id;
            $_SESSION['info'][] = 'Password Changed:' . $user_fname;
        }
        $conn = null;//disconnect the DB
    } catch (Exception $ex) {
    $_SESSION['error'][] = $ex->getMessage();
    echo $ex->getMessage();
}
