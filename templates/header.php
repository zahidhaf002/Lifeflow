<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'LifeFlow'; ?> - LifeFlow</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="navbar">
                <a href="index.php" class="logo">
    <img src="assets/images/logo.svg" alt="LifeFlow - Productivity & Wellness Tracker" height="40">
</a>
                <nav>
                    <ul class="nav-menu">
                        <li><a href="index.php" <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'class="active"' : ''; ?>>Home</a></li>
                        <li><a href="index.php#features">Features</a></li>
                        <li><a href="index.php#how-it-works">How It Works</a></li>
                        <li><a href="index.php#dashboard-preview">Dashboard</a></li>
        
                    </ul>
                    <div class="auth-buttons">
                        <a href="login.php" class="btn btn-login">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                        <a href="register.php" class="btn btn-register">
                            <i class="fas fa-user-plus"></i> Register
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <main>