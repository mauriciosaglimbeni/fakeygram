<?php

    // session starting and db connection
    session_start();
    include('./db.php');

    $sent_by = "";
    $received_by = "";
    $message = "";
    $createdAt = date("Y-m-d h:ia");

    // getting form data
    if(isset($_POST['sent_by'])) {
        $sent_by = $_POST['sent_by'];
    }

    if(isset($_POST['received_by'])) {
        $received_by = $_POST['received_by'];
    }

    if(isset($_POST['message'])) {
        $message = $_POST['message'];
    }

    if($message != "") {
        $sendMessage = "INSERT INTO messages(sent_by,received_by,message,createdAt) VALUES('$sent_by','$received_by','$message','$createdAt')";
        $sendMessageStatus = mysqli_query($conn,$sendMessage) or die(mysqli_error($conn));
        if($sendMessageStatus) {
            header("Location: ../message.php?receiver=$received_by");
        } else {
            header("Location: ../message.php?receiver=$received_by");
        }
    }
?>