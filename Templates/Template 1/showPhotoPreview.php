<?php
require_once('../../../wp-blog-header.php');
$photoId = $_POST['photoId'];

if(is_null($photoId))
{
	//show first photo of the page
	$yaft_page = is_null($_POST['yaftPage']) ? 1 : $_POST['yaftPage'];
	$photosPerPage = is_null($_POST['photosPerPage']) ? 10 : $_POST['photosPerPage'];
	$photos = $yaftFlickr->getPublicPhotos($yaft_nsid, $photosPerPage, $yaft_page);
	
	$photoId = $photos['photo'][0]['id'];
}

echo $yaftFlickr->showPhoto($photoId,300, null, $yaft_use_lightbox);

?>