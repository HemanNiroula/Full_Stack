<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

$theme = $_COOKIE['theme'] ?? "light";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            background: <?= $theme == "dark" ? "#000" : "#fff" ?>;
            color: <?= $theme == "dark" ? "#fff" : "#000" ?>;
            font-family: Arial;
        }
        a {
            display: block;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<h2>Dashboard</h2>

<a href="preference.php">Change Theme</a>
<a href="logout.php">Logout</a>

</body>
</html>
