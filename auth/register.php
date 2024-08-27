<?php include('../themes/auth/header.php'); ?>


<?php
include '../utils/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $gmail = $_POST['gmail'];
    
    $photo = $_FILES['photo'];
    $targetDir = "../assets/img/profile/";
    $photoName = basename($photo['name']);
    $targetFile = $targetDir . $photoName;
    
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $check = getimagesize($photo['tmp_name']);
    if($check === false) {
        $uploadOk = 0;
        echo "File is not an image.";
    }

    if ($photo["size"] > 5000000) {
        $uploadOk = 0;
        echo "Sorry, your file is too large.";
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $uploadOk = 0;
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($photo["tmp_name"], $targetFile)) {
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
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-6 animate__animated animate__fadeInUp">
        <div class="card border rounded-3">
            <div class="card-header text-center bg-white">
                <h3 class="text-danger">Register</h3>
            </div>
            <div class="card-body">
                <form action="register.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <div class="mb-3">
                        <label for="gmail" class="form-label">Gmail</label>
                        <input type="email" name="gmail" id="gmail" class="form-control" placeholder="Enter your Gmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-select">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Profile Photo</label>
                        <input type="file" name="photo" id="photo" class="form-control" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn text-white w-100 bg-danger">Register</button>
                </form>
            </div>
            <div class="card-footer text-center bg-white">
                <p>Already have an account? <a href="login.php" class="text-danger">Login here</a></p>
            </div>
        </div>
    </div>
</div>

<?php include('../themes/auth/footer.php'); ?>
