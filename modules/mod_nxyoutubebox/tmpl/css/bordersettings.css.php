<style type="text/css">
/*
    Stylesheet for nx-youtubeBox border settings
*/
#nxouter_<?php echo $rndm; ?> {
    <?php 
        if ($deg2d !== 0) {
            $padding = $ubw/2;
            echo "padding-bottom:".$padding."px";
        }
    if (($ubo == 1) && ($hem == 1)){
        echo 'border-radius:        '.$bor.';';
		echo 'border:			    '.$bow.'px solid '.$boc.';';
    }
	if (($ubb == 1) && ($hem == 1)){
		echo 'border-bottom:		'.$ubw.'px solid '.$ubc.';';
	}
    if (($she == 1) && ($hem == 1)){
		echo '-webkit-box-shadow: 	'.$shh.'px '.$shv.'px '.$shb.'px '.$shs.'px '.$shc.';';
		echo 'box-shadow:         	'.$shh.'px '.$shv.'px '.$shb.'px '.$shs.'px '.$shc.';';
	}
    ?>
}

#nxouter_<?php echo $rndm; ?> iframe {
    <?php if (($ubo == 1) && ($hem == 0)){
        echo 'border-radius:        '.$bor.';';
		echo 'border:			    '.$bow.'px solid '.$boc.';';
    }
	if (($ubb == 1) && ($hem == 0)){
		echo 'border-bottom:		'.$ubw.'px solid '.$ubc.';';
	}
    if (($she == 1) && ($hem == 0)){
		echo '-webkit-box-shadow: 	'.$shh.'px '.$shv.'px '.$shb.'px '.$shs.'px '.$shc.';';
		echo 'box-shadow:         	'.$shh.'px '.$shv.'px '.$shb.'px '.$shs.'px '.$shc.';';
	}
?>
}
</style>