<?php              

// starting the session
session_start();

// fetching the connection to the database
require "config.php";

// getting the id of the user we want to delete
if(isset($_GET['id'])){

    // creating a variable to store the id
    $id = $_GET['id'];


    // fetching data from the database to ensure the the user to be deleted is in the database
    $fetchUser = $conn->query("SELECT `email` FROM `users` WHERE `id` = '$id'");
    $fetchUser->execute();

    // /if the user exists in the database then the delete action should be completed
    if($fetchUser->rowCount() > 0){

        // deleting everything from the database with the id
        $deleteUser = $conn->query("DELETE FROM `users` WHERE `id` = '$id'");
        $deleteUser->execute();

        // redirecting the user back to the view.php page
        header("location: view.php");
        
    }
    else{

        // redirecting the user back to the view.php page
        header("location: view.php");
    }
}