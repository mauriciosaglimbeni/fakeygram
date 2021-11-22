<?php
// session starting and db connection
    session_start();
    include('./db.php');

    if(isset($_SESSION['email'])) { 
        $email = $_SESSION['email'];
        if($email != 'admin@root.com'){
            header('Location: ./index.php?message=This user doesn´t have access to this section');
        }
    } else {
      header('Location: ./index.php?message=Please login first');
    }
    $id = $_GET['msgId'];

    // deleting the message
    $deleteMsg = "DELETE FROM messages WHERE id = '$id'";
    $deleteUserMsg = mysqli_query($conn, $deleteMsg) or die(mysqli_error($conn));

    

    header('Location: ../adminMessages.php?message=Message deleted');
?>