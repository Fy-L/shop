<?php
namespace app\admin\controller;
use think\Session;
class Base extends \think\Controller
{
	public function _initialize(){
		// session_start();
		$this->checkLogin();
	}

	public function checkLogin(){
		//通过session会话验证
		
		if (!Session::get('admin')) {
			//没有登陆
			$this->redirect('Login/login');
		}
	}
}
