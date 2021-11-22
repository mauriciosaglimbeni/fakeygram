<?php
    session_start();
    $email = $_SESSION['email'];
    unset($_SESSION["email"]);
    session_destroy();
    if($email != 'admin@root.com'){
    header("Location:./index.php?message=You have been successfully logged out!");
    }else{
        header("Location:./index.php?message=Good bye Boss!");
    }
?>