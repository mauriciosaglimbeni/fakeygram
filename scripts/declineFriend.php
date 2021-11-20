<?php

    // session starting and db connection
    session_start();
    include('./db.php');

    if(isset($_SESSION['email'])) { 
        $email = $_SESSION['email'];
    } else {
      header('Location: ./index.php?message=Please login first');
    }

    $friend = $_GET['friend'];
    // getting both user ids
    $getUser= "SELECT * FROM users where email = '$email'";
    $getUserStatus = mysqli_query($conn,$getUser);
    $getUserRow = mysqli_fetch_assoc($getUserStatus);
    $user_id = $getUserRow['id'];

    $getFriend= "SELECT * FROM users where email = '$friend'";
    $getFriendStatus = mysqli_query($conn,$getFriend);
    $getFriendRow = mysqli_fetch_assoc($getFriendStatus);
    $friend_id = $getFriendRow['id'];

    // UPDATING THE DB
    $updateFriend = "UPDATE friendship SET fStatus = 'N 'WHERE fromWho ='$friend_id' AND toWho = '$user_id'"; 
    $updateFriendStatus = mysqli_query($conn,$updateFriend) or die(mysqli_error($conn));

    if($updateFriendStatus){
        header('Location: ../friends.php?message= Friend request declined!');
    }else{
        header('Location: ../friends.php?message= There was an error denying your request');
    }
?>