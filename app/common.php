<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function p($arr){
	echo '<pre>'.print_r($arr,true).'</pre>';
}
function myupload($name,$ext=array('jpg','png','gif','jpeg')){
	//$request = new think\Request;
	$file = request()->file($name);
	if(!is_null($file)){	
		$path = ROOT_PATH.'public'.DS.'uploads';
		//dump($file);die;
		$info = $file ->validate(['ext'=>$ext])->move($path);
		if($info){
			return '/uploads/'.$info->getSaveName();
		}else{
			//echo '<script>alert('.$file->getError().');</script>';
			return false;
		}
	}else{
		//echo 123;die;
		return '';
	}
}
function mydelFile($file){
	@unlink('.'.$file);
}
