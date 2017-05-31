<?php
namespace app\index\controller;

class Index extends \think\Controller
{
    public function index()
    {
	p();
        return $this->fetch('Index/index');
    }
}
