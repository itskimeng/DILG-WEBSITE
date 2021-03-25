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

<script type="text/javaScript">
	 if (typeof jQuery == 'undefined'){
		document.write(unescape('%3Cscript src="<?php echo JURI::Base();?>components/com_easyimagerotator/assets/js/jquery-min.js" %3E%3C/script%3E'));
	}
</script>


<style type="text/css">
	div.easyimagerotatorArea {
		margin-bottom:18px;
	}
	
	div.easyimagerotatorArea div.easyimagerotatorTitle {
		font-weight:bold;
	}
	
	div.collapsibleContent, div.collapsibleContentTitle { 
		max-width:580px;
	}
	
	div.easyimagerotatorContent div {
	}
	
	div.easyimagerotatorContent div label {
		display:block;
		float:left;
		min-width:180px;
	}
	
	div.easyimagerotatorContent div textarea {
		min-width:385px;
		max-width:560px;
	}
	
	div.collapsibleContentTitle {
			font-size:120%;
			font-weight:bold;
			text-transform:uppercase;
			background-color:#D3D3D3;
			margin:0 0 5px 0;
	}
	
	div.collapsibleContentTitle a:hover {
		background-color:#EEEEEE;
		text-decoration:none;
	}
	
	div.collapsibleContentTitle a {
		display:block;
		line-height:24px;
		padding:10px 10px 10px 10px;
		cursor:pointer;
	}
	
	.icon {
		width:20px;
		height:20px;
		display:block;
		margin:12px 4px 0 4px;
		float:left;
		cursor:pointer;
	}
	
	.icon.arrowDown {
		background: url(<?php echo JURI::Base().'components/com_easyimagerotator/assets/icons/'; ?>arrow-down.png) no-repeat;
	}
	
	.icon.arrowUp {
		background: url(<?php echo JURI::Base().'components/com_easyimagerotator/assets/icons/'; ?>arrow-up.png) no-repeat;
	}
</style>

<h1><?php echo $this->msg; ?></h1>


<form id="adminForm" name="adminForm" method="POST" action="<?php echo JRoute::_('index.php?option=com_easyimagerotator'); ?>">
	<div style="float:right;width:250px;border:1px solid #cccccc;background:#ffffff;padding:10px">
		<p><?php echo JText::_('COM_EASYIMAGEROTATOR_DEFAULT_INSTRUCTIONS'); ?> </p>
		<p><?php echo JText::_('COM_EASYIMAGEROTATOR_DEFAULT_INSTRUCTIONS_FALLBACK'); ?> </p>
	</div>
	
	<div class="collapsibleContentTitle"><span class="icon arrowUp">&nbsp;</span><a>default - fallback</a></div>
	<div class="collapsibleContent">
		<!-- default fallback start -->
		<div class="easyimagerotatorArea">
			<div class="easyimagerotatorTitle"><?php echo JText::_('COM_EASYIMAGEROTATOR_DEFAULT_MENUITEM') ?> - Default - Fallback (ID:0)</div>
			<div class="easyimagerotatorContent">
				<div>
					<label><?php echo JText::_('COM_EASYIMAGEROTATOR_DEFAULT_IMAGEURL') ?></label>
					<input type="text" name="menu_url_<?php echo $this->defaultItem->id;?>" size="75" value="<?php echo ($this->defaultItem->img!='') ? $this->defaultItem->img : ''; ?>" />
				</div>
				
				<div>
					<label><?php echo JText::_('COM_EASYIMAGEROTATOR_DEFAULT_IMAGETITLE') ?></label>
					<input type="text" name="menu_title_<?php echo $this->defaultItem->id;?>" size="60" value="<?php echo ($this->defaultItem->img_title!='') ? $this->defaultItem->img_title : ''; ?>" />
				</div>
				
				<div>
					<textarea rows="4" cols="120" name="menu_textlayer_<?php echo $this->defaultItem->id;?>"><?php echo ($this->defaultItem->img_textlayer!='') ? $this->defaultItem->img_textlayer : ''; ?></textarea>
				</div>
				<input type="hidden" name="menu_id[]" value="<?php echo $this->defaultItem->id;?>" />
			</div>
		</div>
		<!-- default fallback end -->
	</div>
	<?php 
	foreach($this->menuItems as $itemKey => $arrValues) {
		$arrTmp = $this->getModel()->getMenuItemByID($arrValues, 0);
		$isDefaultMenuItem = (is_array($arrTmp)) ? true : false;
		if(!$isDefaultMenuItem) {
	?>
		<div class="collapsibleContentTitle"><span class="icon arrowUp">&nbsp;</span><a><?php echo $itemKey.' ('.count($arrValues).' elements)' ; ?></a></div>
		<div class="collapsibleContent">
			<?php foreach($arrValues as $menuItemKey => $arrMenuItem) {
				if ($arrMenuItem['parent_id'] > 0) { ?>
					<!-- regular item start -->
					<div class="easyimagerotatorArea">
						<div class="easyimagerotatorTitle"><?php echo JText::_('COM_EASYIMAGEROTATOR_DEFAULT_MENUITEM') ?> - <?php echo $arrMenuItem['title'];?> (ID:<?php echo $arrMenuItem['id'];?>)</div>
						<div class="easyimagerotatorContent">
							<div>
								<label><?php echo JText::_('COM_EASYIMAGEROTATOR_DEFAULT_IMAGEURL') ?></label>
								<input type="text" name="menu_url_<?php echo $arrMenuItem['id'];?>" size="75" value="<?php echo ($arrMenuItem['img']!='') ? $arrMenuItem['img'] : ''; ?>" />
							</div>
							
							<div>
								<label><?php echo JText::_('COM_EASYIMAGEROTATOR_DEFAULT_IMAGETITLE') ?></label>
								<input type="text" name="menu_title_<?php echo $arrMenuItem['id'];?>" size="60" value="<?php echo ($arrMenuItem['img_title']!='') ? $arrMenuItem['img_title'] : ''; ?>" />
							</div>
							
							<div>
								<textarea rows="4" cols="120" name="menu_textlayer_<?php echo $arrMenuItem['id'];?>"><?php echo ($arrMenuItem['img_textlayer']!='') ? $arrMenuItem['img_textlayer'] : ''; ?></textarea>
							</div>
							<input type="hidden" name="menu_id[]" value="<?php echo $arrMenuItem['id'];?>" />
						</div>
					</div>
					<!-- regular item end -->
				<?php } ?>
			<?php } ?>
			
		</div>
	<?php
		} //if
	} //foreach
	?>
	
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<?php echo JHtml::_('form.token'); ?>
	</form>
	
	<script type="text/javaScript">
			jQuery(document).ready(function() {
			jQuery( ".collapsibleContentTitle" ).click(function() {
					jQuery(this).next().toggle("slow");
					jQuery(this).find('.icon').toggleClass("arrowUp arrowDown");
			});
		});
	</script>