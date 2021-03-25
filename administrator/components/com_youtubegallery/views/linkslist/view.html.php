<?php
/**
 * YoutubeGallery Joomla! Native Component
 * @author Ivan Komlev <support@joomlaboat.com>
 * @link http://www.joomlaboat.com
 * @GNU General Public License
 **/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * YoutubeGallery LinksList View
 */
class YoutubeGalleryViewLinksList extends JViewLegacy
{
        /**
         * YoutubeGallery view display method
         * @return void
         */
        function display($tpl = null)
        {
                // Get data from the model
                $items = $this->get('Items');
                $pagination = $this->get('Pagination');

                // Check for errors.
                if (count($errors = $this->get('Errors')))
                {
                        JFactory::getApplication()->enqueueMessage( implode('<br />', $errors), 'error');
                        return false;
                }
                // Assign data to the view
                $this->items = $items;
                $this->pagination = $pagination;

                // Set the toolbar
				$this->canDo = YoutubeGalleryHelper::getActions('linkslist');
				
				$this->canCreate = $this->canDo->get('linkslist.create');
				$this->canDelete = $this->canDo->get('linkslist.delete');
				$this->canEdit = $this->canDo->get('linkslist.edit');
				$this->canUpdate = $this->canDo->get('linkslist.update');
				
                $this->addToolBar();

                $context= 'com_youtubegallery.linkslist.';
                $mainframe = JFactory::getApplication();
                $search			= $mainframe->getUserStateFromRequest($context."search",'search','',	'string' );
                $search			= JString::strtolower( $search );

                $lists['search']=$search;

                $filter_category= $mainframe->getUserStateFromRequest($context."filter_category",'filter_category','',	'integer' );

                $available_categories=$this->getAllCategories();
                $javascript = 'onchange="document.adminForm.submit();"';
                $lists['categories']=JHTML::_('select.genericlist', $available_categories, 'filter_category', $javascript ,'id','categoryname', $filter_category);

                $this->assignRef('lists', $lists);

                // Display the template
                parent::display($tpl);
        }

        /**
         * Setting the toolbar
        */
        protected function addToolBar()
        {
            JToolBarHelper::title(JText::_('COM_YOUTUBEGALLERY_LINKSLIST'));

			if ($this->canCreate)
                JToolBarHelper::addNew('linksform.add');
            
			if($this->canEdit)
				JToolBarHelper::editList('linksform.edit');
			
			if ($this->canCreate)
				JToolBarHelper::custom( 'linkslist.copyItem', 'copy.png', 'copy_f2.png', 'Copy', true);
		
			if($this->canUpdate)
			{
				JToolBarHelper::custom( 'linkslist.updateItem', 'refresh.png', 'refresh_f2.png', 'Update', true);
				JToolBarHelper::custom( 'linkslist.refreshItem', 'refresh.png', 'refresh_f2.png', 'Refresh', true);
			}
			
			if($this->canDelete)			
                JToolBarHelper::deleteList('', 'linkslist.delete');

        }

       	function getAllCategories()
        {
        	$db = JFactory::getDBO();

        	$query = "SELECT id, categoryname FROM #__youtubegallery_categories ORDER BY categoryname";
        	$db->setQuery( $query );
        	$available_categories = $db->loadObjectList();
        	$this->array_insert($available_categories ,array("id" => 0, "categoryname" => JText::_( 'COM_YOUTUBEGALLERY_SELECT_CATEGORY' )),0);
        	return $available_categories;
        }

        function array_insert(&$array, $insert, $position = -1)
        {
                $position = ($position == -1) ? (count($array)) : $position ;
                if($position != (count($array))) {
                $ta = $array;
                for($i = $position; $i < (count($array)); $i++)
                {
                        if(!isset($array[$i])) {
                                 die("\r\nInvalid array: All keys must be numerical and in sequence.");
                        }
                        $tmp[$i+1] = $array[$i];
                        unset($ta[$i]);
                }
                $ta[$position] = $insert;
                $array = $ta + $tmp;

                } else {
                     $array[$position] = $insert;
                }
                ksort($array);
                return true;
        }
}//class
