-- Create the database
CREATE DATABASE IF NOT EXISTS starting_php;

-- Use the created database
USE starting_php;

-- Create the 'users' table
CREATE TABLE IF NOT EXISTS users (
    id INT(10) AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Optional: Add a comment for clarification
-- The 'id' column is the primary key and auto-increments for each new user.
-- All other fields store user information as strings of up to 255 characters.
