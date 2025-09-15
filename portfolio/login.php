<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $username = $_POST['username'];
    $password = $_POST['password'];
  
    if ($username === 'rajarshi' && $password === 'rajarshi') 
    {
        $_SESSION['loggedin'] = true;
        header('Location: upload.php');
        exit;
    }
    else 
    {
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="login-box">
    <h2>Login</h2>
    <form method="post">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Login</button>
    </form>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
  </div>
</body>
</html>
