<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>PosApp</title>
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <link rel="stylesheet" href="assets/backend/css/globals.css">
    <link rel="icon" type="image/x-icon" href="https://cdn.worldvectorlogo.com/logos/react-2.svg">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.min.js"></script>
</head>
<body>
    <div class="page">
        <aside class="navbar navbar-vertical navbar-expand-md navbar-light bg-white border">
            <div class="container-fluid">
                <button class="navbar-toggler collapsed" type="button" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand" style="font-family: 'Lobster';">
                    PosApp
                </h1>
                <div class="user-profile p-3">
                    <input type="checkbox" id="myprofile">
                    <label for="myprofile" class="myprofile-container">
                        <div class="myprofile-thumb d-flex align-items-center">
                            <img src="path/to/profile_img.jpg" class="rounded-full" style="width: 32px" alt="image">
                            <p class="mb-0 ms-2">Username</p>
                        </div>
                    </label>

                    <div class="dropdown-content mt-2">
                        <a href="/myprofile">
                           👀 My Profile
                        </a>
                        <a href="/toko-madura">
                            🏠 Home
                        </a>
                        <a href="../auth/logout.php" class="text-danger">⬅️ Logout</a>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="sidebar-menu">
                    <ul class="navbar-nav mt-2">
                        <!-- Insert your static navigation items here -->
                    </ul>
                </div>
            </div>
        </aside>
        <div class="page-wrapper">
            <main class="container">
