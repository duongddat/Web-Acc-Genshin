<!-- /templates/layout.php -->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
function isUserLoggedIn()
{
    return isset($_SESSION['currentUser']) && !empty($_SESSION['currentUser']);
}

// Display login or logout button based on session
$loginUser = null;

if (isUserLoggedIn()) {
    $loginUser = $_SESSION['currentUser'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Customer CSS -->
    <link rel="stylesheet" href=".././public/css/main.css">
    <title>Shop Acc Genshin</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">Shop Acc Genshin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/naptien">Nạp Tiền</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php
                    // Check if $loginUser is true
                    if ($loginUser) {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="/" role="button" data-bs-toggle="dropdown"> Hello! <?= $loginUser['taikhoan'] ?>, <?= $loginUser['sotien'] ?> đồng</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/user/changePassword">Đổi mật khẩu</a></li>
                                <li><a class="dropdown-item" href="/user/naptienlist">Lịch Sử Nạp</a></li>
                                <li><a class="dropdown-item" href="/user/hoadonlist">Lịch Sử Giao Dịch</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <?php if ($loginUser['isAdmin'] == 1) { ?>
                                    <li><a class="dropdown-item" href="/admin/user-list">Quản lý người dùng</a></li>
                                    <li><a class="dropdown-item" href="/admin/account-list">Quản lý accounts</a></li>
                                    <li><a class="dropdown-item" href="/admin/quanlynap">Quản lý Nạp</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                <?php } ?>
                                <li><a class="dropdown-item" href="/user/logout">Đăng xuất</a></li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item me-2">
                            <a class="btn btn-warning nav-link" href="/user/signin">Đăng nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-warning nav-link" href="/user/register">Đăng ký</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <?php
        if (isset($_SESSION['flash_message']) && isset($_SESSION['type_message'])) {
            $message = $_SESSION['flash_message'];
            $type_message = $_SESSION['type_message'];

            //Remove session
            unset($_SESSION['flash_message']);

            echo '<div class="alert alert-' . $type_message . ' alert-dismissible fade show" role="alert">
                    <strong>' . strtoupper($type_message) . '</strong> '
                . $message .
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
        ?>
        <?= $content ?>
    </div>

    <!-- Include Bootstrap JS and Popper.js via CDN (required for Bootstrap JavaScript features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>