<?php
require_once '../../backend/class/Session.php';
### Session
$S = new Session();
$isLogin = false;
if( $S->isLoggedIn('frontend') === true ) { $isLogin = true; }
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../css/assignment.css" type="text/css" />
		<script type="text/javascript" src="../js/assignment.js" ></script>
		<title>NASA (2) - Admin</title>
	</head>
	<body>
		<div id="container" class="container">
			<?php include 'menu.php'; ?>
			<div id="main_container" class="main-container">
				<div class="page-title">article page</div>
			</div>
		</div>
	</body>
</html>
