<?php
session_start();

// Database connection
$host = "localhost";
$user = "root"; // your DB username
$pass = "";     // your DB password
$db   = "moviedb"; // your DB name

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form submitted
if(isset($_POST['submit'])) {
    // Sanitize inputs
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $message = $conn->real_escape_string(trim($_POST['message']));

    // Insert into database
    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";
    
    if($conn->query($sql) === TRUE) {
        // Success
        $_SESSION['contact_success'] = "Your message has been sent successfully!";
        header("Location: contact.php");
        exit();
    } else {
        // Error
        $_SESSION['contact_error'] = "Error: " . $conn->error;
        header("Location: contact.php");
        exit();
    }
}
$conn->close();
?>
