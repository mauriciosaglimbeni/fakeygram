<?php

    // session starting and db connection
    session_start();
    include('scripts/db.php');

    if(isset($_SESSION['email'])) { 
        $email = $_SESSION['email'];
    } else {
      header('Location: ./index.php?message=Please login first');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FakeyGram</title>
        <!-- css and bootstrap -->
        <link rel="stylesheet" href="extra/css/snackbar.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body onLoad = "myFunction()">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <h4 style="color :#1e69d4;" class="navbar-brand">FakeyGram</h4>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="navbar-brand" href="./chats.php">Inbox </a>
      </li>
      <li class="nav-item active">
        <a class="navbar-brand" href="./outbox.php">Outbox </a>
      </li>
      <li class="nav-item active">
        <a class="navbar-brand" href="./friends.php">Friends</a>
      </li>
      <li class="nav-item">
        <a class="navbar-brand" href="./logout.php">Logout</a>
      </li>
      <?php
        $getUser = "SELECT * FROM users WHERE email = '$email'";
        $getUserStatus = mysqli_query($conn,$getUser) or die(mysqli_error($conn));
        $getUserRow = mysqli_fetch_assoc($getUserStatus);
      ?>
      <li class = "nav-item">
        <a href="profile.php?user=<?=$email?>">
          <img src="./pfp/<?=$getUserRow['pfp']?>" alt="Profile image" width = "40" class = "dropdown"/>
        </a>
      </li>
  </div>
</nav>
    <!-- Friends section -->
    <div class="container mt-4">
      <?php
        include "extra/snackbar.php";
      ?>
         <div class="card">
            <div class="card-title text-center">
                <strong> Friend list</strong>
            </div>
            <div class="card-body">
                <strong> Pending requests: </strong>
                <!-- CODE AND HTML TO GET FRIEND REQUEST DATA AND REDIRECT ACCORDINGLY, 
                    HTML SHOWS WETHER THERE ARE PENDING REQUESTS OR NOT -->
                <?php
                    $user_id = $getUserRow['id'];
                    $getPending = "SELECT * FROM friendship WHERE toWho = '$user_id'";
                    $getPendingStatus = mysqli_query($conn,$getPending);
                    if(mysqli_num_rows($getPendingStatus) > 0){
                        while($getPendingRow = mysqli_fetch_assoc($getPendingStatus)){
                            if($getPendingRow['fStatus'] == 'P'){
                                $from_Who = $getPendingRow['fromWho'];
                                $getSender = "SELECT * FROM users WHERE id = '$from_Who'";
                                $getSenderStatus = mysqli_query($conn,$getSender) or die(mysqli_error($conn));
                                $getSenderRow = mysqli_fetch_assoc($getSenderStatus);
                        
                ?>
                 <div class="card">
                    <div class="card-body">
                        <img src = "./pfp/<?=$getSenderRow['pfp']?>" alt = "pfp" width = "40"/>
                        <span><strong><?=$getSenderRow['name']?></strong></span> <span class="text-muted"><?=$getSenderRow['email'];?></span>
                        <a href="./scripts/declineFriend.php?friend=<?=$getSenderRow['email'];?>" class="btn btn-outline-secondary" style = "float:right">Decline</a></h6>
                        <a href="./scripts/acceptFriend.php?friend=<?=$getSenderRow['email'];?>" class="btn btn-outline-primary" style = "float:right;margin-right:5px;">Accept</a></h6>
                    </div>
                </div><br/>
                
                 <?php
                        }
                    }
                    }else{
                ?>
                <div class="card-body">
                        <div class="text-center"> No friend requests yet!</div>
                    </div>
                <?php
                        }
                ?>
            </div>
            
            <div class="card-body">
                <strong> Friends: </strong>
                <!-- CODE AND HTML TO GET FRIEND DATA AND REDIRECT TO THEIR PROFILE, 
                     HTML SHOWS WETHER THERE ARE FRIENDS OR NOT -->
                     <?php
                    $user_id = $getUserRow['id'];
                    $getFriends = "SELECT * FROM friendship WHERE fStatus = 'F' AND (fromWho = '$user_id' OR toWho = '$user_id')";
                    $getFriendsStatus = mysqli_query($conn,$getFriends);
                    if(mysqli_num_rows($getFriendsStatus) > 0){
                        while($getFriendsRow = mysqli_fetch_assoc($getFriendsStatus)){
                            if($getFriendsRow['fromWho'] == $user_id){
                                 $friend_id = $getFriendsRow['toWho'];
                            }else{
                                 $friend_id = $getFriendsRow['fromWho'];
                             }
                            $getFriendId = "SELECT * FROM users WHERE id = '$friend_id'";
                            $getFriendIdStatus = mysqli_query($conn,$getFriendId);
                            $getFriendIdRow = mysqli_fetch_assoc($getFriendIdStatus);
                ?>
                <div class="card">
                    <div class="card-body">
                        <img src = "./pfp/<?=$getFriendIdRow['pfp']?>" alt = "pfp" width = "40"/>
                        <span><strong><?=$getFriendIdRow['name']?></strong></span> <span class="text-muted"><?=$getFriendIdRow['email'];?></span>
                        <a href="./scripts/deleteFriend.php?friend=<?=$getFriendIdRow['email'];?>" class="btn btn-outline-primary" style = "float:right;">Delete</a></h6>
                        <a href="./profile.php?user=<?=$getFriendIdRow['email'];?>" class="btn btn-outline-primary" style = "float:right;">View Profile</a></h6>
                    </div>
                </div><br/>
                <?php
                    }
                }else{
                ?>
                <div class="card-body">
                        <div class="text-center"> No friends yet!</div>
                    </div>
            </div>
                <?php
                    }
                ?>
         </div>
    </div>
    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="extra/js/snackbar.js"></script>
    </body>
</html>