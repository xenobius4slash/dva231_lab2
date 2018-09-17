<?php
require_once 'backend/class/Session.php';
require_once 'backend/class/Box.php';

### Session
$S = new Session();
//echo "Session-ID: ".session_id()."<pre>"; print_r($_SESSION); echo "</pre>";
$isLogin = false;
if( (isset($_GET['logout'])) && ($_GET['logout'] == 1) ) {
	$S->destroySession();
} else {
	if( $S->isLoggedIn('index') === true ) { $isLogin = true; } 
}

$BOX = new Box();
$BOX->loadCountAndFilenamesForCol4();
$arrayCol4Data = $BOX->getCol4BoxData();
//echo "<pre>"; print_r($arrayCol4Data); echo "</pre>";
$arrayPtbData = $BOX->getPtbData();
//echo "<pre>"; print_r($arrayPtbData); echo "</pre>";

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="frontend/css/assignment.css" type="text/css" />
		<script type="text/javascript" src="frontend/js/assignment.js" ></script>
		<title>NASA (2)</title>
	</head>
	<body>
		<div id="container" class="container">
			<div id="menu_container" class="menu-container">
				<a href="index.php">
					<div id="menu_logo" class="nasa-logo">
						<div class="fake">FAKE</div>
						<img src="frontend/img/nasa-logo.svg" />
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
							echo "<a href=\"frontend/html/admin.php\"><input type=\"button\" value=\"Admin\" /></a>";
							echo "<a href=\"index.php?logout=1\"><input type=\"button\" value=\"Logout\" /></a>";
						} else {
							echo "<a href=\"frontend/html/login.html\"><input type=\"button\" value=\"Login\" /></a>";
						} ?>
					</div>
				</div>
			</div>
			<div id="main_container" class="main-container">
				<table class="table-news">
<!--
                    <tr id="box001_1">
                        <td colspan="4" class="box-4col box001">
                            <div class="box-headline-4col-container">
                                <span class="hl1-col4">Commercial Crew</span>
                                <span class="hl2-col4">NASA to Name Astronauts Assigned to First Boeing, SpaceX Flights</span>
                            </div>
                        </td>
                    </tr>
                    <tr id="box001_2" class="display-none">
                        <td colspan="4" class="box-4col box001">
                        	<div class="box-headline-4col-container" >
                                <span class="hl1-col4">Astrobiology</span>
                                <span class="hl2-col4">Is Mars Soil Too Dry to Sustain Life?</span>
                            </div>
                        </td>
                    </tr>
					<tr id="box001_3" class="display-none">
						<td colspan="4" class="box-4col box001">
							<div class="box-headline-4col-container">
								<span class="hl1-col4">Chandra X-ray</span>
								<span class="hl2-col4">Chandra May Have First Evidence of a Young Star Devouring a Planet</span>
							</div>
						</td>
					</tr>
-->
					<?php
						for($i=0; $i<count($arrayCol4Data); $i++) {
							$id = $arrayCol4Data[$i]['id'];
							$img = $arrayCol4Data[$i]['img'];
							$hl1 = $arrayCol4Data[$i]['hl1'];
							$hl2 = $arrayCol4Data[$i]['hl2'];
							$display = ($arrayCol4Data[$i]['display'] == 0)?('display-none'):('');
							echo "<tr id=\"$id\" class=\"col4 $display\">";
								if($img=='') { echo "<td colspan=\"4\" class=\"box-4col\" style=\"background-color: black;\">";  }
								else { echo "<td colspan=\"4\" class=\"box-4col\" style=\"background-image: url('$img');\">";	}
									echo "<div class=\"box-headline-4col-container\">";
										echo "<span class=\"hl1-col4\">$hl1</span>";
										echo "<span class=\"hl2-col4\">$hl2</span>";
									echo "</div>";
								echo "</td>";
							echo "</tr>";
						}
					?>
					<tr>
						<td id="box002" class="table-news-td-left box-1col nasa-events">
							<div class="nasa-events-top">
								<p>NASA Events</p>
								<hr class="nasa-events-hr" />
								<p>Wednesday, Sept. 7: OSIRIS-REx Science and Engineering Talk (12 p.m. EDT), Asteroid Panel Discussion (1 p.m. EDT). NASA TV</p>
								<p>Thursday, Sept. 8: Launch of OSIRIS-REx, 7:05 p.m. EDT</p>
								<p>Registration Open: NASA Social, GOES-R Weather Satellite Launch, Nov. 3-4 at Cape Canaveral </p>
							</div>
							<div class="nasa-events-bottom">
								<hr class="nasa-events-hr" />
								<p><span class="nasa-events-bottom-calendar">Calendar</span><span class="nasa-events-bottom-lal">Launches and Landings</span></p>
							</div>
						</td>
						<td id="box003" class="table-news-td-middle box-1col">
							<div class="box-headline-container">
								<span class="hl1">Dawn</span>
								<div class="hl2" onmouseover="show(this)"  onmouseout="hide(this)">The Legacy of NASA's Dawn, Near End of Mission</div>
							</div>
							<span class="display-none">A little bit more informations about the topic "The Legacy of NASA's Dawn, Near End of Mission"</span>
						</td>
						<td id="box004" colspan="2" class="table-news-td-right box-2col">
							<?php if($arrayPtbData['media_type'] == 'img') { 
								echo "<div class=\"pat-picbox\" style=\"background-image: url('".$arrayPtbData['media']['img']."');\"><div class=\"pat-arrow\"></div></div>";
							} else {
								echo "<div class=\"pat-picbox\"><iframe width=\"100%\" height=\"98%\" src=\"".$arrayPtbData['media']['video']."\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe></div>";
							} ?>
							<div class="pat-textbox">
								<div class="pat-textbox-text">
									<span class="pat-textbox-hl"><?=$arrayPtbData['hl']?></span>
									<br/><br/>
									<span class="pat-textbox-middle"><?=$arrayPtbData['middle']?></span>
									<?php if( count($arrayPtbData['bottom']) > 0 ) { 
										echo "<br/><br/>";
										echo "<span class=\"pat-textbox-bottom\">";
										for($i=0; $i<count($arrayPtbData['bottom']);$i++) {
											echo $arrayPtbData['bottom'][$i];
											if( $i < (count($arrayPtbData['bottom'])-1) ) { echo "<br/>"; }
										}
										echo "</span>";
									} ?>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td id="box005" class="table-news-td-left box-1col">
