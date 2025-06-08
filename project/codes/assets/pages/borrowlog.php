<?php
require '../components/db.php';
$conn = connect();

$uid = $_POST['uid'] ?? '';
$isbn = $_POST['isbn'] ?? '';

$sql = "SELECT * FROM borrowlog WHERE 1=1";
$params = [];

if (!empty($uid)) {
    $sql .= " AND UID = :uid";
    $params[':uid'] = $uid;
}
if (!empty($isbn)) {
    $sql .= " AND ISBN = :isbn";
    $params[':isbn'] = $isbn;
}

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>借閱記錄</title>
    <link rel="stylesheet" href="../css/theme.css">
</head>
<body>
    <?php require "header.php"; ?>
    <main>
        <div class="main-content">
            <div class="log-query">
                <h2>📖 借閱紀錄</h2>
                <table border="1" cellpadding="8">
                    <tr>
                        <th>LID</th>
                        <th>UID</th>
                        <th>ISBN</th>
                        <th>借書日</th>
                        <th>到期日</th>
                        <th>還書日</th>
                        <th>已還</th>
                        <th>罰鍰</th>
                    </tr>
                    <?php foreach ($records as $r): ?>
                    <tr>
                        <td><?= $r['LID'] ?></td>
                        <td><?= $r['UID'] ?></td>
                        <td><?= $r['ISBN'] ?></td>
                        <td><?= $r['borrow_date'] ?></td>
                        <td><?= $r['due_date'] ?></td>
                        <td><?= $r['return_date'] ?></td>
                        <td><?= $r['is_returned'] ? '是' : '否' ?></td>
                        <td><?= $r['fine'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <button type="button" onclick="window.location.href='../../index.php'" class="btn-back">返回</button>
            </div>
        </div>
    </main>
    <?php require "footer.php"; ?>
</body>
</html>
