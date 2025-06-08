<h2>Login</h2>
<form action="dashboard.php" method="post" class="form-container">
    <input type="hidden" name="action" value="login">

    <label>Username:</label>
    <input type="text" name="username" required>

    <label>Password:</label>
    <input type="password" name="password" required>
    
    <div class="button-container">
        <button type="submit">Login</button>
        <button type="button" onclick="window.location.href='../../index.php'" class="btn-back">返回</button>
    </div>
</form>
