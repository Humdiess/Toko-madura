<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'utils/db.php';

if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT photo FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<nav class="navbar border d-flex justify-content-center" id="main-navbar">
    <div class="d-flex justify-content-between align-items-center w-100 nav-main px-5">
        <div class="nav-left">
            <a class="navbar-brand fw-bold fs-3" href="<?php echo BASE_URL ?>">Madura<span class="text-danger fw-bold fs-6">.shop</span></a>
        </div>
        <div class="nav-center">
            <div class="nav-search">
                <form action="search.php" method="get">
                    <input type="search" name="search" placeholder="Search" class="form-control rounded-pill" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" required autocomplete="off">
                </form>
            </div>
        </div>
        <div class="nav-right d-flex align-items-center gap-5">
            <div class="nav-action d-flex align-items-center gap-4">
                <div class="cart">
                    <a href="cart.php">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </div>
                <div class="notification">
                    <a href="#">
                        <i class="fas fa-bell"></i>
                    </a>
                </div>
                <div class="history">
                    <a href="history.php">
                        <i class="fas fa-clock-rotate-left"></i>
                    </a>
                </div>
            </div>
            <div class="divider d-none d-md-block"></div>
            <div class="nav-auth dropdown">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <input type="checkbox" id="dropdown-toggler" hidden>
                    <label for="dropdown-toggler" class="profile-img">
                        <?php if (!empty($user['photo']) && file_exists("assets/img/profile/" . $user['photo'])): ?>
                            <img src="assets/img/profile/<?php echo urlencode($user['photo']); ?>" alt="Profile" class="rounded-circle">
                        <?php else: ?>
                            <img src="https://avatars.githubusercontent.com/u/118147438?v=4" alt="Default Profile" class="rounded-circle">
                        <?php endif; ?>
                    </div>
                    <ul id="dropdown-menu" class="dropdown-menu">
                        <li><a href="history.php">Histori transaksi</a></li>
                        <li><a href="cart.php">Keranjang belanja</a></li>
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <li><a href="<?php echo BASE_URL . 'admin' ?>">Manage Products</a></li>
                        <?php endif; ?>
                        <li><a class="text-danger" href="auth/logout.php">Logout</a></li>
                    </ul>
                <?php else: ?>
                    <a href="auth/login.php" class="btn btn-danger rounded-pill px-4">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>


<script>
    function toggleDropdown() {
    const dropdown = document.querySelector('.nav-auth');
    dropdown.classList.toggle('open');
}

window.onclick = function(event) {
    if (!event.target.closest('.nav-auth')) {
        const dropdown = document.querySelector('.nav-auth');
        dropdown.classList.remove('open');
    }
};

</script>