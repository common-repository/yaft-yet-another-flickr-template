<?php

require_once('../../../wp-blog-header.php');

$yaft_page = is_null($_POST['yaftPage']) ? 1 : $_POST['yaftPage'];
$photosPerPage = is_null($_POST['photosPerPage']) ? 10 : $_POST['photosPerPage'];
$photos = $yaftFlickr->getPublicPhotos($yaft_nsid, $photosPerPage, $yaft_page);

foreach ($photos['photo'] as $photo)
{	
	echo $yaftFlickr->showPhotoImage($photo,null, true, false).'&nbsp;';
}

?>