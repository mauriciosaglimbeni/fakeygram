<?php
    
    // session starting and db connection
    session_start();
    include('./db.php');

    if(isset($_SESSION['email'])) { 
        $email = $_SESSION['email'];
    } else {
      header('Location: ./index.php?message=Please login first');
    }
    // setting up the image settings for profile picture directories
    $target_dir = "../pfp/";
    $target_file = $target_dir . basename($_FILES["newPfp"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(isset($_POST["submitPfp"])) {
        $check = getimagesize($_FILES["newPfp"]["tmp_name"]);
        if($check !== false) {
          $uploadOk = 1;
        } else {
          $uploadOk = 0;
        }
    }
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }
    if ($_FILES["newPfp"]["size"] > 500000) {
        $uploadOk = 0;
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["newPfp"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["newPfp"]["name"]). " has been uploaded.";
    }else{
        $uploadOk = 0;
    }
}
if($uploadOk == 1){
  $image = basename($_FILES["newPfp"]["name"]);
  $updateUser = "UPDATE users SET pfp='$image' WHERE email = '$email'";
  $updateUserStatus = mysqli_query($conn,$updateUser);
    if($updateUserStatus){
      header('Location: ../profile.php?message=You have succesfully updated your profile picture!');
    }else{
      header('Location: ../profile.php?message=Unable to update your profile picture');
    }
  }
?>