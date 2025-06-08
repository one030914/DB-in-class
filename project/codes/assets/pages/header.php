<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="header-container">
    <div class="header-content">
        <a href="../../index.php" class="logo"><h1>Library Management System</h1></a>
        <div class="login-register">
            <?php if (isset($_SESSION['user_id'])): ?>
                <p class="username">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
                <form action="/assets/components/signOut.php" method="post">
                    <button type="submit">Logout</button>
                </form>
            <?php else: ?>
                <form action="/assets/pages/auth.php" method="post">
                    <input type="hidden" name="enter" value="login">
                    <button type="submit">Login</button>
                </form>
                <form action="/assets/pages/auth.php" method="post">
                    <input type="hidden" name="enter" value="register">
                    <button type="submit">Register</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</header>