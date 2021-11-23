
<?php
    // THIS SCRIPT DOESN´T WORK ***************** IGNORE 
    // session starting and db connection
    session_start();
    include('./db.php');

    $sent_by = "";
    $received_by = "";
    $createdAt = date("Y-m-d h:ia");

    // getting form data
    if(isset($_POST['sent_by'])) {
        $sent_by = $_POST['sent_by'];
    }

    if(isset($_POST['received_by'])) {
        $received_by = $_POST['received_by'];
    }

        // setting up the image settings for profile picture directories
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["images"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        if(isset($_POST["submit2"])) {
            $image = $_POST['images'];
            $check = getimagesize($_FILES["images"]["tmp_name"]);
            if($check !== false) {
            $uploadOk = 1;
            } else {
            $uploadOk = 0;
            }
        }
    
        if ($_FILES["images"]["size"] > 500000) {
            $uploadOk = 0;
        }
      
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $uploadOk = 0;
        }
    
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["images"]["name"]). " has been uploaded.";
        }else{
            $uploadOk = 0;
        }
    }

    if($uploadOk != 0) {
        $image = $image = basename($_FILES["images"]["name"]);
        $sendMessage = "INSERT INTO messages(sent_by,received_by,message,createdAt) VALUES('$sent_by','$received_by','$image','$createdAt')";
        $sendMessageStatus = mysqli_query($conn,$sendMessage) or die(mysqli_error($conn));
        if($sendMessageStatus) {
            header("Location: ../message.php?receiver=$received_by");
        } else {
            header("Location: ../message.php?receiver=$received_by");
        }
    }else{
        header("Location: ../message.php?receiver=$received_by");
    }

?>