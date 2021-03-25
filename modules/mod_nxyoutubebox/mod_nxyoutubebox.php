<?php
/**
 * Controller File for nx-YouTubeBox 
 * @package     nx-YouTubeBox
 *
 * @copyright   Copyright (C) 2009 - 2017 nx-designs.
 * @license     GNU General Public License version 2 or later
*/

defined('_JEXEC') or die('Restricted access');


require_once (dirname(__FILE__) . '/' . 'helper.php');


$player = array();
$playersetup = array();
// Source Settings
$rndm = intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
$nxdebug = intval($params->get('debug',0));

$player['sourcetype'] = intval($params->get('sourcetype',0));
if($player['sourcetype'] === 0){
	$player['listtsype'] = 'No List Single Video';
}else{
	$player['listtsype'] = $params->get('playlisttype','0');
}

$player['id'] = YTPlayerHelper::cleanUp($params->get('id','0'));

// Player Settings
$player['setup'] = array();
$player['setup']['cookiemode'] = $params->get('cookiemode','http://www.youtube-nocookie.com');
$player['setup']['fullscreen'] = $params->get('fullscreen','1');
$player['setup']['autoplay'] = $params->get('autoplay','0');
$player['setup']['loop'] = $params->get('loop','0');
$player['setup']['mute'] = $params->get('mute','0');
$player['setup']['volume'] = $params->get('volume',50);
$player['setup']['showcontrols'] = $params->get('controls','1');
$player['setup']['showrelated'] = $params->get('related','1');
$player['setup']['disablekb'] = $params->get('disablekb','0');
$player['setup']['modestbranding'] = $params->get('branding','0');
$player['setup']['iv_load_policy'] = YTPlayerHelper::ZeroToThree($params->get('iv_load_policy','0'));
$player['setup']['annotations'] = $params->get('annotations','1');
$player['setup']['showinfo'] = $params->get('showinfo','1');
$player['setup']['starttime'] = $params->get('starttime','0');
$player['setup']['playsinline'] = $params->get('playsinline','1');

// The Styling Parameters
$player['styling'] = array();
$player['styling']['randomizer'] = $rndm;
$player['styling']['rotation'] = intval($params->get('rotation',90))-90;
$player['styling']['CornerRadius'] = $params->get('cornerradius',0);
// Border Setup
$player['styling']['Borders'] = array();
$player['styling']['Borders']['UseBorder'] = $params->get('enableborders');
$player['styling']['Borders']['UseAdvancedBorder'] = $params->get('enableadvancedborders');
$player['styling']['Borders']['BordersColor'] = $params->get('bordercolor');
$player['styling']['Borders']['BorderWidth'] = $params->get('borderwidth');
$player['styling']['Borders']['BorderLeftColor'] = $params->get('bordercolorleft');
$player['styling']['Borders']['BorderTopColor'] = $params->get('bordercolortop');
$player['styling']['Borders']['BorderRightColor'] = $params->get('bordercolorright');
$player['styling']['Borders']['BorderBottomColor'] = $params->get('bordercolorbottom');

// Outer Shadow
$player['styling']['OuterShadow'] = array();
$player['styling']['OuterShadow']['UseOuterShadow'] = intval($params->get('enableoutershadow','0'));
$player['styling']['OuterShadow']['ShadowColor'] = $params->get('outershadowcolor','rgba(0,0,0, 0.7');
$player['styling']['OuterShadow']['HOffset'] = intval($params->get('outershadowhoffset','4'));
$player['styling']['OuterShadow']['VOffset'] = intval($params->get('outershadowvoffset','4'));
$player['styling']['OuterShadow']['BlurRadius'] = intval($params->get('outershadowblurradius','4'));
$player['styling']['OuterShadow']['SpreadRadius'] = intval($params->get('outershadowspreadradius','0'));
// BlockLayer Setup
$player['styling']['BlockLayer'] = array();
$player['styling']['BlockLayer']['UseBlockLayer'] = intval($params->get('enableblocklayer','0'));
$player['styling']['BlockLayer']['BlockLayerType'] = intval($params->get('blocklayertype','0'));					// color || static || animated
$player['styling']['BlockLayer']['BlockLayerBgColor'] = $params->get('blocklayerbackgroundcolor','0');
$player['styling']['BlockLayer']['InsetShadow'] = array();
$player['styling']['BlockLayer']['InsetShadow']['Status'] = intval($params->get('enableinsetshadow','0'));
$player['styling']['BlockLayer']['InsetShadow']['Color'] = $params->get('innershadowcolor','#000');
$player['styling']['BlockLayer']['InsetShadow']['OffsetH'] = intval($params->get('innershadowhoffset','0'));
$player['styling']['BlockLayer']['InsetShadow']['OffsetV'] = intval($params->get('innershadowvoffset','0'));
$player['styling']['BlockLayer']['InsetShadow']['BlurRadius'] = intval($params->get('innershadowblurradius','0'));
$player['styling']['BlockLayer']['InsetShadow']['SpreadRadius'] = intval($params->get('innershadowspreadradius','0'));
$player_bl_sh = $player['styling']['BlockLayer']['InsetShadow']; /*
$player['styling']['BlockLayer']['BlockLayerStaticTheme'] = $params->get('blocklayerstatictheme');
$player['styling']['BlockLayer']['BlockLayerAnimatedTheme'] = $params->get('blocklayeranimatedtheme');
$player['styling']['BlockLayer']['BlockLayerOpacity'] = intval($params->get('blocklayerthemeopacity','1'));
*/

// Headermode Setup
$player['styling']['Headermode'] = array();
$player['styling']['Headermode']['Status'] = intval($params->get('styletype','0'));								// 0 = default || 1 = headermode
$player['styling']['Headermode']['Height'] = intval($params->get('hmodeheight','50'));
$player['styling']['Headermode']['VerticalAlignement'] = intval($params->get('verticalalignement','-40'));



$playerstyle = YTPlayerHelper::playersetup($player['styling']);






// Moduleclass Suffix
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
// The Layout
require( JModuleHelper::getLayoutPath( 'mod_nxyoutubebox' ) );