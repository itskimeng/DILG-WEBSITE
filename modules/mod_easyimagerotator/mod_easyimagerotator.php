<?php
/**
* @package EasyImageRotator
* @Copyright (C) 2011-2017 Daniel Blum. All rights reserved.
* @license Distributed under the terms of the GNU General Public License GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html
* @author Daniel Blum
* @website Visit http://codeninja.eu for updates and information.
**/

defined('_JEXEC') or die('Restricted access');

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');


// Include the syndicate functions only once
require_once (__DIR__ . '/helper.php');
$modEasyImageRotatorHelper = new modEasyImageRotatorHelper();

if(!JFile::exists(JPATH_SITE.'/administrator/components/com_easyimagerotator/easyimagerotator.php')) {
	echo JText::_('This module is nothing without the Easy Image Rotator component!<br><br><strong> Please install this component first!</strong>');
	return;
}

$arrImages = null;
$strCurrentModuleID = (($module!=null) ? $module->id : 0);
$active_menuItemId = $modEasyImageRotatorHelper->getMenu();
$objImgResult			 = $modEasyImageRotatorHelper->getImgEntry($active_menuItemId);

//Parameter Setup
//Basics
$paramIsUseFallbackImages 			= ($params->get("useFallbackImages", 1) == 1 ? true : false);
$paramSelectedFittingOption 		= ($params->get("fitting") != "" ? $params->get("fitting") : "0");
$paramIsResponsive 							=  $params->get("isResponsive", 1);
$paramIntWidth 									= ($params->get("width") != "" ? $params->get("width") : 250);
$paramIntHeight									= ($params->get("height") != "" ? $params->get("height") : 80);

$paramIsShuffleImages						= ($params->get("shuffleImages", 0) == 1 ? true : false);
//SpecificImagePath
$paramIsUseSpecificImagePath 		= ($params->get("useSpecificImagePath", 0) == 1 ? true : false);
$paramSpecificImagePath 				= ($params->get("specificImagePath") != "" ? $params->get("specificImagePath") : "images");
//Slider
$paramIsDisplayAsImageSlider 		= ($params->get("displayAsImageSlider", 1) == 1 ? true : false); /** displayAsImageSlider = 1 display as js slider, displayAsImageSlider = 2 display as normal image **/
$paramIsSliderCropImages				= ($params->get("sliderCropImages", 0) == 1 ? true : false);
$paramIntSliderPauseTime				= (($params->get("sliderPauseTime") != "") ? $params->get("sliderPauseTime") : 3000);
$paramIntSliderEffect						= (($params->get("sliderEffect") != "") ? $params->get("sliderEffect") : 0);

$paramIntNumberOfImagesToLoad		= (($params->get("numberOfImagesToLoad") > 0) ? $params->get("numberOfImagesToLoad") : 1);
$paramIsDisplayImageTitle 			= ($params->get("displayImageTitle", 1) == 1 ? true : false);
$paramIsDisplayHtmlCaption 			= ($params->get("displayHtmlCaption", 1) == 1 ? true : false);
$paramIntSliderAnimationSpeed 	= (($params->get("animationSpeed") != "") ? $params->get("animationSpeed") : 500);

//Setup HelperClass properties
$modEasyImageRotatorHelper->intWidth = $paramIntWidth;
$modEasyImageRotatorHelper->intHeight = $paramIntHeight;
$modEasyImageRotatorHelper->intNumberOfImagesToLoad = $paramIntNumberOfImagesToLoad;
$modEasyImageRotatorHelper->isShuffleImages = $paramIsShuffleImages;
$modEasyImageRotatorHelper->strSelectedFittingOption = $paramSelectedFittingOption;
$modEasyImageRotatorHelper->isUseSpecificImagePathEnabled = $paramIsUseSpecificImagePath;
$modEasyImageRotatorHelper->strSpecificImagePath = $paramSpecificImagePath;

//If fallback for image directory has been set
if($paramIsUseFallbackImages && !$modEasyImageRotatorHelper->isImgEntryUrlValid($objImgResult))
{
	$objImgResult  = $modEasyImageRotatorHelper->getImgEntry(0);
	$arrImages 		 = $modEasyImageRotatorHelper->setUpImages($objImgResult);
}
else
{
	$arrImages = $modEasyImageRotatorHelper->setUpImages($objImgResult);
}

//Text and Caption setup
$strImageTitle = ($paramIsDisplayImageTitle) ? $objImgResult->img_title : '';
$strHtmlCaptionText = ($paramIsDisplayHtmlCaption) ? $objImgResult->img_textlayer : '';

