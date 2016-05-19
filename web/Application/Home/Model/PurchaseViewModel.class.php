<?php

namespace Home\Model;

use Think\Model\ViewModel;

class PurchaseViewModel extends ViewModel{
	public $viewFields = array(
		'Purchase' => array('*'),
		'Employee' => array('name'=>'employee_name','_on'=>'Purchase.employee_id=Employee.id'),
		'StockHouse' => array('name'=>'stock_house_name','_on'=>'Purchase.stock_house_id=StockHouse.id'),
	);

	
}