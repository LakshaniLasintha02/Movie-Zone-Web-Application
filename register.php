<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Movie Zone</title>
  <style>
    * { margin:0; padding:0; box-sizing:border-box; font-family: Arial, sans-serif; }
    body, html { height:100%; width:100%; overflow:hidden; }

    /* Header with background slideshow */
    .header {
      position: relative;
      width: 100%;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #220606ff;
      background-size: cover;
      background-position: center;
      animation: slideBG 70s infinite;
    }

    .header::before {
      content: "";
      position: absolute;
      top:0; left:0;
      width:100%; height:100%;
      background-color: rgba(0,0,0,0.5);
      z-index:1;
    }

    .header .register-container {
      position: relative;
      z-index:2;
      background: rgba(255,255,255,0.95);
      padding: 40px;
      border-radius: 12px;
      width: 350px;
      text-align: center;
      box-shadow: 0 6px 15px rgba(0,0,0,0.3);
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn { from { opacity:0; transform:translateY(-20px);} to {opacity:1; transform:translateY(0);} }

    @keyframes slideBG {
      0%   { background-image: url('img/home6.jpg'); }
      20%  { background-image: url('img/home1.jpg'); }
      40%  { background-image: url('img/home3.jpg'); }
      60%  { background-image: url('img/home7.jpg'); }
      80%  { background-image: url('img/home9.jpg'); }
      100% { background-image: url('img/home5.jpg'); }
    }

    .register-container h2 { margin-bottom:20px; color:#222; }
    .register-container input { width:100%; padding:12px; margin:10px 0; border:1px solid #ddd; border-radius:6px; font-size:14px; }
    .register-container button { width:100%; padding:12px; margin-top:15px; background:#f44336; border:none; color:#fff; font-size:16px; border-radius:6px; cursor:pointer; transition:0.3s; }
    .register-container button:hover { background:#d32f2f; }
    .register-container p { margin-top:15px; font-size:14px; }
    .register-container a { color:#007BFF; text-decoration:none; }
    .register-container a:hover { text-decoration:underline; }
    .message { margin-bottom:10px; font-weight:bold; }
  </style>
</head>
<body>

  <div class="header">
    <div class="register-container">
      <h2>Register</h2>

      <!-- Display error/success messages -->
      <?php
      if(isset($_SESSION['register_error'])){
          echo "<p class='message' style='color:red'>".$_SESSION['register_error']."</p>";
          unset($_SESSION['register_error']);
      }
      if(isset($_SESSION['register_success'])){
          echo "<p class='message' style='color:green'>".$_SESSION['register_success']."</p>";
          unset($_SESSION['register_success']);
      }
      ?>

      <form action="register_backend.php" method="POST" autocomplete="off"> 
        <input type="text" name="username" placeholder="Username" required autocomplete="off">
        <input type="email" name="email" placeholder="Email" required autocomplete="off">
        <input type="password" name="password" placeholder="Password" required autocomplete="off">
        <input type="password" name="confirm_password" placeholder="Confirm Password" required autocomplete="off">
        <!-- Add name="register" so backend detects submission -->
        <button type="submit" name="register">Register</button>
      </form>

      <p>Already registered? <a href="index.php">Sign In</a></p>
    </div>
  </div>

</body>
</html>







