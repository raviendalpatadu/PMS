<?php

// get database connection
require_once '../../control/config.php';
//echo 'test header';
if (isset($_POST['login'])) {
    $login_username = filter_var($_POST['login_username'], FILTER_SANITIZE_STRING);
    $login_password = filter_var(sha1($_POST['login_password']), FILTER_SANITIZE_STRING);

    // Check given user is available in DB or not

    $stmt = $conn->prepare("SELECT * FROM tbl_login, tbl_user WHERE tbl_user.user_email = :login_username && tbl_login.login_username = :login_username && tbl_login.login_password = :login_password LIMIT 1");
    $stmt->bindParam(':login_username', $login_username);
    $stmt->bindParam(':login_password', $login_password);
    $stmt->execute();
    $result = $stmt->fetchAll();

    
    // check the count of user
    try {

        if (count($result)) {
            $row = $result[0];
            $dbPassword = $row['login_password'];
            $dbtype = $row['login_type'];
      
            //check given password and DB password same ?
            if ($login_password == $dbPassword) {
                echo 'passwords match';
                $_SESSION['user_fname'] = $row['user_fname'];
                $_SESSION['login_type'] = $row['login_type'];
                $_SESSION['login_id'] = $row['user_id'];
//  
                $_SESSION['NAME'] = "Welcome " . $row['user_fname'];
                if ($dbtype == 'Admin') {
                    header("Location: " . BASE_URL . "apps/view/userMgt/main.php?sucsess_admin");
                }
                if ($dbtype == 'Staff') {
                    header("Location: " . BASE_URL . "apps/view/userMgt/main.php?sucsessfull_staff");
                }
                if ($dbtype == 'User') {
                    header("Location: " . BASE_URL . "apps/view/userMgt/main.php?sucsessfull_user");
                }
            } else {
                $_SESSION['ERROR'][] = "Invalid user name/password 1!";
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }
        }else {
            $_SESSION['ERROR'][] = "Invalid user name/password ";
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    } catch (Exception $ex) {
        $_SESSION['ERROR'][] = $ex->getMessage();
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}




$conn = null;
?>