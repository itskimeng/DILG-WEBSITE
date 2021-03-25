<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldNxVideoinfo extends JFormField {
	

    protected $type = 'nxVideoinfo';

    // getLabel() left out

    public function getInput() {
		// Dokument Instanzieren
		$document = JFactory::getDocument();
		// Den Die Form-Data holen
		$formData = json_decode($this->form->getData('jform'),'true');
		if(isset($formData['id'])){											// Check if the Module is new
		$id = $formData['params']['id'];									// Video or Playlist ID / Username
		$type = $formData['params']['sourcetype'];							// SourceType
		$listtype = $formData['params']['playlisttype'];					// needed if Sourcetype == 1(Playlist)
		}else{
			return JTEXT::_("MOD_NXYTBOX_VI_NOTHINGSET");					// return if new Module
		}
		
		// Die Funktionen für die Ausführung
		function newModule(){
			return JTEXT::_("MOD_NXYTBOX_VI_NOTHINGSET");
		}
		function cleanUp($id){
			if ((strpos($id,"https://")!==false) OR (strpos($id,"http://")!==false)){
				if ((strpos($id,"list=")!==false)){ 
					$ytarray=explode("list=", $id);

					if((strpos($ytarray[1],"&index=")!==false)){
						$array=explode("&index=",$ytarray[1]);
						$cleanID=$array[0];
					}else{
						$cleanID=$ytarray[1];
					}

				} else {
					$ytarray=explode("/", $id);
					$ytendstring=end($ytarray);
					$ytendarray=explode("?v=", $ytendstring);
					$ytendstring=end($ytendarray);
					$ytendarray=explode("&", $ytendstring);
					$cleanID=$ytendarray[0];
				}
			} else {
				$cleanID = $id;
			}
			return $cleanID;
		}
		function playListXMLInfo($xml){
			$ns = $xml->getDocNamespaces(true);
			$xml->registerXPathNamespace('a', 'http://www.w3.org/2005/Atom');
			$elements = $xml->xpath('//a:entry');
			$content = $elements[0];

			$yt = $content->children('http://www.youtube.com/xml/schemas/2015');
			$media = $content->children('http://search.yahoo.com/mrss/');
			$imgAttr = $media->group->thumbnail->attributes();
			$imgURL = $imgAttr['url'];
			return $imgURL;
		}

		function youtubeVideo($id, $formID){
			if (isset($formID)){			
				$cleanedID = cleanUp($id);
				$url = "https://noembed.com/embed?url=https://www.youtube.com/watch?v=$cleanedID";
				// Some Magic to get the Video Title with noembed.com
				$content = file_get_contents($url);
				$ytarr = json_decode($content, true);
				
				if(array_key_exists('title' , $ytarr)){
					$title = $ytarr['title'];
					return JText::sprintf('MOD_NXYTBOX_VI_TITLE_IMG', $title, $cleanedID);

				}elseif(array_key_exists('error' , $ytarr)){
					$error = $ytarr['error'];
					return JText::sprintf('MOD_NXYTBOX_VI_CHECKID', $error, $cleanedID);

				}else{
					print_r($ytarr);
					return ;
				}
				
			}else{
				$returnval = newModule();
				return $returnval;
			}
		}
		function youtubePlaylist($id, $listtype, $formID){
			if (isset($formID)){
				$cleanedID = cleanUp($id);
				switch ($listtype){
					case 'playlist':
						$url = 'https://www.youtube.com/feeds/videos.xml?playlist_id='.$cleanedID;
						break;
					case 'user_uploads':
						$url = 'https://www.youtube.com/feeds/videos.xml?user='.$cleanedID;
						break;
					case 'search':
						return JTEXT::_("MOD_NXYTBOX_VI_INFO_QUERY");
						break;
					default:
						return JTEXT::_("MOD_NXYTBOX_VI_INFO_NOT_FOUND");
				}

				try{	
					if(!$xml = simplexml_load_file($url)){                        				
						throw new Exception(JTEXT::sprintf("MOD_NXYTBOX_VI_NOTFOUND", $cleanedID));	
					}
				}
				catch (Exception $e){
					return $e->getMessage();
				}
				$title = $xml->title->__toString();

				switch ($listtype){
					case 'playlist':
						$thumbnailURL = playListXMLInfo($xml);
						return JText::sprintf("MOD_NXYTBOX_VI_PLSUCCESS",$title,$thumbnailURL);
						break;
					case 'user_uploads':
						$thumbnailURL = playListXMLInfo($xml);
						return JText::sprintf("MOD_NXYTBOX_VI_USERSUCCESS",$title,$thumbnailURL);
						break;
				}
			}else{
				$returnval = newModule();
				return $returnval;
			}
		}
		// Switch for Single Video or Playlist
		switch($type){
			case 0:
				return youtubeVideo($id, $formData['id']);
				break;
			case 1:
				return youtubePlaylist($id, $listtype, $formData['id']);
				break;
		}
	}
}

?>