<!--							<iframe width="100%" height="98%" src="http://www.youtube.com/embed/KFFmSA4TDKA" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
-->
						</td>
						<td id="box006" colspan="2" class="table-news-td-middle box-2col">
							<div class="box-headline-container">
								<span class="hl1">ICESat-2</span>
								<div class="hl2" onmouseover="show(this)"  onmouseout="hide(this)">ICESat-2 Scientists to Investigate Icy Mysteries</div>
							</div>
							<span class="display-none">A little bit more informations about the topic "ICESat-2 Scientists to Investigate Icy Mysteries"</span>
						</td>
						<td id="box007" class="table-news-td-right box-1col tweet">
							<div class="tweet-headline">
								<span class="tweet-headline-first">Tweets</span> <small>by <span class="tweet-headline-second">@NASA</span></small>
							</div>
							<div class="tweet-bottom">
								<a href="#">NASA to Broadcast Final Parachute Test for Orion Spacecraft</a>
								<a href="#">NASA Invites Media to Witness Final Orion Parachute Test in Arizona</a>
								<a href="#">NASA Astronaut Nick Hague Available for Interviews</a>
								<a href="#">Colorado Students to Speak with Astronauts on Space Station</a>
								<a href="#">NASA Television to Air Launch of Japanese Cargo Ship to Space Station</a>
								<a href="#">NASA to Host Live Chat on Successful Mission to Asteroid Belt</a>
								<a href="#">NASA Television to Air Launch of Global Ice-Measuring Satellite</a>
								<a href="#">NASA Invites Media to View Spacecraft to Study the Frontier of Space</a>
								<a href="#">NASA Awards Contract for Earth Science Mission Hosting Services</a>

							</div>
						</td>
					</tr>
					<tr>
						<td id="box008" class="table-news-td-left box-1col">
							<div class="box-headline-container">
								<span class="hl1">NASA Leadership</span>
								<div class="hl2" onmouseover="show(this)"  onmouseout="hide(this)">Administrator Bridenstine Talks to Commercial Crew Astronauts</div>
							</div>
							<span class="display-none">A little bit more informations about the topic "Administrator Bridenstine Talks to Commercial Crew Astronauts"</span>
						</td>
						<td id="box009" class="table-news-td-middle box-1col">
							<div class="box-headline-container">
								<span class="hl1">Cassini</span>
								<div class="hl2" onmouseover="show(this)"  onmouseout="hide(this)">Saturn's Famous Hexagon May Tower Above the Clouds</div>
							</div>
							<span class="display-none">A little bit more informations about the topic "Saturn's Famous Hexagon May Tower Above the Clouds"</span>
						</td>
						<td id="box010" class="table-news-td-middle box-1col">
							<div class="box-headline-container">
								<span class="hl1">Commercial Crew</span>
								<div class="hl2" onmouseover="show(this)"  onmouseout="hide(this)">NASA, SpaceX Agree on Plans for Crew Launch Day Operations </div>
							</div>
							<span class="display-none">A little bit more informations about the topic "NASA, SpaceX Agree on Plans for Crew Launch Day Operations "</span>
						</td>
						<td id="box011" class="table-news-td-right box-1col">
							<div class="box-headline-container">
								<span class="hl1">Spirit and Opportunity</span>
								<div class="hl2" onmouseover="show(this)"  onmouseout="hide(this)">Martian Skies Clearing over Opportunity Rover</div>
							</div>
							<span class="display-none">A little bit more informations about the topic "Martian Skies Clearing over Opportunity Rover"</span>
						</td>
					</tr>
					<tr>
						<td id="box012" colspan="3" class="table-news-td-left box-3col">
							<div class="box-headline-container">
								<span class="hl1">Hubble</span>
								<div class="hl2" onmouseover="show(this)"  onmouseout="hide(this)">A Piercing Celestial Eye Stares Back at Hubble</div>
							</div>
							<span class="display-none">A little bit more informations about the topic "A Piercing Celestial Eye Stares Back at Hubble"</span>
						</td>
						<td id="box013" class="table-news-td-right box-1col">
							<div class="box-headline-container">
								<span class="hl1">InSight Mars Lander</span>
								<div class="hl2" onmouseover="show(this)"  onmouseout="hide(this)">NASA's InSight Has a Thermometer for Mars</div>
							</div>
							<span class="display-none">A little bit more informations about the topic "NASA's InSight Has a Thermometer for Mars"</span>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>
