<?php
namespace app\admin\controller;
use think\Request;
use think\Db;

class Category extends Base
{
	public function index(){
		$list = Db::table('shop_category')->select();
		$list = $this->getlist($list);
		$this->assign('list',$list);
		return $this->fetch('Category/index');
	}
	public function add(){
		$request = Request::instance();
		if($request->isPost()){
			$data = $request->post();
			$re = Db::table('shop_category')->insert($data);
			if($re){
				$this->success('添加成功','Category/index');
			}else{
				$this->error('添加失败');
			}
		}
		$list = Db::table('shop_category')->select();
		$list = $this->getlist($list);		
		$this->assign('list',$list);
		//dump($list);
		return $this->fetch('Category/add');
	}
	public function edit(){
		$request = Request::instance();
		if($request->isPost()){
			$data = array(
				'cat_id'=>$request->post('cat_id'),
				'cat_name'=>$request->post('cat_name'),
				'parent_id'=>$request->post('parent_id'),
				'cat_desc'=>$request->post('cat_desc'),
				'sort_order'=>$request->post('sort_order'),
				'unit'=>$request->post('unit'),
				'is_show'=>$request->post('is_show'),
			);
			$re = Db::table('shop_category')->update($data);
			if(false!==$re){
				$this->success('修改成功','Category/index');
			}else{
				$this->error('修改失败');
			}
		}
		$id = input('id');
		$find = Db::table('shop_category')->where('cat_id',$id)->find();
		//dump($find);
		if(!$find){
			$this->error('暂无数据','Category/index');	
		}
		$list = Db::table('shop_category')->select();
		$list = $this->getlist($list);
		//dump($list);
		$this->assign('list',$list);
		$this->assign('det',$find);
		return $this->fetch('Category/edit');
	}
	public function getTree($arr,$pid=0){
		$tree = array();
		foreach($arr as $v){
			if($v['parent_id']==$pid){
				$v['child']=self::getTree($arr,$v['cat_id']);
				$tree[]=$v;
			}
		}
		return $tree;
	}
	public static function getlist($arr , $pid =0,$lv=0 ){
		static $list = array();
		foreach($arr as $v){
			if($v['parent_id']==$pid){
				$v['lv']=$lv;
				$list[]=$v;
				self::getlist($arr,$v['cat_id'],$lv+1);
			}
		}
		return $list;
	}
	public function delete(){
		$id = input('id');
		$find = Db::table('shop_category')->where('cat_id',$id)->find();
		if($find){
			$child = Db::table('shop_category')->where('parent_id',$id)->find();
			if(!$child){
				$re = Db::table('shop_category')->where('cat_id',$id)->delete();
				if($re){
					$this->success('删除成功');
				}else{
					$this->error('删除失败');
				}
			}else{
				$this->error('当前分类下存在子类，删除失败');
			}
		}else{
			$this->error('删除失败');
		}		
	}




}
