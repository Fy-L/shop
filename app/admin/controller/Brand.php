<?php
namespace app\admin\controller;
use think\Request;
use think\Db;

class Brand extends Base
{
	public function index(){
		//获取数据
		$list = Db::table('shop_brand')->select();
		//dump($list);
		$this->assign('list',$list);
		return $this->fetch('Brand/index');
	}
	public function add(){
		$request = Request::instance();
		if($request->isPost()){
			$data = $request->Post();
			//dump($data);
			$path =  myupload('logo');
			if($path){
				$data['logo']=$path;
			}
			//dump($path);die;
			$re = Db::table('shop_brand')->insert($data);
			if($re){
				$this->success('添加成功','Brand/index');
			}else{
				$this->error('添加失败');
			}
		}else{
			return $this->fetch('Brand/add');
		}
	}
	public function edit(){
		$request = Request::instance();
		if($request->isPost()){
			$data = array(
				'brand_id'=> $request->post('id'),
				'url'=>$request->post('url'),
				'brand_desc'=>$request->post('brand_desc'),
				'sort_order'=>$request->post('sort_order'),
				'is_show'=>$request->post('is_show'),
				'brand_name'=>$request->post('brand_name'),
				);
			$oldpic = $request->post('oldpic');
		 	$path =  myupload('logo');
			if($path){
				$data['logo']=$path;
			}
			//dump($path);die;		
			$re = Db::table('shop_brand')->update($data);
			if(false !== $re){
				$this->success('修改成功','Brand/index');
			}else{
				$this->error('修改失败');
			}
		}
		$id = input('id');
		//dump($id);		
		$find = Db::table('shop_brand')->where('brand_id',$id)->find();
		if(!$find){
			$this->error('没有数据','Brand/index');
		}
		$this->assign('det',$find);
		return $this->fetch('Brand/edit');
	}

	public function delete(){
		$id = input('id');
		$find = Db::table('shop_goods')->where('brand_id',$id)->find();
		if($find){
			$this->error('改品牌下有商品，删除失败');
		}else{
			$r = Db::table('shop_brand')->where('brand_id',$id)->find();
			if($r){
				$re = Db::table('shop_brand')->where('brand_id',$id)->delete();
				if($re){
					//@unlink('.'.$r['logo']);
					mydelFile($r['logo']);	
					$this->success('删除成功');
				}else{
					$this->error('删除失败'); 
				}
			}else{
				$this->error('删除失败');
			}
		}
	}




















}
