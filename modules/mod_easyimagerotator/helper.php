<?php
/**
* @package EasyImageRotator
* @Copyright (C) 2011-2017 Daniel Blum. All rights reserved.
* @license Distributed under the terms of the GNU General Public License GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html
* @author Daniel Blum
* @website Visit http://codeninja.eu for updates and information.
**/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class modEasyImageRotatorHelper {
	//Public Settings
	public $intWidth = 250;
	public $intHeight = 80;
	public $intNumberOfImagesToLoad = 1;
	public $isShuffleImages = false;
	public $strSelectedFittingOption = 0;
	public $isUseSpecificImagePathEnabled = false;
	public $strSpecificImagePath = "/images";
	public $strBaseURI = "";
	
	//Private
	private $app = null;
	private $arrAllowedFileExtensions = array(".jpeg", ".jpe", ".jpg", ".png", ".gif", ".bmp");
	
	function __construct() {
		$this->app = JFactory::getApplication();
		$this->strBaseURI = JURI::base(); //returns the base URI of the Joomla site.  e.g. Joomla base URI is http://localhost/joomla/
		$this->arrAllowedFileExtensions = array_merge($this->arrAllowedFileExtensions, array_map('strtoupper', $this->arrAllowedFileExtensions)); //add uppercase entries
	}
	
	/**
	* Loads only the minimal header includes for css and js
	**/
	public function loadMinHeaderIncludes()
	{
		$document = JFactory::getDocument();
		$document->addStyleSheet($this->strBaseURI.'modules/mod_easyimagerotator/css/default.css');
	}
	
	/**
	* Loads all possible header includes for css and js
	**/
	public function loadFullHeaderIncludes()
	{
		$document = JFactory::getDocument();
		//dublicates are ignored by addStyleSheet
		$document->addStyleSheet($this->strBaseURI.'modules/mod_easyimagerotator/css/themes/default/default.css'); 
		$document->addStyleSheet($this->strBaseURI.'modules/mod_easyimagerotator/css/nivo-slider.css');
		$document->addScript($this->strBaseURI.'modules/mod_easyimagerotator/js/jquery-min.js');
		$document->addScript($this->strBaseURI.'modules/mod_easyimagerotator/js/jquery.nivo.slider.pack.js');
		$document->addScript($this->strBaseURI.'modules/mod_easyimagerotator/js/jquery.fakecrop.js');
		$document->addScript($this->strBaseURI.'modules/mod_easyimagerotator/js/functions.js');
	}
	
	public function getMenu() {
		$active = $this->app->getMenu()->getActive();
		if (!$active) {
			return 0;
		} else {
			return $active->id;
		}
	}
	
	//return image path from menu itemId
	public function getImgEntry($menuItemId) 
	{
		$db = JFactory::getDBO();
		$query = 'SELECT img_url, img_textlayer, img_title FROM #__easyimagerotator WHERE item_id = '.$menuItemId;
		$db->setQuery($query);
		$objResult = $db->loadObject();
		if(!$objResult)
		{
			$objResult = null;
		}
		return $objResult;
	}
	
	//double-check the image entry for a valid path, file ect.
	public function isImgEntryUrlValid($objEntry)
	{
		$blnIsValid = false;
		if($objEntry != null && trim($objEntry->img_url) != '')
		{
			//double-check for rundom image or directory, file exists
			if($this->isImageDirectory($objEntry->img_url) || $this->isSingleImage($objEntry->img_url))
			{
				$blnIsValid = true;
			}
		}
		return $blnIsValid;
	}
	
	public function setUpImages($objImg) 
	{
		//Get Image form real path
		$arrSelectedImages = $this->getImageData($objImg->img_url);
		#print_r($arrSelectedImages);
		$arrImages = array();
		if(is_array($arrSelectedImages))
		{
			foreach($arrSelectedImages as $img)
			{
				$arrImages[] = $this->prepareImage($img);
			}
		}
		return $arrImages;
	}
	
	//Mapp effect by id to JS option
	public function getMappedEffect($intEffect)
	{
		$value = 'random';
		switch($intEffect)
		{
			case 0:
			default:
				$value = 'random';
			break;
			
			case 1:
				$value = 'fold';
			break;
			
			case 2:
				$value = 'fade';
			break;
			
			case 3:
			$value = 'sliceDown';
			break;
		}
		return $value;
	}
	
	/**
	* Private methods
	**/
	private function getImageData($imagePath) 
	{
		//If specific image path is enbale overwrite img path
		if($this->isUseSpecificImagePathEnabled && $this->strSpecificImagePath != "")
		{
			$imagePath = $this->strSpecificImagePath;
		}
		
		//check for * at the end of the path (if exist it will be truncate)
		$imagePath= $this->strTruncateCharAtEnd($imagePath, '*');
		
		if($imagePath != "")
		{
			if ($this->isSingleImage($imagePath)) //Get singel image
			{
				return array(JPATH_BASE.$imagePath);
			}
			else if ($this->isImageDirectory($imagePath)) //Get images from directory
			{
				// use specified folder to get images from
				$imagePath = JPATH_BASE.$this->strTruncateCharAtEnd($imagePath, '/');
				$images = array();
				//loop through allowed extensions
				foreach($this->arrAllowedFileExtensions as $strExtension)
				{
					$images = array_merge($images,JFolder::files($imagePath, $strExtension, true, true));
				}
				
				//Prepare items
				$selectedImages = null;
				if(count($images) >= 1)
				{
					if($this->intNumberOfImagesToLoad >= 1) 
					{
						//shuffle items
						if($this->isShuffleImages)
						{
							shuffle($images);
						}
						$selectedImages = array_slice($images, 0, $this->intNumberOfImagesToLoad);
					} 
					else 
					{
						$selectedImages = array($images[mt_rand(0, count($images)-1)]);
					}
				}
				return $selectedImages;
			}
		}
		return null;
	}
	
	//prepare image by params
	private function prepareImage($image) 
	{
		$imgURL = "";
		$imgWidth = 0;
		$imgHeight = 0;
		$imgURL = $this->strBaseURI.substr($image,strlen(JPATH_BASE.DIRECTORY_SEPARATOR));
		
		switch ($this->strSelectedFittingOption) {
			case '0': //stretch
			if($this->intWidth > 0 && $this->intHeight > 0) {
					$imgWidth = $this->intWidth;
					$imgHeight = $this->intHeight;
				}
				break;
			case '1': //fit in
			case '2': //fill
				$img_size = getimagesize($imgURL);
				$img_aspect_ratio = $img_size[1] / $img_size[0];
				$box_aspect_ratio = $this->intHeight / $this->intWidth;
				if ( ($this->strSelectedFittingOption=='1' && $img_aspect_ratio > $box_aspect_ratio) 
					|| ($this->strSelectedFittingOption=='2' && $img_aspect_ratio < $box_aspect_ratio) ){
					$new_height = $this->intHeight;
					$new_width = $new_height/$img_aspect_ratio;
				} else {
					$new_width = $this->intWidth;
					$new_height = $new_width*$img_aspect_ratio;
				}
				$imgWidth = $new_width;
				$imgHeight = $new_height;
				break;
		}
		//Add values
		$returnValue = array('URL' => $imgURL
								 				,'WIDTH' => $imgWidth
								 				,'HEIGHT' => $imgHeight);
		return $returnValue;
	}
	
	//Checks if the value point's to a single image file
	private function isSingleImage($strValue)
	{
		$isValid = false;
		if($strValue != '' && JFile::exists(JPATH_BASE.$strValue))
		{
			$isValid = true;
		}
		return $isValid;
	}
	
	//Checks if the value point's to a directory
	private function isImageDirectory($strValue)
	{
		$isValid = false;
		if($strValue != '' && JFolder::exists(JPATH_BASE.$strValue))
		{
			$isValid = true;
		}
		return $isValid;
	}
	
	private function strTruncateCharAtEnd($strValue, $strChar='*')
	{
		if($strValue != '' && $strValue[strlen($strValue)-1] == $strChar)
		{
			$strValue = substr($strValue, 0, (strlen($strValue)-1));
		}
		return $strValue;
	}
}

