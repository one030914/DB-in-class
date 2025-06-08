<?php
require '../components/db.php';
$conn = connect();

$isbn = $_POST['isbn'] ?? '';
$title = $_POST['title'] ?? '';
$genre = $_POST['genre'] ?? '';
$year = $_POST['year'] ?? '';
$author = $_POST['author'] ?? '';
$pid = $_POST['pid'] ?? '';

$check = $conn->prepare("SELECT COUNT(*) FROM book WHERE ISBN = :isbn");
$check->execute([':isbn' => $isbn]);
if ($check->fetchColumn() > 0) {
    header("Location: admin_action.php?action=add&result=exists#add");
    exit;
}
if ($isbn && $title && $genre && $year && $author && $pid) {
    $stmt = $conn->prepare("INSERT INTO book (ISBN, title, genre, year, author, PID)
                            VALUES (:isbn, :title, :genre, :year, :author, :pid)");
    $stmt->execute([
        ':isbn' => $isbn,
        ':title' => $title,
        ':genre' => $genre,
        ':year' => $year,
        ':author' => $author,
        ':pid' => $pid
    ]);
    header("Location: admin_action.php?action=add&result=success#add");
} else {
    header("Location: admin_action.php?action=add&result=error#add");
}
exit;
?>
