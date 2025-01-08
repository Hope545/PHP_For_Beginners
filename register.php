<?php

// fetching the config.php file to establish the connection with the database
require "config.php"; 

// ------------------starting with the code for the backend data fetching from the form to the database------------------------

// if the register button is clicked
if(isset($_POST["submit"])){ 

    // if all or any of the input fields are empty but rhe register button is clicked
    if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['password'])){ 

        // show an alert message
        echo '<script> alert("One or more of the input fields are empty.");</script>';
    }
    else{

         // if none of the input fields are empty, then we create a variable to store the form details for each input field
         $firstname = $_POST['firstname'];
         $lastname = $_POST['lastname'];
         $email = $_POST['email'];
         $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // checking if the email the user entered is valid
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){

            // fetching emails from the database to confirm that the same email is not used twice
            $fetch = $conn->query("SELECT `email` FROM `users` WHERE `email` = '$email'");
            $fetch->execute();

            if ($fetch->rowCount() > 0){

                // display an alert 
                echo '<script> alert("Email already exist.");</script>';
            }
            else{

                // inserting the form data to the database
                $insert = $conn->prepare("INSERT INTO `users` (`firstname`, `lastname`, `email`, `password`) VALUES (:firstname, :lastname, :email, :password)");
                $insert->execute([
                    ":firstname" => $firstname,
                    ":lastname" => $lastname,
                    ":email" => $email,
                    ":password" => $password,
                ]);


                // redirecting user from the register page to the login page after a successful registration
                header("location: login.php");
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
    <title>Register</title>

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
<p>REGISTER A FORM TO GET STARTED WITH PHP</p>
<form action="register.php" method="POST">
    <input type="text" name="firstname" placeholder="Enter your firstname" required>
    <input type="text" name="lastname" placeholder="Enter you lastname" required> 
    <input type="email" name="email" placeholder="Enter your email" required>
    <input type="password" name="password" placeholder="Enter your password" required>
    <input type="submit" name="submit" value="RESIGTER">
</form>
</div>
    
</body>
</html>