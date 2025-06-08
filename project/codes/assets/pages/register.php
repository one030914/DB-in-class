<h2>Register</h2>
<form action="dashboard.php" method="post" class="form-container">
    <input type="hidden" name="action" value="register">

    <label>Username:</label>
    <input type="text" name="username" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <label>Confirm Password:</label>
    <input type="password" name="confirm_password" required>
    
    <div class="button-container">
        <button type="submit">Register</button>
        <button type="button" onclick="window.location.href='../../index.php'" class="btn-back">返回</button>
    </div>
</form>