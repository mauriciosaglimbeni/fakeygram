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
            if($email == 'admin@root.com'){
                $getUser = "SELECT * FROM users WHERE email = '$email'";
                $getUserStatus = mysqli_query($conn,$getUser) or die(mysqli_error($conn));
                if(mysqli_num_rows($getUserStatus) > 0) { // if user exists
                    $getUserRow = mysqli_fetch_assoc($getUserStatus);
                    if(password_verify($password,$getUserRow['password'])){
                        $_SESSION['email'] = $email;
                        header('Location: ../adminZone.php?message=Welcome back Boss!');
                    }
                
            } else {
                header('Location: ../index.php?message=Unable to login into your account!');

            }
               
            }else{
                
                 $getUser = "SELECT * FROM users WHERE email = '$email'";
                $getUserStatus = mysqli_query($conn,$getUser) or die(mysqli_error($conn));
                if(mysqli_num_rows($getUserStatus) > 0) { // if user exists
                        $getUserRow = mysqli_fetch_assoc($getUserStatus);
                        if(password_verify($password,$getUserRow['password'])){
                            $_SESSION['email'] = $email;
                            header('Location: ../chats.php?message=Welcome back');
                        }
                    
                } else {
                    header('Location: ../index.php?message=Unable to login into your account!');

                }
            }
    } else { // if the fields are empty

        header('Location: ../index.php?message=Please fill all the fields');

    }

?>