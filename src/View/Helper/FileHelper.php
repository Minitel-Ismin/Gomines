<?php

namespace App\View\Helper;
use Cake\View\Helper;

class FileHelper extends Helper{
	public function makeIcon($filename) {
		$ext_excel = [ 
				'xls',
				'xlt',
				'xlm',
				'xlsx',
				'xlsm',
				'xltx',
				'xltm',
				'xlsb',
				'xla',
				'xlam',
				'xll',
				'xlw',
				'ods' 
		];
		$ext_pdf = [ 
				'pdf' 
		];
		$ext_word = [ 
				'docx',
				'doc',
				'dot',
				'docm',
				'dotx',
				'dotm',
				'docb',
				'odt' 
		];
		$ext_sound = [ 
				'mp3',
				'wav' 
		];
		$ext_archive = [ 
				'gz',
				'rar',
				'tar',
				'zip' 
		];
		$ext_image = [ 
				'png',
				'gif',
				'bmp',
				'jpeg',
				'jpg',
				'jpe' 
		];
		$ext_text = [ 
				'txt' 
		];
		$ext_video = [ 
				'mkv, avi' 
		];
		$ext_code = [ 
				'html',
				'XML',
				'h',
				'hpp',
				'cpp',
				'c',
				'vhd',
				'php',
				'js',
				'css',
				'ctp',
				'py' 
		];
		$ext_powerpoint = [ 
				'ppt',
				'pot',
				'pps',
				'pptx',
				'pptm',
				'potx',
				'potm',
				'ppam',
				'ppsx',
				'ppsm',
				'sldx',
				'sldm' 
		];
		
		$ext = strrchr ( $filename, '.' );
		$ext = substr ( $ext, 1 );
		
		if (in_array ( $ext, $ext_excel ))
			return [ 
					'type' => '-excel',
					'color' => '#208A45' 
			];
		if (in_array ( $ext, $ext_pdf ))
			return [ 
					'type' => '-pdf',
					'color' => '#CA1C00' 
			];
		if (in_array ( $ext, $ext_word ))
			return [ 
					'type' => '-word',
					'color' => '#395496' 
			];
		if (in_array ( $ext, $ext_sound ))
			return [ 
					'type' => '-sound',
					'color' => '#FF8040' 
			];
		if (in_array ( $ext, $ext_archive ))
			return [ 
					'type' => '-archive',
					'color' => '#A93B88' 
			];
		if (in_array ( $ext, $ext_image ))
			return [ 
					'type' => '-image',
					'color' => '#800000' 
			];
		if (in_array ( $ext, $ext_text ))
			return [ 
					'type' => '-text',
					'color' => '#0080FF' 
			];
		if (in_array ( $ext, $ext_video ))
			return [ 
					'type' => '-video',
					'color' => '#FF8000' 
			];
		if (in_array ( $ext, $ext_code ))
			return [ 
					'type' => '-code',
					'color' => '#8080FF' 
			];
		if (in_array ( $ext, $ext_powerpoint ))
			return [ 
					'type' => '-powerpoint',
					'color' => '#C14424' 
			];
		
		return [ 
				'type' => '',
				'color' => 'black' 
		];
	}
}