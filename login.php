<?php
session_start();

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "moviedb"; // your existing database

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if login form submitted
if(isset($_POST['login'])) {
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = trim($_POST['password']);

    // Fetch user by email
    $sql = "SELECT * FROM users WHERE Email='$email' LIMIT 1";
    $result = $conn->query($sql);

    if($result->num_rows == 1){
        $user = $result->fetch_assoc();

        // Verify password
        if(password_verify($password, $user['Password'])){
            // Login successful, store session
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['user_name'] = $user['Username'];
            header("Location: index.php"); // redirect after login
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid password!";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = "User not found!";
        header("Location: index.php");
        exit();
    }
}

$conn->close();
?>
