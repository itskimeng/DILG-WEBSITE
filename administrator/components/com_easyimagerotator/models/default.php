<?php
/**
* @package EasyImageRotator
* @Copyright (C) 2011-2013 Elite-Tec. All rights reserved.
* @license Distributed under the terms of the GNU General Public License GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html
* @author Daniel Blum (info@blums.eu)
* @website Visit http://blog.blums.eu for updates and information.
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Import Joomla! libraries
jimport('joomla.application.component.model');

class EasyImageRotatorCpModelDefault extends JModelLegacy {

	private $defaultItemTemplate = array('id' => 0, 'parent_id' => 0, 'title' => '', 'img' => '', 'img_textlayer' => '', 'img_title' => '');
	
	function __construct() {
		parent::__construct();
	}

	public function getMenuList()
	{
		
		/// get menus (properly- ie with indents for submenus!) /// adapted from libraries/joomla/html/html/menu.php
		// get a list of the menu items
		// Create a new query object.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true)
			->select('m.id, m.parent_id, m.title, m.menutype')
			->from('#__menu AS m')
			->where('m.published = 1')
			->order('m.menutype, m.parent_id');
			
		$db->setQuery($query);
		$menuResults = $db->loadObjectList();
		
		//Prepare Items
		$arrMenuTree = array();
		$intCurrentParentId = 0;
		$strCurrentMenuType = '';
		foreach($menuResults as $item)
		{
			$strCurrentMenuType = $item->menutype;
			if(!empty($strCurrentMenuType))
			{
				if(!is_array($arrMenuTree[$strCurrentMenuType]))
				{
					$arrMenuTree[$strCurrentMenuType] = array();
				}
				$arrMenuTree[$strCurrentMenuType][] = array('id' => (int)$item->id
																									, 'parent_id' => (int)$item->parent_id
																									, 'title' => $item->title
																									, 'img' => ''
																									, 'img_textlayer' => ''
																									, 'img_title' => '');
			}
		}
		
		//Add default fallback entry to list
		$arrMenuTree['default'][] = array('id' => 0
																		, 'parent_id' => 0
																		, 'title' => 'Default fallback'
																		, 'img' => ''
																		, 'img_textlayer' => ''
																		, 'img_title' => '');
		
		//$menuItems[] = (object) array('value' => 0, 'text' => 'fallback');

		// now get specified entries from component database!
		$db = JFactory::getDBO();
		$query = "SELECT item_id, img_url, img_textlayer, img_title FROM #__easyimagerotator";
		$db->setQuery($query);
		$tmpResults = $db->loadObjectList();
		
		//Merge array objects (2 Levels)
		foreach($arrMenuTree as $treeIndex => $arrTreeItems)
		{
			foreach($arrTreeItems as $itemIndex => $arrMenuItem)
			{
				//optimize later..
				foreach($tmpResults as $tmpItem)
				{
					if($arrMenuTree[$treeIndex][$itemIndex]['id'] == $tmpItem->item_id)
					{
						$arrMenuTree[$treeIndex][$itemIndex]['img'] = $tmpItem->img_url;
						$arrMenuTree[$treeIndex][$itemIndex]['img_textlayer'] = $tmpItem->img_textlayer;
						$arrMenuTree[$treeIndex][$itemIndex]['img_title'] = $tmpItem->img_title;
						break;
					}
				}
			}
		}
		
		return $arrMenuTree;
	} //getMenuList
	
	public function getDefaultMenuItem($arrMenuTree)
	{
		$defaultItem = $this->defailtItemTemplate;
		$hasBeenFound = false;
		foreach($arrMenuTree as $arrTreeItems)
		{
			foreach($arrTreeItems as $arrMenuItem)
			{
				if($arrMenuItem['id'] == 0) 
				{
					$defaultItem = $arrMenuItem;
					$hasBeenFound = true;
					break;
				}
			}
			
			if($hasBeenFound)
				break;
			
		}
		return (object)$defaultItem;
	}
	
	//Returns the Array of the menu item with the relevant ID
	public function getMenuItemByID($arrValues, $intID)
	{
		foreach($arrValues as $menuItemKey => $arrMenuItem) {
			if($arrMenuItem['id'] == $intID)
			{
				return $arrMenuItem;
			}
		}
		return null;
	}
	
	
	public function save()
	{
		$mainframe = JFactory::getApplication();
		$task = JRequest::getCmd('task');
	 
	  // insert new rows
		$postedData = JRequest::get('post', JREQUEST_ALLOWRAW);
		
		if(is_array($postedData['menu_id'])) {
			$db = &JFactory::getDBO();
			// delete all rows
			$query = 'DELETE FROM #__easyimagerotator';
			$db->setQuery($query);
			$db->query();
			
			//$query_msg = '';
			foreach($postedData['menu_id'] as $menuId) {
				if($menuId != '' && is_numeric($menuId ))
				{
					$menu_url = $db->quote($postedData['menu_url_'.$menuId]);
					$menu_textlayer = $db->quote($postedData['menu_textlayer_'.$menuId]);
					$menu_title = $db->quote($postedData['menu_title_'.$menuId]);
					$query = "INSERT INTO #__easyimagerotator (item_id, img_url, img_textlayer, img_title) VALUES (".$menuId.", ".$menu_url.", ".$menu_textlayer.", ".$menu_title.");";
					//$query_msg .= "<br>".$query;
					$db->setQuery($query);
					$db->query();
				}
			}
		}
		
		switch ($task)
		{
			case 'savedefault':
				$link = 'index.php';
				break;
			case 'applydefault':
			default:
				$msg  = JText::_('COM_EASYIMAGEROTATOR_SYSTEM_DATASAVEDSUCCESSFULLY');
				$link = 'index.php?option=com_easyimagerotator';
				break;
		}
		// page redirect
		$mainframe->redirect($link, $msg);
	} //save
	
		// Displays a multi-dimensional array as a HTML unordered lists.
	function displayArrayAsTree($array, $isFirst=true) 
	{
		if($isFirst)
		{
			$output .= "Start Display as Tree<br>";
		}
		$newline = "<br>";
		foreach($array as $key => $value) 
		{    //cycle through each item in the array as key => value pairs
		   if (is_array($value) || is_object($value)) 
		   {        //if the VALUE is an array, then
		      //call it out as such, surround with brackets, and recursively call displayTree.
		       $value = "Array()" . $newline . "(<ul>" . $this->displayArrayAsTree($value, false) . "</ul>)" . $newline;
		   }
		  //if value isn't an array, it must be a string. output its' key and value.
		  $output .= "[$key] => " . $value . $newline;
		}
		return $output;
	}
}

?>
