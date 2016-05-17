<?php

namespace Home\Controller

use Think\Controller

class StockHouseController extends Controller{
	
	public function index(){
		$stockHouse = M('StockHouse')->select();
		$this->assign('list',$stockHouse);
		$this->display();
	}

	public function add(){
		if(IS_GET){
			$this->display();
		}else if(IS_POST){
			$stockHouse = D('StockHouse');
			if($stockHouse->create()){
				$stockHouse->add();
				$this->rediect("添加仓库成功","list");
			}else{
				$this->error($category->getError());
			}
		}
	}

	public function update($id){
		if(IS_GET){
			$result = D('StockHouse')->find($id);
			$this->assign('stockHouse',$result);
			$this->display();
		}else if(IS_POST){
			$stockHouse = D('StockHouse');
			if($stockHouse->create()){
				$stockHouse->save();
				$this->rediect('修改成功！',"index");
			}else{
				$this->error($stockHouse->getError());
			}
		}
	}

	public function del($ids){
		M('StockHouse')->delete($ids);
		$this->rediect("删除成功！","index");
	}
}