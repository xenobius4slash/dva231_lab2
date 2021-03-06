<?php
require_once '../../backend/class/Session.php';
require_once '../../backend/class/Article.php';
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
				<div id="article" name="article">
					<?php $isLoaded = true;
						if(isset($_GET['id']) && intval($_GET['id'])) { 
							$articleId = intval($_GET['id']);
							$ART = new Article();
							$return = $ART->loadArticleById($articleId);
							if($return['status'] === false) {
								echo "<div class=\"article-error\">".$return['msg']."</div>";
								$isLoaded = false;
							} 
						} else { echo "<div class=\"article-error\">there are no article id</div>"; $isLoaded = false; }
					?>
					<div id="article_title" name="article_title" class="article-title"><h1><?=($isLoaded)?($ART->getArticleTitle()):('')?></h1></div>
					<div id="article_subtitle" name="article_subtitle" class="article-subtitle"><h2><?=($isLoaded)?($ART->getArticleSubtitle()):('')?></h2></div>
					<div id="article_media" name="article_media" class="article-media" style="float: left; margin: 15px;" >
						<?php if($isLoaded) {
							if($ART->getArticleMediaType() == 'img') { echo "<img src=\"../../".$ART->getArticleMediaPath()."\"/>"; }
							else { echo "<iframe width=\"100%\" height=\"98%\" src=\"../../".$ART->getArticleMediaPath()."\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>"; }
						} ?>
					</div>
					<span class="article-text"><?=($isLoaded)?($ART->getArticleText()):('')?></span>
					
				</div>
			</div>
		</div>
	</body>
</html>
