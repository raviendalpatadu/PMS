<?php
  require_once '../../control/config.php';

//---------------------------logout process------------------------------------------



  // If the user is logged in, delete the session vars to log them out

  if (isset($_SESSION)) {
      
      
        // if (isset($_SESSION['login_type']) && $_SESSION['login_type'] == 'User') {
        //   unset($_SESSION['User']['Cart_'.$_SESSION['login_id']]);
        // }
        // unset($_SESSION['login_id']);
        // unset($_SESSION['login_username']);
        // unset($_SESSION['login_type']);
        // unset($_SESSION['SUCCESS']);
        session_unset();
        
        header("Location: ". BASE_URL ."index.php?");
        die();
        
  }
  
  


?>
