<?php

// The first step of creating a backend is to create a connection from the website to the database

try{
    // 1. define the host name
    define("HOST", "localhost");

    // define the database name
    define("DBNAME", "starting_php");

    // define the user
    define("USER", "root");

    // define the password
    define("PASS", "");

    // establishing a connection to the database with the defined varables
    $conn = New PDO("mysql:host=" . HOST. ";dbname=" . DBNAME, USER, PASS);
    $conn->setAttribute(PDO::ATTR_AUTOCOMMIT, PDO::ERRMODE_EXCEPTION);

    // echo "welcome";
}

catch(PDOException $errorExpection){
    // getting error messgae when there's an error fromthe connection with the database and the website
    $errorExpection->getMessage();
}



