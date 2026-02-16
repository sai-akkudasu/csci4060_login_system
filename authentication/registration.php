<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  // 1️⃣ Check if email already exists
  $check = $con->prepare("SELECT id FROM users WHERE email = ?");
  $check->bind_param("s", $email);
  $check->execute();
  $check->store_result();

  if ($check->num_rows > 0) {
    // Email checking
    echo "
    <script>
      alert('Email already exists! Please use another email.');
    </script>";
  } else {
    // hashing the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //user new insertion
    $stmt = $con->prepare(
      "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
      echo "
      <script>
        alert('Registration successful! Please log in.');
        document.location = 'login.php';
      </script>";
    } else {
      echo "Error: " . $stmt->error;
    }

    $stmt->close();
  }

  $check->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register - CSCI 4060</title>
  <link rel="stylesheet" href="custom_style.css">

</head>
<body>
<div id="content_div">
  <h1>Create Your Account</h1>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="text" name="name" placeholder="Enter your name" required><br><br>
    <input type="email" name="email" placeholder="Enter your email" required><br><br>
    <input type="password" name="password" placeholder="Enter your password" required><br><br>
    <input type="submit" name="register_btn" id="submit_btn" value="Register">
  </form>
  <h3>Already have an account? <a href='login.php'>Login Here!</a></h3>
</div>

</body>
</html>
