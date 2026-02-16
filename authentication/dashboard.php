<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<body>
  <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
  <p>Email: <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>

  <form method="POST" action="logout.php">
    <input type="submit" value="Logout">
  </form>
</body>
</html>
