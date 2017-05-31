<?php
namespace app\admin\controller;
use think\Request;
use think\Db;
class Goods extends Base
{
	public function index(){
		return $this->fetch('Goods/index');
	}
	public function add(){
		$request = Request::instance();
		if($request->isPost()){
			$data = array(
				'goods_sn'=>$request->post('goods_sn'),
				'goods_name'=>$request->post('goods_name'),
				'brand_id'=>$request->post('brand_id'),
				'cat_id'=>$request->post('cat_id'),
				'type_id'=>$request->post('type_id'),
				'shop_price'=>$request->post('shop_price'),
				'market_price'=>$request->post('market_price'),
				'promote_start_time'=>$request->post('promote_start_time',0,'strtotime'),
				'promote_end_time'=>$request->post('promote_end_time',0,'strtotime'),
				'goods_desc'=>$request->post('goods_desc'),
				'goods_number'=>$request->post('goods_number'),
				'is_best'=>$request->post('is_best'),
				'is_new'=>$request->post('is_new'),
				'is_hot'=>$request->post('is_hot'),
				'is_onsale'=>$request->post('is_onsale'),
				'add_time'=>time(),
				);
			$re = Db::table('shop_goods')->insert($data);
			if($re){
				$attr_ids = $request->post()['attr_id_list'];
				$attr_values = $request->post()['attr_value_list'];
				$attr_prices = $request->post()['attr_price_list'];
				$attrs = array();
				if (!empty($attr_ids)) {
					foreach ($attr_ids as $k => $v) {
						$attrs[] = array(
							'goods_id' => $re,
							'attr_id' => $v,
							'attr_value' => $attr_values[$k],
							'attr_price' => $attr_prices[$k],
						);
					}
				}
				//dump($request->post('attr_id_list'));die;
				Db::table('shop_goods_attr')->insertAll($attrs);
				$this->success('添加成功','Goods/index',1);
			}else{
				$this->error('添加失败');
			}
		}
		$list = Db::table('shop_category')->select(); 		
		$list = Category::getlist($list);
		$brand = Db::table('shop_brand')->select(); 
		$type = Db::table('shop_goods_type') ->select();
		$this->assign('type',$type);
		$this->assign('brand',$brand);
		$this->assign('list',$list);
		return $this->fetch('Goods/add');
	}
	public function edit(){
		return $this->fetch('Goods/edit');
	}
	public function delete(){
		
	}
	public function getAttr(){
		$request = Request::instance();
		$id = $request->get('type_id');
		//echo $id;
		echo $this->getForm($id);
	}
	public function getForm($id){
		$attrs = Db::table('shop_attribute')->where('type_id',$id)->select();
		//拼接字符串操作
		$res = "<table width='100%' id='attrTable'>";
		$res .= "<tbody>";
		foreach ($attrs as $attr) {
			$res .= "<tr>";
			$res .= "<td class='label'>{$attr['attr_name']}</td>";
			$res .= "<td>";
			$res .= "<input type='hidden' name='attr_id_list[]' value='".$attr['attr_id']."'>";
			switch ($attr['attr_input_type']) {
				case 0:
					# 文本框
					$res .= "<input name='attr_value_list[]' type='text' size='40'>";
					break;
				case 1:
					# 下拉列表
					$res.= "<select name='attr_value_list[]'>";
					$res .= "<option value='>请选择...</option>";
					$opts = explode(PHP_EOL, $attr['attr_value']);
					foreach ($opts as $opt) {
						$res .= "<option value='$opt'>$opt</option>";
					}
					$res .= "</select>";
					break;
				case 2 :
					#文本域
					break;
			}
			$res .= "<input type='hidden' name='attr_price_list[]' value='0'>";
			$res .= "</td>";
			$res .= "</tr>";
		}
		$res .= "</tbody>";
		$res .="</table>";

		return $res;
	}
}
