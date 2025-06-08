<?php
session_start();
require '../components/db.php';
$conn = connect();

$uid = $_SESSION['user_id'];
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lid'])) {
    $lid = $_POST['lid'];
    $return_date = date("Y-m-d H:i:s");

    $stmt = $conn->prepare("SELECT due_date FROM borrowlog WHERE LID = :lid AND UID = :uid");
    $stmt->execute([':lid' => $lid, ':uid' => $uid]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $due_date = $row['due_date'];
        $fine = 0;

        if (strtotime($return_date) > strtotime($due_date)) {
            $days_late = ceil((strtotime($return_date) - strtotime($due_date)) / 86400);
            $fine = $days_late * 10;
        }

        $update = $conn->prepare("UPDATE borrowlog SET is_returned = 1, return_date = :ret, fine = :fine WHERE LID = :lid AND UID = :uid");
        $update->execute([
            ':ret' => $return_date,
            ':fine' => $fine,
            ':lid' => $lid,
            ':uid' => $uid
        ]);

        $message = ($fine > 0)
            ? "<div class='alert alert-warning'>⚠️ 還書成功，但您逾期 {$days_late} 天，罰鍰 {$fine} 元。</div>"
            : "<div class='alert alert-success'>✅ 還書成功，感謝您準時歸還！</div>";
    } else {
        $message = "<div class='alert alert-danger'>❌ 找不到對應的借書紀錄。</div>";
    }
}

$stmt = $conn->prepare("SELECT * FROM borrowlog WHERE UID = :uid AND is_returned = 0 ORDER BY borrow_date DESC");
$stmt->execute([':uid' => $uid]);
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="zh-Hant">
    <head>
        <meta charset="UTF-8" />
        <title>還書記錄</title>
        <link rel="stylesheet" href="../css/theme.css" />
    </head>
    <body>
        <?php require 'header.php'; ?>
        <main>
            <div class="main-content">
                <div id="return-section">
                    <h2>還書紀錄</h2>
                    <?= $message ?>
            
                    <?php if (count($logs) >
                    0): ?>
                    <table border="1" cellpadding="8">
                        <tr>
                            <th>書籍 ISBN</th>
                            <th>借書日期</th>
                            <th>到期日期</th>
                            <th>操作</th>
                        </tr>
                        <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?= htmlspecialchars($log['ISBN']) ?></td>
                            <td><?= $log['borrow_date'] ?></td>
                            <td><?= $log['due_date'] ?></td>
                            <td>
                                <form method="POST" action="return.php">
                                    <input type="hidden" name="lid" value="<?= $log['LID'] ?>" />
                                    <button type="submit">還書</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <?php else: ?>
                    <p>✅ 您目前沒有未歸還的書籍。</p>
                    <?php endif; ?>
    
                    <button type="button" onclick="window.location.href='../../index.php'" class="btn-back">返回</button>
                </div>
            </div>
        </main>
        <?php require 'footer.php'; ?>
    </body>
</html>

