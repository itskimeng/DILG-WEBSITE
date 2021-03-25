<?php
/**
* @package EasyImageRotator
* @Copyright (C) 2011-2013 Elite-Tec. All rights reserved.
* @license Distributed under the terms of the GNU General Public License GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html
* @author Daniel Blum (info@blums.eu)
* @website Visit http://blog.blums.eu for updates and information.
**/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the HelloWorld Component
 */
class EasyImageRotatorCpViewDefault extends JViewLegacy
{
	
	function display($tpl = null) 
	{
		$model = $this->getModel();
		$this->menuItems = $model->getMenuList();
		$this->defaultItem = $model->getDefaultMenuItem($this->menuItems);
		// Set the toolbar
		$this->addToolBar();
		
		parent::display($tpl);
	}
	
	/**
	* Setting the toolbar
	*/
	protected function addToolBar() 
	{
		require_once JPATH_COMPONENT.'/helpers/easyimagerotatorcp.php';
		$allowed= EasyImageRotatorCpHelper::getActions();
		if ($allowed->get('core.admin')) 
		{
			JToolBarHelper::preferences('com_easyimagerotator');
			JToolBarHelper::divider();
		}
		
		// If user can edit, can save the item.
		if ($allowed->get('core.edit')) 
		{
			JToolBarHelper::apply('applydefault');
			JToolBarHelper::save('savedefault');
		}
		
		JSubMenuHelper::addEntry(JText::_('COM_EASYIMAGEROTATOR_MENU_DASHBOARD'), 'index.php?option=com_easyimagerotator', true);
		JSubMenuHelper::addEntry(JText::_('COM_EASYIMAGEROTATOR_MENU_HELP'), 'index.php?option=com_easyimagerotator&task=help', false);
	}
}
?>