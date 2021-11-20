<?php

    // session starting and db connection
    session_start();
    include('db.php');

    error_reporting(0);
    if(!isset($_SESSION['email'])) {
        header('Location: ./index.php');
    } else {
        $email = $_SESSION['email'];
    }
    $receiver = $_GET['receiver'];

    // getting users ids

    $getUser = "SELECT * FROM users WHERE email = '$email'";
    $getUserStatus = mysqli_query($conn,$getUser) or die(mysqli_error($conn));
    $getUserRow = mysqli_fetch_assoc($getUserStatus);

    $getReceiver = "SELECT * FROM users WHERE email = '$receiver'";
    $getReceiverStatus = mysqli_query($conn,$getReceiver) or die(mysqli_error($conn));
    $getReceiverRow = mysqli_fetch_assoc($getReceiverStatus);

    
    $user_id = $getUserRow['id'];
    $receiver_id = $getReceiverRow['id'];

    // creating relation
   
         $insertExist = "INSERT INTO friendship (fromWho,toWho,fStatus) VALUES ('$user_id','$receiver_id','P')";
         $insertExistStatus = mysqli_query($conn,$insertExist);
         if(!$insertExistStatus){
             $updateExist =  "UPDATE friendship SET fStatus = 'P 'WHERE fromWho ='$user_id' AND toWho = '$receiver_id'";
         }
         header("Location: ../message.php?receiver=$receiver");
?>