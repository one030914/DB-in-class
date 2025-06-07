<?php
$enter = $_POST['enter'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth</title>
    <link rel="stylesheet" href="../css/theme.css">
    <link rel="stylesheet" href="../css/auth.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="main-content">
            <?php
                switch ($enter) {
                    case 'login':
                        include 'login.php';
                        break;
                    case 'register':
                        include 'register.php';
                        break;
                    default:
                        include '404.php';
                        break;
                }
            ?>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>