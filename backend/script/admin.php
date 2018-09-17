<?php
require_once '../class/Box.php';

if( isset($_POST['send_news']) ) {
	var_dump($_FILES);
	$title = htmlspecialchars($_POST['title']);
	$subtitle = htmlspecialchars($_POST['subtitle']);
	$text = htmlspecialchars($_POST['text']);
	$mediaType = htmlspecialchars($_POST['media_type']); $errorMediaType = false;
	if( $mediaType != 'img' && $mediaType != 'video' ) { $errorMediaType = true; }

	// temp
	$jsonDir = 'frontend/img/';

	$BOX = new Box();
	$arrayPtb = $BOX->getPtbDataScript();
	echo "ptb old<pre>"; print_r($arrayPtb); echo "</pre>";
	$arrayPtb['media_type'] = $mediaType;
	$arrayPtb['media']['img'] = 'test.jpg';//$jsonDir.$_FILES["file_upload"]["tmp_name"];
	$arrayPtb['hl'] = $title;
	$arrayPtb['middle'] = $text;
	$arrayPtb['bottom'] = array();
	echo "ptb new<pre>"; print_r($arrayPtb); echo "</pre>";
	$BOX->writePtbDataScript($arrayPtb);

	$BOX->loadCountAndFilenamesForCol4Script();
	$countCol4 = $BOX->getCol4CountFiles();
	echo "Count FIlename: $countCol4<br/>";
	$arrayCol4 = array(	'id' => 'box001_'.($countCol4+1), 'img' => '', 'hl1' => $title, 'hl2' => $subtitle, 'display' => 0	);
	echo "col4 new<pre>"; print_r($arrayCol4); echo "</pre>";
	$BOX->writeNewCol4BoxData($arrayCol4, ($countCol4+1));

/*
	$arrayFileType = array( 'img' => array("jpg", "jpeg", "png", "gif"), 'video' => array("mp4", "ogv", "ogg", "avi", "flv") );
	if($errorMediaType === false) {
		error_log("[upload] No media type was selected.");
		header('Location: ../../frontend/html/admin.php?upload_ok=0&status=5');
	} else {
		if($mediaType == 'img') { 
			$uploadDir = "../img/"; 
			$jsonDir = 'frontend/img/';
		} elseif($mediaType == 'video') { 
			$uploadDir = '../video/'; 
			$jsonDir = 'frontend/video/';
		}
		$fullFilepath = $uploadDir . basename($_FILES["file_upload"]["name"]);
		$fileType = strtolower(pathinfo($fullFilepath, PATHINFO_EXTENSION));
		$foundFileType = null;
		if( array_search(strtolower($fileType), $arrayFileType['img']) ) { $foundFileType = 'img'; }	// picture
		elseif( array_search($fileType, $arrayFileType['video']) ) { $foundFileType = 'video'; } 		// video
		else { 
			error_log("[upload] Wrong file type, only JPG, JPEG, PNG, GIF, MP4, OGV, OGG, AVI, FLV are allowed."); 
			header('Location: ../../frontend/html/admin.php?upload_ok=0&status=1');
		}

		if($foundFileType == 'img' || $foundFileType == 'video' ) {
			if(file_exists($fullFilepath)) {
				error_log("[upload] The file already exists.");
				header('Location: ../../frontend/html/admin.php?upload_ok=0&status=2');
			} else {
				if ($_FILES["file_upload"]["size"] > 5242880) {
					error_log("[upload] The file is too large.");
					header('Location: ../../frontend/html/admin.php?upload_ok=0&status=3');
				} else {
					if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $fullFilepath)) {
						error_log("[upload] Upload complete ". basename( $_FILES["file_upload"]["name"]) );



//						header('Location: ../../frontend/html/admin.php?upload_ok=1');
					} else {
						error_log("[upload] Internal error.");
						header('Location: ../../frontend/html/admin.php?upload_ok=0&status=4');
					}
				}
			}
		}
	} 
*/
}
?>