if(!$paramIsDisplayAsImageSlider)
{
	//check for available images
	if(is_array($arrImages) && count($arrImages) > 0)
	{
		//load minimal css and js files into the header
		$modEasyImageRotatorHelper->loadMinHeaderIncludes();
		
		if($paramIsResponsive)
		{
			echo '<div class="img-container"><img class="img-responsive" src="'.$arrImages[0]['URL'].'" alt="'.$strImageTitle.'" title="'.$strImageTitle.'" /></div>';
		}
		else
		{
			echo '<div style="height:'.$arrImages[0]['HEIGHT'].'px;width:'.$arrImages[0]['WIDTH'].'px;overflow:hidden;">
						<img class="" src="'.$arrImages[0]['URL'].'" height="'.$arrImages[0]['HEIGHT'].'" alt="'.$strImageTitle.'" title="'.$strImageTitle.'" width="'.$arrImages[0]['WIDTH'].'" />
					</div>';
		}
	}
	else
	{
		//Display error no images ...
		echo '<strong>Error:</strong> No images have been found in directory';
	}
}
else
{
	$isHtmlCaptionsEnabled = false;
	if($paramIsDisplayHtmlCaption)
	{
		if(trim($strHtmlCaptionText) != "") 
		{
			$isHtmlCaptionsEnabled = true;
		}
	}
	
	//check for available images
	if(is_array($arrImages) && count($arrImages) > 0)
	{
		//load full css and js files into the header
		$modEasyImageRotatorHelper->loadFullHeaderIncludes();
		
		//Use CropImages only it the mode is not responsive
		$strSliderCropImagesJS = "";
		if(!$paramIsResponsive && $paramIsSliderCropImages)
		{
			$strSliderCropImagesJS .= "
					/** corp images to ensure slider is working with diffrent sized images **/
					if (jQuery().fakecrop){ jQuery('#slider-".$strCurrentModuleID." img').fakecrop({ wrapperWidth:".$paramIntWidth.", wrapperHeight:".$paramIntHeight.", fill: true }); }
			";
		}
		
		$i=0;
		$strImagesContent = '';
		$strHtmlCaptionContent = '';
		foreach($arrImages as $imgItem) 
		{
			$i++;
			$strImgHtmlCaption = '';
		
			if($isHtmlCaptionsEnabled)
			{
				$strImgHtmlCaption 		= ' title="#htmlcaption-'.$strCurrentModuleID.'-'.$i.'"';
				$strHtmlCaptionContent .= '<div id="htmlcaption-'.$strCurrentModuleID.'-'.$i.'" class="nivo-html-caption">'.$strHtmlCaptionText.'</div>';
			}
		
			$strImgSizes 					= (!$paramIsResponsive) ? ' width="'.$imgItem['WIDTH'].'" height="'.$imgItem['HEIGHT'].'"' : '';
			$strImagesContent .= '<img src="'.$imgItem['URL'].'" '.$strImgSizes.$strImgHtmlCaption.' data-thumb="'.$imgItem['URL'].'" alt="'.$strImageTitle.'" />';
		}
		
		$strSliderStyles = (!$paramIsResponsive) ? ' width:'.$params->get("width").'px;height:'.$params->get("height").'px;' : '';
		echo '<div class="slider-wrapper theme-default" style="'.$strSliderStyles.'">
						<div id="slider-'.$strCurrentModuleID.'" class="nivoSlider" >
							'. $strImagesContent .'
						</div>
						<!-- htmlcaptions -->
						'. $strHtmlCaptionContent .'
				</div>';
				
		?>
			<script type="text/javaScript">
				jQuery(document).ready(function() {
					<?php echo $strSliderCropImagesJS; ?>
					jQuery('#slider-<?php echo $strCurrentModuleID; ?>').nivoSlider({ 
						effect: '<?php echo $modEasyImageRotatorHelper->getMappedEffect($paramIntSliderEffect); ?>',
						animSpeed: <?php echo $paramIntSliderAnimationSpeed; ?>,
						pauseTime: <?php echo $paramIntSliderPauseTime; ?>,
						controlNav: false, 
						controlNavThumbs: false, 
						prevText: 'Prev', 
						nextText: 'Next',
						pauseOnHover: true,
						randomStart: false,
					});
				});
			</script>
		<?php
	}
	else
	{
		//Display error no images ...
		echo '<strong>Error:</strong> No images have been found in directory';
	}

} //End show_as_js_gallery select
?>