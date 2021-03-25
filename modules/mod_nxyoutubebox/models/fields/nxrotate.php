<?php
/**
 * Rotation Formfield for nx-YouTubeBox 
 * @package     nx-YouTubeBox - Form
 *
 * @copyright   Copyright (C) 2009 - 2017 nx-designs.
 * @license     GNU General Public License version 2 or later
*/

defined('JPATH_PLATFORM') or die;

JFormHelper::loadFieldClass('number');

?>
<style>
    #actualRotation {
        margin: 0 15px;
        padding: 2px 10px;
    }
    .nx-strong {
        font-weight: bold;
    }
</style>
<script>
    
function setSlider(value){
    
    var val = value - 90;
    
    jQuery('#actualRotation').html('<i class=""></i> '+val+" deg");
    if(val<0){
        jQuery('#actualRotation').html('<i class="icon-undo-2"></i> '+val+" deg");
    }else if(val>0){
        jQuery('#actualRotation').html('<i class="icon-redo-2"></i> '+val+" deg");
    }else {
        jQuery('#actualRotation').html('<i class="icon-square"></i> '+val+" deg");
    }
    jQuery('#actualRotation').fadeIn('slow');
}
    
jQuery(document).ready(function(){
    jQuery('#actualRotation').hide();
    var val = jQuery('input[id="Rotateslider"]').val();
    setSlider(val);
});
</script>
<?php
class JFormFieldnxRotate extends JFormFieldNumber
{

	protected $type = 'nxRotate';


	protected function getInput()
	{
		// Initialize some field attributes.
		$max      = !empty($this->max) ? ' max="' . $this->max . '"' : '';
		$min      = !empty($this->min) ? ' min="' . $this->min . '"' : '';
		$step     = !empty($this->step) ? ' step="' . $this->step . '"' : '';
		$class    = !empty($this->class) ? ' class="' . $this->class . '"' : '';
		$readonly = $this->readonly ? ' readonly' : '';
		$disabled = $this->disabled ? ' disabled' : '';

		$autofocus = $this->autofocus ? ' autofocus' : '';

		$value = (float) $this->value;
		$value = empty($value) ? $this->min : $value;
		

		// Initialize JavaScript field attributes.
		$onchange = !empty($this->onchange) ? ' onchange="' . $this->onchange . '"' : '';

		// Including fallback code for HTML5 non supported browsers.
		JHtml::_('jquery.framework');
		JHtml::_('script', 'system/html5fallback.js', false, true);

		return '<input id="Rotateslider" type="range" name="' . $this->name . '" id="' . $this->id . '"' . ' value="'
			. htmlspecialchars($value, ENT_COMPAT, 'UTF-8') . '"' . $class . $disabled . $readonly
			. $onchange . $min . $step . $max . $autofocus . ' onchange="setSlider(this.value);" /><span class="alert nx-strong" id="actualRotation"></span>';
	}
}
