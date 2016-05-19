<?php

namespace Home\Model;

use Think\Model\ViewModel;

class SaleItemViewModel extends ViewModel{
	
	public $viewFields = array(
		'SaleItem'=>array('*'),
		'Product'=>array('name'=>'product_name','unit'=>'product_unit','spec'=>'product_spec','_on'=>'SaleItem.product_id = Product.id'),
	);
}