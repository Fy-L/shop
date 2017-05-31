<?php
namespace app\admin\controller;


class Index extends Base
{
	public function index(){
		$this->assign('name','123');		
		return $this->fetch('Index/index');
	}
	public function top(){
		return $this->fetch('Index/top');
	}
	public function main(){
		return $this->fetch('Index/main');
	}
	public function menu(){
		return $this->fetch('Index/menu');
	}
	public function drag(){
		return $this->fetch('Index/drag');
	}
}
