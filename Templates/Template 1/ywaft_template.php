<?php
/*
Template Name: YAFT Template

$Revision: 1 $
$Date: 2008-10-20 00:16:32 -0400 (Thu, 24 Apr 2008) $
$Author: Lula $

*/

get_header();

$photosPerPage = 10; //Configure this at you needs


$allPhotos = $yaftFlickr->getPublicPhotos($yaft_nsid);
$totPhotos= count($allPhotos['photo']);
$lastPage = round(($totPhotos/$photosPerPage) + 1);

?>
<div id="wrapper">
	<div id="container">
	<style>
		.yaftSelected {
			font-size: 1.3em;
			font-weight: bold;
		}
	</style>
	<script	language="javascript" src="<?php bloginfo('wpurl') ?>/wp-content/plugins/yaft/prototype.js"></script>
	<script language="javascript" type="text/javascript">
	
	function goto(direction)
	{	
		
		var i = direction > 0 ? 1 : -1;
		var nextPage = parseInt($F('yaftPage')) + i;
		
		$('page_'+$F('yaftPage')).toggleClassName("yaftSelected");
		$('page_'+nextPage).toggleClassName("yaftSelected");
		
		$('yaftPage').setValue(nextPage);
		
		
		new Ajax.Request(
			'<?php bloginfo('template_url') ?>/showPhotos.php?', 
			{
				parameters: { 
					yaftPage: $F('yaftPage'),
					photosPerPage: <?=$photosPerPage?> 
				},
				onSuccess: function(response) {			
					setLinks();
					$('photoBrowser').update(response.responseText);
					showPreview();
				}				
			});
	}
	
	function gotoPage(page)
	{
		if(page!=null) 
		{
			$('page_'+page).toggleClassName("yaftSelected");
		}
		$('page_'+$F('yaftPage')).toggleClassName("yaftSelected");

		var i = page > $F('yaftPage') ? 1 : -1;
		$('yaftPage').setValue(page);

		new Ajax.Request(
			'<?php bloginfo('template_url') ?>/showPhotos.php?', 
			{
				parameters: { 
					yaftPage: $F('yaftPage'),
					photosPerPage: <?=$photosPerPage?> 
				},
				onSuccess: function(response) {			
					setLinks();
					$('photoBrowser').update(response.responseText);
					showPreview();
				}
			});
	}
	
	function setLinks()
	{
		if($F('yaftPage') == 1)
		{
			$('prev').replace('<span id="prev"><?='<<'?></span>');
		}
		else
		{
			$('prev').replace('<a href="" id="prev" onclick="goto(-1); return false;"><?='<<'?></a>');
		}

		if($F('yaftPage') == $F('lastPage'))
		{
			$('next').replace('<span id="next"><?='>>'?></span>');
		}
		else
		{
			$('next').replace('<a href="" id="next" onclick="goto(1); return false;"><?='>>'?><a>');
		}
	}
	
	function showPreview(photoId)
	{
		new Ajax.Request(
			'<?php bloginfo('template_url') ?>/showPhotoPreview.php',
			{
				parameters: {
					photoId: photoId,
					yaftPage: $F('yaftPage'),
					photosPerPage: <?=$photosPerPage?>
				},
				onSuccess: function(response){
					$('photoPreview').update(response.responseText);
				}
			});
	}
	
	</script>
	
	<div align="center" style="margin: 0 10px 10px 10px;">
		<div id="photoPreview" style="height: 320px"></div>
		<div id="photoBrowser" style="height: 100px; width: 880px"></div>

		<div>
			<input type="hidden" id="lastPage" value="<?=$lastPage?>"/>
			<input type="hidden" id="yaftPage" value="1"/>

			<a href="" id="prev" onclick="goto(-1); return false;"><?='<<'?></a>&nbsp;
			<?php
				for($i=1;$i<=$lastPage;$i++)
				{
					echo '<a href="" id="page_'.$i.'" onclick="gotoPage('.$i.'); return false;" style="padding-left:2px; padding-right:2px;">'.$i.'</a>&nbsp;';
				}
			?>
			<a href="" id="next" onclick="goto(1); return false;"><?='>>'?><a>
		</div>
	</div>
	<script>
		gotoPage();
		showPreview();
	</script>
</div>
<?php

// uncomment this if you need a sidebar
//get_sidebar();

get_footer();
?>