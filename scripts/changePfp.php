<?php
    
    // session starting and db connection
    session_start();
    include('./db.php');

    if(isset($_SESSION['email'])) { 
        $email = $_SESSION['email'];
    } else {
      header('Location: ./index.php?message=Please login first');
    }

?>