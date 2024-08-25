<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $gmail = $_POST['gmail']; // Tambahkan field gmail

    // Simpan data pengguna ke database
    $stmt = $pdo->prepare("INSERT INTO users (username, password, role, gmail) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $password, $role, $gmail]);

    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <label for="gmail">Gmail:</label>
        <input type="email" name="gmail" id="gmail" required>
        <br>
        <label for="role">Role:</label>
        <select name="role" id="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
