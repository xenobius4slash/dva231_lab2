<?php 
// check from where the webseite call come
$url = $_SERVER['REQUEST_URI'];
$pos = strpos($url, "?");
// if exist GET-Parameters
if($pos !== false) { $url = substr($url, 0, -(strlen($url)-$pos) ); }
// if exist "index.php"
if( substr($url, -9) == 'index.php' ) { $index = true; } 
// if there are no index.php written
elseif( substr($url, -1) == '/' ) {	$index = true; } 
else { $index = false; }
?>
<div id="menu_container" class="menu-container">
	<a href="<?=($index)?(''):('../../')?>index.php">
		<div id="menu_logo" class="nasa-logo">
			<div class="fake">FAKE</div>
			<img src="<?=($index)?('frontend/'):('../')?>img/nasa-logo.svg" />
		</div>
	</a>
	<div id="menu_main">
		<table class="table-menu-main">
			<tr>
				<td>Missions</td>
				<td>Galleries</td>
				<td>NASA TV</td>
				<td>Follow NASA</td>
				<td>Downloads</td>
				<td>About</td>
				<td>NASA Audiences</td>
				<td>
					<input type="text" placeholder="Search" />
					<span id="icon-connect" class="icon-connect"></span>
				</td>
			</tr>
		</table>
	</div>
	<div id="menu_sub" class="div-menu-sub">
		<table class="table-menu-sub">
			<tr>
				<td>International Space Station</td>
				<td>Journey to Mars</td>
				<td>Earth</td>
				<td>Technology</td>
				<td>Aeronautics</td>
				<td>Solar System and Beyond</td>
				<td>Education</td>
				<td>History</td>
				<td>Benefits to You</td>
			</tr>
		</table>
		<div class="login-button">
			<?php if($isLogin) {
				if($index) {
					echo "<a href=\"frontend/html/admin.php\"><input type=\"button\" value=\"Admin\" /></a>";
					echo "&nbsp;";
					echo "<a href=\"index.php?logout=1\"><input type=\"button\" value=\"Logout\" /></a>";
				} else {
					echo "<a href=\"admin.php\"><input type=\"button\" value=\"Admin\" /></a>";
					echo "&nbsp;";
					echo "<a href=\"../../index.php?logout=1\"><input type=\"button\" value=\"Logout\" /></a>";
				}
			} else {
				if($index) {
					echo "<a href=\"frontend/html/login.php\"><input type=\"button\" value=\"Login\" /></a>";
				} else {
					echo "<a href=\"login.php\"><input type=\"button\" value=\"Login\" /></a>";
				}
			} ?>
		</div>
	</div>
</div>
