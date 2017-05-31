<?php
namespace app\index\controller;

class Index extends \think\Controller
{
    public function index()
    {	
	//p([1,2,3]);
        return $this->fetch('Index/index');
    }
}
