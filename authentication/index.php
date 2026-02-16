<?php
session_start();
require "db_connection.php";

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

function error_alert() {
    echo "
    <script>
        alert('Incorrect email or password.');
        document.location = 'index.php';
    </script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $con->prepare(
        "SELECT id, name, password FROM users WHERE email = ?"
    );
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $name, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;

            header("Location: dashboard.php");
            exit();
        }
    }

    error_alert();
}
?>
