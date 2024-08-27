<?php include('../themes/auth/header.php'); ?>

<?php
include '../utils/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header('Location: ../admin/index.php');
        } else {
            header('Location: ../index.php');
        }
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-6 animate__animated animate__fadeInDown">
        <div class="card border rounded-3">
            <div class="card-header text-center bg-white">
                <h3 class="text-danger">Login</h3>
            </div>
            <div class="card-body">
                <form action="login.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" autocomplete="off" required>
                    </div>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <?= $error; ?>
                        </div>
                    <?php endif; ?>
                    <button type="submit" class="btn text-white w-100 bg-danger">Login</button>
                </form>
            </div>
            <div class="card-footer text-center bg-white">
                <p>Don't have an account? <a href="register.php" class="text-danger">Sign up here</a></p>
            </div>
        </div>
    </div>
</div>

<?php include('../themes/auth/footer.php'); ?>
