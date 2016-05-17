<?php

namespace Home\Controller

use Think\Controller

/*
 * 仓库库存控制器
 */
class StockController extends Controller{
	
	//查看某个仓库的库存
	public function index($id){
		$StockPileView = D('StockPileView');
		$condition['stock_house_id'] = $id;
		$page = getpage($StockPileView,$condition);
		$result = $StockPileView->where($condition)->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign("list",$result);
		$this->assign("page",$pgae->show());
	}

	public function update($pile_id){
		if(IS_GET){
			$StockPileView = D('StockPileView');
			$stockPile = $StockPileView->find($pile_id);
			$this->assign("vo",$stockPile);
		}else if(IS_POST){
			$StockPile = D('StockPile');
			$StockPile->create();
			$StockPile->save();
			$this->success("更新成功！");
		}
		
	}
}