<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $con->prepare(
    "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
  );
  $stmt->bind_param("sss", $name, $email, $password);

  if ($stmt->execute()) {
    echo "
    <script>
      alert('Registration successful! Please log in.');
      document.location = 'index.php';
    </script>";
  } else {
    echo "Error: " . $stmt->error;
  }
}
?>
