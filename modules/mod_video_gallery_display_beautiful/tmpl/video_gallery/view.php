<?php
/**
* @title		video gallery display beautiful
* @website		http://www.joomhome.com
* @copyright	Copyright (C) 2015 joomhome.com. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/

    // no direct access
    defined('_JEXEC') or die;
?>
<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/css/jhmSlider.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/themes/default/default.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/themes/default-big/default-big.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/themes/dark/dark.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/themes/dark-big/dark-big.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/themes/light/light.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/themes/light-big/light-big.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/css/demo.css" />

<?php
if ($enable_jQuery == 1) {?>
	<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/js/jquery.js"></script>
<?php }?>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/js/jquery.touchSwipe.min.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/js/imagesloaded.min.js"></script>

<script type='text/javascript'>
var call_content_string;
call_content_string = <?php echo $content_string;?>;
</script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/js/jhmSlider/jhmBaseClass.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/js/jhmSlider/jhmSetupLayout.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/js/jhmSlider/jhmSizeAndScale.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/js/jhmSlider/jhmShift.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/js/jhmSlider/jhmSetupBulletNav.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/js/jhmSlider/jhmSetupNavigation.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/js/jhmSlider/jhmSetupSwipeTouch.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/js/jhmSlider/jhmSetupTimer.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/js/jhmSlider/jhmBeforeAfter.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/js/jhmSlider/jhmLock.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/js/jhmSlider/jhmResponsiveClass.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/js/jhmSlider/jhmResetSlider.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/js/jhmSlider/jhmTextbox.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/js/jhmSlider/jhmVideo.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_video_gallery_display_beautiful/tmpl/video_gallery/js/jhmSlider.js"></script>

<style>
.video-gallery-dis-beautiful{
	width:<?php echo $width_module;?>;
	margin:0 auto;
}
</style>

<div class="video-gallery-dis-beautiful">
<div class='jhm-extensions'>
	<?php
		$count1 =1;
		$real_introtext='';
		foreach($data as $index=>$value)
		{
		?>
			<div class='jhm-content'>
				<iframe src="<?php echo $value['link'] ?>" frameborder="0" allowfullscreen></iframe>
			</div>
	<?php
			$count1++ ; 
		} ?>
</div>
</div>