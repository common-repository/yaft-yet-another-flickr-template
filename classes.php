<?php

require_once(dirname(__FILE__).'/phpFlickr/phpFlickr.php');

class YaftFlickr
{
	var $api_key;
	var $phpFlickr;
	
	function YaftFlickr($api_key)
	{
		$this->api_key = $api_key;
		$this->phpFlickr = new phpFlickr($this->api_key);	
	}
	
	function getPublicPhotos($userId, $per_page = NULL, $page = NULL)
	{
		if(!is_null($userId))
		{
			return $this->phpFlickr->people_getPublicPhotos($userId, '', $per_page, $page);
		}
	}
	
	/*
	function showPublicPhotos($userId, $size = null)
	{
		$photos = $this->getPublicPhotos($userId, $per_page, $page);
		if(is_array($photos))
		{
			foreach ($photos['photo'] as $photo) 
			{
				echo $this->showImgUrlToPhoto($photo, $size);
			}
		}
	}
	*/
	
	function showPhotoImage($photo, $size = null, $onClick=null, $onMouseOver=null)
	{
		$size = is_null($size) ? 'Square' : $size;
		$url = $this->phpFlickr->buildPhotoURL($photo, $size);

		if(is_null($onMouseOver))
		{
			return '<a href="#" id="'.$photo['id'].'" title="'.$photo['title'].'"><img src="'.$url.'"/></a>';
		}
		else
		{
			$ret = '<a href="#" id="'.$photo['id'].'" title="'.$photo['title'].'"><img ';
			if(!is_null($onMouseOver) && $onMouseOver==true)
			{
				$ret = $ret.'onMouseOver="showPreview('.$photo['id'].')"';
			}
			
			if(!is_null($onClick) && onClick==true)
			{
				$ret = $ret.'onClick="showPreview('.$photo['id'].')"';
			}
			
			$ret = $ret.'src="'.$url.'"/></a>';
			
			return $ret;
		}
	}
	
	function showPhoto($photoId, $height=200, $showTitle=false, $useLightbox=false)
	{
		$photo = $this->phpFlickr->photos_getInfo($photoId);
		$url = $this->phpFlickr->buildPhotoURL($photo, $size);
		$lightbox = $useLightbox==false ? 'target="_new"' : 'rel="lightbox"';
		$ret = '<a href="'.$url.'" '.$lightbox.' title="'.$photo['title'].'"><img src="'.$url.'" height="'.$height.'"/></a>';

		if($showTitle==true)
		{
			$ret = '<div>'.$ret.'<br/>'.$photo['title'].'</div>';
		}
		
		return $ret;
	}
	
	function getUserPhotoNum()
	{
		return $this->phpFlickr->photos_getCounts();
	}
}

?>