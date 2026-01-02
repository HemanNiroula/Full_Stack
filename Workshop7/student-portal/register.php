<?php
include "db.php";

$message = "";

if (isset($_POST['register'])) {

    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Check if student_id already exists
    $check = $conn->prepare("SELECT student_id FROM students WHERE student_id = ?");
    $check->execute([$student_id]);

    if ($check->rowCount() > 0) {
        $message = "Student ID already exists. Please use a different one.";
    } else {

        // Hash password
        $hashed = password_hash($password, PASSWORD_BCRYPT);

        // Insert student
        $sql = $conn->prepare(
            "INSERT INTO students (student_id, name, password) VALUES (?, ?, ?)"
        );
        $sql->execute([$student_id, $name, $hashed]);

        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Register</h2>

    <?php if ($message != "") echo "<p style='color:red;'>$message</p>"; ?>

    <form method="post">
        Student ID:
        <input name="student_id" required>

        Name:
        <input name="name" required>

        Password:
        <input type="password" name="password" required>

        <button name="register">Register</button>
    </form>
</div>

</body>
</html>
