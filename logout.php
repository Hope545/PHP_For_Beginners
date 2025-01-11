<?php 


// starting session
session_start();

// fetching the connection
require "config.php";

// getting the sessions email
if(isset($_GET['id'])){

    // fetching data from the database
    $fetch = $conn->query("SELECT * FROM `users` WHERE `id` = '$_GET[id]'");
    $fetch->execute();

    if ($fetch->rowCount() > 0){

        // unsettin sessions and destroying sessions
        session_unset();
        session_destroy();

        // redirecting the use to login page
        header("location: login.php");
    }
}
else{
        // redirecting the use to login page
        header("location: login.php");
}
