/*

    youtube API Base
	from https://developers.google.com/youtube/iframe_api_reference
	
	This code loads the IFrame Player API code asynchronously.

*/
jQuery(document).ready(function(){
    
    LoadYouTubeIframeAPI();
    
    function LoadYouTubeIframeAPI()
        {
            var scriptElement = document.createElement("script");
            scriptElement.src = "https://www.youtube.com/iframe_api";
            var firstScriptElement = document.getElementsByTagName("script")[0];
            firstScriptElement.parentNode.insertBefore(scriptElement,firstScriptElement);
        }
    
});
