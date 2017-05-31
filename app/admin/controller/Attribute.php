<?php
namespace app\admin\controller;
use think\Request;
use think\Db;

class Attribute extends Base
{
	public function index(){
		$list = Db::table('shop_goods_type')->select();
		$this->assign('list',$list);
		$attr = Db::table('shop_attribute')->select();
		$this->assign('attr',$attr);
		return $this->fetch('Attribute/index');
	}

	public function add(){
		$request = Request::instance();
		if($request->isPost()){
			//$data = $request ->post();
			$data = array(
				'attr_name'=>$request->post('attr_name'),
				'type_id'=>$request->post('type_id'),
				'attr_type'=>$request->post('attr_type'),
				'attr_input_type'=>$request->post('attr_input_type'),
				'attr_value'=>$request->post('attr_value'),
				//'sort_order'=>$request->post('sort_order'),
				);
			//dump($data);exit;
			$re = Db::table('shop_attribute')->insert($data);
			if($re){
				$this->success('添加成功','Attribute/index');
			}else{
				$this->error('添加失败');
			}
		}
		$list = Db::table('shop_goods_type')->select();
		$this->assign('list',$list);
		return $this->fetch('Attribute/add');
	}
	public function edit(){
		$request = Request::instance();
		if($request->isPost()){
			$data = array(
				'attr_id'=>$request->post('attr_id'),
				'attr_name'=>$request->post('attr_name'),
				'type_id'=>$request->post('type_id'),
				'attr_type'=>$request->post('attr_type'),
				'attr_input_type'=>$request->post('attr_input_type'),
				'attr_value'=>$request->post('attr_value'),
				);	
			$re = Db::table('shop_attribute')->update($data);
			if(false !== $re){
				$this->success('修改成功','Attribute/index');
			}else{
				$this->error('修改失败');		
			}
		}
		$id = input('id');
		$find = Db::table('shop_attribute')->where('attr_id',$id)->find();
		if(!$find){
			$this->error('暂无数据','Attribute/index');
		}
		//dump($find);
		$list = Db::table('shop_goods_type')->select();
		$this->assign('list',$list);
		$this->assign('det',$find);
		return $this->fetch('Attribute/edit');
	}
	public function delete(){
		$id = input('id');
		$find = Db::table('shop_attribute')->where('attr_id',$id)->find();
		if($find){
			$f = Db::table('shop_goods_attr')->where('attr_id',$id)->find();
			if(!$f){
				$re = Db::table('shop_attribute')->where('attr_id',$id)->delete();
				if($re){
					$this->success('删除成功');
				}else{	
					$this->error('删除失败');
				}
			}else{
				$this->error('属性被使用中,删除失败');
			}
		}else{
			$this->error('删除失败');
		}
	}	
}
