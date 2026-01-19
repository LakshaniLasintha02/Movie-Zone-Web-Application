<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "moviedb";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form submitted
if(isset($_POST['register'])){

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate fields
    if(empty($username) || empty($email) || empty($password) || empty($confirm_password)){
        $_SESSION['register_error'] = "All fields are required!";
        header("Location: register.php");
        exit();
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['register_error'] = "Invalid email format!";
        header("Location: register.php");
        exit();
    }

    if($password !== $confirm_password){
        $_SESSION['register_error'] = "Passwords do not match!";
        header("Location: register.php");
        exit();
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT UserID FROM users WHERE Email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0){
        $_SESSION['register_error'] = "Email already registered!";
        $stmt->close();
        header("Location: register.php");
        exit();
    }
    $stmt->close();

    // Hash password and insert
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (Username, Email, Password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if($stmt->execute()){
        $_SESSION['register_success'] = "Registration successful! You can now sign in.";
        $stmt->close();
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['register_error'] = "Database error: " . $stmt->error;
        $stmt->close();
        header("Location: register.php");
        exit();
    }
}

$conn->close();
?>

