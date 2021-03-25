/**
* @package EasyImageRotator
* @Copyright (C) 2011-2017 Daniel Blum. All rights reserved.
* @license Distributed under the terms of the GNU General Public License GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html
* @author Daniel Blum
* @website Visit http://codeninja.eu for updates and information.
**/

var mod_easyimagerotator_currentScriptPath = '';

function mod_easyimagerotator_getCurrentScriptPath() {
	if(mod_easyimagerotator_currentScriptPath.length < 1) {
		var scriptEls = document.getElementsByTagName( 'script' );
		var thisScriptEl = scriptEls[scriptEls.length - 1];
		var scriptPath = thisScriptEl.src;
		var scriptFolder = scriptPath.substr(0, scriptPath.lastIndexOf( '/' )+1 );
		mod_easyimagerotator_currentScriptPath = scriptFolder;
	}
	return mod_easyimagerotator_currentScriptPath;
}
