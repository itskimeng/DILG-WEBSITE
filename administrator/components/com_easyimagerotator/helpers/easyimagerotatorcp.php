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

class EasyImageRotatorCpHelper
{
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_easyimagerotator';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, $assetName));
		}

		return $result;
	}
}