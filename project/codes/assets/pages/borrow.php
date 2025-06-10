<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set("Asia/Taipei");

require '../components/db.php';
$conn = connect();

$uid = $_SESSION['user_id'];
$isbn = $_POST['ISBN'] ?? '';
$borrow = $_POST['borrow_date'] ?? '';

if (empty($isbn)) {
    header("Location: /index.php?section=user&borrow=error");
    exit;
}

// 檢查是否有逾期未還
$check = $conn->prepare("
    SELECT COUNT(*) FROM borrowlog
    WHERE UID = :uid AND is_returned = 0 AND due_date < NOW()
");
$check->bindValue(':uid', $uid);
$check->execute();
if ($check->fetchColumn() > 0) {
    header("Location: /index.php?section=user&borrow=overdue");
    exit;
}

// 檢查該書籍是否存在
$book_check = $conn->prepare("SELECT COUNT(*) FROM book WHERE ISBN = :isbn");
$book_check->bindValue(':isbn', $isbn);
$book_check->execute();
if ($book_check->fetchColumn() == 0) {
    header("Location: /index.php?section=user&borrow=notfound");
    exit;
}

// 檢查書籍是否已有借閱未歸還
$check_book = $conn->prepare("
    SELECT COUNT(*) FROM borrowlog
    WHERE ISBN = :isbn AND is_returned = 0
");
$check_book->bindValue(':isbn', $isbn);
$check_book->execute();
if ($check_book->fetchColumn() > 0) {
    header("Location: /index.php?section=user&borrow=unavailable");
    exit;
}

// 寫入借書紀錄
$due = date("Y-m-d H:i:s", strtotime($borrow . " +14 days"));

$stmt = $conn->prepare("
    INSERT INTO borrowlog (UID, ISBN, borrow_date, due_date, is_returned, fine)
    VALUES (:uid, :isbn, :borrow_date, :due_date, 0, 0)
");
$stmt->execute([
    ':uid' => $uid,
    ':isbn' => $isbn,
    ':borrow_date' => $borrow,
    ':due_date' => $due
]);

header("Location: /index.php?section=user&borrow=success");
exit;
?>
