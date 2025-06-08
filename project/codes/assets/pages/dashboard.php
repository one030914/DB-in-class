<?php
session_start();
date_default_timezone_set("Asia/Taipei");
$action = $_POST['action'] ?? '';

require "../components/db.php";
$conn = connect();
if (!$conn) {
    echo "<h2>Database connection failed.</h2>";
    exit;
}

if ($action === 'login') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT u.UID, u.name, u.role, a.password, a.failed_attempts, a.is_locked, a.login_time
            FROM user as u
            JOIN account as a ON u.UID = a.AID
            WHERE u.name = :username";


    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['is_locked']) {
            $locked_time = new DateTime($row['login_time']);
            $now = new DateTime();
            $interval = $now->getTimestamp() - $locked_time->getTimestamp();
            if ($interval >= 5) {
                $unlock = $conn->prepare("UPDATE account SET is_locked = 0, failed_attempts = 0 WHERE AID = :aid");
                $unlock->bindValue(':aid', $row['UID']);
                $unlock->execute();

                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                header("Location: auth.php?enter=login&error=locked");
                exit;
            }
        }

        if (password_verify($password, $row['password'])) {
            $update = $conn->prepare("UPDATE account SET failed_attempts = 0, is_locked = 0, login_time = NOW() WHERE AID = :aid");
            $update->bindValue(':aid', $row['UID']);
            $update->execute();

            $_SESSION['user_id'] = $row['UID'];
            $_SESSION['username'] = $row['name'];
            $_SESSION['role'] = $row['role'];
            header("Location: ../../index.php");
            exit;
        } else {
            $fail = $conn->prepare("UPDATE account SET failed_attempts = failed_attempts + 1 WHERE AID = :aid");
            $fail->bindValue(':aid', $row['UID']);
            $fail->execute();

            $checkFail = $conn->prepare("SELECT failed_attempts FROM account WHERE AID = :aid");
            $checkFail->bindValue(':aid', $row['UID']);
            $checkFail->execute();
            $attempt = $checkFail->fetchColumn();

            if ($attempt >= 3) {
                $lock = $conn->prepare("UPDATE account SET is_locked = 1, login_time = NOW() WHERE AID = :aid");
                $lock->bindValue(':aid', $row['UID']);
                $lock->execute();
            }

            header("Location: auth.php?enter=login&error=login");
            exit;
        }
    }
    header("Location: auth.php?enter=login&error=login");
    exit;

} elseif ($action === 'register') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($username) || empty($password) || $password !== $confirm_password) {
        header("Location: auth.php?enter=register&error=register");
        exit;
    }

    // 檢查帳號是否已存在
    $stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE name = :username");
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    if ($stmt->fetchColumn() > 0) {
        header("Location: auth.php?enter=register&error=exists");
        exit;
    }

    // 開始註冊
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $now = date("Y-m-d H:i:s");

    try {
        $conn->beginTransaction();

        // 建立 user（UID 自動遞增）
        $stmt1 = $conn->prepare("INSERT INTO user (name, email, join_date) VALUES (:name, :email, :date)");
        $stmt1->execute([
            ':name' => $username,
            ':email' => $email,
            ':date' => $now
        ]);
        $uid = $conn->lastInsertId(); // 拿自動產生的 UID

        // 建立 account（用相同 UID）
        $stmt2 = $conn->prepare("INSERT INTO account (AID, password, login_time, failed_attempts, is_locked) VALUES (:aid, :pw, :time, 0, 0)");
        $stmt2->execute([
            ':aid' => $uid,
            ':pw' => $hashed,
            ':time' => $now
        ]);

        $conn->commit();

        // 自動登入
        $_SESSION['user_id'] = $uid;
        $_SESSION['username'] = $username;
        header("Location: ../../index.php");
        exit;

    } catch (Exception $e) {
        $conn->rollBack();
        echo "<h2>❌ 註冊失敗：" . htmlspecialchars($e->getMessage()) . "</h2>";
        exit;
    }
} else {
    header("Location: 404.html");
    exit;
}
?>