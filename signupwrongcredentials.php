<?php
// signup.php

// Connect to your database
$conn = new mysqli('localhost', 'root', '', 'userdb');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the username already exists
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $error_message = "Username or Password already exists! Please choose a different one.";
    } else {
        // Check if the password already exists (optional)
        $query = "SELECT * FROM users WHERE password = '$password'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $error_message = "Username or Password already exists! Please choose a different one.";
        } else {
            // Insert the new user into the database
            $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
            mysqli_query($conn, $query);
            header("Location: signup.php"); // Redirect to login page
            exit;
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>