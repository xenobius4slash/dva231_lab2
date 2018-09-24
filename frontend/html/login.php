<?php
require_once '../../backend/class/Session.php';
### Session
$S = new Session();
$isLogin = false;
if( $S->isLoggedIn('frontend') === true ) { header('Location: ../../index.php'); }
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
				<div class="page-title"></div>
				<?php if(isset($_GET['login_fail']) && $_GET['login_fail'] == 1) {
					echo "<div class=\"error message\">User or/and password incorrect.</div>";
				}
				?>
				<form id="login_form" method="post" action="../../backend/script/login.php" class="login-form">
					<table>
						<tbody>
							<tr>
								<td>Username:</td>
								<td><input type="text" id="login_username" name="login_username" maxlength="10" size="30" /></td>
							</tr>
							<tr>
								<td>Password:</td>
								<td><input type="password" id="login_password" name="login_password" maxlength=50" size="30"/></td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="submit" id="login_submit" name="login_submit" value="Login" />
									<input type="reset" id="login_clear" name="login_clear" value="Clear" />
									<input type="submit" id="login_abort" name="login_abort" value="Abort" />
								</td>
							</tr>
						</tbody>
					</table>
				</form>

			</div>
		</div>
	</body>
</html>
