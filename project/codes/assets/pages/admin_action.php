<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<h3>🚫 您沒有權限存取此頁面。</h3>";
    exit;
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>管理員操作</title>
    <link rel="stylesheet" href="../css/theme.css">
</head>
<body>
    <?php require "header.php"; ?>
    <main>
        <div class="main-content">
            <div class="admin-action">
                <h2>📚 管理員操作 - <?= htmlspecialchars($action) ?></h2>
            
                <?php if ($action === 'add'): ?>
                    <form action="add_book.php" method="POST" class="form-container">
                        <label>ISBN:</label>
                        <input type="text" name="isbn" required>

                        <label>書名:</label>
                        <input type="text" name="title" required>

                        <label>類型:</label>
                        <input type="text" name="genre" required>

                        <label>出版年份:</label>
                        <input type="number" name="year" required>

                        <label>作者:</label>
                        <input type="text" name="author" required>

                        <label>出版社 ID:</label>
                        <input type="number" name="pid" required>

                        <div class="button-container">
                            <button type="submit">新增書籍</button>
                            <button type="button" onclick="window.location.href='../../index.php'" class="btn-back">返回</button>
                        </div>

                        <?php if (isset($_GET['result']) && $_GET['result'] === 'success'): ?>
                            <div class="alert alert-success">✅ 書籍新增成功！</div>
                        <?php elseif (isset($_GET['result']) && $_GET['result'] === 'exists'): ?>
                            <div class="alert alert-warning">⚠️ 該書籍已存在，請勿重複新增。</div>
                        <?php elseif (isset($_GET['result']) && $_GET['result'] === 'error'): ?>
                            <div class="alert alert-danger">❌ 書籍新增失敗，請檢查欄位。</div>
                        <?php endif; ?>
                    </form>
            
                <?php elseif ($action === 'delete'): ?>
                    <form action="delete_book.php" method="POST" class="form-container">
                        <label>ISBN:</label>
                        <input type="text" name="isbn" required>

                        <div class="button-container">
                            <button type="submit">刪除書籍</button>
                            <button type="button" onclick="window.location.href='../../index.php'" class="btn-back">返回</button>
                        </div>

                        <?php if (isset($_GET['result']) && $_GET['result'] === 'success'): ?>
                            <div class="alert alert-success">✅ 書籍刪除成功！</div>
                        <?php elseif (isset($_GET['result']) && $_GET['result'] === 'error'): ?>
                            <div class="alert alert-danger">❌ 書籍刪除失敗，請檢查欄位。</div>
                        <?php endif; ?>
                    </form>
            
                <?php elseif ($action === 'update'): ?>
                    <form action="update_book.php" method="POST" class="form-container">
                        <label>ISBN (要修改的):</label>
                        <input type="text" name="isbn" required>

                        <label>書名:</label>
                        <input type="text" name="title">

                        <label>類型:</label>
                        <input type="text" name="genre">

                        <label>出版年份:</label>
                        <input type="number" name="year">

                        <label>作者:</label>
                        <input type="text" name="author">

                        <label>出版社 ID:</label>
                        <input type="number" name="pid">

                        <div class="button-container">
                            <button type="submit">修改圖書</button>
                            <button type="button" onclick="window.location.href='../../index.php'" class="btn-back">返回</button>
                        </div>
                        
                        <?php if (isset($_GET['result']) && $_GET['result'] === 'success'): ?>
                            <div class="alert alert-success">✅ 書籍修改成功！</div>
                        <?php elseif (isset($_GET['result']) && $_GET['result'] === 'error'): ?>
                            <div class="alert alert-danger">❌ 修改失敗，請確認 ISBN。</div>
                        <?php endif; ?>
                    </form>

                <?php elseif ($action === 'view_logs'): ?>
                    <form action="borrowlog.php" method="GET" class="form-container">
                        <label>使用者 ID（可選）:</label>
                        <input type="text" name="uid">

                        <label>ISBN（可選）:</label>
                        <input type="text" name="isbn">

                        <div class="button-container">
                            <button type="submit">查詢借閱紀錄</button>
                            <button type="button" onclick="window.location.href='../../index.php'" class="btn-back">返回</button>
                        </div>
                    </form>
            
                <?php else: ?>
                    <p>⚠️ 請選擇有效的操作。</p>
                    <button type="button" onclick="window.location.href='../../index.php'" class="btn-back">返回</button>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <?php require "footer.php"; ?>
</body>
</html>
