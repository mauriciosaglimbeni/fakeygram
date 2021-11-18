<?php
    
    // session starting and db connection
    session_start();
    include('./db.php');

    if(isset($_SESSION['email'])) { 
        $email = $_SESSION['email'];
    } else {
      header('Location: ./index.php?message=Please login first');
    }
    $newName = "";

    // getting form data 
     
    if(isset($_POST['newName'])) {
        $newName = $_POST['newName'];
    }else{
        header('Location: ./profile.php?message=You must type a new name!');
    }

    $updateUser = "UPDATE users SET name='$newName' WHERE email = '$email'";
    $updateUserStatus = mysqli_query($conn,$updateUser);
    if($updateUserStatus) { 
      
        header('Location: ../profile.php?message=You have succesfully updated your name!');

    }  else { 

        header('Location: ../profile.php?message=Unable to update your name');

    }

?>