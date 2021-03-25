<?php
/**
 * Helper File for nx-YouTubeBox 
 * @package     nx-YouTubeBox
 *
 * @copyright   Copyright (C) 2009 - 2017 nx-designs.
 * @license     GNU General Public License version 2 or later
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

JHtml::_('jquery.framework');

$document = JFactory::getDocument();
// Include YouTube iFrame API
$document->addScript('modules/mod_nxyoutubebox/tmpl/js/nx-youtube.js');
$document->addStylesheet('modules/mod_nxyoutubebox/tmpl/css/nx-youtubebox.css');




class YTPlayerHelper
{
	// Subfunctions

	public static function headermodesetup($setup){
		$height = 56.25/100*$setup['Height'];
		$headermode = 'width:100%; height:0; padding-bottom:'.$height.'%; overflow-y:hidden;';
		return $headermode;
	}
	public static function headermodemove($setup){
		$align = 56.25/100*$setup['VerticalAlignement'];
		$videomovement = 'margin-top: '.$align.'%;';
		return $videomovement;
	}

	public static function cornerRadius($setup){
		$value = 'border-radius:'.$setup['CornerRadius'].'; overflow: hidden;';
		return $value;
	}

	public static function shadowoptions($array){
		if($array['UseOuterShadow']){
			$shadowsetup = 'box-shadow:'.$array['HOffset'].'px '.$array['VOffset'].'px '.$array['BlurRadius'].'px '.$array['SpreadRadius'].'px '.$array['ShadowColor'].';';
		}else{
			$shadowsetup = 'box-shadow:none;';
		}
		return $shadowsetup;
	}
		
	public static function bordersetup($array){
		$useBorder = intval($array['Borders']['UseBorder']);
		$advancedBorders = intval($array['Borders']['UseAdvancedBorder']);
		if($advancedBorders){	
			$bordersetup = 'border-style:solid; 
						border-width: '.$array['Borders']['BorderWidth'].'; 
						border-left-color: '.$array['Borders']['BorderLeftColor'].'; 
						border-top-color: '.$array['Borders']['BorderTopColor'].'; 
						border-right-color: '.$array['Borders']['BorderRightColor'].'; 
						border-bottom-color: '.$array['Borders']['BorderBottomColor'].';
						box-sizing: border-box;';
		}elseif($useBorder){
			$bordersetup = 'border-width: '.$array['Borders']['BorderWidth'].'; 
						border-style: solid; 
						border-color: '.$array['Borders']['BordersColor'].'; 
						box-sizing: border-box;';
		}else{
			$bordersetup = 'border:none;';
		}

		return $bordersetup;
	}
	
	
	
	public static function ZeroToThree($number){
		if($number == 0){
			$retval = 3;
		}else{
			$retval = 1;
		}
		return $retval;
	}
	
	
	public static function cleanUp($id){
		if ((strpos($id,"https://")!==false) OR (strpos($id,"http://")!==false)){
			if ((strpos($id,"list=")!==false)){ 
				$ytarray=explode("list=", $id);
				
				if((strpos($ytarray[1],"&index=")!==false)){
					$array=explode("&index=",$ytarray[1]);
					$cleanID=$array[0];
				} else {
					$cleanID=$ytarray[1];
				}
			} else {
				$ytarray=explode("/", $id);
				$ytendstring=end($ytarray);
				$ytendarray=explode("?v=", $ytendstring);
				$ytendstring=end($ytendarray);
				$ytendarray=explode("&", $ytendstring);
				$cleanID=$ytendarray[0];
			}
		} else {
			$cleanID = $id;
		}
		return $cleanID;
	}
	
	public static function playersetup($array){
	$valuesOuterDiv = '';															// will be filled with CSS Styles
	$valuesInnerDiv = '';

	// General Switch

	switch ($array['Headermode']['Status']){
		case 0:
			$valuesOuterDiv .= YTPlayerHelper::bordersetup($array);				// Borders
			$valuesOuterDiv .= YTPlayerHelper::cornerRadius($array);			// Border Radius
		break;
		case 1:
			$valuesOuterDiv .= YTPlayerHelper::headermodesetup($array['Headermode']);
			$valuesInnerDiv .= YTPlayerHelper::headermodemove($array['Headermode']);
		break;	
	}

	$valuesOuterDiv .= YTPlayerHelper::shadowoptions($array['OuterShadow']);			// Outer Shadow

	$playerstlye = '#nx-player_'.$array['randomizer'].'_outer {'.$valuesOuterDiv.'}
					#nx-playercontainer_'.$array['randomizer'].'{'.$valuesInnerDiv.'}';
	return $playerstlye;
}
}
