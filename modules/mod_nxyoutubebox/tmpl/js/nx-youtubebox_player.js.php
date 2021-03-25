<?
/**
 * Individual Script for nx-YouTubeBox Instance 
 * @package     nx-YouTubeBox
 *
 * @copyright   Copyright (C) 2009 - 2017 nx-designs.
 * @license     GNU General Public License version 2 or later
*/
?>
<script type="text/javascript">
var videoInfo = {
	id:'nxplayer_<?php echo $rndm?>',
	height:'390',
	width:'640',
	host: '<?php echo $player['setup']['cookiemode'];?>',
	playerType:'<?php echo $player['sourcetype'];?>',
	videoId:'<?php echo $player['id'];?>',
	playlisttype:'<?php echo $player['listtsype'];?>',
	//autoplay:'<?php echo $player['setup']['autoplay'];?>',
	controls:'<?php echo $player['setup']['showcontrols'];?>',
	fs:'<?php echo $player['setup']['fullscreen'];?>',
	rel:'<?php echo $player['setup']['showrelated'];?>',
	showinfo:'<?php echo $player['setup']['showinfo'];?>',
	disablekb:'<?php echo $player['setup']['disablekb'];?>',
	iv_load_policy:'<?php echo $player['setup']['iv_load_policy'];?>',
	modestbranding:'<?php echo $player['setup']['modestbranding'];?>',
	playsinline:'<?php echo $player['setup']['playsinline'];?>',
	start:'<?php echo $player['setup']['starttime'];?>',
	origin:'<?php echo $_SERVER['HTTP_HOST']; ?>'
				};
	
playerInfoList.push(videoInfo);
	
function nxplayer_<?php echo $rndm?>_onPlayerReady(event){
	<?php if($nxdebug){ echo "console.log('onPlayerReady fired for nxplayer_$rndm');"; } ?>
	event.target.setVolume(<?php echo $player['setup']['volume'];?>);
	<?php 
		if($player['setup']['mute']){
			echo 'event.target.mute();';
		}
		if($player['setup']['autoplay']){
			echo 'event.target.playVideo(); ';
		}
	?>
}
	
function nxplayer_<?php echo $rndm?>_StateChange(event){
	<?php if($nxdebug){ echo "console.log('StateChange Event fired for nxplayer_$rndm');";} ?>
	if (event.data == YT.PlayerState.ENDED) {
		<?php 
			if($player['setup']['loop']){
				echo 'event.target.playVideo();'; 
			}
		?>
	}
	
}
</script>
