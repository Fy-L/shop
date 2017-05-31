<?php
namespace app\admin\controller;
use think\Request;
use think\Db;
class Type extends Base
{
	public function index(){
		$list = Db::table('shop_goods_type')->select();
		$this->assign('list',$list);
		return $this->fetch('Type/index');
	}
	public function add(){
		$request = Request::instance();
		if($request->isPost()){
			$data = $this->request->post();
			//dump($data);
			$re = Db::table('shop_goods_type')->insert($data);
			if($re){
				$this->success('添加成功','Type/index');
			}
		}
		return $this->fetch('Type/add');
	}
	public function edit(){
		$request = Request::instance();
		if($request->isPost()){
			$data = array(
				'type_id'=>$request->post('type_id'),
				'type_name'=>$request->post('type_name'),
				);	
			$re = Db::table('shop_goods_type')->update($data);
			if(false!==$re){
				$this->success('修改成功','Type/index');
			}else{
				$this->error('修改失败');
			}
		}
		$id = input('id');
		$find = Db::table('shop_goods_type')->where('type_id',$id)->find();
		if(!$find){
			$this->error('暂无资料','Type/index');
		}
		$this->assign('det',$find);
		return $this->fetch('Type/edit');
	}
	public function delete(){
		$id = input('id');
		$find = Db::table('shop_goods')->where('type_id',$id)->find();
		$find2 = Db::table('shop_attribute')->where('type_id',$id)->find();
		if($find && $find2){
			$this->error('当前类型被使用中,删除失败');
		}else{
			$r = Db::table('shop_goods_type')->where('type_id',$id)->find();
			if($r){
				$re = Db::table('shop_goods_type')->where('type_id',$id)->delete();
				if($re){
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
