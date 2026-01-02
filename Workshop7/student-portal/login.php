<?php
session_start();
include "db.php";

if (isset($_POST['login'])) {

    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    $sql = $conn->prepare("SELECT password FROM students WHERE student_id = ?");
    $sql->execute([$student_id]);
    $user = $sql->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['logged_in'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid login";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="post">
        Student ID:
        <input name="student_id" required>

        Password:
        <input type="password" name="password" required>

        <button name="login">Login</button>
    </form>
</div>

</body>
</html>
