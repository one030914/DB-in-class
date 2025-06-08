<?php
$type = $_POST['type'] ?? '';
$search = $_POST['search'] ?? '';

require "../components/db.php";
$conn = connect();

if (!$conn) {
    echo "資料庫連線失敗";
    exit;
}

$validFields = [
    'ISBN' => 'b.ISBN',
    'title' => 'b.title',
    'genre' => 'b.genre',
    'year' => 'b.year',
    'author' => 'b.author',
    'publisher' => 'p.name'
];

if (!isset($validFields[$type])) {
    echo "不合法的查詢欄位";
    exit;
}

$field = $validFields[$type];
$useLike = in_array($type, ['title', 'genre', 'author', 'publisher']);

$sql = "SELECT b.ISBN, b.title, b.genre, b.year, b.author, p.name AS publisher
        FROM book AS b
        JOIN publisher AS p ON b.PID = p.PID
        WHERE $field " . ($useLike ? "LIKE :search" : "= :search");

$stmt = $conn->prepare($sql);
$stmt->bindValue(':search', $useLike ? "%$search%" : $search);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>查詢結果</title>
    <link rel="stylesheet" href="../css/theme.css">
</head>
<body>
    <?php include "./header.php"; ?>
    <main>
        <div class="main-content">
            <div class="book-query">
                <h2>查詢結果</h2>
                <?php if ($results): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>書名</th>
                                <th>類型</th>
                                <th>年份</th>
                                <th>作者</th>
                                <th>出版社</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($results as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['ISBN']) ?></td>
                                    <td><?= htmlspecialchars($row['title']) ?></td>
                                    <td><?= htmlspecialchars($row['genre']) ?></td>
                                    <td><?= htmlspecialchars($row['year']) ?></td>
                                    <td><?= htmlspecialchars($row['author']) ?></td>
                                    <td><?= htmlspecialchars($row['publisher']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>查無資料，請重新查詢。</p>
                <?php endif; ?>
            
                <button type="button" onclick="window.location.href='../../index.php'" class="btn-back">返回</button>
            </div>
        </div>
    </main>
    <?php include "./footer.php"; ?>
</body>
</html>
