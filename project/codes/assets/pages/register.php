<h2>Register</h2>
<form action="dashboard.php" method="post" class="form-container">
    <input type="hidden" name="action" value="register">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>
    <div class="button-container">
        <button type="submit">Register</button>
        <button type="button" onclick="window.location.href='../../index.php'" class="back">返回</button>
    </div>
</form>