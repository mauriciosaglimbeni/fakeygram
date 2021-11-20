<?php

    // session starting and db connection
    session_start();
    include('scripts/db.php');

    if(isset($_SESSION['email'])) { 
        $email = $_SESSION['email'];
    } else {
      header('Location: ./index.php?message=Please login first');
    }

    $user = $_GET['user'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FakeyGram</title>
    <!-- css and bootstrap -->
    <link rel="stylesheet" href="extra/css/snackbar.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        form,input, button{
            margin-bottom: 5px;
        }
    </style>
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
            <a class="navbar-brand" href="./chats.php">Home </a>
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

<!-- profile area -->
<div class="container mt-4">
      <?php
        include "extra/snackbar.php";
        $getProfile = "SELECT * FROM users WHERE email = '$user'";
        $getProfileStatus = mysqli_query($conn,$getProfile) or die(mysqli_error($conn));
        $getProfileRow = mysqli_fetch_assoc($getProfileStatus);
      ?>
        <div class="card">
            <div class="card-title text-center">
                <h6> Welcome back <?=$getUserRow['name']?>!</h6>
            </div>
                <div class="card-body"> 
                    <img src="./pfp/<?=$getProfileRow['pfp']?>" alt="Profile image" width = "160" height="160" style="float: left;"/>
                    <div style="display: inline-block; position:relative;left:5% ">
                        <strong>- E-mail: <span class="text-muted"><?=$user?></span></strong>
                        <strong><br/>- Name: <span class="text-muted"><?=$getProfileRow['name']?></span></strong>
                        <strong><br/>- Status: <span class="text-muted"><?=$getProfileRow['status']?></span></strong>
                        <strong><br/>- Age: <span class="text-muted"><?=$getProfileRow['age']?></span></strong>
                     </div>
                     <?php
                          if($email == $user) {
                     ?>
                    <strong style="position:relative; left:2em;"><br/><br/> Update your profile: <br</strong>
                    <form style="display:flex; flex-direction:column; align-content:flex-start;" class="form-inline customize"method = "POST" action = "./scripts/changeProfile.php"  enctype = "multipart/form-data">
                        <input class="form-control mr-sm-2" type="text" name = "newName" placeholder="Type a new name" autocomplete="off">     
                        <input class="form-control mr-sm-2" type="text" name = "status" placeholder="How are you feeling?" autocomplete="off">
                        <input class="form-control mr-sm-2" type="text" name="age" placeholder="Type your age" autocomplete="off">
                        <input type="file" class="form-control" id="pfp" name = "pfp" />
                        <button class="btn btn-primary" type="submit" id="submit">Update</button>
                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    <!--  scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="extra/js/snackbar.js"></script>
</body>
</html>