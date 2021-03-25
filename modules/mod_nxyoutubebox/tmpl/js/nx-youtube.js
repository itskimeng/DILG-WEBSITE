/**
 * Youtube Basescript File for nx-YouTubeBox 
 * @package     nx-YouTubeBox
 *
 * @copyright   Copyright (C) 2009 - 2017 nx-designs.
 * @license     GNU General Public License version 2 or later
*/

// create the var to store the Players and settings
var playerInfoList = [];

// create deferred object
var YTdeferred = jQuery.Deferred();
 
function onYouTubeIframeAPIReady() {
	
	// Check if there is something in the playerInfoList
	if(typeof playerInfoList === 'undefined' || playerInfoList === []){
		if(nxdebug){console.log('Videoplayer Array is undefined or empty');};
		return;
	}
	// resolve when youtube callback is called
    // passing YT as a parameter
    YTdeferred.resolve(window.YT);
	
}

// document ready
jQuery(document).ready(function($) {
		
	
	// whenever youtube callback was called = deferred resolved
    // your custom function will be executed with YT as an argument
    YTdeferred.done(function(YT) {

		// return the Playersettings to the onYouTubeIframeAPIReady Function
		function createPlayer(playerInfo) {
			var playerType = playerInfo.playerType;

			if(playerType == 0){
				// Single Video Player Mode
				return new YT.Player(playerInfo.id, {
					height: playerInfo.height,
					width: playerInfo.width,
					videoId: playerInfo.videoId,
					'host': playerInfo.host,

					playerVars: {
						'autoplay': playerInfo.autoplay, 			// wenn Playlist funktioniert diese Var nicht
						'controls': playerInfo.controls,
						'disablekb': playerInfo.disablekb,
						'fs': playerInfo.fs,
						'iv_load_policy': playerInfo.iv_load_policy,
						'modestbranding': playerInfo.modestbranding,
						'rel': playerInfo.rel,
						'showinfo': playerInfo.showinfo,
						'playsinline': playerInfo.playsinline,
						'start': playerInfo.start,
						'enablejsapi' : 1,
						'origin': playerInfo.origin
					},
					events:{
						'onReady': playerInfo.id+'_onPlayerReady',
						'onStateChange': playerInfo.id+'_StateChange'
					}
			  });
			} else {
				// Playlist Mode
				return new YT.Player(playerInfo.id, {
					height: playerInfo.height,
					width: playerInfo.width,
					'host': playerInfo.host,
					playerVars: {
						'listType': playerInfo.playlisttype,
							'list': playerInfo.videoId,
						'autoplay': playerInfo.autoplay, 			// wenn Playlist funktioniert diese Var nicht
						'controls': playerInfo.controls,
						'disablekb': playerInfo.disablekb,
						'fs': playerInfo.fs,
						'iv_load_policy': playerInfo.iv_load_policy,
						'modestbranding': playerInfo.modestbranding,
						'rel': playerInfo.rel,
						'showinfo': playerInfo.showinfo,
						'playsinline': playerInfo.playsinline,
						'start': playerInfo.start,
						'enablejsapi' : 1,
						'origin': playerInfo.origin
					},
					events:{
						'onReady': playerInfo.id+'_onPlayerReady',
						'onStateChange': playerInfo.id+'_StateChange'
					}
			  });	
			}
		}
	
		
		// create the Player for every Object in the var
		for(var i = 0; i < playerInfoList.length;i++) {
			var playername = playerInfoList[i].id;
			var playername = createPlayer(playerInfoList[i]);
		}
	});
});


// connect to YouTube API
// This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

