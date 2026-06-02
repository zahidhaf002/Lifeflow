<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - LifeFlow</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php if (isset($includeCharts) && $includeCharts): ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php endif; ?>
</head>
<body>
    <header class="dashboard-header">
        <div class="container">
            <div class="navbar">
                <a href="dashboard.php" class="logo">
    <img src="assets/images/logo.svg" alt="LifeFlow Dashboard" height="40">
</a>
                
                <div class="user-info">
                    <span>Welcome, <?php echo escape($_SESSION['full_name']); ?>!</span>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <a href="admin.php" class="btn btn-outline btn-small" style="margin-right: 10px;">
                            <i class="fas fa-cog"></i> Admin
                        </a>
                    <?php endif; ?>
                    <a href="logout.php" class="btn btn-outline btn-small">
                        Logout
                    </a>
                </div>
            </div>
            
            <nav class="dashboard-nav">
                <a href="dashboard.php" <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'class="active"' : ''; ?>>Dashboard</a>
                <a href="tasks.php" <?php echo basename($_SERVER['PHP_SELF']) == 'tasks.php' ? 'class="active"' : ''; ?>>Tasks</a>
                <a href="wellness.php" <?php echo basename($_SERVER['PHP_SELF']) == 'wellness.php' ? 'class="active"' : ''; ?>>Wellness</a>
                <a href="insights.php" <?php echo basename($_SERVER['PHP_SELF']) == 'insights.php' ? 'class="active"' : ''; ?>>Insights</a>
                <a href="profile.php" <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'class="active"' : ''; ?>>Profile</a>
            </nav>
        </div>
    </header>
    <main class="dashboard-main">
        <div class="container">