<?php
namespace app\admin\controller;
use think\Request;
use think\Session;
use think\Db;
class Login extends \think\Controller
{
	//显示登陆页面并验证
	public function login(Request $request){
		if($request->isPost()){
			//$re = input('post.username'),助手函数的用法
            		$user = $request->post('username');
	            	$pwd = $request->post('password');
			$find = Db::table('shop_admin')->where('admin_name',$user)->find();
			if($find['password'] == md5($pwd) && $find ){
			
           			// $code = $request->post('code');//验证码 			
				// echo $user.$pwd;
				Session::set('admin','11');
				$this->success('登陆成功','Index/index');
			}else{
				$this->error('用户名或密码错误');
			}
			
			
		}
		//载入登陆页面
		//echo Session::get('admin');
		return $this->fetch('Login/login');

	}
	public function logout(){
		Session::delete('admin');
		$this->redirect('Login/login');
	}
}
