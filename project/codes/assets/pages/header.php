<header class="header-container">
    <div class="header-content">
        <a href="../../index.php" class="logo"><h1>Library Management System</h1></a>
        <div class="login-register">
            <form action="/assets/pages/auth.php" method="post">
                <input type="hidden" name="enter" value="login">
                <button type="submit">Login</button>
            </form>
            <form action="/assets/pages/auth.php" method="post">
                <input type="hidden" name="enter" value="register">
                <button type="submit">Register</button>
            </form>
        </div>
    </div>
</header>