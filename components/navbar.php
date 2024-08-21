    <nav class="navbar border d-flex justify-content-center" id="main-navbar">
        <div class="d-flex justify-content-between align-items-center w-100 nav-main px-5">
            <div class="nav-left">
                <a class="navbar-brand fw-bold fs-3" href="#">Madura<span class="text-danger fw-bold fs-6">.shop</span></a>
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
                    <input type="checkbox dropdown-toggle" id="dropdown-toggler" hidden>
                    <label for="dropdown-toggler " class="profile-img">
                        <img src="https://avatars.githubusercontent.com/u/118147438?v=4" alt="Profile" class="rounded-circle">
                    </label>
                    <ul class="dropdown-menu">
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <nav class="bottom-tab-bar d-md-none py-2 fixed-bottom container">
        <ul class="nav justify-content-between container">
            <li class="nav-item d-flex flex-column justify-content-center align-items-center">
                <a class="nav-link active mb-0" href="#">
                    <i class="fas fa-home"></i>
                    Home
                </a>
            </li>
            <li class="nav-item d-flex flex-column justify-content-center align-items-center">
                <a class="nav-link mb-0" href="#">
                    <i class="fas fa-search"></i>
                    Search
                </a>
            </li>
            <li class="nav-item d-flex flex-column justify-content-center align-items-center">
                <a class="nav-link mb-0" href="#">
                    <i class="fas fa-shopping-cart"></i>
                    Cart
                </a>
            </li>
            <li class="nav-item d-flex flex-column justify-content-center align-items-center">
                <a class="nav-link mb-0" href="#">
                    <i class="fas fa-user"></i>
                    Profile
                </a>
            </li>
        </ul>
    </nav>

