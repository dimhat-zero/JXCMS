<?php

namespace Home\Controller;

use Think\Controller;

class StockHouseController extends Controller{
	
	public function index(){
		$stockHouse = M('StockHouse')->order('id desc')->select();
		$this->assign('list',$stockHouse);
		$this->display();
	}

	public function add(){
		if(IS_GET){
			$this->display('edit');
		}else if(IS_POST){
			$stockHouse = D('StockHouse');
			if($stockHouse->create()){
				$stockHouse->add();
				$this->redirect("index");
			}else{
				$this->error($stockHouse->getError());
			}
		}
	}

	public function update($id){
		if(IS_GET){
			$result = D('StockHouse')->find($id);
			$this->assign('stockHouse',$result);
			$this->display('edit');
		}else if(IS_POST){
			$stockHouse = D('StockHouse');
			if($stockHouse->create()){
				$stockHouse->save();
				$this->redirect("index");
			}else{
				$this->error($stockHouse->getError());
			}
		}
	}

	public function del($ids){
		M('StockHouse')->delete($ids);
		$this->redirect("index");
	}
}