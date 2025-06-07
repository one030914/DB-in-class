<h2>Login</h2>
<form action="dashboard.php" method="post" class="form-container">
    <input type="hidden" name="action" value="login">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <div class="button-container">
        <button type="submit">Login</button>
        <button type="button" onclick="window.location.href='../../index.php'" class="back">返回</button>
    </div>
</form>