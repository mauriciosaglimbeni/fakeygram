<?php

    // session starting and db connection
    session_start();
    include('scripts/db.php');

    error_reporting(0);
    if(!isset($_SESSION['email'])) {
        header('Location: ./index.php');
    } else {
        $email = $_SESSION['email'];
    }
    $receiver = $_GET['receiver'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FakeyGram</title>
    <!-- css and bootstrap-->
    <link rel="stylesheet" href="extra/css/message.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
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
<!-- Messages screen-->
    <div class="container">
        <?php
            include "extra/snackbar.php";
        ?>
        <?php
            $getReceiver = "SELECT * FROM users WHERE email = '$receiver'";
            $getReceiverStatus = mysqli_query($conn,$getReceiver) or die(mysqli_error($conn));
            $getReceiverRow = mysqli_fetch_assoc($getReceiverStatus);
            $received_by = $getReceiverRow['name'];

            // RECOVERING FRIENDSHIP STATUS
            $user_id = $getUserRow['id'];
            $receiver_id = $getReceiverRow['id'];
            $checkExist = "SELECT * FROM friendship WHERE (fromWho = '$user_id' AND toWho = '$receiver_id') OR  (fromWho = '$receiver_id' AND  toWho ='$user_id')";
            $checkExistStatus = mysqli_query($conn,$checkExist);
            $getExistRow = mysqli_fetch_assoc($checkExistStatus);
            if($getExistRow > 0){
                $fStatus = $getExistRow['fStatus'];
            }else{
                $fStatus = 'N';
            }
            

        ?>
        <div class="card mt-4">
            <div class="card-header">
                <h6><img src="./pfp/<?=$getReceiverRow['pfp']?>" alt="Profile image" width = "40"/><strong> <?=$received_by?>  </strong><span class="text-muted"><?= $getReceiverRow['email']?></span>
              
              
              <?php // OPTION FOR ADDING FRIEND
                    if($fStatus == 'N'){
                ?>
                <a style ="float:right;" href="./scripts/addFriend.php?receiver=<?=$receiver?>"> <button  type = "submit" class="btn btn-primary">Add Friend</button> </a>
                <?php
                    }
                ?>
            </h6>
            </div>
            
            <?php
                $getMessage = "SELECT * FROM messages WHERE sent_by = '$receiver' AND received_by = '$email' OR sent_by = '$email' AND received_by = '$receiver' ORDER BY createdAt asc";
                $getMessageStatus = mysqli_query($conn,$getMessage) or die(mysqli_error($conn));
                if(mysqli_num_rows($getMessageStatus) > 0) {
                    while($getMessageRow = mysqli_fetch_assoc($getMessageStatus)) {
                        
                        $message_id = $getMessageRow['id'];
                        $date = $getMessageRow['createdAt'];
                        $year = substr($date,0,4); 
                        $month =substr($date,5,2);
                        $day = substr($date,8,2);
                        if(date('Y') == $year){
                            $writtenDate = substr($date,5);
                            if(date('m') == $month){
                                $writtenDate = substr($date,8);
                            }
                            if(date('d') == $day){
                                $writtenDate = substr($date,10);
                            }
                        }else{
                            $writtenDate = $date;
                        }
                        $sent_by = $getMessageRow['sent_by'];
                        $getName = "SELECT name FROM users WHERE email = '$sent_by'";
                        $getNameStatus = mysqli_query($conn,$getName);
                        $getNameRow = mysqli_fetch_assoc($getNameStatus);
                        if($sent_by == $email){

            ?>
            <div class="card-body" style="float: right;">
            <!-- <h6 style = "color: #007bff; float:right; ">You</h6> -->
                <div class="message-box ml-4" style="float:right; background-color:lightgray">    
                    <p class="text-center"><?=$getMessageRow['message']?> </p><span style="float: right; opacity:0.7;font-size:0.7em; margin-top:-5%"><?=$writtenDate?></span>
                </div>
            </div>
            <?php
                        }else{
            ?>
            <div class="card-body">
             <!-- <h6 style = "color: #007bff"><?=$getNameRow['name']?></h6> -->
                <div class="message-box ml-4;" >    
                    <p class="text-center"><?=$getMessageRow['message']?></p><span style="float: right;opacity:0.7; font-size:0.7em"><?=$writtenDate?></span>
                </div>
            </div>
            <?php 
                        }
                    } 
                } else {
            ?>
            <div class="card-body">
                    <p class = "text-muted">No messages yet</p>
            </div>
            <?php
                }
            ?>
            <div class="card-footer text-center">
            <form action="scripts/send.php" method = "POST" style = "display: inline-block">
                <input type="hidden" name = "sent_by" value = "<?=$email?>"/>
                <input type="hidden" name = "received_by" value = "<?=$receiver?>"/>
                <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" name = "message" id = "message" class="form-control" placeholder = "Type your message here" autocomplete="off" required/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type = "submit" class="btn btn-primary">Send</button>
                        </div>
            </form>
                        <!-- <form action="./scripts/sendPic.php" method="POST" style="display:flex; flex-direction: row;">
                            <input type="hidden" name = "sent_by" value = "<?=$email?>"/>
                            <input type="hidden" name = "received_by" value = "<?=$receiver?>"/>            
                            <label for="images" class="fa fa-paperclip col-md-1 " style="font-size:2em;cursor:pointer; color:gray;">
                                 <input type="file"  style="display:none;" id="images" name="images"/>
                            </label>    
                            <button type="submit" name="submit2" class="btn btn-secondary" style="position:relative; left:1.5em;">Send pic</button>
                        </form> -->
                    </div>
                
            </div>
        </div>
    </div>

 <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>