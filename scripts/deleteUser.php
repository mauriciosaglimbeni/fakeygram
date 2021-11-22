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
    $user = $_GET['user'];

    // deleting the user and their friendships
    $getUserId = "SELECT id FROM users WHERE email = '$user'";
    $getUserIdStatus = mysqli_query($conn,$getUserId);
    $getUserIdRow = mysqli_fetch_assoc($getUserIdStatus);
    $id = $getUserIdRow['id'];
    $deleteUser = "DELETE FROM users WHERE id = '$id'";
    $deleteUserStatus = mysqli_query($conn, $deleteUser) or die(mysqli_error($conn));

    $deleteFriendships = "DELETE FROM friendships WHERE toWho = '$id' or fromWho = '$id'";

    header('Location: ../adminUsers.php?message=User deleted');
?>