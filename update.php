<?php       

// starting the session
session_start();

// fetching the connection to the database
require "config.php";

// making sure nobody can access this page when logged in
if(!isset($_SESSION['email'])){

    // redirecting the user to the login page
    header("location: login.php");
}

// getting the update user's id 
if(isset($_GET['id'])){
    $id = $_GET['id'];
}

// fetching the user's details from the database
$fetchUser = $conn->query("SELECT * FROM `users` WHERE `id` = '$id'");
$fetchUser->execute();
$fetchUserDetails = $fetchUser->fetch(PDO::FETCH_ASSOC);


// checking if data is fetched
if($fetchUser->rowCount() > 0){

    // creating variables to store the first and last name of the user
    $userId = $fetchUserDetails['id'];
    $firstname = $fetchUserDetails['firstname'];
    $lastname = $fetchUserDetails['lastname'];
    $email = $fetchUserDetails['email'];
    $password = $fetchUserDetails['password']; 
}

// ---------------------------

// when the update button is clicked
if(isset($_POST['submit'])){

    // if all or any of the input fields are empty but rhe register button is clicked
    if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['id'])){ 

        // show an alert message
        echo '<script> alert("One or more of the input fields are empty.");</script>';
    }
    else{

         // if none of the input fields are empty, then we create a variable to store the form details for each input field
         $firstname = $_POST['firstname'];
         $lastname = $_POST['lastname'];
         $email = $_POST['email'];
         $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
         $id = $_POST['id'];

        // checking if the email the user entered is valid
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){

            // fetching emails from the database to confirm that the same email is not used twice
            $update = $conn->prepare("UPDATE `users` SET  `firstname` = :firstname, `lastname` = :lastname, `email` = :email, `password` = :password  WHERE `id` = :id");
            $update->execute([
                ":firstname" => $firstname,
                ":lastname" =>$lastname,
                ":email" =>$email,
                ":password" => $password,
                ':id' => $id,
            ]);


            if ($update->rowCount() > 0){

                // after a successful update, redirecting the user back to the view.php page
                header("location: view.php");
                exit;
            }
            
        }
        else{

            // sends an alert that the email is invalid
            echo '<script> alert("Email is invalid.");</script>';
        }
    }

}



?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: 0;
            font-family: sans-serif;
        }

        body{
            width: 100%;
            height: 100vh;
            
        }

        .form{
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background: linear-gradient(to top right, rgba(0, 0, 255, 0.24), white);
        }

        .form p{
            font-size: 1.3em;
            padding: 30px;
            box-shadow: 0 0 5px blue;
            border-radius: 10px;
            margin-bottom: 20px;
            background-color: rgba(0, 0, 255, 0.062);
            color: rgb(0, 0, 100);
            cursor: default;
            width: 25%;
            text-align: center;
        }

        .form form{
            width: 23%;
            height: auto;
            box-shadow: 0 0 5px blue;
            background-color: rgba(0, 0, 255, 0.062);
            padding: 10px 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            
        }

        form input{
            width: 100%;
            margin: 10px 0;
            border: 1px solid blue;
            padding: 10px;
            border-radius: 5px;
            font-size: 1.1em;
            text-align: center;
            outline: none;
            transition: 0.5;
        }

        form input:focus{
          border: 2px solid blue;
          outline-color: blue;
        }

        

        form input:last-child{
            width: auto;
            border: 0;
            font-size: 1.2em;
            margin: 50px 40% 10px 40%;
            background-color: rgb(2, 2, 161);
            color: rgb(255, 255, 255);
            cursor: pointer;
            transition: 1s;
        }

        form input:last-child:hover{
        transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="form">
<p>UPDATE YOUR REGISTERED FORM TO  WITH PHP</p>
<form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>"> 
    <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="Enter your firstname">
    <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="Enter you lastname"> 
    <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter your email">
    <input type="password" name="password" value="<?php echo $password; ?>" placeholder="Enter your password">
    <input type="submit" name="submit" value="UPDATE">
</form>
</div>
    
</body>
</html>