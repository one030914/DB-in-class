<?php
$enter = $_POST['enter'] ?? $_GET['enter'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth</title>
    <link rel="stylesheet" href="../css/theme.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="main-content">
            <div class="auth-container">
                <?php
                    switch ($enter) {
                        case 'login':
                            include 'login.php';
                            break;
                        case 'register':
                            include 'register.php';
                            break;
                        default:
                            header("Location: 404.html");
                            exit;
                            break;
                    }
                ?>
                <?php if (isset($_GET['error'])): ?>
                    <?php
                        switch ($_GET['error']) {
                        case 'locked':
                            $msg = "❌ 以嘗試多次，請稍後登入。";
                            break;
                        case 'login':
                            $msg = "❌ 登入失敗：帳號或密碼錯誤。";
                            break;
                        case 'register':
                            $msg = "❌ 註冊失敗：請檢查您的輸入。";
                            break;
                        case 'exists':
                            $msg = "⚠️ 此使用者名稱已被註冊。";
                            break;
                        default:
                            $msg = "";
                        }
                    ?>
    
                    <?php if (!empty($msg)): ?>
                        <div class="alert alert-danger" role="alert">
                        <?= $msg ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>