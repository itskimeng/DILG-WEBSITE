<style type="text/css">
/*
    Stylesheet for nx-youtubeBox Blocklayer Settings
*/  
#nx-blocklayer_<?php echo $rndm; ?> {
    position:           absolute;
    display:            block;
    width:              100%; 
    height:             100%;
    
    <?php if ($hem == 0){
        echo 'top:          '.$bow.'px;';
        echo 'left:         '.$bow.'px;';
    }else{
        echo 'top:          0px;';
        echo 'left:         0px;';   
    }
    ?>
    
    z-index:            1;
    }
</style>