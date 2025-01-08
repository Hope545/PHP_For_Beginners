<?php  

// creating a session
session_start();

// fetching the config.php file to establish the connection with the database
require "config.php"; 

// if the login button is clicked
if(isset($_POST['submit'])){

    // if any of the input field is emppty
    if(empty($_POST['email']) || empty($_POST['password'])){

        // display an alert
        echo "<script>alert('One or more input field is empty.');</script>";
    }
    else{

        // creating variables to store the form details
        $email = $_POST['email'];
        $password = $_POST['password'];

        // checking if the email is valid
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){

            // checking if the user email exist in the database by fetching data from the database
            $fetch = $conn->query("SELECT * FROM `users` WHERE `email` = '$email'");
            $fetch->execute();
            $loginUserFetch = $fetch->fetch(PDO::FETCH_ASSOC);


            if($fetch->rowCount() > 0){

                // checking if the user password matches with the database password
                if(password_verify($password, $loginUserFetch['password'])){

                    // creating sessions to be used in the rest of the pages
                    $_SESSION['email'] = $loginUserFetch['email'];


                    // redirecting the user from the login page to the index.php page
                    header("location: index.php");
                    exit;

                }
                else{

                    // display an alert of invalid password
                    echo "<script> alert('Password is incorrect.');</script>";
                }

            }
            else{

                // display an alert of inexistence of user email
                echo "<script> alert('Email doesn't exist, Register to get started');</script>";  

                // redirecting the user to the register page when the email doesn't exist
                header("location: register.php");
            }

        }
        else{

            // display an alert of invalid email
            echo "<script> alert('Email is invalid.');</script>";
        }
    }
}




?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
            margin: 30px 40% 10px 40%;
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
<p>LOGIN TO SEE YOUR FIRST PHP PAGE</p>
<form action="login.php" method="POST">
    <input type="email" name="email" placeholder="Enter your email" required>
    <input type="password" name="password" placeholder="Enter your password" required>
    <input type="submit" name="submit" value="LOGIN">

</form>
</div>
    
</body>
</html>