<?php
/*------------------------------------------------------------------------
# mod_sw_facebook_likebox_sidebar - SW Facebook Likebox Sidebar
# ------------------------------------------------------------------------
# @author - Social Widgets
# copyright - All rights reserved by Social Widgets
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://socialwidgets.net/
# Technical Support:  admin@socialwidgets.net
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die;
$document = JFactory::getDocument();
$document->addStyleSheet('modules/mod_sw_facebook_likebox_sidebar/assets/style.css');
$fb_id = $params->get('fb_id');
$margintop = $params->get('margintop');
$fbwidth = $params->get('fbwidth');
$fbox1_width = trim($params->get( 'fbwidth' )+10);
$fbheight = $params->get('fbheight');
$fbwidth = $params->get('fbwidth');
?>
<div id="sw_facebook_likebox_sidebar">
	<div id="fbox1" style="right: -<?php echo $fbox1_width;?>px; top: <?php echo $margintop;?>px; z-index: 10000;">
		<div id="fobx2" style="text-align: left;width:<?php echo $fbwidth; ?>px;height:<?php echo $fbheight; ?>px;">
			<a class="open" id="fblink" href="#"></a><img style="top: 0px;left:-50px;" src="modules/mod_sw_facebook_likebox_sidebar/assets/facebook-icon.png" alt="">
                            <div id="fb-root"></div>
                            <script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.1";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
                            <div class="fb-page" data-href="<?php echo $fb_id; ?>" data-width="<?php echo trim( $params->get( 'fbwidth' )+3);  ?>" data-height="<?php echo trim( $params->get( 'fbheight' )+3);  ?>" data-hide-cover="false" data-show-facepile="true" data-show-posts="<?php echo trim( $params->get( 'stream' ) );?>"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?php echo $fb_id; ?>"><a href="<?php echo $fb_id; ?>">Facebook</a></blockquote></div></div>
		</div>
	</div>
</div>
<?php
	if (trim( $params->get( 'loadjquery' ) ) == 1){
	$document->addScript("http://code.jquery.com/jquery-latest.min.js");}
?>
	<script type="text/javascript">
		jQuery.noConflict();
		jQuery(function (){
			jQuery(document).ready(function()
				{
					jQuery.noConflict();
					jQuery(function (){
						jQuery("#fbox1").hover(function(){
						jQuery('#fbox1').css('z-index',101009);
						jQuery(this).stop(true,false).animate({right:  0}, 500); },
						function(){
						jQuery('#fbox1').css('z-index',10000);
						jQuery("#fbox1").stop(true,false).animate({right: -<?php echo $params->get( 'fbwidth' )+10; ?>}, 500); });
						});}); });
					</script>
