<?php
/*------------------------------------------------------------------------
# mod_ju_logoshowcase Extension
# ------------------------------------------------------------------------
# author    joomla2you
# copyright Copyright (C) 2018 joomla2you.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomla2you.com
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;

$app = JFactory::getApplication();

require JModuleHelper::getLayoutPath('mod_ju_logoshowcase', $params->get('layout', 'default'));
