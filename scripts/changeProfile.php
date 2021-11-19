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
    $status = "";
    $age = "";
    
    // getting form data 
     if(isset($_POST['newName']));{
         $newName = $_POST['newName'];
     }
     if(isset($_POST['status']));{
        $status = $_POST['status'];
    }
    if(isset($_POST['age']));{
        $age = $_POST['age'];
    }

    // setting up the image settings for profile pictures
    $target_dir = "../pfp/";
    $target_file = $target_dir . basename($_FILES["pfp"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["pfp"]["tmp_name"]);
        if($check !== false) {
        $uploadOk = 1;
        } else {
        $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    if ($_FILES["pfp"]["size"] > 500000) {
        $uploadOk = 0;
    }
  
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["pfp"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["pfp"]["name"]). " has been uploaded.";
    }else{
        $uploadOk = 0;
    }
}
if($newName != '' && $status != '' && $age != ''){
    if($newName != ''){
            if($uploadOk != 0){
            $image = basename($_FILES["pfp"]["name"]);
            $updateUser = "UPDATE users SET name = '$newName', status = '$status', age = '$age', pfp = '$image' WHERE email = '$email'";
            }else{
                $updateUser ="UPDATE users SET name = '$newName', status = '$status', age = '$age' WHERE email = '$email'";
            }
     }else{
        if($uploadOk != 0){
            $image = basename($_FILES["pfp"]["name"]);
            $updateUser = "UPDATE users SET  status = '$status', age = '$age', pfp = '$image' WHERE email = '$email'";
          }else{
              $updateUser ="UPDATE users SET  status = '$status', age = '$age' WHERE email = '$email'";
        }
    }
    $updateUserStatus = mysqli_query($conn,$updateUser) or die(mysqli_error($conn));
    
    if($updateUserStatus){
        header('Location: ../profile.php?message= Your profile was succesfully updated!');
    }else{
        header('Location: ../profile.php?message= Your profile couldn´t be updated');
    }
}else{
    header('Location:../profile.php?message= Please fill the fields!');
}
?>