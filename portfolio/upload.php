<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  header('Location: login.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['images'])) {
  $targetDir = "uploads/";
  $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
  $success = [];
  $error = [];

  foreach ($_FILES['images']['name'] as $key => $name) {
    $fileType = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    if (in_array($fileType, $allowed)) {
      if ($_FILES["images"]["size"][$key] > 5 * 1024 * 1024) { // 2MB limit
        $error[] = "$name - File too large (max 5MB allowed).";
      } else {
        $fileName = uniqid() . "." . $fileType; // Prevent overwrite
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFile)) {
          $success[] = "Uploaded successfully: " . htmlspecialchars($fileName);
        } else {
          $error[] = "$name - Error uploading.";
        }
      }
    } else {
      $error[] = "$name - Unsupported file type.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Image Upload</title>
  <link rel="stylesheet" href="upload.css">
  <link rel="stylesheet" href="../portfolio.css">
</head>
<body>
  <div class="container">
    <h2>Upload Images</h2>
    <form method="post" enctype="multipart/form-data">
      <input type="file" name="images[]" multiple required><br>
      <button type="submit">Upload</button>
    </form>
    <a href="logout.php">Logout</a>

    <?php 
      if (!empty($error)) {
        foreach ($error as $msg) echo "<p class='error'>$msg</p>";
      }
      if (!empty($success)) {
        foreach ($success as $msg) echo "<p class='success'>$msg</p>";
      }
    ?>
  </div>




</body>
</html>
