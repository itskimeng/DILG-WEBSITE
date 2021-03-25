<?php
/*------------------------------------------------------------------------
# mod_sw_twitter_feeds_sidebar - SW Twitter Feeds Sidebar
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
$document->addStyleSheet('modules/mod_sw_twitter_feeds_sidebar/assets/style.css');
/*twitter needed variables*/
$twitter_username = $params->get('tw_username');
//$twitter_widget_id = $params->get('tw_id');
$widget_theme = $params->get('widget_theme');
$scrollber	= 'noscrollbar ';
$nofooter	= 'nofooter ';
$noborders	= 'noborders ';
/*twitter values end here*/

$margintop = $params->get('margintop');
$twidth = $params->get('twidth');
$tbox1_width = trim($params->get( 'twidth' )+10);

$theight = $params->get('theight');

?>
<div id="sw_twitter_feeds_sidebar">
	<div id="tbox1" style="right: -<?php echo $tbox1_width;?>px; top: <?php echo $margintop;?>px; z-index: 10000;">
		<div id="tobx2" style="text-align: left;width:<?php echo $twidth; ?>px;height:<?php echo $theight; ?>px;">
			<a class="open" id="fblink" href="#"></a><img style="top: 0px;left:-50px;" src="modules/mod_sw_twitter_feeds_sidebar/assets/twitter-icon.png" alt="">
			<?php echo '<a class="twitter-timeline" data-theme="'.$widget_theme.'" data-chrome="'.$nofooter.$noborders.$scrollber.'"   href="https://twitter.com/'.$twitter_username.'" width="'.$twidth.'" height="'.$theight.'">Tweets by @'.$twitter_username.'</a>

<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>';

		?>
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
						jQuery("#tbox1").hover(function(){
						jQuery('#tbox1').css('z-index',101009);
						jQuery(this).stop(true,false).animate({right:  0}, 500); },
						function(){
						jQuery('#tbox1').css('z-index',10000);
						jQuery("#tbox1").stop(true,false).animate({right: -300}, 500); });

	});}); });
</script>
