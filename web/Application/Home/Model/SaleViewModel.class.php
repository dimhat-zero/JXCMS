<?php

namespace Home\Model;

use Think\Model\ViewModel;

class SaleViewModel extends ViewModel{
	
	public $viewFields = array(
		'Sale' => array('*'),
		'Employee' => array('name'=>'employee_name','_on'=>'Sale.employee_id=Employee.id'),
		'StockHouse' => array('name'=>'stock_house_name','_on'=>'Sale.stock_house_id=StockHouse.id'),
	);
}