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
        $query = "SELECT * FROM 'users' WHERE 'email' = '$email'";
        $queryRes = mysqli_query($conn,$query) or die(mysqli_error($conn));

        if(mysqli_num_rows($queryRes) > 0) { // if user exists
                $pw = mysqli_query($conn,"SELECT 'password' FROM 'users' WHERE 'email' = '$email'");
                if(password_verify($password,$pw)){
                    header('Location: ../chats.php?message=Welcome back');
                }
            
        } else {
            header('Location: ../index.php?message=Unable to login into your account!');

        }

    } else { // if the fields are empty

        header('Location: ../index.php?message=Please fill all the fields');

    }

?>