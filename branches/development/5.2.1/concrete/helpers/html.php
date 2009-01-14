<?
/**
 * @package Helpers
 * @category Concrete
 * @author Andrew Embler <andrew@concrete5.org>
 * @copyright  Copyright (c) 2003-2008 Concrete5. (http://www.concrete5.org)
 * @license    http://www.concrete5.org/license/     MIT License
 */

/**
 * Functions to help with using HTML. Does not include form elements - those have their own helper. 
 * @package Helpers
 * @category Concrete
 * @author Andrew Embler <andrew@concrete5.org>
 * @copyright  Copyright (c) 2003-2008 Concrete5. (http://www.concrete5.org)
 * @license    http://www.concrete5.org/license/     MIT License
 */

defined('C5_EXECUTE') or die(_("Access Denied."));
class HtmlHelper {

	/** 
	 * Includes a CSS file. This function looks in several places. First it checks the currently active theme, then if a package is specified it checks there. Otherwise if nothing is found it
	 * fires off a request to the relative directory CSS directory. If nothing is there, then it checks to the assets directories
	 * @param $file
	 * @return $str
	 */
	public function css($file, $pkgHandle = null) {
		$v = View::getInstance();
		// checking the theme directory for it. It's just in the root.
		if (file_exists($v->getThemeDirectory() . '/' . $file)) {
			$str = '<style type="text/css">@import "' . $v->getThemePath() . '/' . $file . '";</style>';
		} else if ($pkgHandle != null) {
			if (file_exists(DIR_BASE . '/' . DIRNAME_PACKAGES . '/' . $pkgHandle . '/' . DIRNAME_CSS . '/' . $file)) {
				$str = '<style type="text/css">@import "' . DIR_REL . '/' . DIRNAME_PACKAGES . '/' . $pkgHandle . '/' . DIRNAME_CSS . '/' . $file . '";</style>';
			} else if (file_exists(DIR_BASE_CORE . '/' . DIRNAME_PACKAGES . '/' . $pkgHandle . '/' . DIRNAME_CSS . '/' . $file)) {
				$str = '<style type="text/css">@import "' . ASSETS_URL . '/' . DIRNAME_PACKAGES . '/' . $pkgHandle . '/' . DIRNAME_CSS . '/' . $file . '";</style>';
			}
		}
			
		if (!isset($str)) {
			if (file_exists(DIR_BASE . '/' . DIRNAME_CSS . '/' . $file)) {
				$str = '<style type="text/css">@import "' . DIR_REL . '/' . DIRNAME_CSS . '/' . $file . '";</style>';
			} else {
				$str = '<style type="text/css">@import "' . ASSETS_URL_CSS . '/' . $file . '";</style>';
			}
		}
		return $str;
	}
	
	/** 
	 * Includes a JavaScript file. This function looks in several places. If a package is specified it checks there. Otherwise if nothing is found it
	 * fires off a request to the relative directory JavaScript directory.
	 * @param $file
	 * @return $str
	 */
	public function javascript($file, $pkgHandle = null) {
		if ($pkgHandle != null) {
			if (file_exists(DIR_BASE . '/' . DIRNAME_PACKAGES . '/' . $pkgHandle . '/' . DIRNAME_JAVASCRIPT . '/' . $file)) {
				$str = '<script type="text/javascript" src="' . DIR_REL . '/' . DIRNAME_PACKAGES . '/' . $pkgHandle . '/' . DIRNAME_JAVASCRIPT . '/' . $file . '"></script>';
			} else if (file_exists(DIR_BASE_CORE . '/' . DIRNAME_PACKAGES . '/' . $pkgHandle . '/' . DIRNAME_JAVASCRIPT . '/' . $file)) {
				$str = '<script type="text/javascript" src="' . ASSETS_URL . '/' . DIRNAME_PACKAGES . '/' . $pkgHandle . '/' . DIRNAME_JAVASCRIPT . '/' . $file . '"></script>';
			}
		}
			
		if (!isset($str)) {
			if (file_exists(DIR_BASE . '/' . DIRNAME_JAVASCRIPT . '/' . $file)) {
				$str = '<script type="text/javascript" src="' . DIR_REL . '/' . DIRNAME_JAVASCRIPT . '/' . $file . '"></script>';
			} else {
				$str = '<script type="text/javascript" src="' . ASSETS_URL_JAVASCRIPT . '/' . $file . '"></script>';
			}
		}
		return $str;
	}
	
	
	/** 
	 * Includes an image file when given a src, width and height. Optional attribs array specifies style, other properties.
	 * @todo Make this use getimagesize to generate ?
	 * @param string $src
	 * @param int $width
	 * @param int $height
	 * @param array $attribs
	 * @return string $html
	 */
	public function image($src, $width, $height, $attribs = null) {
		$attribsStr = '';
		if (is_array($attribs)) {
			foreach($attribs as $key => $at) {
				$attribsStr .= " {$key}=\"{$at}\" ";
			}
		}
		$str = '<img src="' . $src . '" width="' . $width . '" border="0" height="' . $height . '" ' . $attribsStr . ' />';
		return $str;
	}	
	
	
}

?>