<?
require_once("phpFlickr.php");
$f = new phpFlickr("c9098653ecd18f69ac32ede86a193983");

$photos = $f->people_getPublicPhotos('78532521@N00');

foreach ($photos['photo'] as $photo) {
    
	$url = $f->buildPhotoURL($photo,'Square');
	echo '<a href="#" title="'.$photo['title'].'"><img src="'.$url.'"/></a>';
    
}
?>
