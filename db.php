<?php
$host = "localhost";
$user = "root";   // default WAMP username
$pass = "";       // default password (empty in WAMP unless you set one)
$dbname = "MovieDB";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
