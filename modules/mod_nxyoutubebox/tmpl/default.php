<?php
/**
 * Printout File for nx-YouTubeBox 
 * @package     nx-YouTubeBox
 *
 * @copyright   Copyright (C) 2009 - 2017 nx-designs.
 * @license     GNU General Public License version 2 or later
*/

defined('_JEXEC') or die('Restricted access');
$document = JFactory::getDocument();

// Load the Playerstyle from helper into Head Section
$document->addStyleDeclaration($playerstyle);


if($nxdebug){
	print_r($player);
}


if($player['styling']['Headermode']['Status'] == 0 && $player['styling']['rotation'] != 0){
	
	// Add the Script itself if not already added
	$document->addScript('modules/mod_nxyoutubebox/tmpl/js/rotator.js');
	
	// Call the Script for this Player
	$rotatorscript = 	"<script type='text/javascript'>
							jQuery(document).ready(function(){
								rotateScript(".$rndm.",".$player['styling']['rotation'].");
							});
						</script>";
	echo $rotatorscript;
}

if($player['styling']['BlockLayer']['UseBlockLayer']){
include __DIR__ .'/css/nx-blocklayer.css.php';
}

include __DIR__ .'/js/nx-youtubebox_player.js.php';
?>

<?php
if($player['styling']['Headermode']['Status'] == 0 && $player['styling']['rotation'] != 0){
	echo '<div id="nx-youtubebox-'.$rndm.'-rotation">'; // Wraps the whole Player for Rotation
}?>
<div id="nx-player_<?php echo $rndm;?>_outer" class="nx-youtubebox">
	<div id="" class="nx-outer">
		<div id="nx-playercontainer_<?php echo $rndm;?>" class="nx-YouTubeBox">
				<div id="nxplayer_<?php echo $rndm;?>"></div>
		</div>
		<?php
			if($player['styling']['BlockLayer']['UseBlockLayer']){
				if($player['styling']['BlockLayer']['BlockLayerType'] ){
					echo '<div class="nx-blocklayer"><div class="themed-blocklayer '.$player['styling']['BlockLayer']['BlockLayerStaticTheme'].'-theme effectstrength"></div></div>';
				}else{
					echo '<div class="nx-blocklayer"></div>';
				}
			}
		?>
	</div>
</div>
<?php
if($player['styling']['Headermode']['Status'] == 0 && $player['styling']['rotation'] != 0){
	echo '</div>'; // End of Rotation Wrapping
}?>
