<?php
include '../utils/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $gmail = $_POST['gmail'];
    
    $photo = $_FILES['photo'];
    $targetDir = "assets/img/profile/";
    $photoName = basename($photo['name']);
    $targetFile = $targetDir . $photoName;
    
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($photo['tmp_name']);
    if($check === false) {
        $uploadOk = 0;
        echo "File is not an image.";
    }

    // Check file size (limit to 5MB)
    if ($photo["size"] > 5000000) {
        $uploadOk = 0;
        echo "Sorry, your file is too large.";
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $uploadOk = 0;
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($photo["tmp_name"], $targetFile)) {
            // Insert user with photo path
            $stmt = $pdo->prepare("INSERT INTO users (username, password, role, gmail, photo) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$username, $password, $role, $gmail, $photoName]);
            header('Location: login.php');
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="register.php" method="post" enctype="multipart/form-data">
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
        <label for="photo">Profile Photo:</label>
        <input type="file" name="photo" id="photo" accept="image/*" required>
        <br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
