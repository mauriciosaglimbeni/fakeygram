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
    <div class="container mt-4">
      <?php
        include "extra/snackbar.php";
      ?>
      <div class="card">
        <div class="card-title text-center">
        <strong> SELECT DATA TO ACCESS<br/> </strong>
          <form class="form-inline mt-4" style = "display : inline-block" method = "POST" action = "./adminUsers.php">
            <button class="btn btn-dark my-2 my-sm-0" type="submit">USERS</button>
            <button class="btn btn-dark my-2 my-sm-0" type="submit" formaction="./adminMessages.php">MESSAGES</button>
          </form>
        </div>
        <div class="card-body text-center">
              <a href="./logout.php" class="btn btn-dark">Log Out</a>
          </div>
    </div>
    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="extra/js/snackbar.js"></script>
</body>
</html>