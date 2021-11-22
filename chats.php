<?php

    // session starting and db connection
    session_start();
    include('scripts/db.php');

    if(isset($_SESSION['email'])) { 
        $email = $_SESSION['email'];
    } else {
      header('Location: ./index.php?message=Please login first');
    }
    if($email == 'admin@root.com'){
      header('Location: ./adminZone.php?message=Welcome back boss!');
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

    <!-- chats section -->
    <div class="container mt-4">
      <?php
        include "extra/snackbar.php";
      ?>
      <div class="card">
        <div class="card-title text-center">
        <strong> Inbox<br/> </strong>
          <form class="form-inline mt-4" style = "display : inline-block" method = "POST" action = "scripts/search-users.php">
            <input class="form-control mr-sm-2" type="search" name = "search" placeholder="Search users" aria-label="Search users" autocomplete="off">
            <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
        <div class="card-body mb-4">
          <?php
            $lastMessage = "SELECT DISTINCT * FROM messages WHERE received_by = '$email' ORDER BY id DESC";
            $lastMessageStatus = mysqli_query($conn,$lastMessage) or die(mysqli_error($conn));
            if(mysqli_num_rows($lastMessageStatus) > 0) {
              while($lastMessageRow = mysqli_fetch_assoc($lastMessageStatus)) {
                $sent_by = $lastMessageRow['sent_by'];
                $last_message = $lastMessageRow['message'];
                $getSender = "SELECT * FROM users WHERE email = '$sent_by'";
                $getSenderStatus = mysqli_query($conn,$getSender) or die(mysqli_error($conn));
                $getSenderRow = mysqli_fetch_assoc($getSenderStatus);

                if(strlen($last_message) > 35){
                  $last_message = substr($last_message,0,35);
                }
          ?>
          <div class="card">
            <div class="card-body">
              <img src = "./pfp/<?=$getSenderRow['pfp']?>" alt = "pfp" width = "40"/>
              <span><strong><?=$getSenderRow['name']?></strong></span> <span class="text-muted"><?=$lastMessageRow['sent_by'];?></span>
              <span><strong class="font-weight-light" style="position:absolute; left:40%;"><?= $last_message?></strong></span>
              <a href="./message.php?receiver=<?=$sent_by?>" class="btn btn-outline-primary" style = "float:right">Send message</a></h6>
              <span class="font-weight-light" style="float:right;margin-right:5px; font-size:0.8em"><?=$lastMessageRow['createdAt']?></span>
            </div>
          </div><br/>
          <?php
            }
          } else {
          ?>
            <div class="card-body text-center">
              <h6><strong>No messages yet!</strong></h6>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>

    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="extra/js/snackbar.js"></script>
</body>
</html>