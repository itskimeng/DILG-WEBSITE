<?php
/**
* @title		video gallery display beautiful
* @website		http://www.joomhome.com
* @copyright	Copyright (C) 2015 joomhome.com. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/
	
    // no direct access
    defined('_JEXEC') or die('Restricted access');  
	
    class jhmCtextHelper
    {

        public $name = 'Text';
        public $uniqid   = 'ctext';
        public $fieldname;
        public $params;
        public function setOptions()
        {
            $html = array();

            $html[] = array(
                'title'=>'Title <span style="display: initial;color:red;">(* Required field)</span>',
                'tip'=>'Slide title',
                'tipdesc'=>'Set slide title text',
                'class'=>$this->uniqid.'-slider-title-li',
                'attrs'=>'',
                'fieldname'=>'title',
                'html'=>'<input ref="title" type="text"  value="'.$this->params['title'].'"   
                name="jform[params]['.$this->fieldname.']['.$this->uniqid.'][title][]">'
            );

            $html[] = array(
                'title'=>'Link Youtube/Vimeo',
                'tip'=>'Custom link',
                'tipdesc'=>'Custom link url',
                'class'=>$this->uniqid.'-slider-link-li',
                'attrs'=>'',
                'fieldname'=>'link',
                'html'=>'<input type="text"  value="'.$this->params['link'].'"   
                name="jform[params]['.$this->fieldname.']['.$this->uniqid.'][link][]">'
            );

            $html[] = array(
                'title'=>'State',
                'tip'=>'Set State',
                'tipdesc'=>'Published or unpublished slide item',
                'class'=>''.$this->uniqid.'-slider-item-li',
                'attrs'=>'',
                'fieldname'=>'text',
                'html'=>'
                <select class="jhm-state" name="jform[params]['.$this->fieldname.']['.$this->uniqid.'][state][]">
                <option value="published" '.(($this->params['state']=='published')?'selected':'').' >Published</option>
                <option value="unpublished"  '.(($this->params['state']=='unpublished')?'selected':'').'>UnPublished</option>
                </select>'
            );

            return $html;
        }


        public function styleSheet()
        {

            return '';

        }


        public function JavaScript()
        {

            return '';

        }


        public function display($helper)
        {
            return $this->params;
        }
}