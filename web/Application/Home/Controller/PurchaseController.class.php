<?php

namespace Home\Controller;

use Think\Controller;

/*
 * 采用缓存项目到数据库的方法
 * 如果采购项目没有采购id，但是有所属用户id，那么这个项目是缓存项目。
 * 在新增采购单的时候会自动调出这种数据（防止突然掉线造成数据丢失）
 * 在正式新增采购单的时候，会修改所属用户的全部采购项目到新增的采购单下
 *
 * <p>
 * 禁止修改单子，一但增加完成，只能取消掉，不能修改
 * </p>
 */
class PurchaseController extends Controller{

	public function index($stock_house_id=NULL,$employee_id=NULL){
		needLogin();
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
		$list = $PurchaseView->where($condition)->order('id desc')->limit($page->firstRow,$page->listRows)->select();
		$this->assign("list",$list);
		$query['stock_house_id']=$stock_house_id;
		$query['employee_id']=$employee_id;
		$this->assign("query",$query);
		$this->assign('employees',M('Employee')->select());
		$this->assign('stockHouses',M('StockHouse')->select());
		$this->display();
	}

	public function detail($id){
		$this->assign("vo",D("PurchaseView")->find($id));
		//$this->assign("items",$this->getItems($id));
		$this->display();
	}

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
			$Purchase = D("Purchase");
			if(!$Purchase->create()){
				$this->error($Purchase->getError());
			}
			
			$Purchase->startTrans();//开启事务
			
			$id = $Purchase->add();
			if(!$id){
				$this->error("新增采购失败");
			}
			//添加采购项目
			//$sql = "update purchase_item set purchase_id ='%s' where purchase_id is NULL and employee_id = '%s'";
            //$result = M()->execete($sql,$id,getUserId());
			$PurchaseItem = M('PurchaseItem');
			$StockPile = M('StockPile');

			foreach($this->getItems() as $item){
				$item['purchase_id']=$id;
				$PurchaseItem->save($item);
				$result = IncStockPile(I('post.stock_house_id'),$item['product_id'],$item['quantity']);
				//print_r($result);
				if(!$result){
					$flag=false;
					break;
				} 
			}
			
			if($flag==false){
				$Purchase->rollback();
				$this->error("采购失败");
				//$this->display("add");
			}else{
				$Purchase->commit();
				$this->success("采购成功",U("index"));
				//$this->display("add");
			}
			
		}
	}


	/*
	 * 下面是采购项目的操作
	 */
	private function getItems($id=NULL){
		$PurchaseItemView = D('PurchaseItemView');
		if($id==NULL){
			$condition['purchase_id']=array('EXP','IS NULL');
			$condition['employee_id']=getUserId();
		}else{
			$condition['purchase_id']=$id;
		}
		$items = $PurchaseItemView->where($condition)->select();
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
			$PurchaseItem = D('PurchaseItem');
			if($PurchaseItem->create()){
				$PurchaseItem->add();
				$data['success']=true;
				$this->ajaxReturn($data);
			}else{
				$data['error']=$PurchaseItem->getError();
				$data['success']=false;
				$this->ajaxReturn($data);
			}
		}
		$data['error']="不支持的提交方式";
		$data['success']=false;
		$this->ajaxReturn($data);
	}

	public function delItem($ids){
		M('PurchaseItem')->delete($ids);
		$data['success']=true;
		$this->ajaxReturn($data);
	}

	//not test
	public function upItem($id){
		if(IS_GET){
			$data['data']=D('PurchaseItemView')->find($id);
			$data['success']=true;
			$this->ajaxReturn($data);
		}else if(IS_POST){
			$PurchaseItem = M('PurchaseItem');
			if($PurchaseItem->create()){
				$PurchaseItem->add();
				$data['success']=true;
				$this->ajaxReturn($data);
			}else{
				$data['error']=$PurchaseItem->getError();
				$data['success']=false;
				$this->ajaxReturn($data);
			}
		}
	}
}