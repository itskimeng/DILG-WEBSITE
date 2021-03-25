<?php

/*------------------------------------------------------------------------
# mod_ju_logoshowcase Extension
# ------------------------------------------------------------------------
# author    joomla2you
# copyright Copyright (C) 2018 joomla2you.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomla2you.com
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die;
if(!defined('DS')){
define( 'DS', DIRECTORY_SEPARATOR );
}
$slide = $params->get('slides');
$cacheFolder = JURI::base(true).'/cache/';
$modID = $module->id;
$modPath = JURI::base(true).'/modules/mod_ju_logoshowcase/';
$document = JFactory::getDocument(); 
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$jqueryload = $params->get('jqueryload');
$jpreload = $params->get('jpreload');
$showarrows = $params->get('showarrows');
$customone = $params->get('customone');
$logo_items    = $params->get('logo_items');
$ju_image            = $params->get('ju_image');
$ju_target           = $params->get('ju_target');
$ju_target_url           = $params->get('ju_target_url');

if($jqueryload) $document->addScript($modPath.'assets/js/jquery.min.js');
if($jqueryload) $document->addScript($modPath.'assets/js/jquery-noconflict.js');
$document->addScript($modPath.'assets/js/jquery.owl.carousel.js');
$document->addScript($modPath.'assets/js/theme.js');
$document->addStyleSheet($modPath.'assets/css/owl.carousel.css');
$document->addStyleDeclaration('.snip { margin-right: calc('.$params->get('container_fix',6).'px + 5px);margin-left: 5px; margin-bottom: calc('.$params->get('container_fix',6).'px + 5px); }'); 

?>


<div class="owl-carousel <?php echo $params->get('navStyle')?> <?php echo $params->get('navPosit')?> <?php echo $params->get('navRounded')?>" data-dots="false" data-autoplay="<?php echo $params->get('autoplay')?>" data-autoplay-hover-pause="<?php echo $params->get('autoplay-hover-pause')?>" data-autoplay-timeout="<?php echo $params->get('autoplay-timeout')?>" data-autoplay-speed="<?php echo $params->get('autoplay-speed')?>" data-loop="<?php echo $params->get('dataLoop')?>" data-nav="<?php echo $params->get('dataNav')?>" data-nav-speed="<?php echo $params->get('autoplay-speed')?>" data-items="<?php echo $params->get('image_width')?>" data-tablet-landscape="<?php echo $params->get('image_width_tabl')?>" data-tablet-portrait="<?php echo $params->get('image_width_tabp')?>" data-mobile-landscape="<?php echo $params->get('image_width_mobl')?>" data-mobile-portrait="<?php echo $params->get('image_width_mobp')?>">
<?php foreach ($logo_items as $item) : ?>
<div class="snip">
<?php if (!empty($item->ju_target_url)) : ?>
<a href="<?php echo $item->ju_target_url; ?>" target="<?php echo $ju_target; ?>">
<?php endif; ?> 
<?php if (!empty($item->ju_image)) : ?>
<div class="smicon">
<img src="<?php echo $item->ju_image; ?>" alt="logo" >
</div>
<?php endif; ?>
<?php if (!empty($item->ju_target_url)) : ?>
</a>
<?php endif; ?>
</div>
<?php endforeach; ?>

</div>

