<?php

namespace App\View\Helper;

use Cake\View\Helper;

class FileSizeHelper extends Helper {
	
	function convertSize($size, $precision = 2){
		$units = array('B', 'KB', 'MB', 'GB', 'TB');
	
		$bytes = max($size, 0);
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024));
		$pow = min($pow, count($units) - 1);
	
		$bytes /= pow(1024, $pow);
	
		return round($bytes, $precision).' '.$units[$pow];
	}
}