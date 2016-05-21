<?php

namespace Home\Controller;

use Think\Controller;

class EmployeeController extends Controller{
	
	public function index(){
		$condition['type']=1;//员工 0是老板
		$condition['status']=1;//可用，非离职
		$this->assign("list",M('Employee')->where($condition)->order('id desc')->select());
		$this->display();
	}

	public function add(){
		if(IS_GET){
			$this->display('edit');
		}else if(IS_POST){
			$Employee = D('Employee');
			if(!$Employee->create()){
				$this->error($Employee->getError());
			}
			
			$Employee->add();
			$this->success("新增成功！","index");
		}

	}

	/*
	 * 离职状态为0，不能够登录
	 * 默认为1
	 */
	public function update($id){
		if(IS_GET){
			$this->assign('vo',M('Employee')->find($id));
			$this->display('edit');
		}else if(IS_POST){
			$Employee = D('Employee');
			if(!$Employee->create()){
				$this->error($Employee->getError());
			}
			$Employee->save();
			$this->success("修改成功！",U("index"));
		}
	}

}