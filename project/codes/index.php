<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Library Management System</title>
	<link rel="stylesheet" href="/assets/css/theme.css">
</head>
<body>
	<?php include "./assets/pages/header.php"; ?>
	<main>
		<div class="main-content">
			<?php include "./assets/pages/book_search.php"; ?>
			<?php
			if (isset($_SESSION['user_id'])) {
				include "./assets/pages/user.php";
				if ($_SESSION['role'] === 'admin') {
					include "./assets/pages/admin.php";
				}
			}
			?>
		</div>
	</main>
	<?php include "./assets/pages/footer.php"; ?>
</body>
</html>