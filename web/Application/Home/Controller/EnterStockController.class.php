<?php

namespace \Home\Controller

use \Think\Controller

EnterStockController extends Controller{

	public function list($stock_house_id,$employee_id,$pageSize=10){
		$condition['stock_house_id']=$stock_house_id;
		$condition['employee_id']=$employee_id;
		$enterStock =  M("EnterStock");
		$count = $enterStock->where($condition)->count();
		$page = new \Think\Page($count,$pageSize);
		//进行分页查询
		$list = $enterStock->where($condition)->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign("list",$list);
		$this->assign("page",$page->show());
		$this->display();

	}

	public function add(){
		$user = session("user");
		if($user==NULL) $this->rediect("User/login");
		if(IS_GET){
			$this->display();
		}else if(IS_POST){
			$enterStock = D("EnterStock");
			if($enterStock->create()){
				$enterStock->startTrans();//开启事务
				$flag=false;
				$result = $enterStock->add();
				if($result){
					$detail=M("EnterStockDetail");
					$array=I("post.items");
					$t=$detail->addAll($array);
					if($t){
						$enterStock->commit();
						$flag=true;
						$this->rediect("list","入库成功");
					}
					else{
						$this->error("入库单项目添加错误",U("list"));
					}
					if(!$flag){
						$enterStock->rollback();
					}
					
				}else{
					$this->error("入库单添加错误",U("list"));
				}

								
			}else{
				$this->error($enterStock->getError());
			}
		}
	}


}