<?php

namespace Home\Controller

use Think\Controller

class SaleController extends Controller{
	
	public function index($stock_house_id=NULL,$employee_id=NULL){
		$user= session('user');
		if($user==NULL) $this->redirect("User/login");
		$SaleView = D('SaleView');
		if($user.type==1){//不是老板
			$condition['employee_id']=$user.id;
		}else if($employee_id){
			$condition['employee_id']=$employee_id;
		}
		if($stock_house_id){
			$condition['stock_house_id']=$stock_house_id;
		}
		
		$page=getpage($SaleView,$condition);
		$result = $SaleView->where($condition)->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('list',$result);
		$this->assign('page',$page->show());

		//添加其他信息
		$query['stock_house_id']=$stock_house_id;
		$query['employee_id']=$employee_id;
		$this->assign('query',$query);

		$this->display();
	}

	/*
	 * 销售单增加，默认status=1，减少库存（可小于0）
	 */
	public function add(){

	}

	/*
	 * 销售单作废，修改status=0，增加库存
	 */
	public function del($id){
		if(IS_GET){
			$SaleView = D('SaleView');
			$SaleDetailView = D('SaleDetailView');
			$this->assign('vo',$SaleView.find($id));
			$this->assign('vo_items',$SaleDetailView->where("sale_id=".$id)->select());
			$this->display();
		}else if(IS_POST){
			//find sale
			$Sale= M('Sale');
			$sale = $Sale.find($id);
			$sale->status = 0;
			//find sale items
			$SaleDetail = M('SaleDetail');
			$saleItems = $SaleDetail->where('sale_id='.$id)->select();

			$sale->startTrans();//开启事务

			foreach($saleItems as $saleItem){
				
			}
		}
	}

}