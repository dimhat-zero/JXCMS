<?php

namespace Home\Controller;

use Think\Controller;

/*
 * 仓库库存控制器
 */
class StockPileController extends Controller{
	
	//查看某个仓库的库存，可按产品名称检索
	public function index($stock_house_id=NULL,$name=NULL,$category_id=Null){
		needLogin();
		$user = session('user');
		if($user['type']==0){//老板可以查看所有仓库
			if($stock_house_id!=NULL){
				$condition['stock_house_id'] = $stock_house_id;
			}
		}else{
			$condition['stock_house_id'] = $user['stock_house_id'];
		}
		if($name){
            $condition['product_name']=array('like','%'.I('get.name').'%');
        }
        if($category_id){
            $condition['category_id']=I('get.category_id');
        }
		$StockPileView = D('StockPileView');
		$count = $StockPileView->where($condition)->count();
		
		//page
		$page = new \Home\Model\Page($count);//默认取pageNo
        $query['pageNo']=$page->nowPage;
        $query['totalPages']=$page->totalPages;
        $query['totalRows']=$page->totalRows;
        $query['name']=$name;
        $query['category_id']=$category_id;
        $query['stock_house_id']=$stock_house_id;
        
		//进行分页查询
		$list = $StockPileView->where($condition)->order('id desc')->limit($page->firstRow,$page->listRows)->select();
		$this->assign("list",$list);
		$this->assign("query",$query);
		$this->assign('stockHouses',M('StockHouse')->select());
		$this->assign('categorys',M('Category')->select());
		$this->display();
	}

	//增加库存
	public function add(){
		if(IS_GET){
			$this->assign("stockHouses",M('StockHouse')->select());
			$this->assign("products",M('Product')->select());
			$this->display();
		}else if(IS_POST){
			$StockPile = M('StockPile');
			if($StockPile->create()){
				$result = IncStockPile(I('post.stock_house_id'),I('post.product_id'),I('post.quantity'));
				$this->success("新增库存成功",U("index"));
			}else{
				$this->error($StockPile->getError());
			}
		}
	}

	public function del($ids){
		M('StockPile')->delete($ids);
		$this->success("删除成功",U("index"));
	}

	public function update($id){
		if(IS_GET){
			$StockPileView = D('StockPileView');
			$stockPile = $StockPileView->find($id);
			$this->assign("vo",$stockPile);
			$this->display('edit');
		}else if(IS_POST){
			//$id = I('post.id');
			//$quantity = I('post.quantity');
			$rules = array(
				array('quantity','/^(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$/',"采购数量格式不正确",0,'regex'),
			);
			$StockPile = M('StockPile');
			if(!$StockPile->validate($rules)->create()){
				$this->error($StockPile->getError());
			}
			//$obj = $StockPile->find($id);
			//$obj['quantity']=$quantity;
			$StockPile->save();
			$this->success("更新成功！");
		}
	}

}