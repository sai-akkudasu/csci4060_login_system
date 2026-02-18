<?php
$cookie_name = "user";
if (isset($_GET['action'])) {

    $action = $_GET['action'];
    if ($action == "update" && isset($_POST['username'])) {
        $cookie_value = $_POST['username'];
        setcookie($cookie_name, $cookie_value, time() + 3600, "/");
    }
    if ($action == "remove") {

        setcookie($cookie_name, "", time() - 3600, "/");
    }

    header("Location: cookie.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cookie Example</title>
    <link rel="stylesheet" href="custom_style.css">
</head>
<body>

<div id="cookie_div">
<?php
if (!isset($_COOKIE[$cookie_name])) {
    echo "<h3>Cookie is not set for this site!</h3>";
} else {
    echo "<h3>Cookie '" . $cookie_name . "' is set!</h3>";
    echo "<p>Value is: " . $_COOKIE[$cookie_name] . "</p>";
}
?>

<?php include "cookie_input.html"; ?>

</div>

</body>
</html>
