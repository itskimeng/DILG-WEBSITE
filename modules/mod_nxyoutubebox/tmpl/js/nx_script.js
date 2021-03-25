
/*

    Script to define the Video Dimensions for nx-youtubeBox

*/
var nxplayersArray=[];

var nxvideobox = (function(){
    jQuery('div.nx-videobox-container').each(function(){
        var videocontainer = jQuery(this).children('div');
        var videoframe = jQuery(this).children('div').children('iframe');
        var videocontainerwidth = videocontainer.width();
        videocontainerwidth = videocontainerwidth - parseInt(videoframe.css('border-left-width')) - parseInt(videoframe.css('border-right-width')) ;
        var videoheight = videocontainerwidth/1.777778;
        videocontainer.parent().css( "position", "relative" ); // could make problems
        jQuery(this).css('min-height',videoheight);
        setTimeout(function(){
        videoframe.attr('height',videoheight).attr('width',videocontainerwidth).fadeIn('slow');
            },200);
    });
});
     
jQuery(window).resize(nxvideobox);


var tryCounter = 0;

function onYouTubePlayerAPIReady() {
    checkifexists(nxvideobox);
}

function checkifexists(runfunction){
    tryCounter = 0;
        if(typeof nxplayerElement === 'undefined'){
            tryCounter++;
            setTimeout(function(){
                onYouTubePlayerAPIReady();
            },100); 
        }else{ 
            tryCounter = 0;
            for(var i = 0; i< nxplayersArray.length; i++){
                nxplayersArray[i]();
            }
            
            setTimeout(function(){
                runfunction();
            },100);
        }
    }

// startup the players
function calculatePositioning(movement,heightval,rand){
    var hve_width = jQuery('#nxouter_'+rand).width(),
        hve_fullheight = hve_width / 1.777778,
        hve_height = hve_fullheight / 100 * heightval,
        hve_inner = jQuery('#nxouter_'+rand).children('div.nx-videobox-container'),
        hve_move = hve_height / 100 * movement;
    
    jQuery('#nxouter_'+rand).css('height', hve_height+'px').css('overflow-y', 'hidden');
    jQuery(hve_inner).css('margin-top', hve_move+'px');   
};

function makevisible(randomizer){
    jQuery(document).ready(function($){
        $('#nxplayer_'+randomizer).css('left', '0px');
        switch ('vid_'+randomizer+'_headermode'){
            case 0:
                $('#nxouter_'+randomizer).css('overflow', 'visible');
                break;
            case 1:
                break;
        }
        
    });
}
