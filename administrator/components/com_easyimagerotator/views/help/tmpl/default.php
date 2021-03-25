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
// load tooltip behavior
JHtml::_('behavior.tooltip');

?>
<div>
	<img src="/administrator/components/com_easyimagerotator/assets/icons/logo-128.png" style="float:left;margin-right:10px;">
	
	<div style="width:600px;float:right;margin-left:10px;border:1px solid #cccccc;background:#ffffff;padding:10px">
		<h3><a href="http://blog.blums.eu/joomla-extensions/easy-image-rotator" target="_blank"><?php echo JText::_('COM_EASYIMAGEROTATOR_HELP_TITLE'); ?> </a></h3>
		<p><?php echo JText::_('COM_EASYIMAGEROTATOR_HELP_DESC'); ?></p>
		<p>
			<strong><?php echo JText::_('COM_EASYIMAGEROTATOR_HELP_INSTRUCTIONS'); ?></strong>
			<ul>
				<li><?php echo JText::_('COM_EASYIMAGEROTATOR_HELP_IMAGEROOT'); ?></li>
				<li><?php echo JText::_('COM_EASYIMAGEROTATOR_HELP_USE_FALLBACK'); ?></li>
				<li><?php echo JText::_('COM_EASYIMAGEROTATOR_HELP_SPECIFICIMAGEORPATH'); ?></li>
				<li><?php echo JText::_('COM_EASYIMAGEROTATOR_HELP_NOIMAGE'); ?></li>
				<li><?php echo JText::_('COM_EASYIMAGEROTATOR_HELP_JS_SLIDER_ENABLE'); ?></li>
				<li><?php echo JText::_('COM_EASYIMAGEROTATOR_HELP_JS_SLIDER_TEXT'); ?></li>
			</ul>
		</p>
	</div>
	
	<br/>
	<p>
		<a href="http://blog.blums.eu/joomla-extensions/easy-image-rotator#docs" target="_blank"><?php echo($lang->_('COM_EASYIMAGEROTATOR_HELP_LINKS_DOCUMENTATION')); ?></a> |
		<a href="http://blog.blums.eu/joomla-extensions/easy-image-rotator#support" target="_blank"><?php echo($lang->_('COM_EASYIMAGEROTATOR_HELP_LINKS_SUPPORT')); ?></a> |
		<a href="http://blog.blums.eu/joomla-extensions/easy-image-rotator#download" target="_blank"><?php echo($lang->_('COM_EASYIMAGEROTATOR_HELP_LINKS_DOWNLOADLATEST')); ?></a> 
	</p>
	<p><?php echo JText::_('COM_EASYIMAGEROTATOR_HELP_LICENSE'); ?></p>
	<p>
		<?php echo JText::_('COM_EASYIMAGEROTATOR_HELP_DONATE'); ?>
		<form action="https://www.paypal.com/cgi-bin/webscr" target="_blank" method="post">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="GA6ERY3HDRKNE">
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
		</form>
	</p>
</div>