<?php

    // session starting and db connection
    session_start();
    include('scripts/db.php');
    error_reporting(0);

    $message = $_GET['message'];
    
    if(isset($_SESSION['email'])) { 
        header('Location: ./chats.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FakeyGram</title>
    <!-- External css and bootstrap -->
    <link rel="stylesheet" href="./extra/css/style.css">
    <link rel="stylesheet" href="./extra/css/snackbar.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body onLoad = "myFunction()">

    <div class="container mt-4 text-center">
        <?php
         include "extra/snackbar.php";
        ?>
        <div class="card" style = "display : inline-block">
            <div class="card-title mt-4">
                <strong style="color :#1e69d4;"><h3>FakeyGram</h3></strong>
                <strong><h4>Log In</h4></strong>
            </div>
            <div class="card-body">
                <form action="scripts/login.php" method = "POST">
                    <div class="form-group">
                        <input type="email" name = "email" id = "email" placeholder = "Email" class="form-control" autocomplete="off" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" name = "password" id = "password" placeholder = "Password" class="form-control" required/>
                    </div>
                    <div>
                        <a style="position:relative; bottom:12px"href="#">Forgot your password?</a>
                    </div>
                    <button type = "submit" class = "btn btn-primary">Log In</button>
                    <p class = "text-muted">New to FakeyGram? <a href="./registration.php">Sign Up Here!</a></p>
                </form>
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