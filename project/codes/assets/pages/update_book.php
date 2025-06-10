<?php
require '../components/db.php';
$conn = connect();

$isbn = $_POST['isbn'] ?? '';
$title = $_POST['title'] ?? '';
$genre = $_POST['genre'] ?? '';
$year = $_POST['year'] ?? '';
$author = $_POST['author'] ?? '';
$pid = $_POST['pid'] ?? '';

if ($isbn) {
    $stmt = $conn->prepare("UPDATE book SET title = :title, genre = :genre, year = :year, author = :author, PID = :pid WHERE ISBN = :isbn");
    $stmt->execute([
        ':isbn' => $isbn,
        ':title' => $title,
        ':genre' => $genre,
        ':year' => $year,
        ':author' => $author,
        ':pid' => $pid
    ]);
    header("Location: admin_action.php?action=update&result=success#update");
} else {
    header("Location: admin_action.php?action=update&result=error#update");
}
exit;
?>