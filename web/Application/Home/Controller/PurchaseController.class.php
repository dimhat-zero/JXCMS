<?php

namespace Home\Controller;

use Think\Controller;

class PurchaseController extends Controller{

	public function index($stock_house_id=NULL,$employee_id=NULL){
		$user = session('user');
		if($stock_house_id!=NULL){
			$condition['stock_house_id']=$stock_house_id;
		}
		if($employee_id!=NULL){
			$condition['employee_id']=$employee_id;
		}
		$PurchaseView =  D("PurchaseView");
		$count = $PurchaseView->where($condition)->count();

		//page
		$page = new \Home\Model\Page($count);//默认取pageNo
        $query['pageNo']=$page->nowPage;
        $query['totalPages']=$page->totalPages;
        $query['totalRows']=$page->totalRows;

		//进行分页查询
		$list = $PurchaseView->where($condition)->limit($page->firstRow,$page->listRows)->select();
		$this->assign("list",$list);
		$query['stock_house_id']=$stock_house_id;
		$query['employee_id']=$employee_id;
		$this->assign("query",$query);
		$this->assign('employees',M('Employee')->select());
		$this->assign('stockHouses',M('StockHouse')->select());
		$this->display();
	}

	public function add(){
		$user = session("user");
		if($user==NULL) $this->redirect("User/login");
		if(IS_GET){
			$this->assign('employees',M('Employee')->select());
			$this->assign('stockHouses',M('StockHouse')->select());
			$this->assign('products',M('Product')->select());
			$this->display();
		}else if(IS_POST){
			$flag = true;
			//添加采购主表
			$Purchase = D("Purchase");
			$Purchase->create();
			$Purchase->startTrans();//开启事务
			
			$id = $Purchase->add();
			if(!$id){
				$this->error("新增采购失败");
			}
			//添加采购项目
			$PurchaseItem = D("PurchaseItem");
			
			$itemArr = json_decode(I('post.json_items'));
			print_r($itemArr);
			foreach ($itemArr as $key => $value) {
				$PurchaseItem->create($value);
				$result = $PurchaseItem->add();
				if(!$result){
					$flag=false;
				} 
			}
			//添加库存，如果不存在则创建，如果存在则增加数量
			foreach ($itemArr as $key => $value) {
				$result = IncStockPile(I('post.stock_house_id'),$value['product_id'],$value['quantity']);
				if(!$result){
					$flag=false;
					break;
				} 
			}
			
			if($flag){
				$Purchase->rollback();
				$this->error("采购添加错误",U("index"));
			}else{
				$Purchase->commit();
				$this->success("采购成功","index");
			}
			
		}
	}


}