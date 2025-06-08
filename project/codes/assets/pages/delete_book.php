<?php
require '../components/db.php';
$conn = connect();

$isbn = $_POST['isbn'] ?? '';

if ($isbn) {
    $stmt = $conn->prepare("DELETE FROM book WHERE ISBN = :isbn");
    $stmt->execute([':isbn' => $isbn]);
    header("Location: admin_action.php?action=delete&result=success#delete");
} else {
    header("Location: admin_action.php?action=delete&result=error#delete");
}
exit;
?>
