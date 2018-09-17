<?php
require_once '../../backend/class/Session.php';

### Session
$S = new Session();
$isLogin = false;
if( $S->isLoggedIn('frontend') === true ) { $isLogin = true; }  else { header('Location: ../../index.php'); }
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
			<div id="menu_container" class="menu-container">
				<a href="../../index.php">
					<div id="menu_logo" class="nasa-logo">
						<div class="fake">FAKE</div>
						<img src="../img/nasa-logo.svg" />
					</div>
				</a>
				<div class="page-title">
					admin page
					<div class="login-button-admin">
						<?php if($isLogin) {
							echo "<a href=\"index.php?logout=1\"><input type=\"button\" value=\"Logout\" /></a>";
						} else {
							echo "<a href=\"frontend/html/login.html\"><input type=\"button\" value=\"Login\" /></a>";
						} ?>
					</div>
				</div>
			</div>
			<div id="main_container" class="main-container">
				<div class="message">
					<?php if( isset($_GET['upload_ok']) ) {
							if( $_GET['upload_ok'] == 0 ) {
								if($_GET['status'] == 1 ) { echo "<span class=\"error\">Wrong file type, only JPG, JPEG, PNG, GIF, MP4, OGV, OGG, AVI, FLV are allowed.</span>"; }
								elseif($_GET['status'] == 2 ) { echo "<span class=\"error\">The file already exists.</span>"; }
								elseif($_GET['status'] == 3 ) { echo "<span class=\"error\">The file is too large.</span>"; }
								elseif($_GET['status'] == 4 ) { echo "<span class=\"error\">Internal error.</span>"; }
								elseif($_GET['status'] == 5 ) { echo "<span class=\"error\">No media type was selected.</span>"; }
							} 
							else { echo "<span class=\"success\">Upload complete.</span>"; }
						}
					?>
				</div>
				<form id="form_admin" class="form-admin" method="post" action="../../backend/script/admin.php" enctype="multipart/form-data">
					<div>
						Replace the piece of news for the Picture-Text-Box and generate a new col4-Item.
					</div>
					<table>
						<tr>
							<td>title:</td>
							<td><input type="text" id="title" name="title" maxlength="50"  size="50" /></td>
						</tr>
						<tr>
							<td>subtitle <small>(col4)</small>:</td>
							<td><input type="text" id="subtitle" name="subtitle"  maxlength="200" size="50" /></td>
						</tr>
						<tr>
							<td>text:</td>
							<td><textarea id="text" name="text" rows="4" cols="54"></textarea></td>
						</tr>
						<tr>
							<td>media type:</td>
							<td>
								<input type="radio" id="mdia_type_img" name="media_type" value="img" checked="checked"/> image
								&nbsp;&nbsp;&nbsp;
								<input type="radio" id="media_type_video" name="media_type" value="video" /> video
							</td>
						</tr>
						<tr>
							<td>select file:</td>
							<td><input type="file" id="file_upload" name="file_upload"> <small>(max. 5 MiB)</small></td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="submit" id="send_news" name="send_news" value="save" />
								&nbsp;
								<input type="reset" id="clear_form" name="clear_form" value="clear" />
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>
