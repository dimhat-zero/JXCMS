<?php

namespace Home\Controller;

use Think\Controller;

class SaleController extends Controller{
	
	public function index($stock_house_id=NULL,$employee_id=NULL){
		needLogin();
		$user = session('user');
		$SaleView = D('SaleView');
		$this->assign('employees',M('Employee')->select());
		$this->assign('stockHouses',M('StockHouse')->select());
		$this->assign('products',M('Product')->select());
		if($user['type']==1){//不是老板
			$condition['employee_id']=getUserId();
		}else if($employee_id){//员工只能查看自己的销售
			$condition['employee_id']=$employee_id;
		}
		if($stock_house_id){
			$condition['stock_house_id']=$stock_house_id;
		}
		$SaleView =  D("SaleView");
		$count = $SaleView->where($condition)->count();

		//page
		$page = new \Home\Model\Page($count);//默认取pageNo
        $query['pageNo']=$page->nowPage;
        $query['totalPages']=$page->totalPages;
        $query['totalRows']=$page->totalRows;

		//进行分页查询
		$list = $SaleView->where($condition)->order('id desc')->limit($page->firstRow,$page->listRows)->select();
		$this->assign('list',$list);
		$query['stock_house_id']=$stock_house_id;
		$query['employee_id']=$employee_id;
		$this->assign("query",$query);

		$this->display();
	}

	public function detail($id){
		$this->assign("vo",D("SaleView")->find($id));
		$this->display();
	}

	/*
	 * 销售单增加，默认status=1，减少库存（可小于0）
	 */
	public function add(){
		needLogin();
		if(IS_GET){
			$this->assign('employees',M('Employee')->select());
			$this->assign('stockHouses',M('StockHouse')->select());
			$this->assign('products',M('Product')->select());
			$this->display();
		}else if(IS_POST){
			$flag = true;
			//添加采购主表
			$Sale = D("Sale");
			if(!$Sale->create()){
				$this->error($Sale->getError());
			}
			
			$Sale->startTrans();//开启事务
			
			$id = $Sale->add();
			if(!$id){
				$this->error("新增采购失败");
			}
			$SaleItem = M('SaleItem');
			$StockPile = M('StockPile');

			foreach($this->getItems() as $item){
				$item['sale_id']=$id;
				$SaleItem->save($item);
				$result = DecStockPile(I('post.stock_house_id'),$item['product_id'],$item['quantity']);
				if(!$result){
					$flag=false;
					break;
				} 
			}
			
			if($flag==false){
				$Sale->rollback();
				//$this->error("销售失败");
				$this->display("add");
			}else{
				$Sale->commit();
				//$this->display("add");
				$this->success("销售成功",U("index"));
			}
			
		}
	}

	/*
	 * 销售单作废，修改status=0，增加库存
	 */
	public function del($id){
		if(IS_GET){
			$SaleView = D('SaleView');
			$SaleItemView = D('SaleItemView');
			$this->assign('vo',$SaleView->find($id));
			$this->assign('vo_items',$SaleItemView->where("sale_id=".$id)->select());
			$this->display();
		}else if(IS_POST){
			//find sale
			$Sale= M('Sale');
			$sale = $Sale->find($id);
			$sale->status = 0;
			//find sale items
			$SaleItem = M('SaleItem');
			$saleItems = $SaleItem->where('sale_id='.$id)->select();

			$sale->startTrans();//开启事务

			foreach($saleItems as $saleItem){
				
			}
		}
	}


	/*
	 * 下面是销售项目的操作
	 */
	private function getItems($id=NULL){
		$SaleItemView = D('SaleItemView');
		if($id==NULL){
			$condition['sale_id']=array('EXP','IS NULL');
			$condition['employee_id']=getUserId();
		}else{
			$condition['sale_id']=$id;
		}
		$items = $SaleItemView->where($condition)->select();
		return $items;
	}

	//根据用户
	public function items($id=NULL){
		$user = session('user');
		if($user==NULL){
			$data['success']=false;
			$data['error']="需要登录";
			$this->ajaxReturn($data);
		}
		
		$rows = array();
		$total_price=0.0;

		foreach($this->getItems($id) as $i=>$item){
			$row['id'] = $item['id'];
			$row['cell'] = array($i+1,$item['product_name'],$item['product_spec'],$item['quantity'].$item['product_unit'],$item['unit_price'],$item['unit_price']*$item['quantity']);
			$rows[]=$row;
			$total_price +=$item['quantity']*$item['unit_price'];
		}
		$data['rows']=$rows;
		$data['success']=true;
		$data['totalPrice']=$total_price;
		//$this->display('add');
		$this->ajaxReturn($data);
	}

	public function addItem(){
		if(IS_POST){
			$SaleItem = D('SaleItem');
			if($SaleItem->create()){
				$SaleItem->add();
				$data['success']=true;
				$this->ajaxReturn($data);
			}else{
				$data['error']=$SaleItem->getError();
				$data['success']=false;
				$this->ajaxReturn($data);
			}
		}
		$data['error']="不支持的提交方式";
		$data['success']=false;
		$this->ajaxReturn($data);
	}

	public function delItem($ids){
		M('SaleItem')->delete($ids);
		$data['success']=true;
		$this->ajaxReturn($data);
	}

	public function upItem($id){
		if(IS_GET){
			$data['data']=D('SaleItemView')->find($id);
			$data['success']=true;
			$this->ajaxReturn($data);
		}else if(IS_POST){
			if($SaleItem->create()){
				$SaleItem = M('SaleItem');
				$SaleItem->add();
				$data['success']=true;
				$this->ajaxReturn($data);
			}else{
				$data['error']=$SaleItem->getError();
				$data['success']=false;
				$this->ajaxReturn($data);
			}
		}
	}

}