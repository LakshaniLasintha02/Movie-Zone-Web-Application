<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign In - Movie Zone</title>
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

.signin-container {
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

.signin-container h2 { margin-bottom:20px; color:#222; }
.signin-container input { width:100%; padding:12px; margin:10px 0; border:1px solid #ddd; border-radius:6px; font-size:14px; }
.signin-container button { width:100%; padding:12px; margin-top:15px; background:#f44336; border:none; color:#fff; font-size:16px; border-radius:6px; cursor:pointer; transition:0.3s; }
.signin-container button:hover { background:#d32f2f; }
.signin-container p { margin-top:15px; font-size:14px; }
.signin-container a { color:#007BFF; text-decoration:none; }
.signin-container a:hover { text-decoration:underline; }
.message { margin-bottom:10px; font-weight:bold; color:red; }
</style>
</head>
<body>

<section class="header">
  <div class="signin-container">
    <h2>Sign In</h2>
    
    <?php
    if(isset($_SESSION['login_error'])){
      echo '<div class="message">'.$_SESSION['login_error'].'</div>';
      unset($_SESSION['login_error']);
    }
    ?>
    
    <form method="post" action="login.php" autocomplete="off">
      <!-- Hidden dummy fields to prevent autofill -->
      <input type="text" name="fakeuser" style="display:none" autocomplete="off">
      <input type="password" name="fakepass" style="display:none" autocomplete="new-password">
      
      <!-- Real fields -->
      <input type="email" name="email" placeholder="Email" autocomplete="off" required>
      <input type="password" name="password" placeholder="Password" autocomplete="new-password" required>
      <button type="submit" name="login">Login</button>
    </form>
    <p>Not registered? <a href="register.php">Create an account</a></p>
  </div>
</section>

</body>
</html>

