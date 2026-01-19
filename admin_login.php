<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE Email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    // 🔹 Plain text password check (no hashing)
    if($admin && $password === $admin['Password']){
        $_SESSION['admin_name'] = $admin['Username'];
        $_SESSION['admin_id'] = $admin['AdminId'];
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<style>
/* Background slideshow (like signIn.php) */
body {
  margin: 0;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background-size: cover;
  background-position: center;
  animation: slideBG 70s infinite;
  font-family: Arial, sans-serif;
  overflow: hidden;
}
body::before {
  content: "";
  position: absolute;
  top:0; left:0;
  width:100%; height:100%;
  background-color: rgba(0,0,0,0.5);
  z-index:1;
}

/* Form container */
form {
  position: relative;
  z-index: 2;
  background: rgba(255,255,255,0.95);
  padding: 40px;
  border-radius: 12px;
  width: 350px;
  text-align: center;
  box-shadow: 0 6px 15px rgba(0,0,0,0.3);
  animation: fadeIn 1s ease-in-out;
}
@keyframes fadeIn {
  from { opacity:0; transform:translateY(-20px);}
  to {opacity:1; transform:translateY(0);}
}

/* Inputs */
input {
  width: 100%;
  padding: 12px;
  margin: 10px 0;
  border: 1px solid #ddd;
  border-radius: 6px;
  font-size: 14px;
}
input::placeholder { color:#888; }

/* Button */
button {
  width: 100%;
  padding: 12px;
  margin-top: 15px;
  background: #f44336;
  border: none;
  color: #fff;
  font-size: 16px;
  border-radius: 6px;
  cursor: pointer;
  transition: 0.3s;
}
button:hover { background:#d32f2f; }

/* Error */
.error {
  color: red;
  margin-bottom: 10px;
  font-weight: bold;
}

/* Background slideshow */
@keyframes slideBG {
  0%   { background-image: url('img/home6.jpg'); }
  20%  { background-image: url('img/home1.jpg'); }
  40%  { background-image: url('img/home3.jpg'); }
  60%  { background-image: url('img/home7.jpg'); }
  80%  { background-image: url('img/home9.jpg'); }
  100% { background-image: url('img/home5.jpg'); }
}
</style>
</head>
<body>
<form method="post" action="" autocomplete="off">
  <h2>Admin Login</h2>
  <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

  <!-- Prevent autofill -->
  <input type="text" name="fakeuser" style="display:none" autocomplete="off">
  <input type="password" name="fakepass" style="display:none" autocomplete="off">

  <!-- Real fields -->
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit" name="login">Login</button>
  
</form>
</body>
</html>







