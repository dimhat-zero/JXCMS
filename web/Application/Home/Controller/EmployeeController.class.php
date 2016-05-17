<?php

namespace Home\Controller;

use Think\Controller;

class EmployeeController extends Controller{
	
	public function index(){
		$this->assign("list",M('Employee')->select());
		$this->display();
	}

	public function add(){
		if(IS_GET){
			$this->display();
		}else if(IS_POST){
			$Employee = M('Employee');
			$Employee->create();
			$Employee->add();
			$this->succes("新增成功！");
		}

	}

	/*
	 * 离职状态为0，不能够登录
	 * 默认为1
	 */
	public function update($id){
		if(IS_GET){
			$this->assign('vo',M('Employee')->find($id));
			$this->display();
		}else if(IS_POST){
			$Employee = M('Employee');
			$Employee->create();
			$Employee->save();
			$this->succes("新增成功！");
		}
	}

}