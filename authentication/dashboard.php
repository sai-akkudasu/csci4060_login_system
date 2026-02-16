<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="custom_style.css">
</head>
<body>
  <div id="content_div">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
    <p>Email: <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>

    <form method="POST" action="logout.php">
      <input type="submit" id="submit_btn" value="Logout">
    </form>
  </div>
</body>

</html>
