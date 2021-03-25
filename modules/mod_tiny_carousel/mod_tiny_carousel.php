<?php
/**
 * Tiny Carousel
 *
 * @package 	Tiny Carousel
 * @subpackage 	Tiny Carousel
 * @version   	3.3
 * @author    	Gopi Ramasamy
 * @copyright 	Copyright (C) 2010 - 2014 www.gopiplus.com, LLC
 * @license   	http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * http://www.gopiplus.com/extensions/2014/06/tiny-carousel-slider-joomla-module/
 */

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$folder	= modTinyCarouselHelper::getFolder($params);
$images	= modTinyCarouselHelper::getImages($params, $folder);

if (!count($images)) 
{
	echo JText::_('NO IMAGES ' . $folder . '<br><br>');
	return;
}

require JModuleHelper::getLayoutPath('mod_tiny_carousel', $params->get('layout', 'default'));
modTinyCarouselHelper::loadScripts($params);
?>