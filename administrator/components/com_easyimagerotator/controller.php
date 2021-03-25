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
 
// import Joomla controller library
jimport('joomla.application.component.controller');
 
/**
 * EasyRotateImage Component Controller
 */
class EasyImageRotatorCPController extends JControllerLegacy
{
	private $document = null;
	
	function __construct() 
	{
		if(JRequest::getCmd('task') == '') {
			JRequest::setVar('task', 'display');
		}
		$this->item_type = 'Default';
		$this->document = JFactory::getDocument();
		parent::__construct();
	}
	
	public function display($cachable = false, $urlparams = false)
	{
		//$document = JFactory::getDocument();
		$vType	  = $this->document->getType();
		$view     = $this->getView('default', $vType);
		
		$model    = $this->getModel('default');
		$view->setModel($model, true);
		$view->setLayout('default');
		$view->display();
	}
	
	public function help()
	{
		//$document = JFactory::getDocument();
		$vType	  = $this->document->getType();
		$view     = $this->getView('help', $vType);
		
		$model    = $this->getModel('help');
		$view->setModel($model, true);

		$view->setLayout('default');
		$view->display();
	}
	
	//Special call without normal controler functionality
	public function savedefault()
	{
		if(JRequest::checkToken( 'get' )) {
			JRequest::checkToken( 'get' ) or die( 'Invalid Token' );
		} else {
			JRequest::checkToken() or die( 'Invalid Token' );
		}
		
		$model = &$this->getModel('default');
	  $model->save();
	}
	
	//Special call without normal controler functionality
	public function applydefault()
	{
		if(JRequest::checkToken( 'get' )) {
			JRequest::checkToken( 'get' ) or die( 'Invalid Token' );
		} else {
			JRequest::checkToken() or die( 'Invalid Token' );
		}
		
		$model = &$this->getModel('default');
		$model->save();
	}
}
?>