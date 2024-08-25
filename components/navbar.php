<nav class="navbar border d-flex justify-content-center" id="main-navbar">
    <div class="d-flex justify-content-between align-items-center w-100 nav-main px-5">
        <div class="nav-left">
            <a class="navbar-brand fw-bold fs-3" href="/toko-madura">Madura<span class="text-danger fw-bold fs-6">.shop</span></a>
        </div>
        <div class="nav-center">
            <div class="nav-search">
                <input type="search" placeholder="Search" class="form-control rounded-pill">
            </div>
        </div>
        <div class="nav-right d-flex align-items-center gap-5">
            <div class="nav-action d-flex align-items-center gap-4">
                <div class="cart">
                    <a href="#">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </div>
                <div class="notification">
                    <a href="#">
                        <i class="fas fa-bell"></i>
                    </a>
                </div>
                <div class="mail">
                    <a href="#">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
            <div class="divider d-none d-md-block"></div>
            <div class="nav-auth dropdown">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <input type="checkbox dropdown-toggle" id="dropdown-toggler" hidden>
                    <label for="dropdown-toggler" class="profile-img">
                        <img src="https://avatars.githubusercontent.com/u/118147438?v=4" alt="Profile" class="rounded-circle">
                    </label>
                    <ul class="dropdown-menu">
                        <li><a href="#">Welcome, <?php echo $_SESSION['role']; ?>!</a></li>
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Settings</a></li>
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <li><a href="admin.php">Manage Products</a></li>
                        <?php endif; ?>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                <?php else: ?>
                    <a href="login.php" class="btn btn-danger rounded-pill">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
