<?
header('Content-Type: text/css');
/**
 * Youtube CSS  for nx-YouTubeBox 
 * @package     nx-YouTubeBox
 *
 * @copyright   Copyright (C) 2009 - 2017 nx-designs.
 * @license     GNU General Public License version 2 or later
*/
?>
<style type="text/css">
div.nx-blocklayer{
	top: 			0;
	left: 			0;
	bottom:			0;
	right:			0;
	background-color: <?php echo $player['styling']['BlockLayer']['BlockLayerBgColor']; ?>;
	position: 		absolute;
	z-index: 		101;
	margin: 		0;
	padding: 		0;
	border: 		0;
	border-radius:	<?php echo $player['styling']['CornerRadius']; ?>;
	overflow: 		hidden;
	<?php
	if($player['styling']['BlockLayer']['InsetShadow']['Status']){
		$eigenschaften = ['-webkit-box-shadow','-moz-box-shadow','box-shadow'];
		foreach($eigenschaften as $n){
			echo "$n: inset ".$player_bl_sh['OffsetH']."px ".$player_bl_sh['OffsetV']."px ".$player_bl_sh['BlurRadius']."px ".$player_bl_sh['SpreadRadius']."px ".$player_bl_sh['Color'].";";
		}
	}
	?>
}
	div.themed-blocklayer{
		position: relative;
		width: 100%;
		height: 100%;
	}
	
@media (min-width:320px){ 
    /* smartphones, iPhone, portrait 480x320 phones */ 
    .nx-blocklayer{
        display: none;
    }
}
@media (min-width:481px){ 
    /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ 
	.nx-blocklayer{
        display: none;
    }
}
@media (min-width:641px){ 
    /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ 
	.nx-blocklayer{
        display: none;
    }
}
@media (min-width:961px){ 
    /* tablet, landscape iPad, lo-res laptops ands desktops */ 
	.nx-blocklayer{
        display: block;
    }
}
@media (min-width:1025px){ 
    /* big landscape tablets, laptops, and desktops */ 
	.nx-blocklayer{
        display: block;
    }
}
@media (min-width:1281px){ 
    /* hi-res laptops and desktops */ 
	.nx-blocklayer{
        display: block;
    }
}
</style>
	