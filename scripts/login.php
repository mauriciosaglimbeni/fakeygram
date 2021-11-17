<?php
    
    // session starting and db connection
    session_start();
    include('./db.php');

    $email = "";
    $password = "";

    // getting form data
    if(isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    if(isset($_POST['password'])) {
        $password = $_POST['password'];
    }

// when fields are not empty
    if($email != "" && $password != "") { 
        $checkUser = "SELECT * FROM `users` WHERE `email` = '$email'";
        $checkUserStatus = mysqli_query($conn,$checkUser) or die(mysqli_error($conn));

        if(mysqli_num_rows($checkUserStatus) > 0) { // if user exists

            password_verify($password,$checkUserStatus['password']);


        } else {

            header('Location: ../index.php?message=Unable to login into your account!');

        }

    } else { // if the fields are empty

        header('Location: ../index.php?message=Please fill all the fields');

    }

?>