<?php

    // session starting and db connection
    session_start();
    include('./db.php');

    $name = "";
    $email = "";
    $password = "";
    $cpassword = "";
    // $salt = uniqid();

    // getting form data
    if(isset($_POST['name'])) {
        $name = $_POST['name'];
    }
    if(isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if(isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    if(isset($_POST['cpassword'])) {
        $cpassword = $_POST['cpassword'];
    }
    // hashing the password
    $hashPassword = password_hash($password,PASSWORD_DEFAULT);

    // setting up the image settings for profile picture directories
    $target_dir = "../pfp/";
    $target_file = $target_dir . basename($_FILES["pfp"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["pfp"]["tmp_name"]);
        if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
        } else {
        echo "File must be an image.";
        $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($_FILES["pfp"]["size"] > 500000) {
        echo "Sorry, your file is too big.";
        $uploadOk = 0;
    }
  
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["pfp"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["pfp"]["name"]). " has been uploaded.";
        } else {
        echo "Sorry, there was an error uploading your file.";
        }
    }
// when fields are not empty
    if($name != "" && $email != "" && $password != "" && $cpassword != "") { 
        
        $checkUser = "SELECT * FROM users WHERE email = '$email'";
        $checkUserStatus = mysqli_query($conn,$checkUser) or die(mysqli_error($conn));

        if(mysqli_num_rows($checkUserStatus) > 0) { 

            header('Location: ../index.php?message=You have already registered!');

        } else {

            if($password == $cpassword) { 
            
                $image = basename($_FILES["pfp"]["name"]);
                $insertUser = "INSERT INTO users(name,email,password,pfp) VALUES('$name','$email','$hashPassword','$image')";
                $insertUserStatus = mysqli_query($conn,$insertUser) or die(mysqli_error($conn));
    
                if($insertUserStatus) { 
      
                    header('Location: ../index.php?message=You have registered successfully!');
    
                }  else { 
    
                    header('Location: ../register.php?message=Unable to register');
    
                }
    
            } else { !
    
                header('Location: ../register.php?message=Password fields do not match');
    
            }

        }


    } else { // if any of the fields are empty!

        header('Location: ../register.php?message=Please fill the fields properly!');  

    }
?>