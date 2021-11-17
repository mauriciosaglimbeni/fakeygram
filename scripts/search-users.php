<?php

    // session starting and db connection
    session_start();
    include('./db.php');

    $search = "";

    // getting form data
    if(isset($_POST['search'])) {
        $search = $_POST['search'];
    }

    if($search != "") { 

        $searchUser = "SELECT * FROM users WHERE name LIKE '$search%' OR email LIKE '$search%'";
        $searchUserStatus = mysqli_query($conn,$searchUser) or die(mysqli_error($conn));
        
        if(mysqli_num_rows($searchUserStatus) > 0) { 
            header('Location: ../search-results.php?message=Search results!');
        } else {
            header('Location: ../search-results.php?message=No user found!');
        }
    } else { 
        header('Location: ../chats.php?message=Please input something!');
    }

    $_SESSION['search'] = $search;
?>